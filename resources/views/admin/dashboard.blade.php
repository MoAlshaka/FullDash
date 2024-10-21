@extends('layouts.master')

@section('title')
    {{ env('APP_NAME') }}-{{ __('title.Dashboard') }}
@endsection


@section('css')
@endsection


@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">{{ __('site.Dashboard') }} /</span> </h4>


    </div>
@endsection


@section('js')
@endsection
