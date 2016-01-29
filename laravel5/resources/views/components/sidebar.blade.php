<!-- Sidebar -->
<div class="sidebar">
   <div class="sidebar-dropdown"><a href="#">Navigation</a></div>
   <!--- Sidebar navigation -->
   <!-- If the main navigation has sub navigation, then add the class "has_sub" to "li" of main navigation. -->
   <ul id="nav">
      <!-- Main menu with font awesome icon -->
      <li class="open">
         <a href="/"><i class="fa fa-home"></i> Dashboard</a>
      </li>
      <li class="has_sub">
         <a href="#"><i class="fa fa-upload"></i> Upload <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
         <ul>
            <li><a href="{{ url('create-folder') }}">Create Folder</a></li>
            <li><a href="{{ url('create-file') }}">Upload File</a></li>
         </ul>
      </li>
      <li class="has_sub">
         <a href="#"><i class="fa fa-list-alt"></i> Folders  <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
         <ul>
            @foreach($folders as $folder)
               <li><a href="/view-folder/{{ $folder->id }}">{{$folder->name}}</a></li>
            @endforeach
         </ul>
      </li>
      <li><a href="#"><i class="fa fa-users"></i> Shared With Me</a></li>
      <li><a href="{{ url('logout') }}"><i class="fa fa-power-off"></i> Logout</a></li>
   </ul>
</div>
<!-- Sidebar ends -->