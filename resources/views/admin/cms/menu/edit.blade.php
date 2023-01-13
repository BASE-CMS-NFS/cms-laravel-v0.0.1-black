@extends('template.content')
@section('content')

    <div class="row">
        
        <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">{{$title}}</h4>
                <form class="form-sample" method="POST" action="{{url('admin/menus/update')}}" enctype="multipart/form-data">
                    @csrf
                  <p class="card-description"> {{$subtitle}} </p>
                  <input type="hidden" name="id" value="{{$row->id}}">
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{Helper::uc('name menu')}}</label>
                        <div class="col-sm-9">
                          <input type="text" name="name" class="form-control" value="{{$row->name}}" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{Helper::uc('icon')}}</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="icon" value="{{$row->icon}}"  required>
                          <a href="https://pictogrammers.github.io/@mdi/font/2.0.46/" target="_blank">check icon klik here</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{Helper::uc('main folder view')}}</label>
                        <div class="col-sm-9">
                          <select class="form-control" name="main_folder" required>
                            <option value="{{$row->main_folder}}" selected>{{$row->main_folder}}</option>
                            <option>microservice</option>
                            <option>management</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{Helper::uc('url')}}</label>
                        <div class="col-sm-9">
                          <input type="text" name="url" value="{{$row->url}}" class="form-control" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{Helper::uc('sub folder view')}}</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" value="{{$row->sub_folder}}" name="sub_folder" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{Helper::uc('sorter')}}</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" value="{{$row->sorter}}" name="sorter" required>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">

                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">{{Helper::uc('status')}}</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="status" required>
                              <option value="{{$row->status}}" selected>{{$row->status}}</option>
                              <option>active</option>
                              <option>notactive</option>
                            </select>
                          </div>
                        </div>
                      </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Modules</label>
                            <div class="col-sm-9">
                                <select class="js-example-basic-single" name="cms_modules_id" style="width:100%">
                                <option value="{{$row->cms_modules_id}}" selected>{{$row->cms_modules_name}}</option>
                                @foreach($cms_modules as $modules)
                                    <option value="{{$modules->id}}">{{$modules->name}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                    </div>

                  </div>

                  <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Parent Menu</label>
                            <div class="col-sm-9">
                                <select class="js-example-basic-single" name="parent_id" style="width:100%">
                                <option value="{{$row->parent_id}}" selected>{{$row->parent_name}}</option>
                                <option value="" style="color: rgb(9, 189, 9)">reset select null</option>
                                @foreach($cms_menus as $menus)
                                    <option value="{{$menus->id}}">{{$menus->name}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{Helper::uc('type')}}</label>
                        <div class="col-sm-9">
                          <select class="form-control" name="type" required>
                            <option value="{{$row->type}}" selected>{{$row->type}}</option>
                            <option>full module</option>
                            <option>only menu</option>
                            <option>section</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <hr>
                
                <div class="row mt-20">
                    <div class="col-sm-12">
                        <a class="btn btn-success" href="{{url('admin/menus')}}">Back</a>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>

                </form>
              </div>
            </div>
          </div>

    </div>


@endsection