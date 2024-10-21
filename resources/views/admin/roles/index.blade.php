@extends('layouts.master')

@section('title')
    {{ env('APP_NAME') }} - {{ __('title.Roles') }}
@endsection


@section('css')
@endsection


@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">{{ __('site.Dashboard') }} /</span> {{ __('site.Roles') }}
        </h4>
        @if (session()->has('Add'))
            <div class="alert alert-success" role="alert">{{ session()->get('Add') }}</div>
        @endif
        @if (session()->has('Update'))
            <div class="alert alert-primary" role="alert">{{ session()->get('Update') }}</div>
        @endif
        @if (session()->has('Error'))
            <div class="alert alert-danger" role="alert">{{ session()->get('Error') }}</div>
        @endif
        @if (session()->has('Delete'))
            <div class="alert alert-danger" role="alert">{{ session()->get('Delete') }}</div>
        @endif
        @if (session()->has('Warning'))
            <div class="alert alert-warning" role="alert">{{ session()->get('Warning') }}</div>
        @endif
        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">{{ __('site.Roles') }}</h5>
                @can('Add Role')
                    <a href="{{ route('roles.create') }}" class="btn btn-sm btn-success m-2">
                        {{ __('site.Add') }}
                    </a>
                @endcan

            </div>
            <div class="table-responsive text-nowrap">

                @if (@isset($roles) && count($roles) > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('site.RoleName') }}</th>
                                <th class="text-center">{{ __('site.More') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $role->name }} @if (auth()->user()->hasRole($role->name))
                                            ({{ __('site.You') }})
                                        @endif
                                    </td>
                                    <td class="text-center d-flex justify-content-center">
                                        @can('Show Role')
                                            <a href="{{ route('roles.show', $role->id) }}" class="btn btn-sm btn-info me-2">
                                                <i class="fa fa-eye"></i> {{ __('site.Show') }}
                                            </a>
                                        @endcan
                                        @can('Edit Role')
                                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-primary me-2">
                                                <i class="fa fa-edit"></i> {{ __('site.Edit') }}
                                            </a>
                                        @endcan
                                        @can('Delete Role')
                                            @if (!auth()->user()->hasRole($role->name))
                                                <form id="role-delete-{{ $role->id }}"
                                                    action="{{ route('roles.destroy', $role->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger sa-delete">
                                                        <i class="fa fa-trash"></i> {{ __('site.Delete') }}
                                                    </button>
                                                </form>
                                            @endif
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <br />
                    {{ $roles->links() }}
                @else
                    <div class="alert alert-danger">
                        {{ __('site.NoDateFound') }}

                    </div>
                @endif
            </div>
        </div>

    </div>
@endsection


@section('js')
@endsection
