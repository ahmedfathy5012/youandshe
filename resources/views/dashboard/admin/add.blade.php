@extends('layouts.masterlayout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {!!'Add New Admin'!!}
                    </div>

                    <div class="card-body">
                        <div class="alert alert-success" role="alert" id="successMsg" style="display: none" >
                            Thank you for getting in touch!
                        </div>
{{--                        <form method="POST" class="row" enctype="multipart/form-data" id="SubmitForm" action="{{route('add_admin')}}">--}}
                        <form id="SubmitForm">
                            @csrf
                            @if (!is_null($admin??null))
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="id" id="id" value="{{$admin->id}}">
                            @endif

                            <div class="form-group col-md-12">
                                <label for="name">الاسم</label>
                                <input type="text" class="form-control" id="name" name= "name" placeholder="الاسم"
                                       value="{{!is_null($admin??null)? $admin->name:old('name')}}">
                                <span class="text-danger" id="nameErrorMsg"></span>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="phone">الهاتف</label>
                                <input type="text" class="form-control" id="phone" name= "phone" placeholder="الهاتف"
                                       value="{{!is_null($admin??null)? $admin->phone:old('phone')}}">
                                <span class="text-danger" id="phoneErrorMsg"></span>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="password">كلمة المرور</label>
                                <input type="password" class="form-control" id="password" name= "password" placeholder="كلمة المرور"
                                       value="{{!is_null($admin??null)? $admin->password:old('password')}}">
                                <span class="text-danger" id="passwordErrorMsg"></span>
                            </div>

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
                $('#SubmitForm').on('submit',function(e){
                    e.preventDefault();
                    let name = $('#name').val();
                    let phone = $('#phone').val();
                    let password = $('#password').val();
                    let id = $('#id').val();
                    $data = {
                        "_token": "{{ csrf_token() }}",
                        name:name,
                        phone:phone,
                        password:password,
                        id: id,
                    };
                    // $imageWindow.modal('show');
                    $.ajax({
                        url:
                            id!=null?
                                "/admin/edite_admin":
                                "/admin/add_admin",
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
                            $('#nameErrorMsg').text((response.responseJSON.errors.name??[''])[0]??'');
                            $('#phoneErrorMsg').text((response.responseJSON.errors.phone??[''])[0]??'');
                            $('#passwordErrorMsg').text((response.responseJSON.errors.password??[''])[0]??'');
                            // alert(response.responseJSON.message??'');
                        },
                    });
                });
        });


    </script>


@endsection



