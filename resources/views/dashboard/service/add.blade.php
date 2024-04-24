@extends('layouts.masterlayout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        @if (!is_null($service??null))
                            {!!'تعديل الخدمة'!!}
                        @else
                            {!!'اضافة خدمة جديدة'!!}
                        @endif

                    </div>

                    <div class="card-body">
                        <div class="alert alert-success" role="alert" id="successMsg" style="display: none" >
                            Thank you for getting in touch!
                        </div>
                        <form method="POST" enctype="multipart/form-data" id="SubmitForm" action="" >
                            <meta name="csrf-token" content="{{ csrf_token() }}" />
                            @csrf
                            @if (!is_null($service??null))
{{--                                <input type="hidden" name="_method" value="PUT">--}}
                                <input type="hidden" name="id" id="id" value="{{$service->id}}">
                            @endif

                            <div class="row">
                                <div class="imagePerview mx-auto mb-5">
                                    <div class="avatar-upload" style="position: relative">
                                        <div class="avatar-edit">
                                            <input type='file' name="icon" id="imageUpload" accept=".png, .jpg, .jpeg" />
                                            <label for="imageUpload"></label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview" style="background-image: url({{!is_null($service??null)?$service->icon:''}});">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
{{--                                <div class="form-group col-12">--}}
{{--                                    <label for="service_icon">الصورة</label>--}}
{{--                                    <input name="icon" type="file" class="form-control-file image-file-upload" value="" id="icon">--}}
{{--                                </div>--}}


                                <div class="form-group col-lg-6 col-12">
                                    <label for="product_title">اسم الخدمة</label>
                                    <input type="text" class="form-control" id="service_title" name= "name" placeholder="اسم الخدمة"
                                           value="{{!is_null($service??null)? $service->name:old('service_title')}}">
                                    <span class="text-danger" id="nameErrorMsg"></span>
                                </div>

                                <div class="form-group col-lg-6 col-12">
                                    <label for="product_title">السعر</label>
                                    <input class="form-control" id="price" name= "price" placeholder="سعر الخدمة"
                                           value="{{!is_null($service??null)? $service->price:old('price')}}">
                                    <span class="text-danger" id="priceErrorMsg"></span>
                                </div>

                                <div class="form-group col-lg-6 col-12">
                                    <label for="product_title">المدة</label>
                                    <input type="number" class="form-control" id="duration" name= "duration" placeholder="مدة الخدمة"
                                           min="1" max="360"
                                           value="{{!is_null($service??null)? $service->duration:old('duration')}}">
                                    <span class="text-danger" id="durationErrorMsg"></span>
                                </div>


                                <div class="form-group col-lg-6 col-12">
                                    <label for="gender">الخدمة مقدمة لمن</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="gender" id="gender" required>
                                        <option>الخدمة مقدمة لمن</option>
                                        <option value="{{0}}"  {{(!is_null($service??null)&&($service->gender == 0)) ? 'selected' : ''}}>{{'ذكور'}}</option>
                                        <option value="{{1}}"  {{(!is_null($service??null)&&($service->gender == 1)) ? 'selected' : ''}}>{{'اناث'}}</option>
                                        <option value="{{2}}"  {{(!is_null($service??null)&&($service->gender == 2)) ? 'selected' : ''}}>{{'ذكور و اناث'}}</option>
                                    </select>
                                    <span class="text-danger" id="StateErrorMsg"></span>
                                </div>

                            </div>

                            <div class="form-group col-md-6 offset-md-3">
                                <button type="submit" class="btn btn-primary btn-block"  >حفظ</button>
                            </div>
{{--                            <button type="submit" class="btn btn-primary">Submit</button>--}}
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

            var formData = new FormData($('#SubmitForm')[0]);


                // var $imageWindow = $('.image-window');
                $('#SubmitForm').on('submit',function(e){
                    e.preventDefault();
                    let name = $('#service_title').val();
                    let icon = $('#service_icon').val();
                    let id = $('#id').val();
                    $data = {
                        "_token": "{{ csrf_token() }}",
                        name:name,
                        icon:icon,
                        id: id,
                    };
                    // $imageWindow.modal('show');
                    $.ajax({
                        url:
                            id!=null?
                            "/admin/edite_service":
                            "/admin/add_service",
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
                                $('#nameErrorMsg').text((response.responseJSON.errors.name??[''])[0]);
                                $('#priceErrorMsg').text((response.responseJSON.errors.price??[''])[0]);
                            }
                        },
                        error: function(response) {
                            $("#loader").css({"display": "none"});
                            console.log(response);
                            $('#nameErrorMsg').text((response.responseJSON.errors.name??[''])[0]);
                            $('#priceErrorMsg').text((response.responseJSON.errors.price??[''])[0]);
                        },
                    });
                });
        });


    </script>


@endsection



