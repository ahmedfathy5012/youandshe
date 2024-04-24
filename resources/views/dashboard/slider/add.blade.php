@extends('layouts.masterlayout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        @if (!is_null($slider??null))
                            {!!'تعديل الاعلان'!!}
                        @else
                            {!!'اضافة اعلان جديدة'!!}
                        @endif

                    </div>

                    <div class="card-body">
                        <div class="alert alert-success" role="alert" id="successMsg" style="display: none" >
                            Thank you for getting in touch!
                        </div>
                        <form method="POST" enctype="multipart/form-data" id="SubmitForm" action="" >
                            <meta name="csrf-token" content="{{ csrf_token() }}" />
                            @csrf
                            @if (!is_null($slider??null))
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="id" id="slider_id" value="{{$slider->id}}">
                            @endif

                            <div class="row">
                                <div class="imagePerview mx-auto mb-5">
                                    <div class="avatar-upload" style="position: relative">
                                        <div class="avatar-edit">
                                            <input type='file' name="image" id="imageUpload" accept=".png, .jpg, .jpeg" />
                                            <label for="imageUpload"></label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview" style="background-image: url({{!is_null($slider??null)?$slider->image:''}});">
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-danger" id="imageErrorMsg"></span>
                                </div>
                            </div>

                            <div class="form-group col-md-6 offset-md-3">
                                <button type="submit" class="btn btn-primary btn-block"  >حفظ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('scripts')

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });
    </script>

    <script>
            $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

                $('#SubmitForm').on('submit',function(e){
                    e.preventDefault();
                    let id = $('#slider_id').val();
                    $.ajax({
                        url:
                            id!=null?
                            "/admin/edite_slider":
                            "/admin/add_slider",
                        type:"POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType:'json',
                        // enctype:'multipart/form-data',
                        data: new FormData(this),
                        beforeSend: function(){
                            $("#loader").css({"display": "flex"});
                        },
                        success:function(response){
                            $("#loader").css({"display": "none"});
                            if(response.status){
                                $('#successMsg').show();
                                console.log(response);
                                if(response.route !==''){
                                    window.location.replace(response.route);
                                }
                            }else{
                                $('#imageErrorMsg').text((response.responseJSON.errors.image??[''])[0]);
                            }
                        },
                        error: function(response) {
                            $("#loader").css({"display": "none"});
                            console.log(response);
                            $('#imageErrorMsg').text((response.responseJSON.errors.image??[''])[0]);
                        },
                    });
                });
        });


    </script>


@endsection



