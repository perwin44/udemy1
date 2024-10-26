{{-- @extends('layouts.master')

@section('content')
    <h1>{{__('frontend.test')}}</h1>
@endsection --}}
@extends('layouts.master')

@section('content')
    <div class="">
        <div class="">
            <a href="{{route('greeting','en')}}" class="btn btn-primary">English</a>
            <a href="{{route('greeting','hi')}}" class="btn btn-primary">Hindi</a>
        </div>
        <div class="display-3">{{__('frontend.Welcome to Our Application!')}}</div>
        <p>{{__('frontend.Laravels localization features provide a convenient way to retrieve strings in various languages, allowing you to easily support multiple languages within your application.')}}</p>
        <div class="row">
            <ul class="row">
                <li>{{__('frontend.home')}}</li>
                <li>{{__('frontend.about')}}</li>
                <li>{{__('frontend.contact')}}</li>
                <li>{{__('frontend.more')}}</li>
            </ul>
        </div>
    </div>
@endsection