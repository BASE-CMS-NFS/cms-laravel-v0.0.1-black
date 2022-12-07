@extends('template.content')
@section('content')

    <div class="row">
        <div class="col-sm-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">{{$title}}</h4>
              <p class="card-description"> {{$subtitle}} </p>
              
              <div class="table-responsive">
                <table class="table table-borderless">
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td>{{$row->name}}</td>
                    </tr>
                    <tr>
                        <td>Value</td>
                        <td>:</td>
                        <td>{{$row->value}}</td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>:</td>
                        <td>{{$row->description}}</td>
                    </tr>
                    <tr>
                        <td>Image</td>
                        <td>:</td>
                        <td>
                            @if($row->image)
                            <img src="{{url('storage/'.$row->image)}}" width="200" alt="">
                            @else
                            <p>no image</p>
                            @endif
                        </td>
                    </tr>
                </table>
              </div>

              <div class="mt-10">
                <a class="btn btn-success" href="{{url('admin/settings')}}"><i class="mdi mdi-arrow-left-thick"></i>&nbsp;Back</a>
              </div>

            </div>
          </div>
        </div>
    </div>


@endsection