@extends('template.content')
@section('content')

    <div class="row">
        <div class="col-sm-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">{{$title}}</h4>
              <p class="card-description"> {{$subtitle}} </p>
              
              <div class="table-responsive">
                <table class="table table-borderless">
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td>{{$users->name}}</td>
                    </tr>
                    <tr>
                      <td>email</td>
                      <td>:</td>
                      <td>{{$users->email}}</td>
                   </tr>
                    <tr>
                      <td>status</td>
                      <td>:</td>
                      <td>{{$users->status}}</td>
                    </tr>
                    <tr>
                      <td>cms_role</td>
                      <td>:</td>
                      <td>{{$users->cms_role_name}}</td>
                    </tr>
                    <tr>
                      <td>phone</td>
                      <td>:</td>
                      <td>{{$users->phone}}</td>
                    </tr>
                </table>
              </div>

              <div class="mt-10">
                <a class="btn btn-success" href="{{url('admin/users')}}"><i class="mdi mdi-arrow-left-thick"></i>&nbsp;Back</a>
              </div>

            </div>
          </div>
        </div>
    </div>


@endsection