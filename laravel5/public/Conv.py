__author__ = 'Johnathan Calle'
"""Librerías para Python 3.+"""

"""Librerías para preparar los PDF en su última versión"""
from pdfminer.pdfparser import PDFParser, PDFDocument
from pdfminer.pdfinterp import PDFResourceManager, PDFPageInterpreter
from pdfminer.converter import PDFPageAggregator
from pdfminer.layout import LAParams, LTTextBox, LTTextLine

"""Librerías preparar los .Docx en su última versión"""
try:
    from xml.etree.cElementTree import XML
except ImportError:
    from xml.etree.ElementTree import XML
import zipfile

"""Librerías procesamiento lenguaje natural en su última versión"""
import nltk
from nltk.tokenize import RegexpTokenizer
from nltk.corpus import stopwords
import re

"""Librería web"""
import cherrypy



WORD_NAMESPACE = '{http://schemas.openxmlformats.org/wordprocessingml/2006/main}'
PARA = WORD_NAMESPACE + 'p'
TEXT = WORD_NAMESPACE + 't'
#cherrypy.config.update({'server.socket_port': 3030})

class Preprocess(object):


    # Reducida
    @cherrypy.expose
    def pre_process(self,sentence):
        """Se procesa línea a línea extraída de las funciones de preparación (PDF y Docx)"""

        sentence = sentence.lower()
        tokenizer = RegexpTokenizer(r'\w+')
        tokens = tokenizer.tokenize(sentence)
        stop_words = stopwords.words('english')

        filtered_words = [w for w in tokens if not w in stop_words and len(w) > 2]
        porter = nltk.PorterStemmer()
        stemmed = [porter.stem(token) for token in filtered_words]
        lmtzr = nltk.stem.wordnet.WordNetLemmatizer()
        lemmatized = [lmtzr.lemmatize(token) for token in stemmed]

        #Elementos adicionales a eliminar
        otros = re.compile(r'[-.?!,":;()|0-9]')
        final=[]

        for word in lemmatized:
            word = otros.sub("", word)
            final.append(word)

        return " ".join(final)

    @cherrypy.expose
    def prepare_pdf(self,source):
        """Captura el PDF, extrae textos, arregla palabras partidas y divide por párrafos/líneas para enviar a preprocess"""

        fp = open(source, 'rb')
        parser = PDFParser(fp)
        doc = PDFDocument()
        parser.set_document(doc)
        doc.set_parser(parser)
        doc.initialize('')

        fp.close()
        rsrcmgr = PDFResourceManager()
        laparams = LAParams()
        device = PDFPageAggregator(rsrcmgr, laparams=laparams)
        interpreter = PDFPageInterpreter(rsrcmgr, device)
        output = ''+str(source[:-4])+'.txt'
        t = open(output,'wb')

        parrafos = []

        # Process each page contained in the document.
        for page in doc.get_pages():
            interpreter.process_page(page)
            layout = device.get_result()

            for lt_obj in layout:

                if isinstance(lt_obj, LTTextBox) or isinstance(lt_obj, LTTextLine):
                    del (parrafos[:])
                    t.write(b'\n')
                    cadena = lt_obj.get_text()

                    if (cadena == "-\n"):
                        cadena = " "

                    cadena2 = cadena.splitlines(cadena.count('\n'))

                    p = 0
                    cadena2.reverse()

                    for i in cadena2:

                        if ("-\n" in i):
                            if (i.startswith("-")):
                                i = ":)"
                                cadena2[p] = ":)"

                            else:
                                i = i[:-2] + cadena2[p - 1]
                                cadena2[p - 1] = "*-*"
                                cadena2[p] = i
                        p += 1

                    parrafos = [i for i in reversed(cadena2) if not i.startswith("*-*")]

                    for i in parrafos:
                        aux = self.pre_process(i)

                        if (aux == " " or aux == ""):
                            continue
                        else:
                            t.write(aux.encode('utf-8'))
                            t.write(b'\n')
        return output

    @cherrypy.expose
    def prepare_docx(self,source):
        """Captura el Docx, extrae textos, arregla palabras partidas y divide por párrafos/líneas para enviar a preprocess"""
        document = zipfile.ZipFile(source)
        xml_content = document.read('word/document.xml')
        document.close()
        tree = XML(xml_content)
        output = ''+str(source[:-5])+'_txt.txt'
        t = open(output,'wb')
        paragraphs = []
        for paragraph in tree.getiterator(PARA):
            texts = [node.text
                     for node in paragraph.getiterator(TEXT)
                     if node.text]

            if (texts!=[] and texts and texts!=" " and texts !=""):
                t.write(self.pre_process(''.join(texts)).encode('utf-8'))
                t.write(b'\n')
            else:
                t.write(b'\n')

        t.close()

        return output

    @cherrypy.expose
    def start(self,path):
        """Define función a ejecutar dependiendo de la extensión del archivo"""
        if (path[-5:] == '.docx'):
            output = self.prepare_docx(path)
        elif (path[-4:] == '.pdf'):
            output = self.prepare_pdf(path)

        return output


if __name__ == '__main__':
    cherrypy.quickstart(Preprocess())
    #a = Preprocess()
    #a.start('file2.pdf')