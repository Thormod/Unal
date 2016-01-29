@extends('app')

@section('content')

<div class="main-content">
   <!-- Sidebar -->
   @include('components.sidebar')
   <!-- Main bar -->
   <div class="mainbar">
      <!-- Page heading -->

      <div class="page-head">
         <legend class="pull-left"><i class="fa fa-home"></i> Upload/Folder Creation</legend>
         <!-- Breadcrumb -->
         <div class="bread-crumb pull-right">
            <a href="index.html"><i class="fa fa-home"></i></a> 
            <!-- Divider -->
            <span class="divider">/</span> 
            <a href="#" class="bread-current">Upload/Folder Creation</a>
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

    
      <form class="form-horizontal" role="form" class="form" method="POST"
      action="{{ url('create-folder/save') }}">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <fieldset>

          <!-- Form Name -->
          <legend>Folder Details</legend>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Name</label>
            <div class="col-sm-8">
              <input type="text" placeholder="Folder name" class="form-control"
              id="folder_name"
              name="folder_name">
            </div>

            <button type="submit" class="btn btn-primary">Save</button>

          </div>

        </fieldset>
      </form>

  
     
   </div>
   <!-- /Mainbar -->
</div>
</div>

@endsection