@extends('layouts.app1')
    <!-- Page Content -->
@section('content')

<div class="container-fluid">
    <div class="show-users">
        @if ($users)


        <table class="table text-center">
            <thead class="btn-color">
                <tr>
                    <th scope="col">الرقم</th>
                    <th scope="col">الاسم</th>
                    <th scope="col">البريد الالكتروني</th>
                    <th scope="col">الدور</th>
                    <th scope="col">عدد تحميلات الكتب</th>
                    <th scope="col">تاريخ الإضافة</th>
                    <th scope="col">الإجراء</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)


                    <tr>
                        <td><a href="/admin/users/{{$user->id}}" style="text-decoration: none; color: black;">{{$user->id}}</a></td>
                        <td><a href="/admin/users/{{$user->id}}" style="text-decoration: none; color: black;">{{$user->name}}</a></td>
                        <td><a href="/admin/users/{{$user->id}}" style="text-decoration: none; color: black;">{{$user->email}}</a></td>
                        <td><a href="/admin/users/{{$user->id}}" style="text-decoration: none; color: black;">@if ($user->role == '0')
                                مستخدم عادي
                        @else
                            مستخدم مدير
                        @endif</a></td>
                        <td><a href="/admin/users/{{$user->id}}" style="text-decoration: none; color: black;">{{$user->number_of_downloads_books}}</a></td>
                        <td><a href="/admin/users/{{$user->id}}" style="text-decoration: none; color: black;">{{$user->created_at}}</a></td>
                        <td>

                            <p><button type="submit" class="custom-btn"><a href="/admin/users/{{$user->id}}/edit">تعديل</a></button>

                            <form action="/admin/users/{{$user->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="custom-btn confirm">&nbsp;حذف</button>
                            </form>
                        </p>
                        </td>
                    </tr>

                    @empty
                    <div class="text-danger">
                        <small >لم يتم تسجيل اي مستخدمين اخرين </small>
                    </div>
                @endforelse
            </tbody>
        </table>

        <!-- Start pagination -->
        {{$users->links()}}

        @else
        <div class="text-danger">
            <h3 >لم يتم تسجيل اي مستخدمين اخرين </h3>
        </div>
        @endif
    </div>
</div>
<!-- /#page-content-wrapper -->

@endsection
