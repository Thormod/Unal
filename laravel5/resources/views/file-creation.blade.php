@extends('app')
@section('content')
<style type="text/css">
   .image-preview-input {
   position: relative;
   overflow: hidden;
   margin: 0px;    
   color: #333;
   background-color: #fff;
   border-color: #ccc;    
   }
   .image-preview-input input[type=file] {
   position: absolute;
   top: 0;
   right: 0;
   margin: 0;
   padding: 0;
   font-size: 20px;
   cursor: pointer;
   opacity: 0;
   filter: alpha(opacity=0);
   }
   .image-preview-input-title {
   margin-left:2px;
   }
</style>
<div class="main-content">
<!-- Sidebar -->
@include('components.sidebar')
<!-- Main bar -->
<div class="mainbar">
   <!-- Page heading -->
   <div class="page-head">
      <legend class="pull-left"><i class="fa fa-home"></i> Upload/File Upload</legend>
      <!-- Breadcrumb -->
      <div class="bread-crumb pull-right">
         <a href="index.html"><i class="fa fa-home"></i></a> 
         <!-- Divider -->
         <span class="divider">/</span> 
         <a href="#" class="bread-current">Upload/File Upload</a>
      </div>
      <div class="clearfix"></div>
   </div>
   <!-- Page heading ends -->
   <!-- Matter -->
   <div class="matter">
      <div class="container">
         @if (count($errors) > 0)
         <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
               @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
               @endforeach
            </ul>
         </div>
         @endif

         <form class="form" role="form" class="form" method="POST"
            action="{{ url('create-file/save') }}"
            enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
              <label>File (select one):</label>
              <br>
              <br>
              <div class="input-group image-preview">
               <input type="text" class="form-control image-preview-filename" disabled="disabled">
               <span class="input-group-btn">
                  
                  <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                  <span class="glyphicon glyphicon-remove"></span> Clear
                  </button>
                 
                  <div class="btn btn-default image-preview-input">
                     <span class="glyphicon glyphicon-folder-open"></span>
                     <span class="image-preview-input-title">Browse</span>
                     <input type="file" accept="application/pdf, application/txt" id="file_input" name="file_input"/>
                  </div>
               </span>
            </div>
            </div>
            
            <div class="form-group">
               <label for="sel1">Container Folder:</label>
               <br>
               <br>
               <select class="form-control" id="sel1" name="sel1">
                  @foreach($folders as $folder)
                  <option value="{{$folder->id}}">{{ $folder->name }}</option>
                  @endforeach
               </select>
            </div>
            <div class="form-group">
               <label for="sel2">File Type:</label>
               <br>
               <br>
               <select class="form-control" id="sel2" name="sel2">
                  <option>Initial</option>
                  <option>Pre-processed</option>
                  <option>Retoric CROM Document</option>
                  <option>Controlled Speech</option>
               </select>
            </div>
             <div class="form-group">
            <label>Name</label>
            <br>
            <br>
              <input type="text" placeholder="File name" class="form-control"
              id="file_nickname"
              name="file_nickname"
              value="{{ old('file_nickname') }}">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
         </form>
      </div>
      <!-- /Mainbar -->
   </div>
</div>
@endsection