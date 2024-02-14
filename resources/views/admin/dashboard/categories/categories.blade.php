@extends('layouts.app1')
    <!-- Page Content -->
@section('content')

  <!-- Page Content -->



  <div class="container-fluid">
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
    <!-- Start categories section -->
    <div class="categories">
        @if ($categories)


      <div class="show-cat">
        <table class="table text-center">
          <thead class="btn-color">
            <tr>
              <th scope="col">الرقم</th>
              <th scope="col">عنوان التصنيف</th>
              <th scope="col">تاريخ الإضافة</th>
              <th scope="col">الإجراء</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($categories as $category)


              <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->categoryName}}</td>
                <td>{{$category->created_at}}</td>
                <td>

                    <p><button type="submit" class="custom-btn"><a href="/admin/categories/{{$category->id}}/edit">تعديل</a></button>

                    <form action="/admin/categories/{{$category->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="custom-btn confirm">&nbsp;حذف</button>
                    </form>
                </p>
                </td>
              </tr>
              @empty
              <div>
                <h3 class="text-danger">لا توجد اي تصانيف في الوقت الحالي يرجى ادراج بعض التصانيف</h3>
              </div>
            @endforelse

          </tbody>
        </table>

        <!-- Start pagination -->
        {{$categories->links()}}

    </div>
    <!-- End categories section -->
    @else
    <div class="alert alert-danger text-center">
        <h3 >لا توجد اي تصانيف في الوقت الحالي يرجى ادراج بعض التصانيف</h3>
      </div>
    @endif
  </div>
  </div>
  <!-- /#page-content-wrapper -->

@endsection
