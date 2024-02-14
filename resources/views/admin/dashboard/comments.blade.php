@extends('layouts.app1')

@section('content')

<div class="container-fluid">
    <div class="content">
      <div class="statistics text-center">
        <div class="row">
            @if ($comments)
                @forelse ($comments as $comment)
                    <div class="col-sm-6">
                        <div class="statistic">
                        <h3>اسم الكتاب: {{$comment->book->title}}</h3>
                        <p>التعليق: {{$comment->body}}</p>
                        <form action="/admin/notifications/comments/{{$comment->id}}" method="post">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success">قبول</button>
                        </form>

                        <form action="/admin/notifications/comments/{{$comment->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" id="" class="btn btn-danger">حذف</button>
                        </form>
                        </div>

                    </div>

                @empty
                    <center>
                        <div class="alert-succse">
                        <h1>تمت الموافقة على جميع التعليقات</h1>
                        </div>
                    </center>
                @endforelse
                {{$comments->links()}}

            @else
            <div class="alert-danger text-center">
                <h3>لايوجد اي تعليقات يرجى اضافة الكتب</h3>
            </div>
          @endif
        </div>
      </div>
    </div>
</div>














@endsection
