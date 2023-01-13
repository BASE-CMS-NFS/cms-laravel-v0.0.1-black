@extends('template.content')
@section('content')


    <div class="row">
      <div class="col-sm-12 mb-10">
        <a href="{{url('admin/modules/create')}}" class="btn btn-success btn-fw">add data</a>
      </div>
        <div class="col-sm-12">
            
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">{{$title}}</h4>
                    <div class="table-responsive">
                      <table class="table table">
                        <thead>
                          <tr>
                            <th>name</th>
                            <th>icon</th>
                            <th>middleware</th>
                            <th>controller</th>
                            <th>model</th>
                            <th>table</th>
                            <th>status</th>
                            <th>folder controller</th>
                            <th>folder storage</th>
                            <th>folder model</th>
                            <th>Settings ID</th>
                            <th>generate modules</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($cms_modules as $key)
                          <tr>
                            <td>{{$key->name}}</td>
                            <td><i class="mdi {{$key->icon}}"></i></td>
                            <td>{{$key->middleware}}</td>
                            <td>{{$key->controller}}</td>
                            <td>{{$key->model}}</td>
                            <td>{{$key->table}}</td>
                            <td>@php echo Helper::status($key->status); @endphp</td>
                            <td>{{$key->folder_controller}}</td>
                            <td>{{$key->folder_storage}}</td>
                            <td>{{$key->folder_model}}</td>
                            <td>{{$key->cms_settings_name}}</td>
                            <td>
                              <a href="javascript:void(0)"
                                onclick="generate('{{url('admin/modules/generate/'.$key->id)}}')" class="btn btn-sm btn-success">klik generate</a></td>
                            <td>
                              <a href="{{url('admin/modules/show/'.$key->id)}}" class="btn btn-sm btn-primary">detail</a>
                              <a href="{{url('admin/modules/edit/'.$key->id)}}" class="btn btn-sm btn-warning">edit</a>
                              <a href="javascript:void(0)" onclick="hapus('{{url('admin/modules/destroy/'.$key->id)}}')" class="btn btn-sm btn-danger">delete</a>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

        </div>
    </div>

    @push('js')
    <script>
      function generate(url){
          Swal.fire({
              title: 'Are you sure?',
              text: "You won't generate this module",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#696cff',
              cancelButtonColor: '#ff3e1d',
              confirmButtonText: 'Yes, generate it!'
              }).then((result) => {
              if (result.isConfirmed) {
                  location.href=url; 
                  Swal.fire(
                  'Generate!',
                  'Your has been generete module ?.',
                  'success'
                  )
              }
              })
          }
  </script>
    @endpush

@endsection