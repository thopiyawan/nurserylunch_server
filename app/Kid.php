<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Kid extends Model
{
    //
    protected $fillable = [
        'classroom_id', 'firstname', 'lastname', 'nickname', 'sex', 'birthday',
    ];
    public function food_restrictions(){
        return $this->hasMany(FoodRestriction::class);
    }
	public function growth_entries(){
        return $this->hasMany(GrowthEntry::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function getAge()
    {
		$age = \Carbon\Carbon::parse($this->birthday)->diff(\Carbon\Carbon::now())->format('%y ปี %m เดือน %d วัน');
    	return $age;
    }
    public function getBirthYear()
    {
    	return \Carbon\Carbon::parse($this->birthday)->year;
    }
    public function getBirthMonth()
    {
    	$month = \Carbon\Carbon::parse($this->birthday)->month;
    	if($month >10){
    		$month = '0'.$month;
    	}
    	return $month;
    }
    public function getBirthDate()
    {
    	$day = \Carbon\Carbon::parse($this->birthday)->day;
    	// if($day >10){
    	// 	$day = '0'.$day;
    	// }
    	return $day;
    }
    public function getRestrictions(){
    	$temp = array();
    	foreach($this->food_restrictions as $rest)
    	{
    		$type = "แพ้อาหาร";
    		if ($rest->detail == "muslim" or $rest->detail == "vege" or $rest->detail == "vegan")
    		{
    			$type = "อาหารพิเศษ";
    		}
    		$detail_array = array(
    			'muslim' => 'มุสลิม',
    			'vege' => 'มังสวิรัติ',
    			'vegan' => 'เจ',
    			'milk' => 'แพ้นม',
    			'breastmilk' => 'แพ้นมแม่',
    			'egg' => 'แพ้ไข่ไก่',
    			'wheat' => 'แพ้แป้งสาลี',
    			'shrimp' => 'แพ้กุ้ง',
    			'shell' => 'แพ้หอย',
    			'crab' => 'แพ้ปู',
    			'fish' => 'แพ้ปลา',
    			'peanut' => 'แพ้ถั่วลิสง',
    			'soybean' => 'แพ้ถั่วเหลือง',
    		);
    		$thaiRest = array('id'=> $rest->id,'type' => $type, 'detail'=> $detail_array[$rest->detail] );
    		$temp[$rest->id] = $thaiRest;
    	}
    	return $temp;
    }
    public function getActiveLevel()
    {
    	if ($this->active_level == "high")
    	{
    		return "สูง";
    	}
    	elseif ($this->active_level == "medium")
    	{
    		return "ปานกลาง";
    	}
    	elseif ($this->active_level == "low")
    	{
    		return "ต่ำ";
    	}
    	else
    	{
    		return "ยังไม่ระบุ";
    	}
    }
    public function getClassName()
    {
    	$classroom = Classroom::where('id', $this->classroom_id)->first();
    	return $classroom->class_name;
    }
    public function getFullName()
    {
    	return $this->firstname." ".$this->lastname." ( ".$this->nickname." )";
    }
    public function getLastestGrowth()
    {
        $lastest =  GrowthEntry::where('kid_id', $this->id)->latest('date')->first();
        return $lastest;
    }

    public function getGrowthEntries()
    {
    	$entries = GrowthEntry::where('kid_id', $this->id)->orderBy('date', 'ASC')->get();
    	foreach ($entries as $en) {
    		$en->datestring = date('d/m/Y', strtotime($en->date));
    	}
    	return $entries;
    }
    public function getNotes()
    {
        $notes = Comment::where('kid_id', $this->id)->orderBy('date', 'ASC')->get();
        foreach ($notes as $n) {
            $n->datestring = date('d/m/Y', strtotime($n->date));
        }
        return $notes;
    }
    public function getMilk($type)
    {
    	if($type == "ml")
    	{
    		return number_format($this->milk_oz*29.574, 0);

    	}
    	elseif($type == "box")
    	{
    		return number_format($this->milk_oz*29.574/180, 1);

    	}
    	return $this->milk_oz;
    }
    public function getMilkUpdate()
    {
        //$milk_update = \Carbon\Carbon::parse($this->milk_update)->diff(\Carbon\Carbon::now())->format('%y ปี %m เดือน %d วัน');
        \Carbon\Carbon::setLocale('th');
        if ($this->milk_update == null)
        {
            return "ไม่มีข้อมูลการอัพเดท";
        }
        else
        {
            $milk_update = \Carbon\Carbon::parse($this->milk_update)->diffForHumans();
            return "อัพเดทล่าสุดเมื่อ ".$milk_update;
        }

    }
    public function getSex()
    {
    	if ($this->sex == "male")
    	{
    		return "ชาย";
    	}
    	else
    	{
    		return "หญิง";
    	}
    }
}
