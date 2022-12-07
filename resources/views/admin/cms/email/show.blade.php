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
                        <td>Template Name</td>
                        <td>:</td>
                        <td>{{$row->name}}</td>
                    </tr>
                    <tr>
                        <td>slug</td>
                        <td>:</td>
                        <td>{{$row->slug}}</td>
                    </tr>
                    <tr>
                        <td>subject</td>
                        <td>:</td>
                        <td>{{$row->subject}}</td>
                    </tr>
                    <tr>
                        <td>content</td>
                        <td>:</td>
                        <td>
                            @php
                                echo $row->content;
                            @endphp
                        </td>
                    </tr>
                    <tr>
                        <td>description</td>
                        <td>:</td>
                        <td>{{$row->description}}</td>
                    </tr>
                    <tr>
                        <td>from_name</td>
                        <td>:</td>
                        <td>{{$row->from_name}}</td>
                    </tr>
                    <tr>
                        <td>from_email</td>
                        <td>:</td>
                        <td>{{$row->from_email}}</td>
                    </tr>
                    <tr>
                        <td>cc_email</td>
                        <td>:</td>
                        <td>{{$row->cc_email}}</td>
                    </tr>

                    <tr>
                        <td>Image</td>
                        <td>:</td>
                        <td>
                            @if($row->image)
                            <img class="img-show" src="{{url('storage/'.$row->image)}}" alt="">
                            @else
                            <p>no image</p>
                            @endif
                        </td>
                    </tr>
                    
                </table>

              </div>

              <div class="mt-10">
                <a class="btn btn-success" href="{{url('admin/emails')}}"><i class="mdi mdi-arrow-left-thick"></i>&nbsp;Back</a>
              </div>

            </div>
          </div>
        </div>
    </div>


@endsection