@extends('template.content')
@section('content')

    <div class="row">
        
        <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">{{$title}}</h4>
                <form class="form-sample" method="POST" action="{{url('admin/menus/store')}}" enctype="multipart/form-data">
                    @csrf
                  <p class="card-description"> {{$subtitle}} </p>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{Helper::uc('name / menu')}}</label>
                        <div class="col-sm-9">
                          <input type="text" name="name" class="form-control" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{Helper::uc('icon')}}</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="icon" required>
                          <a href="https://pictogrammers.github.io/@mdi/font/2.0.46/" target="_blank">check icon klik here</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{Helper::uc('main folder view')}}</label>
                        <div class="col-sm-9">
                          <input type="text" name="main_folder" class="form-control" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{Helper::uc('link / url')}}</label>
                        <div class="col-sm-9">
                          <input type="text" name="url" class="form-control" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{Helper::uc('sub folder view')}}</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="sub_folder" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{Helper::uc('sorter')}}</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" name="sorter" required>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">

                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">{{Helper::uc('status')}}</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="status" required>
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
                                <option value="" selected> pilih modules</option>
                                @foreach($cms_modules as $modules)
                                    <option value="{{$modules->id}}">{{$modules->name}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                    </div>

                  </div>

                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Parent Menu</label>
                            <div class="col-sm-9">
                                <select class="js-example-basic-single" name="parent_id" style="width:100%">
                                <option value="" selected> Optional sub menus</option>
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
                            <option>full module</option>
                            <option>only menu</option>
                          </select>
                        </div>
                      </div>
                    </div>

                  </div>

                  <div>
                    <a class="btn btn-success" href="{{url('admin/menus')}}"><i class="mdi mdi-arrow-left-thick"></i>&nbsp;Back</a>
                    <button type="submit" class="btn btn-primary mr-2"><i class="mdi mdi-content-save"></i>&nbsp;Submit</button>
                  </div>

                </form>
              </div>
            </div>
          </div>

    </div>


@endsection