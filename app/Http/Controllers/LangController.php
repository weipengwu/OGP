<?php namespace App\Http\Controllers;


class LangController extends Controller {


	public function switchLang($lang)
	{
		Session::set('applocale', $lang);
		return Redirect::back();
	}

}
