@extends('template.content')
@section('content')

@push('css')
    <style>
      .ck.ck-editor__main>.ck-editor__editable {
          background: #000!important;
          border-radius: 0;
      }

      .ck-reset_all :not(.ck-reset_all-excluded *), .ck.ck-reset_all {
          color: #fff!important;
      }

      .ck.ck-toolbar {
        background: #000!important;
        border: 1px solid #000000;
        padding: 0 var(--ck-spacing-small);
    }
    </style>

    
@endpush

    <div class="row">
        <div class="col-sm-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">{{$title}}</h4>
              <p class="card-description"> {{$subtitle}} </p>
              <form class="forms-sample" method="POST" action="{{url('admin/emails/update')}}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{$row->id}}">
                <div class="form-group">

                  <label for="template name">{{Helper::uc('template name')}}</label>
                  <input type="text" class="form-control" value="{{$row->name}}" id="name" name="name" placeholder="name" required>
                </div>

                <div class="form-group">

                    <label for="slug">{{Helper::uc('slug')}}</label>
                    <input type="text" class="form-control" id="slug" value="{{$row->slug}}" name="slug" placeholder="slug" required>
                  </div>

                <div class="form-group">
                    <label for="subject">{{Helper::uc('subject')}}</label>
                    <textarea class="form-control" name="subject" id="subject" rows="4">{{$row->subject}}</textarea>
                </div>

                <div class="form-group">
                    <label for="content">{{Helper::uc('content')}}</label>
                    <textarea class="form-control" name="content" id="content" rows="10">{{$row->content}}</textarea>
                </div>

                <div class="form-group">
                    <label for="description">{{Helper::uc('description')}}</label>
                    <textarea class="form-control" name="description" id="description" rows="4">{{$row->description}}</textarea>
                </div>

                <div class="form-group">
                    @if($row->image)
                            <img class="img-show" src="{{url('storage/'.$row->image)}}" alt="">
                    @endif
                </div>

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

                <div class="form-group">

                    <label for="from_name">{{Helper::uc('from name')}}</label>
                    <input type="text" class="form-control" id="from_name" name="from_name" value="{{$row->from_name}}"  placeholder="from name" required>
                </div>

                <div class="form-group">

                    <label for="from_email">{{Helper::uc('from email')}}</label>
                    <input type="text" class="form-control" id="from_email" name="from_email" value="{{$row->from_email}}" placeholder="from email" required>

                </div>

                <div class="form-group">

                    <label for="cc_email">{{Helper::uc('cc email')}}</label>
                    <input type="text" class="form-control" id="cc_email" name="cc_email" value="{{$row->cc_email}}" placeholder="cc email">

                </div>

                <hr>
                
                <div class="form-group mt-20">
                  <a class="btn btn-success" href="{{url('admin/emails')}}"><i class="mdi mdi-arrow-left-thick"></i>&nbsp;Back</a>
                    <button type="submit" class="btn btn-primary mr-2"><i class="mdi mdi-content-save"></i>&nbsp;Submit</button>
                </div>

              </form>
            </div>
          </div>
        </div>
    </div>

    @push('js')

    <script>
        ClassicEditor
    .create( document.querySelector( '#content' ), {
        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
            ]
        }
    } )
    .catch( error => {
        console.log( error );
    } );

    ClassicEditor
    .create( document.querySelector( '#description' ), {
        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
            ]
        }
    } )
    .catch( error => {
        console.log( error );
    } );
    </script>
        
    @endpush

@endsection