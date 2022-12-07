<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{Nfs::app()}}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{url('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{url('assets/vendors/sweetalert2/sweetalert2.min.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{url('assets/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{url('web/assets/img/favicons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{url('web/assets/img/favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('web/assets/img/favicons/favicon-16x16.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{url('web/assets/img/favicons/favicon.ico')}}">
    <style>
      .card{
       border-radius: 10px !important;
      }
   </style>
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">

            <div class="card col-lg-4 mx-auto">
              <div class="card-body px-5 py-5">

                @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                @endif

              @if(session()->has('error'))

                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{session('error')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

              @endif

              @if(session()->has('success'))

                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>{{session('success')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

              @endif

                <h3 class="card-title text-left mb-3">Sign-In <a href="{{url('/')}}" style="color: orangered">{{Nfs::app()}}</a></h3>
                <form method="POST" action="{{url('sign-in')}}">
                  @csrf
                  <div class="form-group">
                    <label>email *</label>
                    <input type="email" name="email" id="email" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Password *</label>
                    <input type="password" name="password" id="password" class="form-control p_input">
                  </div>
                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input"> Remember me </label>
                    </div>
                    <a href="{{url('forget')}}" class="forgot-pass">Forgot password</a>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
                  </div>
                  <p class="sign-up">Don't have an Account?<a href="{{url('register')}}"> Sign Up</a></p>
                </form>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{url('assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <script src="{{url('assets/vendors/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{url('assets/js/off-canvas.js')}}"></script>
    <script src="{{url('assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{url('assets/js/misc.js')}}"></script>
    <script src="{{url('assets/js/settings.js')}}"></script>
    <script src="{{url('assets/js/todolist.js')}}"></script>
    <!-- endinject -->
  </body>
</html>