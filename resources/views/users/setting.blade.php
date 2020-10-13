@extends('layouts.app')
@section('content')
<aside id="aside-menu" class="p-t">
    <ul class="nav nav-tab main-level">
        <li class="">
            <a data-toggle="tab" href="#system" aria-expanded="true" class="active">
                <i class="fas fa-cog"></i> <span>ตั้งค่าระบบ</span>
            </a>
        </li>
        <li class="">
            <a data-toggle="tab" href="#school" aria-expanded="false">
                <i class="fas fa-school"></i> <span>ข้อมูลโรงเรียน</span>
            </a>
        </li>
        <li class="">
            <a data-toggle="tab" href="#user" aria-expanded="false">
                <i class="fas fa-user-circle"></i> <span>ข้อมูลผู้ใช้งาน</span>
            </a>
        </li>
    </ul>
</aside>

<div id="wrapper">
    <div class="tab-content">
        <div id="system" class="tab-pane active">
            <div class="panel-body">
                @include('users.system')
            </div>
        </div>
        <div id="school" class="tab-pane">
            <div class="panel-body">
                @include('users.school')
            </div>
        </div>
        <div id="user" class="tab-pane">
            <div class="panel-body">
                @include('users.info')
            </div>
        </div>
    </div>
</div>
@endsection
