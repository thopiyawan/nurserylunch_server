<h1>ตั้งค่าระบบจัดสำรับ</h1>
<form method="POST" action="/setting" class="form-horizontal">   
@csrf 
    <div class="form-group">
        <!-- day -->
    	<label class="control-label">จัดอาหารสำหรับ</label>
        <div class="checkbox">
    		<input type="checkbox" value="{{ $setting->is_weekday }}" name="is_weekday" {{$setting->is_weekday ? 'checked' : ''}}> 
            <label>วันจันทร์ - วันศุกร์</label>
        </div>
        <div class="checkbox">
        	<input type="checkbox"  value="{{ $setting->is_saturday }}" name="is_saturday" {{$setting->is_saturday ? 'checked' : ''}}> 
        	<label>วันเสาร์</label>
        </div>
        <div class="checkbox">
    		<input type="checkbox"  value="{{ $setting->is_sunday }}" name="is_sunday" {{$setting->is_sunday ? 'checked' : ''}}> 
    		<label>วันอาทิตย์</label>
        </div>
    </div>
    <div class="form-group">
        <!-- meal -->
        <label class="control-label">จัดอาหารสำหรับมื้อ</label>
        <div class="checkbox">
            <input type="checkbox" value="{{ $setting->is_breakfast }}" name="is_breakfast" {{$setting->is_breakfast ? 'checked' : ''}}> 
            <label>เช้า</label>
        </div>
        <div class="checkbox">
            <input type="checkbox"  value="{{ $setting->is_morning_snack }}" name="is_morning_snack" {{$setting->is_morning_snack ? 'checked' : ''}}> 
            <label>ว่างเช้า</label>
        </div>
        <div class="checkbox">
            <input type="checkbox"  value="{{ $setting->is_lunch }}" name="is_lunch" {{$setting->is_lunch ? 'checked' : ''}}> 
            <label>กลางวัน</label>
        </div>
        <div class="checkbox">
            <input type="checkbox"  value="{{ $setting->is_afternoon_snack }}" name="is_afternoon_snack" {{$setting->is_afternoon_snack ? 'checked' : ''}}> 
            <label>ว่างบ่าย</label>
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <!-- small kids -->
        <label class="control-label">จัดอาหารสำหรับเด็กอายุต่ำกว่า 1 ปี</label>
        <div class="checkbox">
            <input type="checkbox" value="{{ $setting->is_for_small }}" name="is_for_small" {{$setting->is_for_small ? 'checked' : ''}}> 
            <label>จัดอาหารสำหรับเด็กอายุต่ำกว่า 1 ปี</label>
        </div>
        <label class="control-label">จัดอาหารพิเศษสำหรับเด็กอายุต่ำกว่า 1 ปี</label>
        <div>
            ยังไม่มีอาหารพิเศษ
        </div>

        <!-- small kids special menu -->
        <div>
            <label class="control-label">อาหารพิเศษ</label>
        </div>
        <div class="checkbox checkbox-inline">
            <input type="checkbox"  value="{{ $setting->is_s_muslim }}" name="is_s_muslim" {{$setting->is_s_muslim ? 'checked' : ''}}> 
            <label>อาหารมุสลิม</label>
        </div>
        <div class="checkbox checkbox-inline">
            <input type="checkbox"  value="{{ $setting->is_s_vege }}" name="is_s_vege" {{$setting->is_s_vege ? 'checked' : ''}}> 
            <label>อาหารมังสวิรัติ</label>
        </div>
        <div class="checkbox checkbox-inline">
            <input type="checkbox"  value="{{ $setting->is_s_vegan }}" name="is_s_vegan" {{$setting->is_s_vegan ? 'checked' : ''}}> 
            <label>อาหารเจ</label>
        </div>
        <!-- small kids carbs -->
        <div>
            <label class="control-label">สําหรับเด็กที่แพ้อาหารประเภท นม / ไข่ / แป้ง</label>
        </div>
        <div class="checkbox checkbox-inline">
            <input type="checkbox"  value="{{ $setting->is_s_milk }}" name="is_s_milk" {{$setting->is_s_milk ? 'checked' : ''}}> 
            <label>นมวัว</label>
        </div>
        <div class="checkbox checkbox-inline">
            <input type="checkbox"  value="{{ $setting->is_s_breastmilk }}" name="is_s_breastmilk" {{$setting->is_s_breastmilk ? 'checked' : ''}}> 
            <label>นมแม่</label>
        </div>
        <div class="checkbox checkbox-inline">
            <input type="checkbox"  value="{{ $setting->is_s_egg }}" name="is_s_egg" {{$setting->is_s_egg ? 'checked' : ''}}> 
            <label>ไข่ไก่</label>
        </div>
        <div class="checkbox checkbox-inline">
            <input type="checkbox"  value="{{ $setting->is_s_wheat }}" name="is_s_wheat" {{$setting->is_s_wheat ? 'checked' : ''}}> 
            <label>แป้งสาลี</label>
        </div>
        <!-- small kids seafood -->
        <div>
            <label class="control-label">สําหรับเด็กที่แพ้อาหารประเภท อาหารทะเล</label>
        </div>
        <div class="checkbox checkbox-inline">
            <input type="checkbox"  value="{{ $setting->is_s_shrimp }}" name="is_s_shrimp" {{$setting->is_s_shrimp ? 'checked' : ''}}> 
            <label>กุ้ง</label>
        </div>
        <div class="checkbox checkbox-inline">
            <input type="checkbox"  value="{{ $setting->is_s_shell }}" name="is_s_shell" {{$setting->is_s_shell ? 'checked' : ''}}> 
            <label>หอย</label>
        </div>
        <div class="checkbox checkbox-inline">
            <input type="checkbox"  value="{{ $setting->is_s_crab }}" name="is_s_crab" {{$setting->is_s_crab ? 'checked' : ''}}> 
            <label>ปู</label>
        </div>
        <div class="checkbox checkbox-inline">
            <input type="checkbox"  value="{{ $setting->is_s_fish }}" name="is_s_fish" {{$setting->is_s_fish ? 'checked' : ''}}> 
            <label>ปลา</label>
        </div>
        <!-- small kids ิ beans-->
        <div>
            <label class="control-label">สําหรับเด็กที่แพ้อาหารประเภท ถั่ว</label>
        </div>
        <div class="checkbox checkbox-inline">
            <input type="checkbox"  value="{{ $setting->is_s_peanut }}" name="is_s_peanut" {{$setting->is_s_peanut ? 'checked' : ''}}> 
            <label>ถั่วลิสง</label>
        </div>
        <div class="checkbox checkbox-inline">
            <input type="checkbox"  value="{{ $setting->is_s_soybean }}" name="is_s_soybean" {{$setting->is_s_soybean ? 'checked' : ''}}> 
            <label>ถั่วเหลือง</label>
        </div>

    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <!-- small kids -->
        <label class="control-label">จัดอาหารสำหรับเด็กอายุ 1 - 3 ปี</label>
        <div class="checkbox">
            <input type="checkbox" value="{{ $setting->is_for_big }}" name="is_for_big" {{$setting->is_for_big ? 'checked' : ''}}> 
            <label>จัดอาหารสำหรับเด็กอายุต่ำกว่า 1 ปี</label>
        </div>
        <label class="control-label">จัดอาหารพิเศษสำหรับเด็กอายุ 1 - 3 ปี</label>
        <div>
            ยังไม่มีอาหารพิเศษ
        </div>

        <!-- small kids special menu -->
        <div>
            <label class="control-label">อาหารพิเศษ</label>
        </div>
        <div class="checkbox checkbox-inline">
            <input type="checkbox"  value="{{ $setting->is_b_muslim }}" name="is_b_muslim" {{$setting->is_b_muslim ? 'checked' : ''}}> 
            <label>อาหารมุสลิม</label>
        </div>
        <div class="checkbox checkbox-inline">
            <input type="checkbox"  value="{{ $setting->is_b_vege }}" name="is_b_vege" {{$setting->is_b_vege ? 'checked' : ''}}> 
            <label>อาหารมังสวิรัติ</label>
        </div>
        <div class="checkbox checkbox-inline">
            <input type="checkbox"  value="{{ $setting->is_b_vegan }}" name="is_b_vegan" {{$setting->is_b_vegan ? 'checked' : ''}}> 
            <label>อาหารเจ</label>
        </div>
        <!-- small kids carbs -->
        <div>
            <label class="control-label">สําหรับเด็กที่แพ้อาหารประเภท นม / ไข่ / แป้ง</label>
        </div>
        <div class="checkbox checkbox-inline">
            <input type="checkbox"  value="{{ $setting->is_b_milk }}" name="is_b_milk" {{$setting->is_b_milk ? 'checked' : ''}}> 
            <label>นมวัว</label>
        </div>
        <div class="checkbox checkbox-inline">
            <input type="checkbox"  value="{{ $setting->is_b_breastmilk }}" name="is_b_breastmilk" {{$setting->is_b_breastmilk ? 'checked' : ''}}> 
            <label>นมแม่</label>
        </div>
        <div class="checkbox checkbox-inline">
            <input type="checkbox"  value="{{ $setting->is_b_egg }}" name="is_b_egg" {{$setting->is_b_egg ? 'checked' : ''}}> 
            <label>ไข่ไก่</label>
        </div>
        <div class="checkbox checkbox-inline">
            <input type="checkbox"  value="{{ $setting->is_b_wheat }}" name="is_b_wheat" {{$setting->is_b_wheat ? 'checked' : ''}}> 
            <label>แป้งสาลี</label>
        </div>
        <!-- small kids seafood -->
        <div>
            <label class="control-label">สําหรับเด็กที่แพ้อาหารประเภท อาหารทะเล</label>
        </div>
        <div class="checkbox checkbox-inline">
            <input type="checkbox"  value="{{ $setting->is_b_shrimp }}" name="is_b_shrimp" {{$setting->is_b_shrimp ? 'checked' : ''}}> 
            <label>กุ้ง</label>
        </div>
        <div class="checkbox checkbox-inline">
            <input type="checkbox"  value="{{ $setting->is_b_shell }}" name="is_b_shell" {{$setting->is_b_shell ? 'checked' : ''}}> 
            <label>หอย</label>
        </div>
        <div class="checkbox checkbox-inline">
            <input type="checkbox"  value="{{ $setting->is_b_crab }}" name="is_b_crab" {{$setting->is_b_crab ? 'checked' : ''}}> 
            <label>ปู</label>
        </div>
        <div class="checkbox checkbox-inline">
            <input type="checkbox"  value="{{ $setting->is_b_fish }}" name="is_b_fish" {{$setting->is_b_fish ? 'checked' : ''}}> 
            <label>ปลา</label>
        </div>
        <!-- small kids ิ beans-->
        <div>
            <label class="control-label">สําหรับเด็กที่แพ้อาหารประเภท ถั่ว</label>
        </div>
        <div class="checkbox checkbox-inline">
            <input type="checkbox"  value="{{ $setting->is_b_peanut }}" name="is_b_peanut" {{$setting->is_b_peanut ? 'checked' : ''}}> 
            <label>ถั่วลิสง</label>
        </div>
        <div class="checkbox checkbox-inline">
            <input type="checkbox"  value="{{ $setting->is_b_soybean }}" name="is_b_soybean" {{$setting->is_b_soybean ? 'checked' : ''}}> 
            <label>ถั่วเหลือง</label>
        </div>

    </div>

    <div class="form-group">
        <div class="col-sm-8 col-sm-offset-2">
            <!-- <button class="btn btn-default" type="submit">Cancel</button> -->
            <button class="btn btn-primary" type="submit" name="update" value="system">บันทึกข้อมูล</button>
        </div>
    </div>

</form>
