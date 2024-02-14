@extends('layouts.app1')

@section('content')
<div class="container-fluid">
    <div class="mails">
    <div class="add-cat">
        <h3>ارسال رسالة بالبريد الالكتروني الى جميع المستخدمين او مستخدم معين</h3>
        @if ($users)
                    <form action="{{route('sendMail')}}" method="POST">
                        @csrf
                        <div class="form-group">
                        <label for="cat"> موضوع الرسالة :</label>
                        <input type="text" id="cat" class="form-control" name="subject">
                        @error('subject')
                            <div>
                                <small class="text-danger">{{$message}}</small>
                            </div>
                        @enderror
                        </div>


                        <div class="form-group">
                        <label for="user">المستلم</label>
                        <select class="form-control" name="user">
                            <option value=""></option>
                            <option value="all">كل المستخدمين</option>
                            @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                        @error('user')
                            <div>
                                <small class="text-danger">{{$message}}</small>
                            </div>
                        @enderror
                    </div>
                <div class="form-group">
                    <label for="message">نص الرسالة</label>
                    <textarea name="message" id="" cols="30" rows="10" class="form-control"></textarea>
                    @error('message')
                        <div>
                            <small class="text-danger">{{$message}}</small>
                        </div>
                    @enderror
                </div>
                <button type="submit" class="custom-btn">ارسال</button>
            </form>
        @else
                <div class="alert alert-danger text-center">
                    <h3>لم يتم تسجيل اي مستخدمين</h3>
                </div>
            @endif
    </div>
</div>
</div>
@endsection
