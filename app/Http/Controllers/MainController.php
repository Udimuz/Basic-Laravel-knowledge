<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class MainController extends Controller
{
	//	http://first-project.loc/main
	public function index() {
		return view('main');
	}
}
