<ul class="nav nav-tab main-level" id="">
    @foreach($classrooms as $c)
        <li>
            <a  href="#">
                <span class="class-name">ห้อง {{$c->class_name }}</span>
                @if (!$c->active)
                    <span>ปิดชั่วคราว</span>
                @endif
                <span class="fa arrow"></span>
            </a>
            <ul class="nav nav-tab nav-second-level" aria-expanded="false">
                @if($c->getKids() == null)
                    <li><a href="#" class="">ไม่มีนักเรียนในห้องเรียนนี้</a></li>
                @else
                     @foreach ($c->getKids() as $k)
                        <li class="kid-name">
                            <a href="/kid/{{$k->id}}">
                                <span><i class="far fa-user"></i></span>
                                {{$k->firstname.' '.$k->lastname}}
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </li>
    @endforeach
    <li>
        <a href="" data-toggle="modal" data-target="#newClassroomForm"> 
            <span> <i class="fas fa-plus"></i> เพิ่มห้องเรียนใหม่ </span> 
        </a>
    </li>
</ul>

<div class="menu-block">
    <a class="btn btn-primary btn-block" data-toggle="modal" data-target="#newKidForm"> 
        <span><i class="fas fa-user-plus"></i> เพิ่มนักเรียนใหม่ </span>
    
    </a>
</div>



<div class="modal fade" id="newClassroomForm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="color-line "></div>             -->
            <div class="modal-body">
                <h4 class="modal-title">เพิ่มห้องเรียนใหม่</h4>
                <form method="POST" action="/classroom/create" class="">   
                    @csrf 
                    <div class="form-group">
                        <label class="control-label">ชื่อห้องเรียน</label>
                        <div class=""><input type="text" value="" name="class_name" class="form-control"></div>
                    </div>
                    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                    <button class="btn btn-primary" type="submit" name="create" value="">บันทึกการเพิ่ม</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="newKidForm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="color-line "></div>             -->
            <div class="modal-body">
                <h4 class="modal-title">เพิ่มเด็กใหม่</h4>
                <form method="POST" action="/kid/create" class="form-horizontal">   
                    @csrf 
                        <div class="form-group">
                            <label class="control-label">ห้องเรียน</label>
                            <select  value="" name="classroom_id" class="form-control">
                                @foreach($classrooms as $c)
                                    @if ($c->active)
                                        <option value="{{$c->id}}"> {{ $c->class_name }} </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">ชื่อจริง</label>
                            <div class=""><input type="text" value="" name="firstname" class="form-control"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">นามสกุลจริง</label>
                            <div class=""><input type="text" value="" name="lastname" class="form-control"></div>
                        </div>
                    
                    
                        <div class="form-group">
                            <label class="control-label">ชื่อเล่น</label>
                            <div class=""><input type="text" value="" name="nickname" class="form-control"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">เพศ</label>
                            <div class="">
                                <select  value="" name="sex" class="form-control">
                                    <option value="male">ชาย </option>
                                    <option value="female">หญิง </option>
                                </select>
                            </div>
                        </div>
                    
                    <label class="control-label">วัน เดือน ปี เกิด</label>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <select  value="" name="b-day" class="form-control">
                                @for ($x = 1; $x <= 31; $x++)
                                    <option value="{{$x}}"> {{$x}} </option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group col-md-5">
                            <select  value="" name="b-month" class="form-control">
                                <option value="01"> มกราคม </option>
                                <option value="02"> กุมภาพันธ์ </option>
                                <option value="03"> มีนาคม </option>
                                <option value="04"> เมษายน </option>
                                <option value="05"> พฤษภาคม </option>
                                <option value="06"> มิถุนายน </option>
                                <option value="07"> กรกฎาคม </option>
                                <option value="08"> สิงหาคม </option>
                                <option value="09"> กันยายน </option>
                                <option value="10"> ตุลาคม </option>
                                <option value="11"> พฤศจิกายน </option>
                                <option value="12"> ธันวาคม </option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <select  value="" name="b-year" class="form-control">
                                @for ($x = 2020; $x >= 2000; $x--)
                                    <option value="{{$x}}"> {{$x}} </option>
                                @endfor
                            </select>
                        </div>
                    </div>
  <!--                   <div class="form-group">
                        <label class="control-label">การใช้พลังงาน</label>
                        <select  value="" name="energy" class="form-control">
                            <option value="01"> ใช้พลังงานมาก </option>
                            <option value="02"> ใช้พลังงานปานกลาง </option>
                            <option value="03"> ใช้พลังงานน้อย </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">บันทึกจากผู้ดูแล</label>
                        <textarea name="" class="form-control" rows="4"></textarea> 
                    </div> -->
                    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                    <button class="btn btn-primary" type="submit" name="create" value="">บันทึกการเพิ่ม</button>
                </form>
            </div>
        </div>
    </div>
</div>
