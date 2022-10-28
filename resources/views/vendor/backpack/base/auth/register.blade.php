@extends(backpack_view('layouts.plain'))

@section('content')
    <div class="row no-gutters h-100 overflow-hidden ">
        <div class="col-md-6 bg-content-left p-5 d-flex justify-content-center align-items-center bg-primary"
            style="background:#004876!important">
            <div class="main-content-wrapper text-center logos">
                <div class="main-logo">
                    <img src="{{ asset('assets/indication-plus-intro.svg') }}" style="margin-bottom: 2rem;" class="img-fluid"
                        alt="logo" />
                </div>
                <div class="intro-content-title mb-5">
                    <span class="text-uppercase d-block" style="font-weight: 500;font-size: 10px;line-height: 12.19px;color: #b1b1b1;">TOGETHER IS VALUE</span>
                </div>
                <div class="into-description">
                    <p style="font-weight: 700; font-size: 30px; line-height: 43.2px; font-family: Gotham,sans-serif;"> The <span style="color: #ee907b!important;">First</span> Digital Appraisal
                        <br> Service Platform In
                        <br> <span style="color: #ee907b!important;">Cambodia</span>
                    </p>
                </div>
            </div>
            <div class="img-footer" style="position: absolute;bottom: 0;">
                <img src="{{ asset('assets/skyline.svg') }}" class="img-fluid" alt="bg-footer" />
            </div>
        </div>
        <div class="col-md-6 p-5 d-flex justify-content-center align-items-center">
            <div class="form-style form-custom">
                <div class="card border-0 rounded-0 bg-white p-4 position-relative">
                    <div class="card-body p-4">
                        <form class="col-md-12 p-t-10" role="form" method="POST" action="{{ route('backpack.auth.register') }}">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label class="control-label" for="name">{{ trans('backpack::base.name') }}</label>
                                <div>
                                    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="{{ backpack_authentication_column() }}">{{ config('backpack.base.authentication_column_name') }}</label>
                                <div>
                                    <input type="{{ backpack_authentication_column() == 'email' ? 'email' : 'text' }}" class="form-control{{ $errors->has(backpack_authentication_column()) ? ' is-invalid' : '' }}" name="{{ backpack_authentication_column() }}" id="{{ backpack_authentication_column() }}" value="{{ old(backpack_authentication_column()) }}">
                                    @if ($errors->has(backpack_authentication_column()))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first(backpack_authentication_column()) }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">{{ trans('backpack::base.password') }}</label>
                                <div>
                                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password_confirmation">{{ trans('backpack::base.confirm_password') }}</label>
                                <div>
                                    <input type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" id="password_confirmation">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group" style="width: 400px;">
                                <div>
                                    <button type="submit" class="btn btn-block btn-dark font-weight-600">
                                        {{ trans('backpack::base.register') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
