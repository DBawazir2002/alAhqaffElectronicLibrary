@extends('layouts.appPublic')
<!--End navbar -->
@section('content')
@if ($book_enrolled_in_cart_by_useR)


<table class="table text-center">
    <thead class="thead-dark">
        <tr>
            <th scope="col">الرقم</th>
            <th scope="col">عنوان الكتاب</th>
            <th scope="col">المؤلف</th>
            <th scope="col">التصنيف</th>
            <th scope="col">السعر</th>
            <th scope="col">ازالة من السلة</th>

        </tr>
    </thead>
    <tbody>
        @forelse ($book_enrolled_in_cart_by_useR as $book)


            <tr>
                <td> {{$book->id}}</td>
                <td> {{$book->title}}</td>
                <td> {{$book->authorName}}</td>
                <td> {{$book->category->categoryName}}</td>
                <td>
                    @if ($book->cost == 0)
                        مجاني
                    @else
                        {{{$book->cost}}}
                    @endif
                </td>
                <td>
                    <form action="/cart/book/{{$book->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="custom-btn confirm" style="width: 160px;">&nbsp;ازالة</button>
                    </form>
                </td>
            </tr>

            @empty
            <div>
                <h3 class="text-danger">لم يتم اضافة اي كتاب الى السلة</h3>
            </div>
        @endforelse
    </tbody>
</table>
@if (session()->has('msg'))
            <div class="text-danger text-center">
                <h3>{{session()->get('msg')}}</h3>
            </div>
            @endif
<h4 class="mb-5">المجموع النهائي: {{$totalPrice}}</h4>
<form action="/cart/downloadBooks/user/{{Auth::user()->id}}" method="post">
    @csrf
    <button class="custom-btn d-inline-block" style="width: 160px;" type="submit">تحميل الكتب المجانية</button>
</form>
<a href="{{route('credit.checkout')}}" class="custom-btn d-inline-block" style="width: 160px;">
<span> بطاقة ائتمانية </span>
<i class="fas fa-credit-card"></i>
</a>
@else
<div class="alert alert-danger text-center">
    <h3 >لم يتم اضافة اي كتاب الى السلة</h3>
</div>
@endif
@for ($i = 0; $i < 23; $i++)
<br />
@endfor
@endsection
