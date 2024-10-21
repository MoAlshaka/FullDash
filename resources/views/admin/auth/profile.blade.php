@extends('layouts.master')

@section('title')
    {{ env('APP_NAME') }}- {{ __('title.MyProfile') }}
@endsection


@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection


@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light"> {{ __('site.Dashboard') }} /</span>
            {{ __('site.PersonalAccount') }}</h4>
        @if (session()->has('Update'))
            <div class="alert alert-primary" role="alert">{{ session()->get('Update') }}</div>
        @endif
        @if (session()->has('Add'))
            <div class="alert alert-primary" role="alert">{{ session()->get('Add') }}</div>
        @endif
        @if (session()->has('Delete'))
            <div class="alert alert-danger" role="alert">{{ session()->get('Delete') }}</div>
        @endif
        <!-- content -->
        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <h4 class="card-header">{{ __('site.AccountDetails') }}</h4>
                    <!-- Account -->

                    <div class="card-body pt-2 mt-1">
                        <form id="formAccountSettings" method="POST"
                            action="{{ route('admin.update.profile', Auth::user()->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    @if (auth()->user()->image)
                                        <img src="{{ asset('assets/users/images/' . auth()->user()->image) }}"
                                            alt="user-avatar" class="d-block w-px-120 h-px-120 rounded" id="uploadedAvatar"
                                            style="height: 100px; width: 100px;" />
                                    @else
                                        <img src="{{ Avatar::create(auth()->user()->name)->toBase64() }}" alt="user-avatar"
                                            class="d-block w-px-120 h-px-120 rounded" id="uploadedAvatar"
                                            style="height: 100px; width: 100px;" />
                                    @endif
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                            <span class="d-none d-sm-block">{{ __('site.UplodeNewPhoto') }}</span>
                                            <i class="mdi mdi-tray-arrow-up d-block d-sm-none"></i>
                                            <input type="file" name="image" id="upload" class="account-file-input"
                                                hidden accept="image/png, image/jpeg" />
                                        </label>
                                        <button type="button" class="btn btn-outline-danger account-image-reset mb-3">
                                            <i class="mdi mdi-reload d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">{{ __('site.Reset') }}</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2 gy-4">
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input class="form-control" type="text" id="Name" name="name"
                                            value="{{ Auth::user()->name }}" autofocus />
                                        <label for="Name"> {{ __('site.Name') }} <span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                @error('name')
                                    <div class="text-danger mb-3">{{ $message }}</div>
                                @enderror
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input class="form-control" type="text" id="UserName" name="username"
                                            value="{{ Auth::user()->username }}" autofocus />
                                        <label for="UserName"> {{ __('site.Username') }} <span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                @error('username')
                                    <div class="text-danger mb-3">{{ $message }}</div>
                                @enderror
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input class="form-control" type="text" id="phone" name="phone"
                                            value="{{ Auth::user()->phone }}" autofocus />
                                        <label for="phone"> {{ __('site.Phone') }}</label>
                                    </div>
                                </div>
                                @error('phone')
                                    <div class="text-danger mb-3">{{ $message }}</div>
                                @enderror



                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary me-2">
                                    {{ __('site.SaveChanges') }} </button>
                                <button type="reset" class="btn btn-outline-secondary">{{ __('site.Reset') }}</button>
                            </div>

                        </form>
                    </div>
                    <!-- /Account -->
                </div>
                <div class="card">
                    <h5 class="card-header">{{ __('site.ChangePassword') }} </h5>
                    <div class="card-body">
                        @if (session()->has('pass_error'))
                            <div class="alert alert-danger" role="alert">{{ session()->get('pass_error') }}</div>
                        @endif
                        <form id="formAccountDeactivation" action="{{ route('admin.change.password', Auth::user()->id) }}"
                            method="POST">
                            @csrf
                            <div class="row mb-3 form-password-toggle">
                                <label class="col-sm-2 col-form-label" for="old_password">{{ __('site.CurrentPassword') }}
                                    <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <input type="password" name="old_password" id="old_password" class="form-control"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="multicol-password2" />
                                        <span class="input-group-text cursor-pointer" id="multicol-password2"><i
                                                class="ti ti-eye-off"></i></span>
                                    </div>
                                </div>
                                @error('old_password')
                                    <div class="text-danger mb-3">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row mb-3 form-password-toggle">
                                <label class="col-sm-2 col-form-label" for="new_password">{{ __('site.NewPassword') }}
                                    <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <input type="password" name="new_password" id="new_password"
                                            class="form-control"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="multicol-password2" />
                                        <span class="input-group-text cursor-pointer" id="multicol-password2"><i
                                                class="ti ti-eye-off"></i></span>
                                    </div>
                                </div>
                                @error('new_password')
                                    <div class="text-danger mb-3">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row mb-3 form-password-toggle">
                                <label class="col-sm-2 col-form-label" for="confirm_password">
                                    {{ __('site.ConfirmNewPassword') }}<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <input type="password" name="confirm_password" id="confirm_password"
                                            class="form-control"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="multicol-password2" />
                                        <span class="input-group-text cursor-pointer" id="multicol-password2"><i
                                                class="ti ti-eye-off"></i></span>
                                    </div>
                                </div>
                                @error('confirm_password')
                                    <div class="text-danger mb-3">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary me-2">{{ __('site.Change') }} </button>
                                <button type="reset" class="btn btn-outline-secondary">{{ __('site.Reset') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <!-- end content -->

    </div>
@endsection


@section('js')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    {{-- <script src="{{ asset('assets/vendor/libs/@form-validation/popular.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/bootstrap5.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/vendor/libs/@form-validation/auto-focus.js') }}"></script> --}}
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endsection
