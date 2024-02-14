@extends('layouts.appPublic')
<!--End navbar -->
@section('content')

<!-- Start show book-->
<div class="books">
<div class="container">
    <div class="book">
        <div class="row">
            <div class="col-md-4">
                <div class="book-cover">
                    <img src="/storage/{{$book->bookCover}}" alt="Book cover" />
                </div>
            </div>
            <div class="col-md-8">
                <div class="book-content">
                    <h4>{{$book->title}}</h4>
                    <h5><a href="/author/{{$book->authorName}}">{{$book->authorName}}</a></h5>
                    <h6>التصنيف: <a href="/category/{{$book->category->id}}">{{$book->category->categoryName}}</a></h6>
                    <h6>تقييم الكتاب: @if ($book->rate == 0)
                        كن اول من يقييم هذا الكتاب
                    @else
                        {{$book->rate}}
                    @endif
                    </h6>
                    <h6>القيمة: @if ($book->cost == 0)
                        مجاني
                    @else
                        {{{$book->cost}}} $
                    @endif</h6>
                    <hr/>
                    <p>{{$book->brief}}</p>
                    {{-- @if ($book->cost == 0)


                        @auth
                            <form action="/downloadBook/book/{{$book->id}}/user/{{Auth::user()->id}}" method="post">
                                @csrf
                                <button class="custom-btn" style="width: 160px;" type="submit">تحميل الكتاب</button>
                            </form>
                        @else
                            <button class="custom-btn" style="width: 160px;">تحميل الكتاب</button>
                            <div>
                                <small class="alert-danger text-center">يرجى تسجيل الدخول من اجل تحميل الكتاب</small>
                            </div>
                        @endauth
                    @else --}}
                            @auth

                                @if ($cartBookExist)
                                  <button class="custom-btn" style="width: 160px;"><a href="/cart/" >اذهب الى السلة</a></button>
                                @else
                                    <form action="/cart/book/{{$book->id}}/" method="post">
                                        @csrf
                                        <button class="custom-btn" style="width: 160px;">اضف الى السلة</button>
                                    </form>
                                @endif

                            @else
                            <button class="custom-btn" style="width: 160px;">اضف الى السلة</button>
                            <div>
                                <small class="alert-danger text-center">يرجى تسجيل الدخول من اجل اضافة الكتاب الى السلة</small>
                            </div>
                            @endauth
                    {{-- @endif --}}
                    <form action="/book/{{$book->id}}/edit" method="post">
                        @csrf
                        @method('PATCH')
                        <select name="rate" id="" onchange="this.form.submit()">
                            <option value="0">قييم الكتاب الان !</option>
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- End show book -->

<!-- Start comments -->
<h2>التعليقات</h2>
@forelse ($comments as $comment)
{{-- <b>{{$comment->created_at->diffForHumans();}}</b> --}}
    <h4>{{$comment->name}}</h4>
    <p>{{$comment->body}}</p>
@empty

@endforelse
<div class="container">
    <div class="row">
        <div class="col-md-8">
    <h5 class="alert-danger">لن يتم نشر التعليق الا بعد موافقة مشرف الموقع على ذلك</h5>
    <form action="/book/{{$book->id}}/CreateComment" method="post">
        @csrf
        <div class="form-group">
        <label for="name" >الاسم</label>
            <input type="text" name="name" id="name" class="form-control" />

        @error('name')
            <div class="alert-danger">
                <small>{{$message}}</small>
            </div>
        @enderror
        </div>
        <div class="form-group">
            <label for="body" >التعليق</label>
            <input type="text" name="body" id="" class="form-control" />
        @error('body')
            <div class="alert-danger">
                <small>{{$message}}</small>
            </div>
        @enderror
        </div>

        <button type="submit" style="padding: 10px;
        border: 1px solid #555;
        outline: none;
        transition: 0.3s;
        width: 30%;
        background: #1f847d;">ارسال</button>
    </form>
</div>
    </div>
</div>

<!-- Start Related Books -->
<div class="related-books">
<div class="container">
<h4>كتب ذات صلة</h4>
<hr/>
<div class="row">
    @forelse ($relatedBooks as $booK)
    <div class="col-lg-3 col-md-4 col-6">
        <div class="related-book text-center">
        <div class="card text-center">
                    <div class="img-cover">
                        <img src="/storage/{{$booK->bookCover}}" alt="Book cover" class="card-img-top">
                    </div>
                    <div class="card-book">
                        <h4 class="card-title">
                            <a href="/book/{{$booK->id}}">{{$booK->title}}</a>
                        </h4>
                        <button class="custom-btn">
                            <a href="/book/{{$booK->id}}">الاطلاع على الكتاب</a>
                        </button>
                    </div>
                </div>

        </div>
    </div>
    @empty
        <div>
            <h3 class="alert-danger text-center">لاتتوفر اي كتب مشابهة في الوقت الحالي</h3>
        </div>
    @endforelse







</div>
</div>
</div>
<!-- End Releated Books-->

@endsection
