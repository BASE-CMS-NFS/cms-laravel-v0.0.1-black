@extends('template.content')
@section('content')


    <div class="row">
      <div class="col-sm-12 mb-10">
        <a href="{{url('admin/role/create')}}" class="btn btn-success btn-fw">add data</a>
      </div>

        <div class="col-sm-12">
            
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">{{$title}}</h4>
                    <div class="table-responsive">
                      <table class="table table">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Role Access</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($data as $key)
                          <tr>
                            <td>{{$key->name}}</td>
                            <td>
                              <a href="{{url('admin/role_access/'.$key->id)}}" class="btn btn-sm btn-success">Role Access</a>
                            </td>
                            <td>
                              <a href="{{url('admin/role/show/'.$key->id)}}" class="btn btn-sm btn-primary">detail</a>
                              <a href="{{url('admin/role/edit/'.$key->id)}}" class="btn btn-sm btn-warning">edit</a>
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

@endsection