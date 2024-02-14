@extends('layouts.app1')
    <!-- Page Content -->
@section('content')
    <!-- Page Content -->
    <div class="books">
        <div class="container">
            <div class="book">
                <div class="row">
                        <div class="book-content">
                            <h4>اسم المستخدم: {{$user->name}}</h4>
                            <h5>البريدالالكتروني: {{$user->email}}</h5>
                            <h5>الدور: @if ($user->role == '0')
                                مستخدم عادي
                        @else
                            مستخدم مدير
                        @endif
                    </h5>
                    <h5>عدد التحميلات للكتب: {{$user->number_of_downloads_books}}</h5>
                    <h5>تم الانضمام الى المكتبة بتاريخ: {{$user->created_at}}</h5>
                            <hr/>
                    <h4>الكتب التي تم تحميلها من قبل {{$user->name}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@if ($book_downloaded_by_user)

<div class="show-books">
    <table class="table">
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
            @forelse ($book_downloaded_by_user as $book)


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
    @else
    <div>
        <h3 class="text-danger">لا تتوفر اي كتب </h3>
    </div>
    @endif
        <!-- End show book -->
       <center><p><button class="custom-btn"><a href="/admin/users/{{$user->id}}/edit">تعديل</a></button></p></center>
{{$book_downloaded_by_user->links()}}
@endsection
