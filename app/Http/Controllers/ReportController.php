<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Collection;
use App\Setting;
use App\EnergyLogs;
use App\PurUnit;
use App\School;
use App\FoodLogs;
use App\FoodRecipe;
use Carbon\Carbon;
use App\SettingDescription;
use PDF;
use Debugbar;
use Datetime;


class ReportController extends Controller
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
    public function nutritionReport($startDate = null, $endDate = null)
    {
        $school = School::find(auth()->user()->school_id);
        $daysCount = count($school->getSelectedDates($startDate));
        return view('report.nutritionReport', ['school' => $school, 'daysCount'=> $daysCount]);
    }
    public function getNutrition(Request $request){
        $schoolId = auth()->user()->school_id;
        $school = School::find($schoolId);
        $inputs = $request->all();
        $startDate = (new DateTime($inputs['date']['startDate']))->format('Y-m-d');
        $endDate = (new DateTime($inputs['date']['endDate']))->format('Y-m-d');
        $inputFoodType = $inputs['foodType'];
        $selectedAge = $inputFoodType == 8? 'small' : 'big'; 

        $data = EnergyLogs::getNutritionData($schoolId, $startDate,$endDate, $selectedAge);
        return $data;
    }

    public function materialReport($startDate = null, $endDate = null){
        $schoolId = auth()->user()->school_id;
        $userSetting = Setting::where('school_id', $schoolId)->first();

        $school = School::find(auth()->user()->school_id);
        $daysCount = count($school->getSelectedDates($startDate));
        return view('report.materialReport', ['userSetting' => $userSetting, 'daysCount'=> $daysCount]);
    }


    public function getMaterial(Request $request){
        $schoolId = auth()->user()->school_id;
        $school = School::find($schoolId);

        $inputs = $request->all();
        $startDate = (new DateTime($inputs['date']['startDate']))->format('Y-m-d');
        $endDate = (new DateTime($inputs['date']['endDate']))->format('Y-m-d');
        $foodLogs = getMaterialLogs($schoolId, $startDate, $endDate);
        $ouputs = []; 
        //$materials = getMaterialData($schoolId);
        $allServings = $school->getServings();
        // $allServings = getServingsBySchool($schoolId);
        foreach($foodLogs as $log){
            $serving = $allServings[$log->food_type];
            $log->serving = $serving;
            $recipes = getRecipe($log->food_id);
            foreach ($recipes as $recipe) {
                if(!array_key_exists($recipe->composition_id, $ouputs)){
                    $recipe->unit = PurUnit::getUnitByID($recipe->pur_unit_id);
                    $ouputs[$recipe->composition_id] = $recipe; 
                }
                else{
                    $ouputs[$recipe->composition_id]['pur_quantity'] += $recipe->pur_quantity*$serving;
                }
            }
        }

        $materials = [];
        foreach($ouputs as $id => $output){
            $materials[] = $output;
        }
        $temp = collect($materials);
        $sortedMaterials = $temp->sortBy('composition_id')->values();
        $selectedDates = $school->getSelectedDates($startDate);
        // $sortedMaterials->values()->all();
        return view('report.materialData' , ['logs' => $foodLogs, 'materials'=>$sortedMaterials, 'selectedDates'=>$selectedDates, 'school'=>$school]);
    }

    public function downloadPdf(Request $request){
        $data = $request->all();

        $schoolId = auth()->user()->school_id;
        $school = School::find($schoolId);
        // $userSetting = $school->setting;
        $startDate = (new DateTime($data['startDate']))->format('Y-m-d');
        $endDate = (new DateTime($data['endDate']))->format('Y-m-d');
        $inputFoodType = $data['foodType'];
        $selectedAge = $inputFoodType == 8? 'small' : 'big'; 
        $foodLogs = FoodLogs::getLogsByDatesAndAge($schoolId, $startDate,$endDate, $selectedAge);
        $selectedDates = $school->getSelectedDates($startDate);
        // $selectedFoodTypes = $school->getSelectedFoodTypesByAge($selectedAge);


        $data['kelly'] = 'kelly';
        $data['selectedDates'] = $selectedDates;
        $data['school'] = $school;
        $data['logs'] = $foodLogs;
        $pdf = PDF::loadView('report.nutritionPdf', $data);     
        return $pdf->stream('medium.pdf');
    }

    public function downloadMaterialPdf(Request $request){
        $data = $request->all();
        $schoolId = auth()->user()->school_id;
        $school = School::find($schoolId);
        $data['school'] = $school;
        // $startDate = (new DateTime($data['startDate']))->format('Y-m-d');
        // $endDate = (new DateTime($data['endDate']))->format('Y-m-d');

        
        // $data['kelly'] = 'kelly';

        $pdf = PDF::loadView('report.materialPdf', $data);     
        return $pdf->stream('medium.pdf');

    }


}

function getServingsBySchool($schoolId){
    $servings = School::getServingsBySchool($schoolId);
    return $servings;
}
function getRecipe($food_id){
    $recipes = FoodRecipe::getRecipes($food_id);
    //$recipes = [];
    return $recipes;
}

function getMaterialLogs($schoolId, $startDate,$endDate){
    $foodLogs = FoodLogs::getLogsForMaterial($schoolId, $startDate,$endDate);
    return $foodLogs;
}