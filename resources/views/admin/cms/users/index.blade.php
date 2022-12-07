@extends('template.content')
@section('content')

    <div class="row">

      <div class="col-sm-12 mb-10">
        <a href="{{url('admin/users/create')}}" class="btn btn-success btn-fw">add data</a>
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
                            <th>Role</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($data as $key)
                          <tr>
                            <td>{{$key->name}}</td>
                            <td>{{$key->cms_role_name}}</td>
                            <td>{{$key->email}}</td>
                            <td>{{$key->phone}}</td>
                            <td>{{$key->status}}</td>
                            <td>
                              <a href="{{url('admin/users/show/'.Nfs::Encrypt($key->id))}}" class="btn btn-sm btn-primary">detail</a>
                              <a href="{{url('admin/users/edit/'.Nfs::Encrypt($key->id))}}" class="btn btn-sm btn-warning">edit</a>
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