@component('mail::message')
<h1>
      مكتبة الاحقاف الالكترونية
</h1>
<h2>
    لقد تم اضافة كتاب جديد للمكتبة
</h2>

        1. اسم الكتاب: {{$data['title']}}


        2. الكاتب:     {{$data['authorName']}}


        3. نبذه عن الكتاب: {{$data['brief']}}


@component('mail::button', ['url' => '#'])
قم بزيارتنا
@endcomponent
@endcomponent
