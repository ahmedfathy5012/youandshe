@extends('layouts.masterlayout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        @if (!is_null($package??null))
                            {!!'تعديل الباقة'!!}
                        @else
                            {!!'اضافة الباقة جديدة'!!}
                        @endif

                    </div>
                    <div class="card-body">
                        <div class="alert alert-success" role="alert" id="successMsg" style="display: none" >
                            Thank you for getting in touch!
                        </div>
                        <form method="POST" enctype="multipart/form-data" id="SubmitForm" action="" >
                            <meta name="csrf-token" content="{{ csrf_token() }}" />
                            @csrf
                            @if (!is_null($package??null))
{{--                                <input type="hidden" name="_method" value="PUT">--}}
                                <input type="hidden" name="id" id="id" value="{{$package->id}}">
                            @endif

                            <div class="row">
                                <div class="imagePerview mx-auto mb-5">
                                    <div class="avatar-upload" style="position: relative">
                                        <div class="avatar-edit">
                                            <input type='file' name="icon" id="imageUpload" accept=".png, .jpg, .jpeg" />
                                            <label for="imageUpload"></label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview" style="background-image: url({{!is_null($package??null)?$package->image:''}});">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
{{--                                <div class="form-group col-12">--}}
{{--                                    <label for="package_icon">الصورة</label>--}}
{{--                                    <input name="icon" type="file" class="form-control-file image-file-upload" value="" id="icon">--}}
{{--                                </div>--}}


                                <div class="form-group col-lg-6 col-12">
                                    <label for="product_title">اسم الباقة</label>
                                    <input type="text" class="form-control" id="package_name" name= "name" placeholder="اسم الخدمة"
                                           value="{{!is_null($package??null)? $package->name:old('package_name')}}">
                                    <span class="text-danger" id="nameErrorMsg"></span>
                                </div>


                                <div class="form-group col-lg-6 col-12">
                                    <label for="product_title">السعر</label>
                                    <input class="form-control" id="price" name= "price" placeholder="سعر الخدمة"
                                           value="{{!is_null($package??null)? $package->price:old('price')}}">
                                    <span class="text-danger" id="priceErrorMsg"></span>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="state">الخدمات</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="services[]" id="services_ids" required multiple>
                                        <option>اختر الخدمات</option>
                                        @foreach ($services as $service)
{{--                                            <option value="{{$service->id}}">{{$service->name}} {{(!is_null($package??null)&&(in_array($service,$package->services))) ? 'selected' : ''}}</option>--}}
{{--                                            <option value="{{$service->id}}">{{$service->name}} {{(!is_null($package??null)&&(in_array($service,array_map(function($o) { return $o->id;}, $package->services)))) ? 'selected' : ''}}</option>                                        @endforeach--}}
{{--                                            <option value="{{$service->id}}" {{(!is_null($package??null)&&(in_array($service->id,array_map(function($o) { return $o->id;}, $package->services)))) ? 'selected' : ''}}>{{$service->name}} </option>                                        @endforeach--}}
                                            <option value="{{$service->id}}">{{$service->name}} </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="StateErrorMsg"></span>

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

            var formData = new FormData($('#SubmitForm')[0]);


                // var $imageWindow = $('.image-window');
                $('#SubmitForm').on('submit',function(e){
                    e.preventDefault();
                    let id = $('#id').val();

                    $.ajax({
                        url:
                            id!=null?
                            "/admin/edite_package":
                            "/admin/add_package",
                        type:"POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType:'json',
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



