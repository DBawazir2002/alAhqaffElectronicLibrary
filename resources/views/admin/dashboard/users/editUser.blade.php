@extends('layouts.app1')
    <!-- Page Content -->
@section('content')
    <!-- Page Content -->

    <div class="container-fluid">
        <!-- Start new user -->
        <div class="new-book">
            <form method="POST" action="/admin/users/{{$user->id}}">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="name">اسم المستخدم</label>
                    <input type="text" id="title" class="form-control" name="name" value="{{$user->name}}">
                    @error('name')
                        <div class="text-danger">
                            <small >{{$message}}</small>
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">البريد الالكتروني</label>
                    <input type="email" id="email" class="form-control" name="email" value="{{$user->email}}">
                    @error('email')
                        <div class="text-danger">
                            <small >{{$message}}</small>
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="role">الصلاحيات</label>
                    <select class="form-control" name="role">
                            @if ($user->role == '1')
                            <option value="1">مستخدم مدير</option>
                            <option value="0">مستخدم عادي</option>
                            @else
                            <option value="0">مستخدم عادي</option>
                            <option value="1">مستخدم مدير</option>
                            @endif
                    </select>
                    @error('role')
                        <div class="text-danger">
                            <small >{{$message}}</small>
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">كلمة المرور</label>
                    <input type="password" name="password" id="password" class="form-control">
                    @error('password')
                    <div class="text-danger">
                        <small>{{$message}}</small>
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">تأكيد كلمة المرور</label>
                    <input type="password_confirmation" name="password_confirmation" id="password_confirmation" class="form-control">
                    @error('password_confirmation')
                    <div class="text-danger">
                        <small>{{$message}}</small>
                    </div>
                    @enderror
                </div>
                <button class="custom-btn">تعديل</button>
            </form>
        </div>
        <!-- End new user -->
    </div>
    <!-- /#page-content-wrapper -->

@endsection
