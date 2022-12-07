@extends('template.content')
@section('content')

    <div class="users">
        <div class="col-sm-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">{{$title}}</h4>
              <p class="card-description"> {{$subtitle}} </p>
              <form class="forms-sample" method="POST" action="{{url('admin/users/update')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{Nfs::Encrypt($users->id)}}">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" value="{{$users->name}}" name="name" placeholder="name" required>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" value="{{$users->email}}" name="email" placeholder="email" required>
                </div>
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="number" class="form-control" id="phone" name="phone" value="{{$users->phone}}" placeholder="phone" required>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="password">
                </div>
                <div class="form-group">
                  <label for="status">Status</label>
                  <select class="form-control" name="status" id="status" required>
                    <option selected>{{$users->status}}</option>
                    <option>active</option>
                    <option>notactive</option>
                    <option>suspend</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="cms_role_id">Cms Role Id</label>
                  <select class="form-control" name="cms_role_id" id="cms_role_id" required>
                    <option selected value="{{$users->cms_role_id}}">{{$users->cms_role_name}}</option>
                    @foreach($cms_role as $cms_role_key)
                      <option value="{{$cms_role_key->id}}">{{$cms_role_key->name}}</option>
                    @endforeach
                  </select>
                </div>
                <a class="btn btn-success" href="{{url('admin/users')}}"><i class="mdi mdi-arusers-left-thick"></i>&nbsp;Back</a>
                <button type="submit" class="btn btn-primary mr-2"><i class="mdi mdi-content-save"></i>&nbsp;Submit</button>
              </form>
            </div>
          </div>
        </div>
    </div>


@endsection