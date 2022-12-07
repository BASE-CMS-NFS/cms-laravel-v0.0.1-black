<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
      <a class="sidebar-brand brand-logo" href="{{url('dashboard')}}"><img src="{{url('assets/images/logo.png')}}" alt="logo" /></a>
      <a class="sidebar-brand brand-logo-mini" href="{{url('dashboard')}}"><img src="{{url('assets/images/logo-mini.png')}}" alt="logo" /></a>
    </div>
    <ul class="nav">
      <li class="nav-item profile">
        <div class="profile-desc">
          <div class="profile-pic">
            <div class="count-indicator">
              <img class="img-xs rounded-circle " src="{{url('assets/images/faces/profile.png')}}" alt="">
              <span class="count bg-success"></span>
            </div>
            <div class="profile-name">
              <h5 class="mb-0 font-weight-normal">{{Session::get('name')}}</h5>
              <span>Gold Member</span>
            </div>
          </div>
          <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
          <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
            <a href="#" class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-settings text-primary"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-onepassword  text-info"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-calendar-today text-success"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
              </div>
            </a>
          </div>
        </div>
      </li>
      <li class="nav-item nav-category">
        <span class="nav-link">Navigation</span>
      </li>

      @auth
        <li class="nav-item menu-items @if($link=='dashboard') nav-active @endif">
          <a class="nav-link" href="{{url('dashboard')}}">
            <span class="menu-icon">
              <i class="mdi mdi-speedometer"></i>
            </span>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>

        
        @foreach (Nfs::menu(Session::get('id')) as $menu_access)

            @php
              $sub = Nfs::submenuSidebar(Session::get('id'),$menu_access->cms_menus_id);
            @endphp

            @if(count($sub) == 0)
          
              <li class="nav-item menu-items @if($link==$menu_access->url) nav-active @endif">
                <a class="nav-link" href="{{url($menu_access->url.'/'.Nfs::Encrypt($menu_access->cms_menus_id))}}">
                  <span class="menu-icon">
                    <i class="mdi {{$menu_access->icon}}"></i>
                  </span>
                  <span class="menu-title">{{$menu_access->name}}</span>
                </a>
              </li>

            @else

            <li class="nav-item menu-items">
              <a class="nav-link" data-toggle="collapse" href="#submenu{{$menu_access->cms_menus_id}}" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-icon">
                  <i class="mdi {{$menu_access->icon}}"></i>
                </span>
                <span class="menu-title">{{$menu_access->name}}</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="submenu{{$menu_access->cms_menus_id}}">
                <ul class="nav flex-column sub-menu">

                  @foreach($sub as $submenu)
                    <li class="nav-item @if($link==$submenu->url) nav-active @endif"> 
                      <a class="nav-link" href="{{url($submenu->url.'/'.Nfs::Encrypt($submenu->cms_menus_id))}}">
                          <span class="menu-icon">
                            <i class="mdi {{$submenu->icon}}"></i>
                          </span>
                          <span class="menu-title">{{$submenu->name}}</span>
                      </a>
                    </li>
                  @endforeach

                </ul>
              </div>
            </li>

            @endif
            
        @endforeach

      @endauth

      @if(Session::get('cms_role_id') ==1 or Session::get('cms_role_id') ==2 )
      @auth
      <li class="nav-item nav-category">
        <span class="nav-link">Panel Admin</span>
      </li>

      <li class="nav-item menu-items @if($link=='cms_role') nav-active @endif">
        <a class="nav-link" href="{{url('admin/role')}}">
          <span class="menu-icon">
            <i class="mdi mdi-key"></i>
          </span>
          <span class="menu-title">Roles Management</span>
        </a>
      </li>

      <li class="nav-item menu-items @if($link=='users') nav-active @endif">
        <a class="nav-link" href="{{url('admin/users')}}">
          <span class="menu-icon">
            <i class="mdi mdi-account-multiple"></i>
          </span>
          <span class="menu-title">Users Management</span>
        </a>
      </li>

      <li class="nav-item menu-items @if($link=='cms_settings') nav-active @endif">
        <a class="nav-link" href="{{url('admin/settings')}}">
          <span class="menu-icon">
            <i class="mdi mdi-widgets"></i>
          </span>
          <span class="menu-title">Settings</span>
        </a>
      </li>

      <li class="nav-item menu-items @if($link=='cms_logs') nav-active @endif">
        <a class="nav-link" href="{{url('admin/logs')}}">
          <span class="menu-icon">
            <i class="mdi mdi-flag-outline"></i>
          </span>
          <span class="menu-title">Log Users Access</span>
        </a>
      </li>
      @endauth
      @endif


      @if(Session::get('cms_role_id') ==1)
      @auth
        <li class="nav-item nav-category">
          <span class="nav-link">Panel Superadmin</span>
        </li>

        <li class="nav-item menu-items @if($link=='cms_menus') nav-active @endif">
          <a class="nav-link" href="{{url('admin/menus')}}">
            <span class="menu-icon">
              <i class="mdi mdi-format-list-bulleted-type"></i>
            </span>
            <span class="menu-title">Menu Management</span>
          </a>
        </li>

        <li class="nav-item menu-items @if($link=='cms_modules') nav-active @endif">
          <a class="nav-link" href="{{url('admin/modules')}}">
            <span class="menu-icon">
              <i class="mdi mdi-code-not-equal-variant"></i>
            </span>
            <span class="menu-title">Module Generator</span>
          </a>
        </li>

        <li class="nav-item menu-items @if($link=='cms_emails') nav-active @endif">
          <a class="nav-link" href="{{url('admin/emails')}}">
            <span class="menu-icon">
              <i class="mdi mdi-code-not-equal-variant"></i>
            </span>
            <span class="menu-title">Email Templates</span>
          </a>
        </li>

        <li class="nav-item menu-items @if($link=='cms_document') nav-active @endif">
          <a class="nav-link" href="{{url('admin/document')}}">
            <span class="menu-icon">
              <i class="mdi mdi-file-document-box"></i>
            </span>
            <span class="menu-title">Documentation</span>
          </a>
        </li>
      @endauth
      @endif

    </ul>
  </nav>