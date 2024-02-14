@extends('layouts.appPublic')
<!--End navbar -->
@section('content')
<!-- Start banar-->
<div class="banar" style="height: 50vh;">
    <div class="overlay"></div>
    <div class="lib-info">
        <h4>حمّل عشرات الكتب مجانا</h4>
        <p>من اجل نشر المعرفة والثقافة , وغرس حب القراءة بين المتحدثين باللغة العربية</p>
    </div>
</div>
<!-- End banar-->

<!-- Start Books-->
<div class="books">
    <div class="container">
        <div class="row">
                    @forelse ($books as $book)
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
                                    <button class="custom-btn">
                                        <a href="/book/{{$book->id}}">تحميل الكتاب</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                    <div class="alert alert-danger text-center">
                        <h3>لاتتوفر اي كتب في الوقت الحالي يرجى معاودة الزيارة لاحقا</h3>
                    </div>
                    @for ($i = 0; $i < 23; $i++)
                    <br />
                    @endfor
                    @endforelse
                    

        </div>
    </div>
</div>
<!-- End Books-->

<!-- Start pagination -->
{{$books->links()}}
@endsection
