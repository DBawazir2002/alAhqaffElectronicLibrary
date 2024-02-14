@extends('layouts.appPublic')
<!--End navbar -->
@section('content')
    {{-- <div class="container">
      <img class="ax-center my-10 w-24" src="/storage/imagePublic/ahqaff-.jpg" />
      <div class="card p-6 p-lg-10 space-y-4">
        <h1 class="h3 fw-700 alert-danger">
           مرحبا بك في مكتبة الاحقاف الالكترونية
        </h1>
        <p>
         نحن في هذه المكتبة مقدم اهم الكتب التي ممكن ان تساعد الطلاب والباحثين في امورهم الدراسية
        </p>
        <a class="btn btn-primary custom-btn" href="/">قمت </a>
      </div>
      {{-- <img class="ax-center mt-10 w-40" src="storage/imagePublic/ahqaff.jpg" /> --}}
      {{-- <p> There are {{$t->count()}}</p> --}}
      {{-- @foreach ($t->groupByType() as $type => $modelSearchResults) --}}
        {{-- <h2>{{$type}}</h2> --}}
        {{-- @foreach ($modelSearchResults as $serachResult)
            <ul class="list-group">
                <li class="list-group-item">{{$serachResult->title}}</li>
            </ul> --}}
        {{-- @endforeach
      @endforeach --}}
      <div class="books">
        <div class="container">
            <div class="row">
                @if ($data)

      @forelse ($data as $book)
      <div class="col-md-6 col-lg-4">
        <div class="card text-center">
            <div class="img-cover">
                <img src="storage/{{$book->bookCover}}" alt="Book cover" class="card-img-top">
            </div>
            <div class="card-book">
                <h4 class="card-title">
                    <a href="/book/{{$book->id}}">{{$book->title}}</a>
                </h4>
                <p class="card-text">{{$book->brief}}</p>
                @if ($book->cost == 0)
                        <button class="custom-btn">
                            <a href="/book/{{$book->id}}">الاطلاع على الكتاب</a>
                        </button>
                    @else
                        <form action="/cart/book/{{$book->id}}" method="post">
                            @csrf
                            <button class="custom-btn" style="width: 160px;">اضف الى السلة</button>
                        </form>
                    @endif
            </div>
        </div>
    </div>
      @empty
          <div class="alert alert-danger text-center">
            <h3 class="text-danger">لم يتم العثور على اي نتائج</3><br>
          </div>
          <button class="custom-btn" style="width: 20%"><a href="/">العودة الى الصفحة الرئيسية</a></button>
      @endforelse
            </div>
        </div>
      </div>
{{$data->links()}}
@else
<div class="alert alert-danger text-center">
    <h3>لاتتوفر اي كتب في الوقت الحالي يرجى معاودة الزيارة لاحقا</h3>
</div>
@endif
    @endsection
