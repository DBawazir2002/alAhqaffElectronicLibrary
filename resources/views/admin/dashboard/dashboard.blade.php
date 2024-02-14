@extends('layouts.app1')
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
              <h3>{{$usersNo}}</h3>
              <p>عدد المستخدمين</p>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="statistic">
              <h3>{{$booksNo}}</h3>
              <p>عدد الكتب</p>
            </div>

          </div>

          <div class="col-sm-6">
            <div class="statistic">
                @if ($bigRateBook)
                    <h3>{{$bigRateBook->title}}</h3>
                    <p>اعلى كتاب في المكتبة تقييما وهو بتقييم <b> {{$bigRateBook->rate}}</b></p>
                @else
                    <h3>0</h3>
                    <p>اعلى الكتب تقييما</p>
                @endif
            </div>

            </div>

        <div class="col-sm-6">
            <div class="statistic">
                <h3>{{$categoriesNo}}</h3>
                <p>عدد التصنيفات</p>
            </div>

            </div>

        </div>
      </div>


      <div class="statistics text-center">
        <div class="statistic">
            <h3>أخر خمسة مستخدمين تم اضافتهم الى المكتبة</h3>
            @if ($users)
        <div class="show-users">
            <table class="table text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">الرقم</th>
                        <th scope="col">الاسم</th>
                        <th scope="col">البريد الالكتروني</th>
                        <th scope="col">الدور</th>
                        <th scope="col">عدد تحميلات الكتب</th>
                        <th scope="col">تاريخ الإضافة</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)


                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>@if ($user->role == '0')
                                    مستخدم عادي
                            @else
                                مستخدم مدير
                            @endif</a></td>
                            <td>{{$user->number_of_downloads_books}}</td>
                            <td>{{$user->created_at}}</td>
                        </tr>

                        @empty
                        <div class="text-danger">
                            <h3 >لم يتم تسجيل اي مستخدمين اخرين </h3>
                        </div>
                    @endforelse
                </tbody>
            </table>



        </div>

    </div>
      </div>
      @else
      <div class="alert alert-danger text-center">
        <h3 >لم يتم تسجيل اي مستخدمين اخرين </h3>
    </div>
      @endif

      <div class="statistics text-center">
        <div class="statistic">
            <h3>أخر خمسة كتب تم اضافتهم الى المكتبة</h3>
            @if ($books)
            <div class="show-books">
                <table class="table text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">الرقم</th>
                            <th scope="col">عنوان الكتاب</th>
                            <th scope="col">المؤلف</th>
                            <th scope="col">التصنيف</th>
                            <th scope="col">التقييم</th>
                            <th scope="col">عدد التحميلات</th>
                            <th scope="col">تاريخ الإضافة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($books as $book)


                            <tr>
                                <td>{{$book->id}}</td>
                                <td>{{$book->title}}</td>
                                <td>{{$book->authorName}}</td>
                                <td>{{$book->category->categoryName}}</td>
                                <td>{{$book->rate}}</td>
                                <td>{{$book->numberOfDownloads}}</td>
                                <td>{{$book->created_at}}</td>
                            </tr>

                            @empty
                            <div>
                                <h3 class="text-danger">لا تتوفر اي كتب </h3>
                            </div>
                        @endforelse
                    </tbody>
                </table>

          </div>
        </div>
      </div>
      @else
      <div class="alert alert-danger text-center">
        <h3 >لا تتوفر اي كتب </h3>
    </div>
      @endif
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->
@endsection
