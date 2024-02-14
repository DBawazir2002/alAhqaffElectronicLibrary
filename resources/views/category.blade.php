@extends('layouts.appPublic')
<!--End navbar -->
@section('content')
<div class="bg-secondary text-white p-2 mb-3">
                <h4><span>تصنيف: </span>
                    <span>{{$categoryName}}</span>
                </h4>
            </div>
            <div class="row">
@forelse ($books as $book)
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
                    <a href="/book/{{$book->id}}">الاطلاع على الكتاب </a>
                </button>
            </div>
        </div>
    </div>
@empty
    <div class="alert alert-danger text-center">
        <h3>لاتتوفر اي كتب متعلقة بهذا التصنيف</h3>
    </div>
@endforelse


{{$books->links()}}
@endsection
