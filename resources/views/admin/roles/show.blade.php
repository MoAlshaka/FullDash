@extends('layouts.master')

@section('title')
    {{ env('APP_NAME') }} - {{ __('title.ShowRole') }} - {{ $role->name }}
@endsection


@section('css')
@endsection


@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light"> {{ __('site.Dashboard') }}/</span> {{ __('site.Roles') }} /
            {{ __('site.Show') }}</h4>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('site.RoleName') }}:</strong>
                {{ $role->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong> {{ __('site.Permissions') }}:</strong>
                @if (!empty($rolePermissions))
                    @foreach ($rolePermissions as $v)
                        <label class="label label-success">{{ $v->name }},</label>
                    @endforeach
                @endif
            </div>
        </div>

    </div>
@endsection


@section('js')
@endsection
