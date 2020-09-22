<?php

namespace App\Http\Controllers;


use App\User;
use App\School;
use App\Classroom;
use App\Kid;
use App\FoodRestriction;
use App\GrowthEntry;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule; 
use Illuminate\Support\Facades\Validator;

class KidController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {

        $this->middleware('auth');
    }

    public function showClassroom($id = null)
    {
        $user = auth()->user();
        $classrooms = Classroom::where('school_id', $user->school_id)->get();
        foreach($classrooms as $c)
        {
            $c->init();
        }

        if ($id == null){
            $classroom = Classroom::where('school_id', $user->school_id)->first();//$classroom = null;
            if ($classroom){
                return redirect('classroom/'.$classroom->id);
            }
        }else{
            $classroom = Classroom::where('id', $id)->first();
        }
        $classroom->init();

        return view('kids.classroom', ['classrooms' => $classrooms, 'classroom'=> $classroom]);
    }

    public function createClassroom(Request $request)
    {

        $user = auth()->user();
        $school = School::where('id', $user->school_id)->first();
        $validator = Validator::make($request->all(), [
            'class_name' => [
                'required', 
                'max:255', 
                Rule::unique('classrooms')->where(function($query) use ($school) {
                    $query->where('school_id', $school->id);
                }),
            ]
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'createclass');
        }

        $classroom = Classroom::create([
            'class_name' => $request['class_name'],
        ]);


        $school->classrooms()->save($classroom);

        return redirect('classroom/'.$classroom->id);

    }
    public function editClassroom(Request $request, $id = null)
    {
    
        $classroom = Classroom::where('id', $id)->first();
        $validator = Validator::make($request->all(), [
            'class_name' => [
                'required', 
                'max:255', 
                Rule::unique('classrooms')->ignore($classroom->id)->where(function($query) use ($classroom) {
                    $query->where('school_id', $classroom->school_id);
                }),
            ]
        ]);
        if ($validator->fails()) {
            return redirect('classroom/'.$classroom->id)->withErrors($validator, 'editclass');
        }
        

        // $rules = [
        //     'class_name' => [
        //         'required', 
        //         'max:255', 
        //         Rule::unique('classrooms')->ignore($classroom->id)->where(function($query) use ($classroom) {
        //             $query->where('school_id', $classroom->school_id);
        //         }),
        //     ],
        // ];

        // $customMessages = ['class_name' => ''];
        // $attributes = ['class_name' => 'class_name',];

        // $this->validate($request, $rules, $customMessages, $attributes );


        $classroom->class_name = $request['class_name'];
        $classroom->save();
        
        return redirect('classroom/'.$id);

    }
    public function toggleClassroom($id = null)
    {
    
        $classroom = Classroom::where('id', $id)->first();
        $classroom->active = !$classroom->active;
        $classroom->save();
        
        return redirect('classroom/'.$id);

    }
     public function deleteClassroom($id = null)
    {
    
        $classroom = Classroom::where('id', $id)->first();
        $classroom->delete();

        $user = auth()->user();
        $classroom = Classroom::where('school_id', $user->school_id)->first();//$classroom = null;
        
        return redirect('classroom/'.$classroom->id);

    }

    public function showKid($id = null)
    {
        $user = auth()->user();
        $classrooms = Classroom::where('school_id', $user->school_id)->get();
        //$kids = Kid::where('classroom_id', $classroom->id)->get();
        $kid = Kid::where('id', $id)->first();
        $classroom = Classroom::where('id', $kid->classroom_id)->first();
        $classroom->init();
        
        return view('kids.profile', ['classrooms' => $classrooms, 'classroom'=> $classroom, 'kid'=> $kid, ]);
    }

    public function createKid(Request $request)
    {
        $user = auth()->user();
        $school = School::where('id', $user->school_id)->first();
        $birthday = $request['b-year'].'-'.$request['b-month'].'-'.$request['b-day'];
        $request->merge(['birthday' => date("Y-m-d", strtotime($birthday))]);

        $validator = Validator::make($request->all(), [
            'birthday' => 'before_or_equal:'.date('Y-m-d'),
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'createkid');
        }

        $kid = Kid::create([
            'classroom_id' => $request['classroom_id'],
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'nickname' => $request['nickname'],
            'sex' => $request['sex'],
            'birthday' => $request['birthday'],
        ]);

        $school->kids()->save($kid);

        return redirect('classroom/'.$request['classroom_id']);

    }
    public function editKid(Request $request, $id = null)
    {
    
        $kid = Kid::where('id', $id)->first();
        $birthday = $request['b-year'].'-'.$request['b-month'].'-'.$request['b-day'];
        $request->merge(['birthday' => date("Y-m-d", strtotime($birthday))]);

        $validator = Validator::make($request->all(), [
            'birthday' => 'before_or_equal:'.date('Y-m-d'),
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'editkid');
        }

        $kid->firstname = $request->input("firstname");
        $kid->lastname = $request->input("lastname");
        $kid->nickname = $request->input("nickname");
        $kid->sex = $request->input("sex");
        $kid->birthday = $request['birthday'];
        $kid->active_level = $request->input("active_level");
        
        $kid->save();
        
        return redirect('kid/'.$id);

    }

    public function moveClass(Request $request, $id = null)
    {
        $kid = Kid::where('id', $id)->first();
        $kid->classroom_id = $request->input("classroom_id");
        $kid->save();

        return redirect('kid/'.$id);

    }
    public function withdraw(Request $request, $id = null)
    {
        $kid = Kid::where('id', $id)->first();
        $classroom_id = $kid->classroom_id;
        $kid->status = "withdraw";
        $kid->save();

        return redirect('classroom/'.$classroom_id);

    }
    public function editNotes(Request $request, $id = null)
    {
        
        $kid = Kid::where('id', $id)->first();
        $kid->notes = $request->input("notes");
        $kid->save();
        
        return redirect('kid/'.$id);

    }
    public function createRestriction(Request $request, $id = null)
    {
        
        $validator = Validator::make($request->all(), [
            'detail' => Rule::unique('food_restrictions')->where(function($query) use ($id) {
                    $query->where('kid_id', $id);
                }),
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'createRestriction');
        } 

        $kid = Kid::where('id', $id)->first();
        $type = "alergy";
        if ($request['type'] == 'muslim' or $request['type'] == 'vege' or $request['type'] == 'vegan')
        {
            $type = "special";
        }
        $rest = FoodRestriction::create([
            'type' => $type,
            'detail' => $request['detail'],
        ]);
        $kid->food_restrictions()->save($rest);
        return redirect('kid/'.$id);
    }
    public function deleteRestriction(Request $request, $id = null)
    {
    
        $rest = FoodRestriction::where('id', $id)->first();

        $rest->delete();
        
        return redirect('kid/'.$request['kid_id']);

    }
        public function editMilk(Request $request, $id = null)
    {
    
        $kid = Kid::where('id', $id)->first();
        $kid->milk_oz = $request->input("oz");
        $kid->milk_update = \Carbon\Carbon::now();
        $kid->save();
        
        return redirect('kid/'.$id);

    }

     public function deleteMilk(Request $request, $id = null)
    {
    
        $kid = Kid::where('id', $id)->first();
        $kid->milk_oz = null;
        $kid->milk_update = null;
        $kid->save();
        
        return redirect('kid/'.$id);

    }
    public function createGrowth(Request $request, $id = null)
    {
        $kid = Kid::where('id', $id)->first();
        $date = date("Y-m-d", strtotime($request["date"]));
        $entry = GrowthEntry::create([
            'date' => $date,
            'height' => $request['height'],
            'weight' => $request['weight'],
        ]);

        $kid->growth_entries()->save($entry);
        return redirect('kid/'.$id);
    }
    public function editGrowth(Request $request, $id = null)
    {
        $kid_id = $id;
        
        $kid = Kid::where('id', $kid_id)->first();
        $entry = GrowthEntry::where('id', $request['growth_id'])->first();
        
        $date = date('Y-m-d', strtotime($request['date']));
        $entry->date = $date;
        $entry->weight = $request['weight'];
        $entry->height = $request['height'];

        $entry->save();

        return redirect('kid/'.$kid_id);
    }
    public function deleteGrowth(Request $request, $id = null)
    {
    
        $growth = GrowthEntry::where('id', $id)->first();
        $growth->delete();
        
        return redirect()->back();

    }
}

