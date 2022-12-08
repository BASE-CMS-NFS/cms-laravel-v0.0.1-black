@extends('template.content')
@section('content')


    <div class="row">
      <div class="col-sm-12 mb-10">
        <a href="{{url('admin/settings/create')}}" class="btn btn-success btn-fw">add data</a>
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
                            <th>Value</th>
                            <th>description</th>
                            <th>Image</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($cms_settings as $key)
                          <tr>
                            <td>{{$key->name}}</td>
                            <td>{{$key->value}}</td>
                            <td>{{$key->description}}</td>
                            <td>
                                @if($key->image)
                                <a data-fslightbox="gallery" href="{{url('storage/'.$key->image)}}">
                                    <img src="{{url('storage/'.$key->image)}}" class="img-table" alt="{{$key->name}}">
                                </a>
                                @else
                                    <p>no image</p>
                                @endif
                            </td>
                            <td>
                              <a href="{{url('admin/settings/show/'.$key->id)}}" class="btn btn-sm btn-primary">detail</a>
                              <a href="{{url('admin/settings/edit/'.$key->id)}}" class="btn btn-sm btn-warning">edit</a>
                              <a href="javascript:void(0)" onclick="hapus('{{url('admin/settings/destroy/'.$key->id)}}')" class="btn btn-sm btn-danger">delete</a>
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