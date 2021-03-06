
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="shortcut icon" type="image/png" href="img/domain.png"/>
  <title>GetProgrammer</title>
  <link rel="stylesheet" href="/css/app.css">
  <link rel="stylesheet" href="/css/global.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar">
          </button>
        </div>
      </div>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
      <img src="./img/domain.png" alt="GetProgrammer Logo" class="brand-image2 img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">GetProgrammer</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="./img/boy.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <router-link to="/dashboard" class="nav-link">
              <i class="fas fa-tachometer-alt"></i>&nbsp;
              <p>
                Dashboard
              </p>
            </router-link>
          </li>
          <li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link">
              <i class="fas fa-cog"></i>&nbsp;
              <p>
                Management
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/users" class="nav-link">
                  <i class="fa fa-users nav-icon"></i>&nbsp;
                  <p>Users</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/admin-settings" class="nav-link">
                  <i class="fas fa-cogs"></i>&nbsp;
                  <p>Admin Settings</p>
                </router-link>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <router-link to="/profile" class="nav-link">
              <i class="fas fa-user-alt"></i>&nbsp;
              <p>
                Profile
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="nav-link">
                <i class="fas fa-power-off"></i>&nbsp;
                <p>
                  Logout
                </p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper">
    <div class="content">
      <div class="container-fluid">
          <router-view></router-view>
          <vue-progress-bar></vue-progress-bar>
      </div>
    </div>
  </div>

  <footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <strong>Copyright &copy; 2014-2018 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<script src="/js/app.js"></script>
</body>
</html>
