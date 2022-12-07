<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{Nfs::app()}}</title>
    <!-- plugins:css -->
    @include('template.css')
    @stack('css')
  </head>
  <body>
    <div class="container-scroller">

        @include('template.sidebar')

        <div class="container-fluid page-body-wrapper">
            @include('template.header')

            <div class="main-panel">

              <div class="content-wrapper">

                @if ($errors->any() || session()->has('message'))
                <div class="row">
                  <div class="col-sm-12">
                    @include('template.alert')
                  </div>
                </div>
                @endif

                @yield('content')

              </div>

                @include('template.footer')

            </div>
        </div>

    </div>

    @include('template.js')
    @stack('js')
  </body>
</html>
  