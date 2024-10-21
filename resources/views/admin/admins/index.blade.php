@extends('layouts.master')

@section('title')
    {{ $app_name }} - المستخدمين
@endsection


@section('css')
@endsection


@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">الرئيسية /</span> المستخدمين</h4>
        @if (session()->has('Add'))
            <div class="alert alert-success" role="alert">{{ session()->get('Add') }}</div>
        @endif
        @if (session()->has('Update'))
            <div class="alert alert-primary" role="alert">{{ session()->get('Update') }}</div>
        @endif
        @if (session()->has('Delete'))
            <div class="alert alert-danger" role="alert">{{ session()->get('Delete') }}</div>
        @endif
        @if (session()->has('Warning'))
            <div class="alert alert-warning" role="alert">{{ session()->get('Warning') }}</div>
        @endif
        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">المستخدمين</h5>
                @can('إضافة مستخدم')
                    <a href="{{ route('users.create') }}" class="btn btn-sm btn-success m-2">
                        إضافه
                    </a>
                @endcan

            </div>
            <div class="table-responsive text-nowrap">
                <input type="hidden" id="ajax_search_url" value="{{ route('users.ajax_search') }}">
                <input type="hidden" id="token_search" value="{{ csrf_token() }}">
                <div class="col-md-6 p-2">
                    <input type="text" id="search_by_text" placeholder="بحث بالاسم" class="form-control">
                    <br />
                </div>
                <div id="ajax_search_table">
                    @if (@isset($users) && count($users) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>اسم المستخدم</th>
                                    <th>الحاله</th>
                                    <th>الهاتف</th>
                                    <th>المزيد</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>
                                            {{ $user->name }}
                                            @if (auth()->user()->id == $user->id)
                                                <span class="badge bg-gray"> أنت</span>
                                            @endif
                                        </td>
                                        <td> {{ $user->username }}</td>
                                        <td>
                                            @if ($user->status == 1)
                                                <span class="badge bg-success">مفعل</span>
                                            @else
                                                <span class="badge bg-danger">معطل</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->phone ?? 'ـــــــــ' }}</td>

                                        <td class="text-center d-flex">
                                            @can('تعديل مستخدم')
                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class="btn btn-sm btn-info me-2">
                                                    <i class="fa fa-edit"></i> تعديل
                                                </a>
                                            @endcan
                                            @can('حذف مستخدم')
                                                @if (auth()->user()->id !== $user->id)
                                                    <form id="user-delete-{{ $user->id }}"
                                                        action="{{ route('users.destroy', $user->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger sa-delete me-2">
                                                            <i class="fa fa-trash"></i> حذف
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
                        {{ $users->links() }}
                    @else
                        <div class="alert alert-danger">
                            عفوا لا توجد بيانات لعرضها !!

                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection


@section('js')
    <script src="{{ asset('assets/javascript/users.js') }}"></script>
@endsection
