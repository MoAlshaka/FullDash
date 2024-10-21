@extends('layouts.master')

@section('title')
    {{ $app_name }} - إنشاء مستخدم
@endsection


@section('css')
@endsection


@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">الرئيسية /</span>إنشاء مستخدم</h4>
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0"> إنشاء مستخدم جديد </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">الإسم<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" id="basic-default-name"
                                    placeholder="الإسم" value="{{ old('name') }}" />
                            </div>
                        </div>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="username">اسم المستخدم<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="username" class="form-control" id="username"
                                    placeholder="اسم المستخدم" value="{{ old('username') }}" />
                            </div>
                        </div>
                        @error('username')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="row mb-3 form-password-toggle">
                            <label class="col-sm-2 col-form-label" for="multicol-password">كلمه السر<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input type="password" name="password" id="multicol-password" class="form-control"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="multicol-password2" />
                                    <span class="input-group-text cursor-pointer" id="multicol-password2"><i
                                            class="ti ti-eye-off"></i></span>
                                </div>
                            </div>
                        </div>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="status">الحاله<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select id="status" name="status" class=" form-select" data-allow-clear="true">
                                    <option value="">اختر الحاله</option>
                                    <option value="1" @if (old('status') == '1') selected @endif>مفعل</option>
                                    <option value="0" @if (old('status') == '0') selected @endif>معطل</option>
                                </select>
                            </div>
                        </div>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="roles">الصلاحية<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select id="roles" name="roles[]" class="select2 form-select" data-allow-clear="true"
                                    multiple>
                                    <option value="">اختر الصلاحية</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}"
                                            @if (old('roles_name') == $role) selected @endif>
                                            {{ $role }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        @error('roles')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">إضافه</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection


@section('js')
@endsection
