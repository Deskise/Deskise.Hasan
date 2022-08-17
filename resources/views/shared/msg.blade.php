<?php
$msg = \Session::get("msg");
$msgClass = 'alert-info';
?>
@if($msg)
@php
$status = [
    's:' => 'success',
    'w:' => 'warning',
    'i:' => 'info',
    'e:' => 'danger'
];

foreach ($status as $key=>$value) {
    if (str_starts_with(strtolower($msg),$key)) {
        $msgClass = 'alert-'.$value;
        $msg = substr($msg,2);
        break;
    }
}
@endphp

<style>
    .alert {
        margin: auto auto;
        position: fixed;
        top: 9%;
        left: 35%;
        right: 30%;
        z-index: 100000000;
        text-align: center;
        transition: top 1s ease-in-out;
    }
</style>
<div class='alert {{$msgClass}} alert-dismissible'>
    {{$msg}}
{{--    <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--        <span aria-hidden="true">&times;</span>--}}
{{--    </button>--}}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger  alert-dismissible show">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
{{--    <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--        <span aria-hidden="true">&times;</span>--}}
{{--    </button>--}}
</div>
@endif



<script>
    let els = document.getElementsByClassName('alert')
    console.log(els)
    setTimeout(() => {
        for(let i=0;i<els.length;i++)
        {
            console.log(els[i])
            els[i].style.top = "-200px"
            setTimeout(() => {
                els[i].remove()
            }, 4000)
        }
    }, 2700)
</script>
