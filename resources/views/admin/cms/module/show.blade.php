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
                        <td>{{$row->name}}</td>
                    </tr>
                    <tr>
                        <td>icon</td>
                        <td>:</td>
                        <td><i class="mdi {{$row->icon}}"></i></td>
                    </tr>
                    <tr>
                        <td>middleware</td>
                        <td>:</td>
                        <td>{{$row->middleware}}</td>
                    </tr>
                    <tr>
                        <td>controller</td>
                        <td>:</td>
                        <td>{{$row->controller}}</td>
                    </tr>
                    <tr>
                        <td>model</td>
                        <td>:</td>
                        <td>{{$row->model}}</td>
                    </tr>
                    <tr>
                        <td>table</td>
                        <td>:</td>
                        <td>{{$row->table}}</td>
                    </tr>
                    <tr>
                        <td>status</td>
                        <td>:</td>
                        <td>{{$row->status}}</td>
                    </tr>
                    <tr>
                        <td>folder controller</td>
                        <td>:</td>
                        <td>{{$row->folder_controller}}</td>
                    </tr>
                    <tr>
                        <td>folder model</td>
                        <td>:</td>
                        <td>{{$row->folder_model}}</td>
                    </tr>
                    <tr>
                        <td>folder storage</td>
                        <td>:</td>
                        <td>{{$row->folder_storage}}</td>
                    </tr>
                    <tr>
                        <td>cms settings</td>
                        <td>:</td>
                        <td>{{$row->cms_settings_name}}</td>
                    </tr>

                </table>
              </div>

              <div class="mt-10">
                <a class="btn btn-success" href="{{url('admin/modules')}}"><i class="mdi mdi-arrow-left-thick"></i>&nbsp;Back</a>
              </div>

            </div>
          </div>
        </div>
    </div>


@endsection