@extends('layouts.app1')
    <!-- Page Content -->
@section('content')

    <!-- Page Content -->

      <div class="container-fluid">

        <div class="profile">
            <form action="/admin/profile" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="name">الإسم</label>
                    <input type="text" class="form-control" id="name" value="{{$user->name}}" name="name">
                    @error('name')
                    <div class="text-danger">
                        <small></small>
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">البريد الإلكتروني</label>
                    <input type="text" class="form-control" id="email"  value="{{$user->email}}" name="email">
                    @error('email')
                    <div class="text-danger">
                        <small>{{$message}}</small>
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
                    <label for="password-confirmation">تأكيد كلمة المرور</label>
                    <input type="password-confirmation" name="password_confirmation" id="password-confirmation" class="form-control">
                    @error('password-confirmation')
                    <div class="text-danger">
                        <small>{{$message}}</small>
                    </div>
                    @enderror
                </div>

                <button class="custom-btn" name="edit">تعديل البيانات</button>
            </form>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

@endsection
