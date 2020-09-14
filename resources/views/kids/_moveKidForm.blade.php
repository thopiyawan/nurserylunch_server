<h4 class="modal-title">ย้ายห้องเรียน</h4>
<h3 class="">ย้ายห้องเรียน {{$kid->getFullName()}}</h3>
<h3 class="">จากห้อง {{$kid->getClassName()}} ไปห้อง  </h3>
<form method="POST" action="/kid/moveclass/{{$kid->id}}" class="">   
    @csrf 
    <input type="hidden" id="" name="kid_id" value="{{$kid->id}}">
    <div class="form-group">
        <select  name="classroom_id" class="form-control">
            @foreach($classrooms as $c)
            <option value="{{$c->id}}"> {{$c->class_name}} </option>
            @endforeach
        </select>
    </div>
    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
    <button class="btn btn-primary" type="submit" name="" value="">บันทึกการเปลี่ยนแปลง</button>
</form>