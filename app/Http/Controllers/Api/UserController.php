<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{

	protected $user = null;

	public function __construct(User $user){
		$this->user = $user;
	}

    public function allUsers(){

    	return $this->user->allUsers();
    }

    public function getUser($id){
    	

    }

    public function saveUser(){
    	
    	return 'testes testes';//$this->user->saveUser();
    }

    public function updateUser($id){
    	
    }

    public function deleteUsers($id){
    	
    }
}
