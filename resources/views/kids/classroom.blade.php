@extends('layouts.app')
@section('content')
<aside id="aside-menu">
    @include('kids.sidemenu')
</aside>
<div id="wrapper">
    <div class="row">
        <div class="col-md-6">
            @if ($classroom == null)
                <div>ยังไม่มีห้องเรียน</div>
            @else
                <h1>ห้อง {{$classroom->class_name}}</h1>
               
            @endif
        </div>
        <div class="col-md-6 pull-right">
            <a class="btn btn-default" data-toggle="modal" data-target="#editClassroomForm"> 
                <span> <i class="far fa-edit"></i> แก้ไขชื่อห้องเรียน</span>
            </a>
            <a class="btn btn-default" href="/classroom/toggle/{{$classroom->id}}">                 
                <span> <i class="fas fa-minus-circle"></i> {{($classroom->active?'ปิดห้องเรียนชั่วคราว':'เปิดห้องเรียน')}}</span>
            </a>
             <a class="btn btn-default" href="/classroom/delete/{{$classroom->id}}">                 
                <span> <i class="far fa-trash-alt"></i> ลบห้องเรียนถาวร</span>
            </a>
        </div>
    </div>
    <div>
    <h3>ข้อมูลเด็กในห้อง</h3>
    <div class="table-responsive">
        <table cellpadding="1" cellspacing="1" class="table table-condensed table-striped">
            <thead>
            <tr>
                <th>ชื่อ-นามสกุล</th>
                <th>ชื่อเล่น</th>
                <th>เพศ</th>
                <th>อายุ</th>
                <th>ส่วนสูง</th>
                <th>น้ำหนัก</th>
                <th>ดื่มนมต่อวัน</th>
                <th>จัดการ</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($kids as $k)
                <tr>
                    <td><a href="/kid/{{$k->id}}" class="">{{$k->firstname.' '.$k->lastname}}</a></td>
                    <td>{{$k->nickname}}</td>
                    <td>{{$k->sex}}</td>
                    <td>{{$k->birthday}}</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>




<div class="modal fade" id="editClassroomForm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="color-line "></div>             -->
            <div class="modal-body">
                <h4 class="modal-title">เพิ่มห้องเรียนใหม่</h4>
                <form method="POST" action="/classroom/edit/{{$classroom->id}}" class="form-horizontal">   
                    @csrf 
                    <div class="row form-group">
                        <label class="col-sm-4 control-label">ชื่อห้องเรียน</label>
                        <div class="col-sm-6">
                            <input type="text" value="{{$classroom->class_name}}" name="class_name" class="form-control">
                        </div>
                    </div>
                    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                    <button class="btn btn-primary" type="submit" name="create" value="">บันทึกการเปลี่ยนแปลง</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
