@extends('app')
@section('content')
<style type="text/css">
   a{color: #437eba;}
</style>
<div class="main-content">
   <!-- Sidebar -->
   @include('components.sidebar')
   <!-- Main bar -->
   <div class="mainbar">
      <!-- Page heading -->
      <div class="page-head">
         <h2 class="pull-left"><i class="fa fa-home"></i> 
            {{ Auth::user()->name }}
         </h2>
         <!-- Breadcrumb -->
         <div class="bread-crumb pull-right">
            <a href="index.html"><i class="fa fa-home"></i></a> 
            <!-- Divider -->
            <span class="divider">/</span> 
            <a href="#" class="bread-current">Dashboard</a>
         </div>
         <div class="clearfix"></div>
      </div>
      <!-- Page heading ends -->
      <!-- Matter -->
      <div class="matter">
         <div class="container">
            <div class="row">
               @foreach($folders as $folder)
               
               <div class="col-md-2 context" style="margin-top: 10px;">
                  <table>
                     <td>
                        <div class="folder" onclick="window.open('/view-folder/{{$folder->id}}', '_blank');"><i class="fa fa-cogs"></i></div>
                        <h5>{{ $folder->name }}</h5>
                     </td>
                     <td>
                        <div class='a_menu' style="display: none; position: absolute; padding: 5px;">
                           <ul style="margin-top: -50px;">
                              <li>
                                <a href="#" data-toggle="tooltip" data-placement="right" title="Delete">
                                <div data-toggle="modal" data-target="#myModal{{$folder->name}}">
                                <i class="fa fa-trash fa-2x"></i></a>
                                </div>
                              </li>
                              <li style="margin-top: 10px;">
                                <a href="#" data-toggle="tooltip" data-placement="right" title="Share">
                                <i class="fa fa-users fa-lg"></i></a>
                              </li>
                           </ul>
                        </div>
                     </td>
                  </table>
               </div>

               @endforeach
            </div>
         </div>
      </div>
   </div>
   <!-- /Mainbar -->
</div>


@foreach($folders as $folder)
   <!-- Modal -->
   <div id="myModal{{$folder->name}}" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Alert!</h4>
            </div>
            <div class="modal-body">
               <p>¿Do you really want to delete "{{$folder->name}}" folder with all his content?</p>
            </div>
            <div class="modal-footer">
               <input type="button" class="btn btn-default" onclick="location.href='{{ url('create-folder/delete/' . $folder->id) }}';" value="Accept" />
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
@endforeach
@endsection