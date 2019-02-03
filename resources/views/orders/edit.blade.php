@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> Create Order</div>

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
