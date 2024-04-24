@extends("layouts.masterlayout")
@section("content")
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header flex-wrap py-5">
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <a href="{{route('add_permission_form')}}" class="btn btn-primary font-weight-bolder" >
                    <span class="svg-icon svg-icon-md">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <circle fill="#000000" cx="9" cy="15" r="6" />
                                <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>{{'اضافة صلاحية'}}</a>
                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                <table class="table table-responsive-sm" id="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">الاسم</th>
                        <th scope="col">الاسم المعروض</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for ($i = 0; $i < count($permissions); $i++)
                        <tr>
                            <th scope="row">{{$permissions[$i]->id??''}}</th>
                            <td>{{$permissions[$i]->name??''}}</td>
                            <td>{{$permissions[$i]->display_name??''}}</td>
                            <td>
                                <a href="{{route('edite_permission_form',['id' => $permissions[$i]->id])}}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3" id="editState">
                                    <i class="fas fa-edit text-primary"></i>
                                </a>
                                <a href="{{route('delete_permission',['id' => $permissions[$i]->id])}}" class="btn btn-icon btn-light btn-hover-danger btn-sm" id="deleteState" type="click">
                                    <i class="fas fa-trash text-danger"></i>
                                </a>
{{--                                <script>--}}
{{--                                    document.getElementById('deleteState').onclick = function() {--}}
{{--                                        swal("Are you sure delete ?!!", "You clicked the button!", "error");--}}
{{--                                    };--}}
{{--                                </script>--}}
{{--                                <script>--}}
{{--                                    document.getElementById('editState').onclick = function() {--}}
{{--                                        swal("Are you sure delete ?!!", "You clicked the button!", "error");--}}
{{--                                    };--}}
{{--                                </script>--}}
                            </td>
                        </tr>
                    @endfor
{{--                    <tr>--}}
{{--                        <th scope="row">1</th>--}}
{{--                        <td>Mark</td>--}}
{{--                        <td>--}}
{{--                            <a href="" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">--}}
{{--                                <i class="fas fa-edit text-primary"></i>--}}
{{--                            </a>--}}
{{--                            <a href="#" class="btn btn-icon btn-light btn-hover-danger btn-sm" id="deleteState">--}}
{{--                                <i class="fas fa-trash text-danger"></i>--}}
{{--                            </a>--}}
{{--                            <script>--}}
{{--                                document.getElementById('deleteState').onclick = function() {--}}
{{--                                    swal("Are you sure delete ?!!", "You clicked the button!", "error");--}}
{{--                                };--}}
{{--                            </script>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <th scope="row">2</th>--}}
{{--                        <td>Jacob</td>--}}
{{--                        <td>--}}
{{--                            <a href="" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">--}}
{{--                                <i class="fas fa-edit text-primary"></i>--}}
{{--                            </a>--}}
{{--                            <a href="#" class="btn btn-icon btn-light btn-hover-danger btn-sm" id="deleteState2">--}}
{{--                                <i class="fas fa-trash text-danger"></i>--}}
{{--                            </a>--}}
{{--                            <script>--}}
{{--                                document.getElementById('deleteState2').onclick = function() {--}}
{{--                                    swal("Are you sure delete ?!", "You clicked the button!", "error");--}}
{{--                                };--}}
{{--                            </script>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <th scope="row">3</th>--}}
{{--                        <td>Larry</td>--}}
{{--                        <td>--}}
{{--                            <a href="" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">--}}
{{--                                <i class="fas fa-edit text-primary"></i>--}}
{{--                            </a>--}}
{{--                            <a href="#" class="btn btn-icon btn-light btn-hover-danger btn-sm" id="deleteState3">--}}
{{--                                <i class="fas fa-trash text-danger"></i>--}}
{{--                            </a>--}}
{{--                            <script>--}}
{{--                                document.getElementById('deleteState3').onclick = function() {--}}
{{--                                    swal("Are you sure delete ?!", "You clicked the button!", "error");--}}
{{--                                };--}}
{{--                            </script>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
                    </tbody>
                </table>
            </div>
        </div>
        <!--end::Card-->
    </div>
@endsection


@section('scripts')
    <!--begin::Page Vendors(used by this page)-->
    <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{asset('assets/js/pages/crud/datatables/basic/basic.js')}}"></script>
    <!--end::Page Scripts-->
    <script src="{{asset('assets/js/sweetalert.min.js')}}"></script>


    <script>
            $('#deleteState').click(function(e){
                $.ajax({
                    url: "/delete_permission",
                    type:"POST",
                    data:{
                        'id':1,
                    },
                    beforeSend: function(){
                        $("#loader").css({"display": "flex"});
                    },
                    success:function(response){
                        $("#loader").css({"display": "none"});
                        window.location.reload();
                    },
                    error: function(response) {
                        $("#loader").css({"display": "none"});
                    },
                });
            });
    </script>


@endsection
