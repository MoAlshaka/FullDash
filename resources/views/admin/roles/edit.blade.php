@extends('layouts.master')

@section('title')
    {{ env('APP_NAME') }} - {{ __('title.EditRole') }} - {{ $role->name }}
@endsection


@section('css')
@endsection


@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @if (session()->has('Error'))
            <div class="alert alert-danger" role="alert">{{ session()->get('Error') }}</div>
        @endif
        <h4 class="py-3 mb-4"><span class="text-muted fw-light"> {{ __('site.Dashboard') }}/</span> {{ __('site.Roles') }} /
            {{ __('site.Edit') }}</h4>
        <form action="{{ route('roles.update', $role->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="mb-3">
                    <label class="form-label" for="bs-validation-name"> {{ __('site.RoleName') }}<span
                            class="text-danger">*</span></label>
                    <input name="name" type="text" class="form-control" placeholder="{{ __('site.RoleName') }}"
                        value="{{ old('name', $role->name) }}">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label" for="bs-validation-Permissions">{{ __('site.Permissions') }}
                        <span class="text-danger">*</span></label>
                    <div class="form-check">
                        <input class="form-check-input select-all" type="checkbox" id="selectAll">
                        <label class="form-check-label" for="selectAll"> {{ __('site.SelectAll') }}
                        </label>

                    </div>
                    @foreach ($permission as $value)
                        <div class="form-check">
                            <input name="permission[]" class="form-check-input name" type="checkbox"
                                value="{{ $value->id }}" id="defaultCheck2"
                                @if (in_array($value->id, $rolePermissions)) checked @endif>
                            <label class="form-check-label" for="defaultCheck2"> {{ $value->name }} </label>

                        </div>
                    @endforeach
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">{{ __('site.Edit') }}</button>
                </div>
            </div>
        </form>

    </div>
@endsection


@section('js')
    <script>
        // Handle the "Select All" checkbox
        const selectAllCheckbox = document.querySelector('.select-all');
        const permissionCheckboxes = document.querySelectorAll('.name');

        selectAllCheckbox.addEventListener('change', function() {
            permissionCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });
    </script>
@endsection
