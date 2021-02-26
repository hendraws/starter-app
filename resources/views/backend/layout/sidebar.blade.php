 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('/dist/img/AdminLTELogo.png')}}"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">My Blog</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-fw  fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>  
          </li>
          
          <li class="nav-header">CONTENT</li>
          <li class="nav-item has-treeview">
            <a href="{{action('PostController@index')}}" class="nav-link {{ (request()->segment(1) == 'post') ? 'active' : '' }}">
              <i class="nav-icon fas fa-fw fa-file-alt"></i>
              <p>
                Post
              </p>
            </a>  
          </li>
          <li class="nav-item has-treeview">
            <a href="{{action('CategoryController@index')}}" class="nav-link {{ (request()->segment(1) == 'category') ? 'active' : '' }}">
              <i class="nav-icon fas fa-fw fa-list-ul"></i>
              <p>
                Category
              </p>
            </a>  
          </li>
          <li class="nav-item has-treeview">
            <a href="{{action('TagController@index')}}" class="nav-link {{ (request()->segment(1) == 'tags') ? 'active' : '' }}">
              <i class="nav-icon fas fa-fw fa-tags"></i>
              <p>
                Tags
              </p>
            </a>  
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
