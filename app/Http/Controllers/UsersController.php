<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Middleware\RedirectIfAuthenticated;

class UsersController extends Controller
{
	public function __construct()
	{
		$this->middleware(RedirectIfAuthenticated::class, [
			'only' => 'create'
		]);
	}

    public function create()
    {
    	return view('users.create');
    }

    public function store(StoreUserRequest $request)
    {
    	$user = new User();
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = Hash::make($request->password);
    	$user->save();
    	Auth::login($user);
    	return redirect('/');
    }
}