@extends('template.content')
@section('content')

    <div class="row">
        
        <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">{{$title}}</h4>
                <form class="form-sample" method="POST" action="{{url('admin/modules/store')}}" enctype="multipart/form-data">
                    @csrf
                  <p class="card-description"> {{$subtitle}} </p>
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{Helper::uc('name')}}</label>
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
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{Helper::uc('middleware')}}</label>
                        <div class="col-sm-9">
                          <input type="text" name="middleware" class="form-control" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{Helper::uc('controller')}}</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="controller" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{Helper::uc('model')}}</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="model" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{Helper::uc('table')}}</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="table" required>
                        </div>
                      </div>
                    </div>
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
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{Helper::uc('folder controller')}}</label>
                        <div class="col-sm-9">
                          <select class="form-control" name="folder_controller" id="folder_controller" required>
                            <option>Microservice</option>
                            <option>Management</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{Helper::uc('folder model')}}</label>
                        <div class="col-sm-9">
                          <select class="form-control" name="folder_model" id="folder_model" required>
                            <option>Microservice</option>
                            <option>Management</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{Helper::uc('folder storage')}}</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="folder_storage" required>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Settings Optinoal</label>
                            <div class="col-sm-9">
                                <select class="js-example-basic-single" name="cms_settings_id" style="width:100%">
                                <option value="" selected> pilih settings optional</option>
                                @foreach($cms_settings as $settings)
                                    <option value="{{$settings->id}}">{{$settings->name}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                    </div>

                  </div>

                  <hr>
                
                <div class="row mt-20">
                    <div class="col-sm-12">
                        <a class="btn btn-success" href="{{url('admin/modules')}}">Back</a>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>

                </form>
              </div>
            </div>
          </div>

    </div>


@endsection