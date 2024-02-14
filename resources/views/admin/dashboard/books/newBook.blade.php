@extends('layouts.app1')
    <!-- Page Content -->
@section('content')
    <!-- Page Content -->

    <div class="container-fluid">
        <!-- Start new book -->
        <div class="new-book">
            @if (session()->has('msg'))
            <div class="text-danger">
                <small>{{session()->get('msg')}}</small>
            </div>
            @endif
            <form action="/admin/books" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">عنوان الكتاب</label>
                    <input type="text" id="title" class="form-control" name="title" value="">
                    @error('title')
                        <div class="text-danger">
                            <small>{{$message}}</small>
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="author">إسم الكاتب</label>
                    <input type="text" id="author" class="form-control" name="authorName" value="">
                    @error('authorName')
                        <div class="text-danger">
                            <small>{{$message}}</small>
                        </div>
                    @enderror
                </div>
                @if ($categories == null)
                    <div class="alert-danger">
                        <small>يرجى اضافة تصانيف من اجل اضافة الكتاب</small>
                    </div>
                @else
                    <div class="form-group">
                        <label for="title">التصنيف</label>
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
                @endif
                <div class="form-group">
                    <label for="author">قيمة الكتاب</label>
                    <small class="text-danger">ملاحظة: 0 للكتب المجانية</small>
                    <input type="text" id="" class="form-control" name="cost" value="">
                    @error('cost')
                        <div class="text-danger">
                            <small>{{$message}}</small>
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="img">غلاف الكتاب</label>
                    <input type="file" class="form-control" name="bookCover">
                    @error('bookCover')
                        <div class="text-danger">
                            <small>{{$message}}</small>
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="book">ملف الكتاب</label>
                    <input type="file" class="form-control" name="book">
                    @error('book')
                        <div class="text-danger">
                            <small>{{$message}}</small>
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="brief">نبذة عن الكتاب</label>
                    <textarea name="brief" id="" cols="30" rows="10" class="form-control"></textarea>
                    @error('brief')
                        <div class="text-danger">
                            <small>{{$message}}</small>
                        </div>
                    @enderror
                </div>
                <button class="custom-btn">نشر الكتاب</button>
            </form>
        </div>
        <!-- End new book -->
    </div>
    <!-- /#page-content-wrapper -->

@endsection
