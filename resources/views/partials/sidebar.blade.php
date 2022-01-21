<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    <a class="sidebar-brand brand-logo" href="{{url('/dashboard')}}"><h1 class="main-logo">A R P I T</h1></a>
    <a class="sidebar-brand brand-logo-mini" href="{{url('/dashboard')}}"><h1 class="main-logo"> A </h1></a>
  </div>
  <ul class="nav">
    <li class="nav-item profile">
      <div class="profile-desc">
        <div class="profile-pic">
          <div class="count-indicator">
            <img class="img-xs rounded-circle " src="{{ asset('assets/images/faces/face15.jpg')}}" alt="">
            <span class="count bg-success"></span>
          </div>
          <div class="profile-name">
            <h5 class="mb-0 font-weight-normal">{{Auth::user()->name}}</h5>
            <span>{{Auth::user()->email}}</span>
          </div>
        </div>
        
      </div>
    </li>
    <li class="nav-item nav-category">
      <span class="nav-link">Navigation</span>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="{{ url('/dashboard') }}">
        <span class="menu-icon">
          <i class="mdi mdi-speedometer"></i>
        </span>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-icon">
          <i class="mdi mdi-file-document-box"></i>
        </span>
        <span class="menu-title">Products</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ url('/product/add') }}">Product (New)</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ url('/product') }}">Products Details</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ url('/product/trash/{id}') }}">Trash Products</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic1">
        <span class="menu-icon">
          <i class="mdi mdi-playlist-play"></i>
        </span>
        <span class="menu-title">Category</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic1">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ url('/category') }}">Categories (New)</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ url('/category_trash') }}">Trash Category</a></li>
          {{-- <li class="nav-item"> <a class="nav-link" href="{{ url('/edit_category/{id}') }}"> &nbsp; </a></li> --}}
       </ul>
      </div>
    </li>


    <li class="nav-item menu-items">
      <a class="nav-link" href="{{ url('users')}}">
        <span class="menu-icon">
          <i class="mdi mdi-contacts"></i>
        </span>
        <span class="menu-title">Users</span>
      </a>
    </li>
    
    <li class="nav-item menu-items">
      <a class="nav-link" href="#">
        <span class="menu-icon">
          <i class="mdi mdi-file-document-box"></i>
        </span>
        <span class="menu-title">Documentation</span>
      </a>
    </li>
  </ul>
</nav>