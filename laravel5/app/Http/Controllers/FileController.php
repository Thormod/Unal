<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Folder;
use App\File;

class FileController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$folders = Folder::where('created_by', Auth::user()->id)->get();

		return view('file-creation')
		->with('folders',$folders);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//
		while(!is_uploaded_file($_FILES['file_input']['tmp_name'])){
			$clave = ini_get("session.upload_progress.prefix") . $_POST[ini_get("session.upload_progress.name")];
			var_dump($_SESSION[$clave]);
        };
		//Validate the Request through the validation rules
        $validator = Validator::make($request->all(),[
            'file_input' => 'required',
            'file_nickname' => 'required|min:5',
        ]);

        //Take actions when the validation has failed
        if($validator->fails()){
            return redirect('create-file')
                ->withErrors($validator)
                ->withInput();
        }

		$file_created_by = Auth::user()->id;
		$file_type = $_POST['sel2'];
		$folder_id = $_POST['sel1'];
		$file_nickname = $request->input('file_nickname');

		$target_dir = "folders";
		$target_dir .= "/";
		$target_dir .= $file_created_by;
		$target_dir .= "/";
		$target_dir .= $folder_id;

		$file_size = $_FILES['file_input']['size'];
		$file_mime = $_FILES['file_input']['type'];
		$tmp_name = $_FILES['file_input']['tmp_name'];
		$name = $_FILES['file_input']['name'];
        $filename = uniqid() . $name;
		$file_path = $target_dir . '/' . $filename;

		move_uploaded_file($tmp_name, $target_dir.'/'.$filename);
		
		if($file_mime == 'application/pdf'){
			$data = file_get_contents('http://localhost:8080/start?path='.$file_path);
			$filename = $data;
			$file_mime = 'application/txt';
			unlink(public_path($file_path));
			$file_path = $target_dir . '/' .$filename;
		}
		
		$folder = Folder::find($folder_id);
		$file = $folder->files()->create([
			'folder_id' => $folder_id,
			'file_name' => $filename,
			'file_type' => $file_type,
			'file_nickname' => $file_nickname,
			'file_size' => $file_size,
			'file_mime' => $file_mime,
			'file_path' => $file_path,
			'created_by'=> $file_created_by, 
		]);

		return redirect()->action('HomeController@index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
