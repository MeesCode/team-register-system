@extends('layouts.app')

@section('content')

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{__('custom.full_name_coach')}}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('custom.email') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        {{-- my own additions --}} 

        <div class="form-group row">
            <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{__('custom.phone_number')}}</label>

            <div class="col-md-6">
                <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number">

                @error('phone_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="school_name" class="col-md-4 col-form-label text-md-right">{{__('custom.name')}} {{__('custom.school')}}</label>

            <div class="col-md-6">
                <input id="school_name" type="text" class="form-control @error('school_name') is-invalid @enderror" name="school_name" value="{{ old('school_name') }}" required autocomplete="school_name">

                @error('school_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="school_place" class="col-md-4 col-form-label text-md-right">{{__('custom.place')}} {{__('custom.school')}}</label>

            <div class="col-md-6">
                <input id="school_place" type="text" class="form-control @error('school_place') is-invalid @enderror" name="school_place" value="{{ old('school_place') }}" required autocomplete="school_place">

                @error('school_place')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="school_address" class="col-md-4 col-form-label text-md-right">{{__('custom.address')}} {{__('custom.school')}}</label>

            <div class="col-md-6">
                <input id="school_address" type="text" class="form-control @error('school_address') is-invalid @enderror" name="school_address" value="{{ old('school_address') }}" required autocomplete="school_address">

                @error('school_address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="school_postal_code" class="col-md-4 col-form-label text-md-right">{{__('custom.postal_code')}} {{__('custom.school')}}</label>

            <div class="col-md-6">
                <input id="school_postal_code" type="text" class="form-control @error('school_postal_code') is-invalid @enderror" name="school_postal_code" value="{{ old('school_postal_code') }}" required autocomplete="school_postal_code">

                @error('school_postal_code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('custom.password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('custom.confirm_password') }}</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </div>
        </div>
    </form>

@endsection
