@extends('layouts.app2')
    <!-- Page Content -->
@section('content')
  <!-- /#sidebar-wrapper -->

  <!-- Page Content -->

  <div class="container-fluid">
    <div class="content">
      <div class="statistics text-center">
        <div class="row">
          <div class="col-sm-6">
            <div class="statistic">
              <h3>{{$booksNo}}</h3>
              <p>عدد الكتب</p>
            </div>

          </div>

          <div class="col-sm-6">
            <div class="statistic">
                @if ($bigRateBook)
                    <h3><a href="/book/{{$bigRateBook->id}}" target="_blank" rel="noopener noreferrer">{{$bigRateBook->title}}</a></h3>
                    <p>اعلى كتاب في المكتبة تقييما وهو بتقييم <b> {{$bigRateBook->rate}}</b></p>
                @else
                    <h3>0</h3>
                    <p>اعلى الكتب تقييما</p>
                @endif
            </div>

            </div>

        <center>
            <div class="col-sm-6">
                <div class="statistic">
                    <h3>{{$categoriesNo}}</h3>
                    <p>عدد التصنيفات</p>
                </div>

                </div>
        </center>

        </div>
      </div>

      <div class="statistics text-center">
        <div class="statistic">
            <h3>أخر خمسة كتب تم اضافتهم الى المكتبة</h3>
            @if ($books)
            <div class="books">
                <div class="container">
                    <div class="row">
                                @forelse ($books as $book)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card text-center">
                                            <div class="img-cover">
                                                <img src="/storage/{{$book->bookCover}}" alt="Book cover" class="card-img-top" height="200" width="200">
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
                                    <h3>لاتتوفر اي كتب في الوقت الحالي يرجى معاودة الزيارة لاحقا</h3>
                                @endforelse


                    </div>
                </div>
            </div>
            <!-- End Books-->



        </div>
      </div>
      @else
      <div class="alert alert-danger text-center">
        <h3>لا تتوفر اي كتب </h3>
    </div>
      @endif

    <!-- Related Books Downloaded-->
    <div class="statistics text-center">

    <h3>بعض الكتب التي قد تعجبك حسب تحميلاتك</h3>
    <div class="statistic">

    @forelse ($relatedDownloads as $b)
    <div class="books">
        <div class="container">
            <div class="row">
                        @foreach ($b as $book)
                            <div class="col-md-6 col-lg-4">
                                <div class="card text-center">
                                    <div class="img-cover">
                                        <img src="/storage/{{$book->bookCover}}" alt="Book cover" class="card-img-top" height="200" width="200">
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
                        @endforeach
@empty
<div class="alert alert-danger text-center">
<h3>لم تقم بتحميل اي كتب بعد.</h3>
</div>
@endforelse

    <!-- /#page-content-wrapper -->

  </div>



</div>
</div>
  <!-- /#wrapper -->
@endsection
