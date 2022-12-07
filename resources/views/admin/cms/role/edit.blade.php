@extends('template.content')
@section('content')

    <div class="row">
        <div class="col-sm-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">{{$title}}</h4>
              <p class="card-description"> {{$subtitle}} </p>
              <form class="forms-sample" method="POST" action="{{url('admin/role/update')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$row->id}}">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{$row->name}}" placeholder="name">
                </div>
                <a class="btn btn-success" href="{{url('admin/role')}}"><i class="mdi mdi-arrow-left-thick"></i>&nbsp;Back</a>
                <button type="submit" class="btn btn-primary mr-2"><i class="mdi mdi-content-save"></i>&nbsp;Submit</button>
              </form>
            </div>
          </div>
        </div>
    </div>


@endsection