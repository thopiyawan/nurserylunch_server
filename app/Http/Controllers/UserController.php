<?php
namespace App\Http\Controllers;						// Location of file

use App\User;										// Import other classes
use App\Http\Controllers\Controller;

class UserController extends Controller				// Define the class name
{
    public function index()							// Define the method name
    {
        $users = User::all();
        return view('users.list', ['users' => $users]);	// Return response to client
    }
    
}
