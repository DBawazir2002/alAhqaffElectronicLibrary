@extends('layouts.app1')
    <!-- Page Content -->
@section('content')

<div class="container-fluid">
    <div class="show-books">
        @if ($books)


        <table class="table text-center">
            <thead class="btn-color">
                <tr>
                    <th scope="col">الرقم</th>
                    <th scope="col">عنوان الكتاب</th>
                    <th scope="col">المؤلف</th>
                    <th scope="col">التصنيف</th>
                    <th scope="col">التقييم</th>
                    <th scope="col">عدد التحميلات</th>
                    <th scope="col">حجم الكتاب</th>
                    <th scope="col">السعر</th>
                    <th scope="col">تاريخ الإضافة</th>
                    <th scope="col">الإجراء</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($books as $book)


                    <tr>
                        <td><a href="/admin/books/{{$book->id}}" style="text-decoration: none; color: black;">{{$book->id}}</a></td>
                        <td><a href="/admin/books/{{$book->id}}" style="text-decoration: none; color: black;">{{$book->title}}</a></td>
                        <td><a href="/admin/books/{{$book->id}}" style="text-decoration: none; color: black;">{{$book->authorName}}</a></td>
                        <td><a href="/admin/books/{{$book->id}}" style="text-decoration: none; color: black;">{{$book->category->categoryName}}</a></td>
                        <td><a href="/admin/books/{{$book->id}}" style="text-decoration: none; color: black;">{{$book->rate}}</a></td>
                        <td><a href="/admin/books/{{$book->id}}" style="text-decoration: none; color: black;">{{$book->numberOfDownloads}}</a></td>
                        <td><a href="/admin/books/{{$book->id}}" style="text-decoration: none; color: black;">{{$book->size}} بت</a></td>
                        <td><a href="/admin/books/{{$book->id}}" style="text-decoration: none; color: black;">{{$book->cost}} $</a></td>
                        <td><a href="/admin/books/{{$book->id}}" style="text-decoration: none; color: black;">{{$book->created_at}}</a></td>
                        <td>



                               <p>
                                <button class="custom-btn"><a href="/admin/books/{{$book->id}}/edit">تعديل</a></button>

                            <form action="/admin/books/{{$book->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                               <button type="submit" class="custom-btn confirm">&nbsp;حذف</button>
                            </form>
                        </p>
                        </td>
                    </tr>

                    @empty
                    <div>
                        <h3 class="text-danger">لا تتوفر اي كتب </h3>
                    </div>
                @endforelse
            </tbody>
        </table>

        <!-- Start pagination -->
        {{$books->links()}}

        @else
        <div class="alert alert-danger text-center">
            <h3>لا تتوفر اي كتب </h3>
        </div>
        @endif
    </div>
</div>
<!-- /#page-content-wrapper -->

@endsection
