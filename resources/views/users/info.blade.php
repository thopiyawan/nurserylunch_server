<h1>ข้อมูลผู้ใช้งาน</h1>
<form method="POST" action="/setting" class="form-horizontal">   
@csrf 
    <div class="row form-group">
        <label class="col-sm-2 control-label">ชื่อผู้ใช้งาน (username) </label>
        <div class="col-sm-6">{{ $user->username }}</div>
    </div>
    <div class="row form-group">
        <label class="col-sm-2 control-label">รหัสผ่าน</label>
        <div class="col-sm-6"> *********** </div>
    </div>
    <div class="row form-group">
        <label class="col-sm-2 control-label">ชื่อผู้ติต่อหลัก</label>
        <div class="col-sm-6"><input type="text" value="{{ $user->firstname }}" name="firstname" class="form-control"></div>
    </div>
    <div class="row form-group">
        <label class="col-sm-2 control-label">นามสกุลผู้ติดต่อหลัก</label>
        <div class="col-sm-6"><input type="text" value="{{ $user->lastname }}" name="lastname" class="form-control"></div>
    </div>
    <div class="row form-group">
        <label class="col-sm-2 control-label">E-mail</label>
        <div class="col-sm-6"><input type="text" value="{{ $user->email }}" name="email" class="form-control"></div>
    </div>
    <div class="form-group">
        <div class="col-sm-8 col-sm-offset-2">
            <!-- <button class="btn btn-default" type="submit">Cancel</button> -->
            <button class="btn btn-primary" type="submit" name="update" value="info">บันทึกข้อมูล</button>
        </div>
    </div>

</form>