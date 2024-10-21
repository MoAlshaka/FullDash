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
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-info me-2">
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
        <div class="col-md-12" id="ajax_pagination_in_search">
            {{ $users->links() }}
        </div>
    @else
        <div class="alert alert-danger">
            عفوا لا توجد بيانات لعرضها !!

        </div>
    @endif
</div>
