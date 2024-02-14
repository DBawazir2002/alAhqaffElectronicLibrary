@extends('layouts.app1')
    <!-- Page Content -->
@section('content')

    <!-- Page Content -->

    <!-- Fetch categoryName form database -->
    <div class="container-fluid">
        <div class="edit-cat">
            <form action="/admin/categories/{{$category->id}}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="categoryName">تعديل التصنيف</label>
                    <input type="text" class="form-control" id="cat" value="{{$category->categoryName}}" name="categoryName">
                    @error('categoryName')
                        <div>
                            <h3 class="text-danger">{{$message}}</h3>
                        </div>
                    @enderror
                </div>
                <button class="custom-btn">تعديل</button>
            </form>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

    @endsection
