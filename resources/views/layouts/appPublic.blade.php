<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مكتبة الاحقاف الالكترونية</title>
    @vite(['resources/css/custom1.css', 'resources/css/bootstrap.min.css'])
  @vite(['resources/css/bootstrap.rtl.css', 'resources/js/bootstrap.min.js'])
  @vite(['resources/tiny/jquery.tinymce.min.js', 'resources/js/jquery-3.6.0.js'])
  <link href="https://fonts.googleapis.com/css?family=Rubik&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js" integrity="sha256-a2yjHM4jnF9f54xUQakjZGaqYs/V1CYvWpoqZzC2/Bw=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">

</head>

<body>
    <!-- Start navbar-->
    <nav class="navbar navbar-expand-sm navbar-light">
        <div class="container">


            <button class="navbar-toggler" data-toggle="collapse" data-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collpase navbar-collapse" id="menu">
                <ul class="navbar-nav ml-auto">
                    <li>
                        <a href="/" class="navbar-brand" class="nav-link">مكتبة الاحقاف الالكترونية</a>
                    </li>
                    <li class="navbar-itm">
                        <a href="/" class="nav-link">الرئيسية</a>
                    </li class="navbar-itm">
                    <li class="navbar-itm">
                        <a href="/categories" class="nav-link">التصنيفات</a>
                    </li>
                    <li class="navbar-itm">
                        <a href="#" class="nav-link">تواصل معنا</a>
                    </li>
                    @auth
                    <li class="navbar-itm">
                        <a href="/cart/" target="_blank" class="nav-link">السلة</a>
                    </li>
                    @endauth

                    {{-- @if (Auth::check())
                        <a href="dashboard/" target="_blank" id="dashboard-btn">لوحة التحكم</a>
                    @endif --}}


                        @if (Route::has('login'))

                                @auth
                                <li class="navbar-itm">
                                    <a href="{{ url('/welcome') }}" target="_blank" id="dashboard-btn" class="nav-link">لوحة التحكم</a>
                                </li>
                                @else

                                <li class="navbar-itm">
                                    <a href="{{ route('login') }}" class="nav-link font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">تسجيل الدخول</a>
                                </li>
                                <li class="navbar-itm">
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="nav-link ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">انشاء حساب جديد</a>
                                    @endif
                                </li>
                                @endauth
                        @endif

                    <li class="navbar-itm">
                        <div class="container" style="margin-top: 5px;">
                            <form action="/t" method="GET">
                                {{-- wire:model="searchTerm" --}}
                                <div class="input-group">
                                    <input class="form-control" type="text"  id="search" name="search" placeholder="ابحث عن عنوان الكتاب او اسم الكاتب" style="width: 300px;" @if (empty(request()->search)){
                                        value=""
                                    }

                                    @else
                                        value="{{request()->search}}"
                                    @endif>
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="submit">
                                            <i class="glyphicon glyphicon-search" name="btn-submit">ابحث</i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <br>
                                <div id="search_list">

                                </div>
                        </div>

                    </li>

                </ul>
            </div>
        </div>




    </nav>



@yield('content')

    <!-- Start Footer-->
    <footer class="text-center">جميع الحقوق محفوظة &copy; 2023</footer>
    <!-- End Footer-->

    <!-- jQuery-->
    <script src="layout/js/jquery-3.6.0.js"></script>
    <!-- Bootstrab js-->
    <script src="layout/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            fetch_books_data();

            function fetch_books_data(query = ''){
                $.ajax({
                    url:"t",
                    type:'GET',
                    data:{query:query},
                    dataType: 'json',
                    success:function(data){
                        $('#search_list').html(data);

                    }
                });
            }

            // $('#search').on('keyup', function(){
            //     var query = $(this).val();
            //     $.ajax({
            //         url:'search',
            //         type:'GET',
            //         data:{'search':query},
            //         success:function(data){
            //             $('#search_list').html(data);
            //         }
            //     });
            // });


            $(document).on('keyup','#search',function(){
                var query = $(this).val();
                fetch_books_data(query);
            })
        });
    </script>
</body>
</html>
