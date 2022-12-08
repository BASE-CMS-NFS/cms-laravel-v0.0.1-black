@extends('admin.cms.menu.subaction')
@section('menus_action')

<div class="row">
    <div class="col-sm-12 mb-10">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add">add data</button>
    </div>

    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
              <h4 class="card-title">{{$title}}</h4>
              <div class="table-responsive">
                <table class="table table">
                  <thead>
                    <tr>
                      <th class="head-white">menu</th>
                      <th class="head-white">method</th>
                      <th class="head-white">url / route</th>
                      <th class="head-white">blade / view</th>
                      <th class="head-white">function</th>
                      <th class="head-white">action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($cms_menus_detail as $key)
                    <tr>
                        <td>{{$key->cms_menus_name}}</td>
                        <td>{{$key->method}}</td>
                        <td>{{$key->url}}</td>
                        <td>{{$key->view}}</td>
                        <td>{{$key->function}}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#edit{{$key->id}}">edit</button>
                            <a href="javascript:void(0)" onclick="hapus('{{url('admin/menu_detail/destroy/'.$key->id)}}')" class="btn btn-sm btn-danger">delete</a>
                        </td>
                    </tr>

                                            <!-- Modal -->
                        <div class="modal fade" id="edit{{$key->id}}" tabindex="-1" aria-labelledby="edit{{$key->id}}" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{$title}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <form action="{{url('admin/menu_detail/update')}}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="hidden" value="{{$key->id}}" name="id">
                                        <input type="hidden" value="{{$key->cms_menus_id}}" name="cms_menus_id">

                                        <div class="form-group">
                                            <label for="url">url / route</label>
                                            <input type="text" class="form-control" value="{{$key->url}}" name="url" id="url" placeholder="url">
                                        </div>

                                        <div class="form-group">
                                            <label for="view">blade / view</label>
                                            <input type="text" class="form-control" value="{{$key->view}}" name="view" id="view" placeholder="view">
                                        </div>

                                        <div class="form-group">
                                          <label for="method">method</label>
                                          <input type="text" class="form-control" name="method" value="{{$key->method}}" id="method" placeholder="method">
                                        </div>

                                        <div class="form-group">
                                            <label for="function">function controller</label>
                                            <input type="text" class="form-control" value="{{$key->function}}" name="function" id="function" placeholder="function">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Edit changes</button>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>

                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
</div>


<div class="row mt-20">
  <div class="col-sm-12">
    <div class="card">
        <div class="card-body">
          <h4 class="card-title">Copy Paste To web.php</h4>
            <p>LIST CLASS</p>
            @foreach(Nfs::controller($row->id) as $class)

                <p style="color: red">{{$class['class']}}</p>
            
            @endforeach
            <br>

            <p>LIST ROUTE</p>
            @foreach(Nfs::route($row->id) as $route)

                <p style="color: aqua">{{$route['url']}}</p>

            @endforeach
        </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" aria-labelledby="add" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{$title}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{url('admin/menu_detail/store')}}" method="POST">
            @csrf
            <div class="modal-body">
                <input type="hidden" value="{{$row->id}}" name="cms_menus_id">

                <div class="form-group">
                    <label for="url">url / route</label>
                    <input type="text" class="form-control" name="url" id="url" placeholder="url">
                  </div>

                  <div class="form-group">
                    <label for="view">blade / view</label>
                    <input type="text" class="form-control" name="view" id="view" placeholder="view">
                  </div>

                  <div class="form-group">
                    <label for="method">method</label>
                    <input type="text" class="form-control" name="method" id="method" placeholder="method">
                  </div>

                  <div class="form-group">
                    <label for="function">function controller</label>
                    <input type="text" class="form-control" name="function" id="function" placeholder="function">
                  </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
</div>

@endsection