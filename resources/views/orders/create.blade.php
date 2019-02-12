@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Create Order
                        <a href="{{ URL('orders') }}" class="btn btn-success float-right">List</a>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ URL('orders') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">Account</label>

                                <div class="col-md-6">
                                    <input id="account" type="float"
                                           class="form-control{{ $errors->has('account') ? ' is-invalid' : '' }}"
                                           name="account" value="{{ old('account') }}" required autofocus>

                                    @if ($errors->has('account'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('account') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col ">
                                    <select class="form-control" name="channel_code" id="channels">
                                        @foreach($channels as $channel)
                                            <option value="{{$channel['code']}}">{{$channel['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col ">
                                    @foreach($channels as $channel)
                                        <select class="form-control paychannel-type" name="type_code"
                                                id="channel-code-{{$channel['code']}}">
                                            @foreach($channel['types'] as $type)
                                                <option value="{{$type->code}}"> {{$type->name}}</option>
                                            @endforeach
                                        </select>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                    <a href=" {{URL('orders')}} " class="btn btn-dark">BACK</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('javascript')
    <script>
        $(document).ready(function () {
            $('.paychannel-type').css('display', 'none').prop('disabled', 'disabled');
            $('.paychannel-type:first').css('display', 'block').prop('disabled', false);

            $("#channels").bind("change", function () {
                channel_code = this.value;
                $('.paychannel-type').css('display', 'none').prop('disabled', 'disabled');
                $('#channel-code-' + channel_code).css('display', 'block').prop('disabled', false);
            });
        });
    </script>
@endsection

