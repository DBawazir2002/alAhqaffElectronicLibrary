@extends('layouts.app2')
    <!-- Page Content -->
@section('content')

    <!-- Page Content -->

      <div class="container-fluid">

        <div class="profile">
            <form action="{{route('profile')}}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="name">الإسم</label>
                    <input type="text" class="form-control" id="name" value="{{$user->name}}" name="name">
                    @error('name')
                    <div class="text-danger">
                        <small>{{$message}}</small>
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
                    <label for="pass">كلمة السر</label>
                    <input type="text" class="form-control" id="pass"  value="" name="password">
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
            <form action="/nUser/user/{{auth()->user()->id


            }}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger confirm">حذف حسابي</button>
            </form>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

@endsection
