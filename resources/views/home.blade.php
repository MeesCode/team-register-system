@extends('layouts.app')

@section('content')
    <h2>{{ __('custom.home_header') }}</h2>
    <p>{{ __('custom.home_1') }}</p>
    <p>{!! __('custom.home_2') !!}</p>
    <p>{!! __('custom.home_3') !!}</p>

    <a href="{{route('login')}}">
        <button  class="btn btn-primary" type="submit">{{ __('custom.login') }}</button>
    </a>
    <a href="{{route('register')}}" class="mt-2">
        <button  class="btn btn-primary" type="submit">{{ __('custom.register') }}</button>
    </a>
@endsection