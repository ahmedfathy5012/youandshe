@extends('layouts.masterlayout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        @if (!is_null($address_type??null))
                            {!!'تعديل النوع'!!}
                        @else
                            {!!'اضافة نوع جديد'!!}
                        @endif

                    </div>

                    <div class="card-body">
                        <div class="alert alert-success" role="alert" id="successMsg" style="display: none" >
                            Thank you for getting in touch!
                        </div>
                        <form method="POST" enctype="multipart/form-data" id="SubmitForm" action="" >
                            <meta name="csrf-token" content="{{ csrf_token() }}" />
                            @csrf
                            @if (!is_null($address_type??null))
{{--                                <input type="hidden" name="_method" value="PUT">--}}
                                <input type="hidden" name="id" class="form-control" id="id" value="{{$address_type->id}}">
                            @endif

                            <div class="form-group col-md-12">
                                <label for="address_type_icon">الصورة</label>
                                <input name="icon" type="file" class="form-control-file image-file-upload" value="" id="icon">
                            </div>


                            <div class="form-group col-md-12">
                                <label for="product_title">اسم النوع</label>
                                <input type="text" class="form-control" id="address_type_name" name= "name" placeholder="اسم الخدمة"
                                       value="{{!is_null($address_type??null)? $address_type->name:old('address_type_name')}}">
                                <span class="text-danger" id="nameErrorMsg"></span>
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
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let id = $('#id').val();
            $('#SubmitForm').on('submit',function(e){
                e.preventDefault();
                $.ajax({
                    url:
                        id!=null?
                            "/admin/edite_address_type":
                            "/admin/add_address_type",
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
                        $('#successMsg').show();
                        console.log(response);
                        if(response.route !==''){
                            window.location.replace(response.route);
                        }
                    },
                    error: function(response) {
                        $("#loader").css({"display": "none"});
                        console.log(response);
                        $('#nameErrorMsg').text((response.responseJSON.errors.name??[''])[0]);
                    },
                });
            });
        });


    </script>


@endsection



