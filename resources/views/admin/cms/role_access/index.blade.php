@extends('template.content')
@section('content')

    <div class="mb-20">
      <a href="{{url('admin/role')}}" class="btn btn-link btn-rounded btn-fw"><i class="mdi mdi-arrow-left-bold-circle-outline">&nbsp;back to menu role</i></a>
    </div>

    <div class="row">

        <div class="col-sm-12">
            
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">{{$title}} <span style="color:chartreuse">({{$row->name}})</span></h4>
                    <form action="{{url('admin/role_access/store')}}" method="POST">
                      @csrf
                      <input type="hidden" name="cms_role_id" value="{{$row->id}}">
                      <table class="table table-borderless">
                        <thead>
                          <tr>
                            <th>Menu</th>
                            <th>is view</th>
                            <th>is create</th>
                            <th>is edit</th>
                            <th>is detail</th>
                            <th>is delete</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($menu as $key)
                          @php
                              $data = Nfs::roleAccess($row->id,$key->id);
                          @endphp
                          <tr>
                            <td>
                              {{$key->name}}
                              <input type="hidden" name="cms_menus_id[]" value="{{$key->id}}">
                            </td>

                            @if($data)
                              <td>
                                <!-- Default switch -->
                                @if($data->is_view=="true")
                                  <input type="hidden" name="is_view[]" id="is_view{{$key->id}}" value="true">

                                  <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is_view_action{{$key->id}}" checked>
                                    <label class="custom-control-label" for="is_view_action{{$key->id}}">
                                      <small>true</small>
                                    </label>
                                  </div>
                                @else
                                  <input type="hidden" name="is_view[]" id="is_view{{$key->id}}" value="false">

                                  <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is_view_action{{$key->id}}">
                                    <label class="custom-control-label" for="is_view_action{{$key->id}}">
                                      <small>true</small>
                                    </label>
                                  </div>
                                @endif

                              </td>
                              <td>

                                @if($data->is_create=="true")
                                <input type="hidden" name="is_create[]" id="is_create{{$key->id}}" value="true">

                                <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input" id="is_create_action{{$key->id}}" checked>
                                  <label class="custom-control-label" for="is_create_action{{$key->id}}">
                                    <small>true</small>
                                  </label>
                                </div>

                                @else
                                  <input type="hidden" name="is_create[]" id="is_create{{$key->id}}" value="false">

                                  <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is_create_action{{$key->id}}">
                                    <label class="custom-control-label" for="is_create_action{{$key->id}}">
                                      <small>true</small>
                                    </label>
                                  </div>
                                @endif
                              </td>
                              <td>
                                @if($data->is_edit=="true")
                                  <input type="hidden" name="is_edit[]" id="is_edit{{$key->id}}" value="true">

                                  <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is_edit_action{{$key->id}}" checked>
                                    <label class="custom-control-label" for="is_edit_action{{$key->id}}">
                                      <small>true</small>
                                    </label>
                                  </div>
                                @else
                                  <input type="hidden" name="is_edit[]" id="is_edit{{$key->id}}" value="false">

                                  <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is_edit_action{{$key->id}}">
                                    <label class="custom-control-label" for="is_edit_action{{$key->id}}">
                                      <small>true</small>
                                    </label>
                                  </div>
                                @endif

                              </td>
                              <td>
                                @if($data->is_detail=="true")
                                  <input type="hidden" name="is_detail[]" id="is_detail{{$key->id}}" value="true">

                                    <div class="custom-control custom-switch">
                                      <input type="checkbox" class="custom-control-input" id="is_detail_action{{$key->id}}" checked>
                                      <label class="custom-control-label" for="is_detail_action{{$key->id}}">
                                        <small>true</small>
                                      </label>
                                    </div>
                                @else
                                  <input type="hidden" name="is_detail[]" id="is_detail{{$key->id}}" value="false">

                                  <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is_detail_action{{$key->id}}">
                                    <label class="custom-control-label" for="is_detail_action{{$key->id}}">
                                      <small>true</small>
                                    </label>
                                  </div>
                                @endif
                              </td>
                              <td>
                                @if($data->is_delete=="true")
                                  <input type="hidden" name="is_delete[]" id="is_delete{{$key->id}}" value="true">

                                    <div class="custom-control custom-switch">
                                      <input type="checkbox" class="custom-control-input" id="is_delete_action{{$key->id}}" checked>
                                      <label class="custom-control-label" for="is_delete_action{{$key->id}}">
                                        <small>true</small>
                                      </label>
                                    </div>
                                @else
                                  <input type="hidden" name="is_delete[]" id="is_delete{{$key->id}}" value="false">

                                  <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is_delete_action{{$key->id}}">
                                    <label class="custom-control-label" for="is_delete_action{{$key->id}}">
                                      <small>true</small>
                                    </label>
                                  </div>
                                @endif

                              </td>
                            @else

                            <td>
                              <input type="hidden" name="is_view[]" id="is_view{{$key->id}}" value="false">

                                  <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is_view_action{{$key->id}}">
                                    <label class="custom-control-label" for="is_view_action{{$key->id}}">
                                      <small>true</small>
                                    </label>
                                  </div>
                            </td>

                            <td>
                              <input type="hidden" name="is_create[]" id="is_create{{$key->id}}" value="false">

                              <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_create_action{{$key->id}}">
                                <label class="custom-control-label" for="is_create_action{{$key->id}}">
                                  <small>true</small>
                                </label>
                              </div>
                            </td>

                            <td>
                              <input type="hidden" name="is_edit[]" id="is_edit{{$key->id}}" value="false">

                              <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_edit_action{{$key->id}}">
                                <label class="custom-control-label" for="is_edit_action{{$key->id}}">
                                  <small>true</small>
                                </label>
                              </div>
                            </td>

                            <td>
                              <input type="hidden" name="is_detail[]" id="is_detail{{$key->id}}" value="false">

                              <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_detail_action{{$key->id}}">
                                <label class="custom-control-label" for="is_detail_action{{$key->id}}">
                                  <small>true</small>
                                </label>
                              </div>
                            </td>

                            <td>
                              <input type="hidden" name="is_delete[]" id="is_delete{{$key->id}}" value="false">

                              <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_delete_action{{$key->id}}">
                                <label class="custom-control-label" for="is_delete_action{{$key->id}}">
                                  <small>true</small>
                                </label>
                              </div>
                            </td>

                            @endif
                            
                          </tr>
                          @push('js')
                          <script>
                            $(document).ready(function(){

                              $("#is_view_action{{$key->id}}").change(function(){
                                  if($(this).prop("checked") == true){
                                    $("#is_view{{$key->id}}").val("true")
                                  }else{
                                    $("#is_view{{$key->id}}").val("false")
                                  }
                              });
                              $("#is_create_action{{$key->id}}").change(function(){
                                  if($(this).prop("checked") == true){
                                    $("#is_create{{$key->id}}").val("true")
                                  }else{
                                    $("#is_create{{$key->id}}").val("false")
                                  }
                              });
                              $("#is_edit_action{{$key->id}}").change(function(){
                                  if($(this).prop("checked") == true){
                                    $("#is_edit{{$key->id}}").val("true")
                                  }else{
                                    $("#is_edit{{$key->id}}").val("false")
                                  }
                              });
                              $("#is_detail_action{{$key->id}}").change(function(){
                                  if($(this).prop("checked") == true){
                                    $("#is_detail{{$key->id}}").val("true")
                                  }else{
                                    $("#is_detail{{$key->id}}").val("false")
                                  }
                              });
                              $("#is_delete_action{{$key->id}}").change(function(){
                                  if($(this).prop("checked") == true){
                                    $("#is_delete{{$key->id}}").val("true")
                                  }else{
                                    $("#is_delete{{$key->id}}").val("false")
                                  }
                              });
                          });
                          </script>
                          @endpush

                          @endforeach
                        </tbody>
                      </table>
                      <hr>
                      <div class="mt-50">
                        <button type="submit" class="btn btn-primary mr-2"><i class="mdi mdi-content-save"></i>&nbsp;save changes</button>
                      </div>
                  </form>
                    
                  </div>
                </div>

        </div>
    </div>

@endsection