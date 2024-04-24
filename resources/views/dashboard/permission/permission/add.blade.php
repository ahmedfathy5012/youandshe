@extends('layouts.masterlayout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {!!'Add New Permission'!!}
                    </div>

                    <div class="card-body">
                        <div class="alert alert-success" permission="alert" id="successMsg" style="display: none" >
                            Thank you for getting in touch!
                        </div>
{{--                        <form method="POST" class="row" enctype="multipart/form-data" id="SubmitForm" action="{{route('add_permission')}}">--}}
                        <form id="SubmitForm">
                            @csrf
                            @if (!is_null($permission??null))
{{--                                <input type="hidden" name="_method" value="PUT">--}}
                                <input type="hidden" name="id" id="id" value="{{$permission->id}}">
                            @endif

{{--                             @for($i=0;$i<6;$i++)--}}
{{--                            <div class="form-group col-md-12">--}}
{{--                                <label for="product_title">الصورة</label>--}}
{{--                                <input name="product_images" type="file" class="form-control-file image-file-upload" value="" id="image">--}}
{{--                            </div>--}}
{{--                            @endfor--}}

                            <div class="form-group col-md-12">
                                <label for="name">الاسم</label>
                                <input type="text" class="form-control" id="name" name= "name" placeholder="الاسم"
                                       value="{{!is_null($permission??null)? $permission->name:old('name')}}">
                                <span class="text-danger" id="nameErrorMsg"></span>
                            </div>


                            <div class="form-group col-md-12">
                                <label for="display_name">الاسم المعروض</label>
                                <input type="text" class="form-control" id="display_name" name= "display_name" placeholder="الاسم"
                                       value="{{!is_null($permission??null)? $permission->display_name:old('display_name')}}">
                                <span class="text-danger" id="displayNameErrorMsg"></span>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="description">الاسم المعروض</label>
                                <input type="text" class="form-control" id="description" name= "description" placeholder="الوصف"
                                       value="{{!is_null($ermission??null)? $permission->description:old('description')}}">
                                <span class="text-danger" id="descriptionErrorMsg"></span>
                            </div>



{{--                            <div class="form-group col-md-6 offset-md-3">--}}
{{--                                <button type="submit" class="btn btn-primary btn-block"  >حفظ</button>--}}
{{--                            </div>--}}
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('scripts')
    <script>
            $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
                // var $imageWindow = $('.image-window');
                $('#SubmitForm').on('submit',function(e){
                    e.preventDefault();
                    let name = $('#name').val();
                    let id = $('#id').val();
                    $data = {
                        "_token": "{{ csrf_token() }}",
                        name:name,
                        id: id,
                    };
                    // $imageWindow.modal('show');
                    $.ajax({
                        url:
                            id!=null?
                            "/admin/edite_permission":
                            "/admin/add_permission",
                        type:"POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType:'json',
                        data:new FormData(this),
                        beforeSend: function(){
                            $("#loader").css({"display": "flex"});
                        },
                        success:function(response){
                            $("#loader").css({"display": "none"});
                            $('#successMsg').show();
                            console.log(response.message??'');
                            if(response.route !==''){
                                window.location.replace(response.route);
                            }
                        },
                        error: function(response) {
                            $("#loader").css({"display": "none"});
                            $('#nameErrorMsg').text(response.responseJSON.errors.title??'');
                        },
                    });
                });
        });


    </script>


@endsection



