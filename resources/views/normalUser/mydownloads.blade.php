@extends('layouts.app2')

@section('content')
@if (count($book_downloaded_by_user) > 0)
<div class="books">
    <div class="container">
        <div class="row">
                                @forelse ($book_downloaded_by_user as $book)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card text-center">
                                            <div class="img-cover">
                                                <img src="/storage/{{$book->bookCover}}" alt="Book cover" class="card-img-top" height="300" width="300">
                                            </div>
                                            <div class="card-book">
                                                <h4 class="card-title">
                                                    <a href="/book/{{$book->id}}">{{$book->title}}</a>
                                                </h4>
                                                <p class="card-text">{{$book->brief}}</p>
                                                <button class="custom-btn">
                                                    <a href="/book/{{$book->id}}">تحميل الكتاب</a>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                <div class="alert alert-danger text-center">
                                    <h3 class="text-danger">لم تقم بتحميل اي كتب بعد</h3>
                                </div>
                                @endforelse


                    </div>
                </div>
            </div>
            <!-- End Books-->



      @else
      <div class="alert alert-danger text-center">
        <h3>لا تتوفر اي كتب </h3>
    </div>
      @endif
      {{$book_downloaded_by_user->links()}}
@endsection
