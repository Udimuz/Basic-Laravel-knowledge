<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class AboutController extends Controller
{
	//	http://first-project.loc/about
	public function index() {
		return view('about');
	}
}