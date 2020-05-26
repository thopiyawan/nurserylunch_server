<?php
namespace App\Http\Controllers;						// Location of file

use App\Ingredient;
use App\IngredientGroup;										// Import other classes
use App\Http\Controllers\Controller;

class MealplanController extends Controller				// Define the class name
{
	public function index()							// Define the method name
    {
        $in_groups = IngredientGroup::all();
        return view('mealplan', ['in_groups' => $in_groups]);	// Return response to client
    }


    
    
}
