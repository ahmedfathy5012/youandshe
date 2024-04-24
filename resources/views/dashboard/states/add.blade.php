@extends('layouts.masterlayout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {!!'Add New State'!!}
                    </div>

                    <div class="card-body">
                        <div class="alert alert-success" role="alert" id="successMsg" style="display: none" >
                            Thank you for getting in touch!
                        </div>
{{--                        <form method="POST" class="row" enctype="multipart/form-data" id="SubmitForm" action="{{route('add_state')}}">--}}
                        <form id="SubmitForm">
                            @csrf
                            @if (!is_null($state??null))
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="state_id" id="state_id" value="{{$state->id}}">
                            @endif

{{--                             @for($i=0;$i<6;$i++)--}}
{{--                            <div class="form-group col-md-12">--}}
{{--                                <label for="product_title">الصورة</label>--}}
{{--                                <input name="product_images" type="file" class="form-control-file image-file-upload" value="" id="image">--}}
{{--                            </div>--}}
{{--                            @endfor--}}


                            <div class="form-group col-md-12">
                                <label for="product_title">اسم المحافظة</label>
                                <input type="text" class="form-control" id="product_title" name= "title" placeholder="اسم المحافظة"
                                       value="{{!is_null($state??null)? $state->title:old('product_title')}}">
                                <span class="text-danger" id="nameErrorMsg"></span>
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
                    let name = $('#product_title').val();
                    let id = $('#state_id').val();
                    $data = {
                        "_token": "{{ csrf_token() }}",
                        title:name,
                        id: id,
                    };
                    // $imageWindow.modal('show');
                    $.ajax({
                        url:
                            id!=null?
                            "/admin/edite_state":
                            "/admin/add_state",
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
                            $('#nameErrorMsg').text(response.responseJSON.errors.title??'');
                            alert(response.responseJSON.message??'');
                        },
                    });
                });
        });


    </script>


@endsection



