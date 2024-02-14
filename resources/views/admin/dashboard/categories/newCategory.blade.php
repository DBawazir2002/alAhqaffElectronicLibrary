@extends('layouts.app1')
@section('content')
<div class="categories">
    <div class="add-cat">
      <form action="/admin/categories" method="POST">
          @csrf
        <div class="form-group">
          <label for="cat">إضافة تصنيف :</label>
          <input type="text" id="cat" class="form-control" name="categoryName">
          @error('categoryName')
            <div class="text-danger">
                <small>{{$message}}</small>
            </div>
          @enderror
        </div>
        <button type="submit" class="custom-btn">إضافة</button>
      </form>
    </div>
</div>

@endsection
