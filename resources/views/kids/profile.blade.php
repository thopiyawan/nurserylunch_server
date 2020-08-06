@extends('layouts.app')
@section('content')
<aside id="aside-menu">
    @include('kids.sidemenu')
</aside>
<div id="wrapper">
   	<h1 class="page-title">{{$classroom->class_name.' > '.$kid->firstname.' '.$kid->lastname}}</h1>
    <div class="row">
        <div class="col-lg-6">
            <div class="hpanel kid-panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <i class="light-icon fas fa-user-circle fa-7x"></i>
                        </div>
                        <div class="col-lg-9">
                            <div class="">
                                <div class="row">
                                    <div class="kid-name m-b col-lg-8">
                                        {{$kid->firstname.' '.$kid->lastname.' ( '.$kid->nickname.' )'}}
                                    </div>
                                    <div class="col-lg-4">
                                        <a class="pull-right" data-toggle="modal" data-target="#editKidForm">
                                            <span> <i class="fas fa-pen"></i> แก้ไข</span>
                                        </a>
                                    </div>
                                </div>
                                <h4 class="title"> ข้อมูลส่วนตัว </h4>
                                <div class="update">อัพเดทล่าสุดเมื่อ 2 เดือนที่แล้ว</div>
                                <div class="row">
                                    <div class="col-lg-2 panel-label">อายุ</div>
                                    <div class="col-lg-10 panel-text">1 ปี 3 เดือน</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2 panel-label">เพศ</div>
                                    <div class="col-lg-10 panel-text">หญิง</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2 panel-label">ห้อง</div>
                                    <div class="col-lg-10 panel-text">JUNIOR 1</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 panel-label">การใช้พลังงาน</div>
                                    <div class="col-lg-8 panel-text">สูง</div>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
            <div class="hpanel kid-panel">
                <div class="panel-body">
                    <div class="">
                        <div class="row">
                            <div class="col-lg-8">
                                <h4 class="title"> บันทึกจากผู้ดูแล </h4>
                                <div class="update">อัพเดทล่าสุดเมื่อ 2 เดือนที่แล้ว</div>
                            </div>
                            <div class="col-lg-4">
                                <a class="pull-right" data-toggle="modal" data-target="#editKidForm">
                                    <span> <i class="fas fa-pen"></i> แก้ไข</span>
                                </a>
                            </div>
                        </div>
                        <div class="note-card">
                            น้องไม่ชอบทานแครอทและมักจะแยกออกจากจานเสมอ
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="hpanel kid-panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <h4 class="title"> ข้อจำกัดอาหาร </h4>
                            <div class="update">อัพเดทล่าสุดเมื่อ 2 เดือนที่แล้ว</div>
                        </div>
                        <div class="col-lg-4">
                            <a class="pull-right" data-toggle="modal" data-target="#editKidForm">
                                <span> <i class="fas fa-pen"></i> แก้ไข</span>
                            </a>
                        </div>
                    </div>
                    <div class="row m-t">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-3">
                                    <i class="light-icon fas fa-exclamation-circle fa-3x"></i>
                                </div>
                                <div class="col-lg-9">
                                    <div class="text-danger">อาหารพิเศษ</div>
                                    <div class="text-extra">มุสลิม</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-3">
                                    <i class="light-icon fas fa-exclamation-circle fa-3x"></i>
                                </div>
                                <div class="col-lg-9">
                                    <div class="text-danger">แพ้อาหาร</div>
                                    <div class="text-extra">กุ้ง</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hpanel kid-panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <h4 class="title"> การดื่มนม </h4>
                            <div class="update">อัพเดทล่าสุดเมื่อ 2 เดือนที่แล้ว</div>
                        </div>
                        <div class="col-lg-4">
                            <a class="pull-right" data-toggle="modal" data-target="#editKidForm">
                                <span> <i class="fas fa-pen"></i> แก้ไข</span>
                            </a>
                        </div>
                    </div>
                    <div class="row m-t">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-3">
                                    <i class="light-icon fas fa-exclamation-circle fa-3x"></i>
                                </div>
                                <div class="col-lg-9">
                                    <div class="">การดื่มนม (มล. / ต่อวัน)</div>
                                    <div class="text-extra">200</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hpanel kid-panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <h4 class="title"> การเจริญเติบโต </h4>
                            <div class="update">อัพเดทล่าสุดเมื่อ 2 เดือนที่แล้ว</div>
                        </div>
                        <div class="col-lg-4">
                            <a class="pull-right" data-toggle="modal" data-target="#editKidForm">
                                <span> <i class="fas fa-pen"></i> แก้ไข</span>
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>วันที่</th>
                                    <th>ส่วนสูง (ซม.)</th>
                                    <th>น้ำหนัก (กก.)</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>25/03/63</td>
                                        <td>105</td>
                                        <td>16</td>
                                    </tr>
                                    <tr>
                                        <td>25/03/63</td>
                                        <td>105</td>
                                        <td>16</td>
                                    </tr>
                                    <tr>
                                        <td>25/03/63</td>
                                        <td>105</td>
                                        <td>16</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>

</div>	


@endsection