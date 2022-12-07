@extends('template.content')
@section('content')

    <div class="row">
        <div class="col-sm-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">{{$title}}</h4>
              <p class="card-description"> {{$subtitle}} </p>
              <form class="forms-sample" method="POST" action="{{url('admin/settings/update')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$row->id}}">
                <div class="form-group">

                  <label for="name">{{Helper::uc('name')}}</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{$row->name}}" placeholder="name" required>
                </div>

                <div class="form-group">

                    <label for="value">{{Helper::uc('value')}}</label>
                    <input type="text" class="form-control" id="value" name="value" value="{{$row->value}}" placeholder="value" required>
                  </div>

                <div class="form-group">
                    <label for="description">{{Helper::uc('description')}}</label>
                    <textarea class="form-control" name="description"  id="description" rows="4">{{$row->description}}</textarea>
                  </div>

                  @if($row->image)
                  <div class="form-group">
                    <img src="{{url('storage/'.$row->image)}}" width="200px" alt="">
                  </div>
                  @endif

                <div class="form-group">
                    <label>{{Helper::uc('file upload')}}</label>
                    <input type="file" name="image" class="file-upload-default">
                    <div class="input-group col-sm-12">
                      <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                      <span class="input-group-append">
                        <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                      </span>
                    </div>
                </div>

                <hr>
                
                <div class="form-group mt-20">
                  <a class="btn btn-success" href="{{url('admin/settings')}}"><i class="mdi mdi-arrow-left-thick"></i>&nbsp;Back</a>
                    <button type="submit" class="btn btn-primary mr-2"><i class="mdi mdi-content-save"></i>&nbsp;Submit</button>
                </div>

              </form>
            </div>
          </div>
        </div>
    </div>


@endsection