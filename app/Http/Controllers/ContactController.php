<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ContactController extends Controller
{
	//	http://first-project.loc/contact
	public function index() {
		return view('contact');
	}
}
