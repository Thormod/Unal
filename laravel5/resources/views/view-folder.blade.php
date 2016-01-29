@extends('app')

@section('content')

<div class="main-content">
   <!-- Sidebar -->
   @include('components.sidebar')
   <!-- Main bar -->
   <div class="mainbar">
      <!-- Page heading -->
      <div class="page-head" >
         <h2 class="pull-left"><i class="fa fa-home"></i> 
          "{{ $folder->name }}" Folder
          </h2>
         <!-- Breadcrumb -->
         <div class="bread-crumb pull-right">
            <a href="index.html"><i class="fa fa-home"></i></a> 
            <!-- Divider -->
            <span class="divider">/</span> 
            <a href="#" class="bread-current">"{{ $folder->name }}" Folder</a>
         </div>
         <div class="clearfix"></div>
      </div>
      <!-- Page heading ends -->
      <!-- Matter -->
      <div class="matter">
        <ul class="nav nav-justified">
            <li class="active"><a href="#" id="#window-but">Home</a></li>
          </ul>
         <div class="container">
          
          <div class="row">
            @foreach($files as $file)
            <div class="col-md-2" style="margin-top: 10px;" onclick="loadFile( {{ $file->id }} , '{{ $file->file_path }}')">
              <span class="file f_html"></span>
              <h5>{{ $file->file_nickname}}[{{ $file->file_type }}].txt</h5>
            </div>
            @endforeach
          </div>

          <div id="draggable" class="ui-widget-content" style="border: 0px;">
               
         </div>          
      </div>

   </div>
   <!-- /Mainbar -->
</div>


<script type="text/javascript">

$( document ).ready(function() {
   //$("#window").hide();
   $( "#draggable" ).draggable({
      containment: '#window-container',
      scroll: false
  });
});

/*$("#minimize").on('click', function() {
  $("#window").hide();
  $("#window-but").css('visibility', 'visible');
});

$("#window-but").on('click',function() {
  $("#window").show();
  $("#window-but").css('visibility', 'hidden');
});

$("#resize").on('click', function() {
    console.log($("#window").css('width'));
    console.log($(window).width());
    if($("#window").width() == $(window).width()){
        $("#window").css('width', '600px');
    }else{
        $("#window").css('left', '0px');
        $("#window").css('width', '100%');
    }
});*/



function loadFile(fileId, filePath) {
    $('html').css('padding','0');
    $( "#draggable" ).append('<div id="window'+fileId+'" class="resize window"><form method="post" action="action.php"><input type="text" style="display: none;" value="test.txt" id="file-name" name="file-name"/><div id="buttons"><a href="#" id="minimize"></a><a href="#" id="resize"></a><a href="#" id="close" onclick="close()"></a></div><div id="title">Notepad</div><textarea id="edit3" name="edit3" style="resize: none;"></textarea><input type="submit" class="btn btn-primary pull-right" style="margin: 4px;" value="Save"/></form></div>');
    
    jQuery.get('/'+filePath, function(data) {
      $('#edit3').append(data);
    });
}
  $(function() {
  $( ".resize" ).resizable();
  });
$("#close").on('click', function() {
    $(".window").hide();
});


function saveFile(){
    alert($("#edit3").text());
}



</script>




@endsection
