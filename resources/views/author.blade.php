@extends('layouts.appPublic')
<!--End navbar -->
@section('content')

<div class="books">
<div class="container">
    <!--
                    هذا الون جميل جدا
    <div class="bg-warning"></div> -->
    <div class="author-info bg-secondary text-white p-2 mb-3 text-right">
        <span>جميع كتب</span>
        <span>{{$authorBooks[0]->authorName}}</span>
    </div>
    <div class="row">
        @forelse ($authorBooks as $book)
            <div class="col-md-6 col-lg-4">
              <div class="card text-center">
                <div class="img-cover">
                    <img src="/storage/{{$book->bookCover}}" alt="Book cover" class="card-img-top">
                </div>
                <div class="card-book">
                    <h4 class="card-title">
                        <a href="/book/{{$book->id}}">{{$book->title}}</a>
                    </h4>
                    <p class="card-text">{{$book->brief}}</p>
                    <button class="custom-btn">
                        <a href="/book/{{$book->id}}">الاطلاع على الكتاب</a>
                    </button>
                </div>
            </div>
        </div>
        @empty
            <div class="alert alert-danger text-center">
                <h3>لاتتوفر اي كتب مشابهة في الوقت الحالي</h3>
            </div>
            @for ($i = 0; $i < 23; $i++)
                <br />
            @endfor
        @endforelse


    </div>
    </div>
</div>


<!-- Start pagination -->
{{$authorBooks->links()}}


@endsection
