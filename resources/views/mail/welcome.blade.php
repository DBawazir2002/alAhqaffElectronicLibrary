@component('mail::message')
<h1>مكتبة الاحقاف الالكترونية</h1>
<h2>مرحبا ب {{$data->name}} في مكتبة الاحقاف الالكترونية.</h2>
<h3>نحن في هذه المكتبة نقدم اهم الكتب التي ممكن ان تساعد الطلاب والباحثين في امورهم الدراسية
</h3>{{$data->book}}
@component('mail::button',['url' => $data->book])
قم بزيارتنا
@endcomponent
@endcomponent
