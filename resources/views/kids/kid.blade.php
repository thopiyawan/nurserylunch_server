@extends('layouts.app')
@section('content')
<aside id="aside-menu">
    @include('kids.sidemenu')
</aside>
<div id="wrapper">
    <div class="row">
    	<h1>{{$kid->firstname.' '.$kid->lastname}}</h1>
    </div>
</div>	


@endsection