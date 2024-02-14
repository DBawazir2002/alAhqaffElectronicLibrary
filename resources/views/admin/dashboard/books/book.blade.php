@extends('layouts.app1')
    <!-- Page Content -->
@section('content')

<!-- Start show book-->
<div class="books">
    <div class="container">
        <div class="book">
            <div class="row">
                <div class="col-md-4">
                    <img src="/storage/{{$book->bookCover}}" alt="Book cover" height="400" width="400" class="book-cover"/>

                </div>
                <div class="col-md-8">
                    <div class="book-content">
                        <h4>عنوان الكتاب: {{$book->title}}</h4>
                        <h5>الكاتب: <a href="/author/{{$book->authorName}}">{{$book->authorName}}</a></h5>
                        <h6>
                             تقييم الكتاب: {{$book->rate}}

                        </h6>
                        <h6>التحميلات لهذا الكتاب: {{$book->numberOfDownloads}}</h6>
                        <hr/>
                        <h7>نبذة الكتاب: </h7><p>{{$book->brief}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- End show book -->
   <center><p><button class="custom-btn"><a href="/admin/books/{{$book->id}}/edit">تعديل</a></button></p></center>
   <center><p>ارسال بالبريد الالكترون الى جميع المستخدمين عن هذا الكتاب<button class="custom-btn"><a href="/admin/books/{{$book->id}}/mail">ارسال </a></button></p></center>
@endsection

