<?php namespace App\Http\Controllers;
use Session;
use Redirect;

class LangController extends Controller {


	public function switchLang($lang)
	{
		Session::set('applocale', $lang);
		return Redirect::back();
	}

}
