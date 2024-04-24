@extends('layouts.masterlayout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        @if (!is_null($cancel_reason??null))
                            {!!'تعديل السبب'!!}
                        @else
                            {!!'اضافة سبب جديد'!!}
                        @endif

                    </div>

                    <div class="card-body">
                        <div class="alert alert-success" role="alert" id="successMsg" style="display: none" >
                            Thank you for getting in touch!
                        </div>
                        <form method="POST" enctype="multipart/form-data" id="SubmitForm" action="" >
                            <meta name="csrf-token" content="{{ csrf_token() }}" />
                            @csrf
                            @if (!is_null($cancel_reason??null))
{{--                                <input type="hidden" name="_method" value="PUT">--}}
                                <input type="hidden" name="id" class="form-control" id="id" value="{{$cancel_reason->id}}">
                            @endif

                            <div class="form-group col-md-12">
                                <label for="product_title">مسمي السبب</label>
                                <input type="text" class="form-control" id="cancel_title" name= "title" placeholder="مسمي السبب"
                                       value="{{!is_null($cancel_reason??null)? $cancel_reason->title:old('cancel_title')}}">
                                <span class="text-danger" id="titleErrorMsg"></span>
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
                            "/admin/edite_cancel_reason":
                            "/admin/add_cancel_reason",
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
                        $('#titleErrorMsg').text((response.responseJSON.errors.title??[''])[0]);
                    },
                });
            });
        });


    </script>


@endsection



