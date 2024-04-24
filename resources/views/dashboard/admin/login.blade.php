@extends('layouts.adminindex')

@section('content')
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-12">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        {!!'Login Admin'!!}--}}
{{--                    </div>--}}

{{--                    <div class="card-body">--}}
{{--                        <div class="alert alert-success" role="alert" id="successMsg" style="display: none" >--}}
{{--                            Thank you for getting in touch!--}}
{{--                        </div>--}}
{{--                        <form method="POST" class="row" enctype="multipart/form-data" id="SubmitForm" action="{{route('add_admin')}}">--}}
{{--                        <form id="SubmitForm">--}}
{{--                            @csrf--}}

{{--                            <div class="form-group col-md-12">--}}
{{--                                <label for="phone">الهاتف</label>--}}
{{--                                <input type="text" class="form-control" id="phone" name= "phone" placeholder="الهاتف"--}}
{{--                                       value="{{!is_null($admin??null)? $admin->phone:old('phone')}}">--}}
{{--                                <span class="text-danger" id="phoneErrorMsg"></span>--}}
{{--                            </div>--}}

{{--                            <div class="form-group col-md-12">--}}
{{--                                <label for="password">كلمة المرور</label>--}}
{{--                                <input type="text" class="form-control" id="password" name= "password" placeholder="كلمة المرور"--}}
{{--                                       value="{{!is_null($admin??null)? $admin->password:old('password')}}">--}}
{{--                                <span class="text-danger" id="passwordErrorMsg"></span>--}}
{{--                            </div>--}}

{{--                            <button type="submit" class="btn btn-primary">Submit</button>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <style>
        .login {
            background-color: #fff;
            height: 100vh;
        }
        .login h2 {
            font-family: "bold";
        }
        .login span {
            font-family: "regular";
            margin-bottom: 3rem;
            display: block;
        }
        .login img {
            height: 100vh;
            width: 100%;
        }
        .login .form-group {
            position: relative;
        }
        .login .form-group .form-control {
            font-family: "regular";
            padding: .75rem;
            font-size: .8rem;
        }
        .login .form-group i {
            position: absolute;
            top: 3rem;
            left: 1rem;
        }
        .login button[type="submit"] {
            font-family: "regular";
            width: 100%;
            background-color: #2F4858;
            color: #fff;
            padding: .75rem;
            font-size: 1rem;
            margin-top: 2rem;
            border-radius: 10px;
            transition: .7s ease-in-out;
        }
        .login button[type="submit"]:hover {
            background-color: #fff;
            color: #2F4858;
            border: 1px solid #2F4858;
            transition: .7s ease-in-out;
        }
    </style>

    <div class="login">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-1 col-12"></div>
                <div class="col-lg-4 col-12 d-flex flex-column justify-content-center" style="height: 100vh">
                    <form id="SubmitForm">
                        @csrf
                        <h2>مرحبا بك</h2>
                        <span>مرحبا بك ، من فضلك قم بادخال بيانات تسجيل الدخول</span>
                        <div class="form-group">
                            <label>رقم الهاتف</label>
                            <input type="number" class="form-control" id="phone" name= "phone" value="{{!is_null($admin??null)? $admin->phone:old('phone')}}" placeholder="ادخل رقم االهاتف">
                            <i class="fas fa-phone-alt"></i>
                            <span class="text-danger" id="phoneErrorMsg"></span>
                        </div>
                        <div class="form-group">
                            <label>كلمه المرور</label>
                            <input type="password" class="form-control" id="password" name= "password" value="{{!is_null($admin??null)? $admin->password:old('password')}}" placeholder="ادخل كلمه المرور">
                            <i class="fas fa-lock"></i>
                            <span class="text-danger" id="passwordErrorMsg"></span>
                        </div>
                        <button type="submit" class="btn">تسجيل الدخول</button>
                    </form>
                </div>
                <div class="col-lg-1 col-12"></div>
                <div class="col-lg-6 col-12">
                    <img src="{{asset("assets/media/login.png")}}" />
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
                $('#SubmitForm').on('submit',function(e){
                    e.preventDefault();
                    let phone = $('#phone').val();
                    let password = $('#password').val();
                    $data = {
                        "_token": "{{ csrf_token() }}",
                        phone:phone,
                        password:password,
                    };
                    // $imageWindow.modal('show');
                    $.ajax({
                        url: "/admin/login",
                        type:"POST",
                        data:$data,
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
                            $('#phoneErrorMsg').text((response.responseJSON.errors.phone??[''])[0]??'');
                            $('#passwordErrorMsg').text((response.responseJSON.errors.password??[''])[0]??'');
                            // alert(response.responseJSON.message??'');
                        },
                    });
                });
        });


    </script>


@endsection



