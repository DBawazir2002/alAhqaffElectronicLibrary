<!DOCTYPE html dir="rtl">
<html lang="ar">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>لوحة التحكم</title>
  <!-- favicon -->
  <link rel="icon" type="image/png" href="/storage/app/public/imagePublic/book.png">
  <!-- Bootstrap and Bootstrap Rtl -->
  {{-- <link rel="stylesheet" href="../admin/dashboard/css/bootstrap.min.css">
  <link rel="stylesheet" href="../admin/dashboard/css/bootstrap-rtl.css"> --}}
  <!-- Custom css -->
  {{-- <link rel="stylesheet" href="../admin/dashboard/css/custom.css"> --}}
  @vite(['resources/css/custom.css', 'resources/css/bootstrap.min.css'])
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
{{-- @vite(['resources/css/custom.css', 'resources/css/bootstrap.min.css', ,'resources/css/bootstrap.rtl.css', 'resources/js/bootstrap.min.js', 'resources/js/jquery-3.6.0.js', 'resources/tiny/jquery.tinymce.min.js' --}}
<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->

    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">لوحة التحكم</div>
      <div class="list-group list-group-flush">
        <a href="/nUser/dashboard" class="list-group-item list-group-item-action bg-light">نظرة عامة</a>
        <a href="/nUser/profile" class="list-group-item list-group-item-action bg-light">البروفايل</a>
        <a href="/nUser/mydownloads" class="list-group-item list-group-item-action bg-light">تحميلاتي</a>
      </div>
    </div>

    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle"><span class="navbar-toggler-icon"></span></button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="/" target="_blank">عرض الموقع <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <!-- Show user Name  -->
                {{Auth::user()->name}}
              </a>
             <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                {{-- <a class="dropdown-item" href="/">تسجيل الخروج</a> --}}
                <form method="POST" action="{{ route('logout') }}" >
                    @csrf

                    <button type="submit" class="dropdown-item">تسجيل الخروج</button>
                </form>
              </div>
            </li>
          </ul>
        </div>
      </nav>



      @yield('content')


      <!--jQuery-->
      <script src="js/jquery-3.6.0.js"></script>
      <!--Font Awesome-->
      <script src="https://kit.fontawesome.com/03757ac844.js"></script>
      <!--Bootstrap-->
      <script src="js/bootstrap.min.js"></script>
      <script src="tiny/ "></script>
      <!-- Menu Toggle Script -->
      <script>
          $("#menu-toggle").click(function(e) {
              e.preventDefault();
              $("#wrapper").toggleClass("toggled");
          });
      </script>
      <script>
          $('.confirm').click(function() {
              return confirm("هل أنت متأكد ؟");
          });
      </script>
    </div>
  </div>

      </body>

      </html>



