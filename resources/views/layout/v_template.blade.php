<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ITJ | @yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-master/') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-master/') }}/dist/css/adminlte.min.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="{{ asset('AdminLTE-master/') }}/dist/img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="User Image">
          <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>

              
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-primary">
            <img src="{{ asset('AdminLTE-master/') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">

            <h6>
              {{ Auth::user()->name }} - {{ Auth::user()->email }}
            </h6>
              @if (auth()->user()->id_divisi == 1)
                  <small>Inventory - </small>
              @elseif (auth()->user()->id_divisi == 2)
                  <small>Marketing - </small>
              @elseif(auth()->user()->id_divisi == 3)
                  <small>Top Level Management - </small>
              @endif
              @if (auth()->user()->id_jabatan == 1)
                  <small>Kepala Gudang</small>
              @elseif (auth()->user()->id_jabatan == 2)
                  <small>Staff Gudang</small>
              @elseif(auth()->user()->id_jabatan == 3)
                  <small>Kepala Marketing</small>
              @elseif(auth()->user()->id_jabatan == 4)
                  <small>Staff Marketing</small>
              @elseif(auth()->user()->id_jabatan == 5)
                  <small>Top Level Management</small>
              @endif
          </li>
          <!-- Menu Body -->

          <!-- Menu Footer-->
              <li class="user-footer">
                <center>
                <table border="0">
                  <td>
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                  </td>
                  <td>
                    <div class="pull-right">
                      <form id="logout-form" action="{{ route('logout') }}" method="POST">
                      @csrf
                      
                        <button type="submit" class="btn btn-danger btn-flat">Log out</button>
                      </form>
                    </div>

                
                  </td>
                </table>
                </center>
              </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    {{-- <a href="{{ asset('AdminLTE-master/') }}/index3.html" class="brand-link">
      <img src="{{ asset('AdminLTE-master/') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a> --}}

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('AdminLTE-master/') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            <a  class="d-block">
                
              @if (auth()->user()->id_divisi == 1)
                  <small>Inventory - </small>
              @elseif (auth()->user()->id_divisi == 2)
                  <small>Marketing - </small>
              @elseif(auth()->user()->id_divisi == 3)
                  <small>Top Level Management - </small>
              @endif
              @if (auth()->user()->id_jabatan == 1)
                  <small>Kepala Gudang</small>
              @elseif (auth()->user()->id_jabatan == 2)
                  <small>Staff Gudang</small>
              @elseif(auth()->user()->id_jabatan == 3)
                  <small>Kepala Marketing</small>
              @elseif(auth()->user()->id_jabatan == 4)
                  <small>Staff Marketing</small>
              @elseif(auth()->user()->id_jabatan == 5)
                  <small>Top Level Management</small>
              @endif
                
                
            </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        @include('layout.v_nav')
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    

    <section class="content-header">
        @yield('content')
    </section>


    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('AdminLTE-master/') }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('AdminLTE-master/') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE-master/') }}/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('AdminLTE-master/') }}/dist/js/demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>
</html>
