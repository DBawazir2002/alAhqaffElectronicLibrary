@extends('layouts.app1')
    <!-- Page Content -->
@section('content')

    <div class="container-fluid">
        <!-- Start edit book -->
        <div class="new-book">
            <form action="/admin/books/{{$book->id}}" method="POST"  enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="title">عنوان الكتاب</label>
                    <input type="text" id="title" class="form-control" name="title" value="{{$book->title}}">
                    @error('title')
                        <div>
                            <h3 class="text-danger">{{$message}}</h3>
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="authorName">إسم الكاتب</label>
                    <input type="text" id="author" class="form-control" name="authorName" value="{{$book->authorName}}">
                    @error('authorName')
                        <div>
                            <h3 class="text-danger">{{$message}}</h3>
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category_id">التصنيف</label>
                    <select class="form-control" name="category_id">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->categoryName}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div>
                            <h3 class="text-danger">{{$message}}</h3>
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="author">قيمة الكتاب</label>
                    <small class="text-danger">ملاحظة: 0 للكتب المجانية</small>
                    <input type="text" id="" class="form-control" name="cost" value="{{$book->cost}}">
                    @error('cost')
                        <div class="text-danger">
                            <small>{{$message}}</small>
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="bookCover">غلاف الكتاب</label>
                    <input type="file" class="form-control" name="bookCover" value="{{$book->bookCover}}">
                    @error('bookCover')
                        <div>
                            <h3 class="text-danger">{{$message}}</h3>
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="book">ملف الكتاب</label>
                    <input type="file" class="form-control" name="book" value="{{$book->book}}">
                    @error('book')
                        <div>
                            <h3 class="text-danger">{{$message}}</h3>
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="brief">نبذة عن الكتاب</label>
                    <textarea name="brief" id="" cols="30" rows="10" class="form-control">{{$book->brief}}</textarea>
                    @error('brief')
                        <div>
                            <h3 class="text-danger">{{$message}}</h3>
                        </div>
                    @enderror
                </div>
                <button class="custom-btn">نشر الكتاب</button>
            </form>
        </div>
        <!-- End edit book -->
    </div>
    <!-- /#page-content-wrapper -->
@endsection
