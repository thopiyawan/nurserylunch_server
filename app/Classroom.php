<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Kid;

class Classroom extends Model
{
    //
	protected $kids;
	protected $kids_count;
	protected $min_age;
	protected $max_age;
	protected $avg_height;
	protected $min_height;
	protected $max_height;
	protected $avg_weight;
	protected $min_weight;
	protected $max_weight;
	protected $milk_oz;
	protected $milk_ml;
	protected $milk_box;


    protected $fillable = [
        'class_name',
    ];

    public function init()
    {
    	$this->kids = Kid::where('classroom_id', $this->id)->where('status', 'active')->get();
    	$this->kids_count = $this->kids->count();

    	$smallest = $this->kids->max('birthday');
    	$biggest = $this->kids->min('birthday');
    	$this->min_age = \Carbon\Carbon::parse($smallest)->diff(\Carbon\Carbon::now())->format('%y ปี %m เดือน %d วัน');
    	$this->max_age = \Carbon\Carbon::parse($biggest)->diff(\Carbon\Carbon::now())->format('%y ปี %m เดือน %d วัน');

    	$growth = collect([]);
    	foreach($this->kids as $k)
    	{
    		$lastest =  GrowthEntry::where('kid_id', $k->id)->latest('date')->first();
    		$growth->push($lastest);
    		
    	}
		$this->avg_height = $growth->avg('height');
		$this->min_height = $growth->min('height');
		$this->max_height = $growth->max('height');
		$this->avg_weight = $growth->avg('weight');
		$this->min_weight = $growth->min('weight');
		$this->max_weight = $growth->max('weight');


    	$this->milk_oz = $this->kids->avg('milk_oz');
    	$this->milk_ml = number_format($this->milk_oz*29.574, 2);
    	$this->milk_box = number_format($this->milk_oz*29.574/180, 1);

    }
    public function getKids()
    {
    	$this->kids = Kid::where('classroom_id', $this->id)->where('status', 'active')->get();
    	return $this->kids;
    }

    public function getKidCount()
    {
        $this->kids = Kid::where('classroom_id', $this->id)->where('status', 'active')->get();
        $this->kids_count = $this->kids->count();
    	return $this->kids_count;
    }
    public function getMinAge()
    {
    	return $this->min_age;
    }
    public function getMaxAge()
    {
    	return $this->max_age;
    }
    public function getAverageHeight()
    {
    	return $this->avg_height;
    }
    public function getMinHeight()
    {
    	return $this->min_height;
    }
    public function getMaxHeight()
    {
    	return $this->max_height;
    }
    public function getAverageWeight()
    {
    	return $this->avg_weight;
    }
    public function getMinWeight()
    {
    	return $this->min_weight;
    }
    public function getMaxWeight()
    {
    	return $this->max_weight;
    }
    public function getMilkOz()
    {
    	return $this->milk_oz;
    }
    public function getMilkMl()
    {
    	return $this->milk_ml;
    }
    public function getMilkBox()
    {
    	return $this->milk_box;
    }
}



