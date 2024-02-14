@component('mail::message')
<h1>
      مكتبة الاحقاف الالكترونية
</h1>
<h2>
    معلومات عن كتاب {{$data['title']}}
</h2>

        1. اسم الكتاب  {{$data['title']}}


        2. الكاتب  {{$data['authorName']}}


        3. نبذه عن الكتاب  {{$data['brief']}}

        4. تاريخ الاضافة الى المكتبة  {{$data['created_at']}}


@component('mail::button', ['url' => '#'])
قم بزيارتنا
@endcomponent
@endcomponent
