@extends('layouts.masterlayout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {!!'Add New City'!!}
                    </div>

                    <div class="card-body">
                        <div class="alert alert-success" role="alert" id="successMsg" style="display: none" >
                            Thank you for getting in touch!
                        </div>

{{--                        <div class="card-body">--}}
{{--                            <div class="alert alert-success" role="alert" id="failedMsg" style="display: none" >--}}
{{--                               An Error Occur--}}
{{--                            </div>--}}

                        <form id="SubmitForm">
                            @csrf
                            @if (!is_null($city??null))
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="city_id" id="city_id" value="{{$city->id}}">
                            @endif

{{--                             @for($i=0;$i<6;$i++)--}}
{{--                            <div class="form-group col-md-12">--}}
{{--                                <label for="city_title">الصورة</label>--}}
{{--                                <input name="product_images" type="file" class="form-control-file image-file-upload" value="" id="image">--}}
{{--                            </div>--}}
{{--                            @endfor--}}


                            <div class="form-group col-md-12">
                                <label for="state">المحافظة</label>
                                <select class="form-control" name="state" id="state_id" required>
                                    <option>اختر المحافظة</option>
                                    @foreach ($states as $state)
                                        @if(!is_null($city??null))
                                            <option value="{{$state->id}}"  {{(!is_null($city??null)&&($city->state->id === $state->id)) ? 'selected' : ''}}>{{$state->title}}</option>
                                            @else
                                            <option value="{{$state->id}}" }}>{{$state->title}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <span class="text-danger" id="StateErrorMsg"></span>

                            </div>


                            <div class="form-group col-md-12">
                                <label for="city_title">اسم المدينة</label>
                                <input type="text" class="form-control" id="city_title" name= "title" placeholder="اسم المدينة"
                                       value="{{!is_null($city??null)? $city->title:old('city_title')}}">
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
                    let name = $('#city_title').val();
                    let id = $('#city_id').val();
                    let state_id = $('#state_id').val();
                    $data = {
                        "_token": "{{ csrf_token() }}",
                        title:name,
                        state_id: state_id,
                        id: id,
                    };
                    // $imageWindow.modal('show');
                    $.ajax({
                        url:
                        state_id!=null?
                             "/admin/edite_city":
                            "/admin/add_city",
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
                            $('#failedMsg').show();
                            $('#nameErrorMsg').text((response.responseJSON.errors.title??[''])[0]);
                            $('#nameErrorMsg').text((response.responseJSON.errors.state_id??[''])[0]);
                            // alert(response.responseJSON.message??'');
                        },
                    });
                });
        });


    </script>


@endsection



