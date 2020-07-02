<h1>ข้อมูลโรงเรียน</h1>
<form method="POST" action="/setting" class="form-horizontal">   
@csrf 
    <div class="row form-group">
        <div class="col-sm-2 school-i">
            <i class="fas fa-school"></i>
        </div>
        <div class="col-sm-6 border">
            <h1>{{ $user->name }}</h1>
            <h1>4-66-192-2201</h1>
        </div>
    </div>

    <div class="row form-group">
        <label class="col-sm-2 control-label">ที่อยู่</label>
        <div class="col-sm-6"><input type="text" value="{{ $school->address }}" name="address" class="form-control"></div>
    </div>
    <div class="row form-group">
        <label class="col-sm-2 control-label">ตำบล</label>
        <div class="col-sm-6"><input type="text" value="{{ $school->tumbol }}" name="tumbol" class="form-control"></div>
    </div>
    <div class="row form-group">
        <label class="col-sm-2 control-label">อำเภอ</label>
        <div class="col-sm-6"><input type="text" value="{{ $school->amper }}" name="amper" class="form-control"></div>
    </div>
    <div class="row form-group">
        <label class="col-sm-2 control-label">จังหวัด</label>
        <div class="col-sm-6"><input type="text" value="{{ $school->province }}" name="province" class="form-control"></div>
    </div>
    <div class="row form-group">
        <label class="col-sm-2 control-label">รหัสไปรษณีย์</label>
        <div class="col-sm-6"><input type="text" value="{{ $school->post_number }}" name="post_number" class="form-control"></div>
    </div>
    <div class="form-group">
        <div class="col-sm-8 col-sm-offset-2">
            <!-- <button class="btn btn-default" type="submit">Cancel</button> -->
            <button class="btn btn-primary" type="submit" name="update" value="school">บันทึกข้อมูล</button>
        </div>
    </div>

</form>