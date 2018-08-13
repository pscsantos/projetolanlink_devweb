<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee;

class AdminController extends Controller
{
    public function index(){

    	return view('admin.home.index');
    }
     
    public function login(){

    	return view('auth.login');
    }

    public function filtro(){

    	$employees = Employee::all()->pluck('id','name');

    	return view('admin.home.filtro',compact('employees'));
    } 

}
