  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
          </li>
      </ul>

      <ul class="navbar-nav ml-auto">
          <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
              <i class="far fa-user"></i>
              {{auth()->user()->name}}
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
              <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="nav-icon fa fa-power-off"></i> Logout
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-lock"></i> Change Password
              </a>
          </div>

      </ul>

      <!-- SEARCH FORM -->

      <!-- Right navbar links -->
  </nav>
  <!-- /.navbar -->
