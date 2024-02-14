@extends('layouts.appPublic')
<!--End navbar -->
@section('content')


    <div class="books">
        <div class="container">

    <div class="container-fluid">
        <div class="content">
            <div class="statistics text-center" style="margin-top: 30px;margin-bottom: 30px;">

                <div class="row">
                    @forelse ($categories as $category)
                        <div class="col-sm-6 cat-cont">
                            <div class="statistic" style="  background: #fff;border: 1px solid #eee;padding: 20px;margin-bottom: 20px;">
                                <h4><a href="/category/{{$category->id}}">{{$category->categoryName}}</a></h4>
                            </div>
                        </div>

                        @empty
                            <div class="alert alert-danger text-center">
                                <h3>لا تتوفر اي تصانيف في الوقت الحالي</h3>
                            </div>
                            @for ($i = 0; $i < 23; $i++)
                                <br />
                            @endfor
                    @endforelse
                </div>
            </div>
        </div>
    </div>






    <!-- Start pagination -->
{{$categories->links()}}


    @endsection

