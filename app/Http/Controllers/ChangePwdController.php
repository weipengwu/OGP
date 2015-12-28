<?php namespace App\Http\Controllers;
use App\User;
use Request;
use Validator;
use Hash;

class ChangePwdController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Change Password Controller
	|--------------------------------------------------------------------------
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */


	public function changepwdindex()
	{
		return view('auth.changepassword');
	}

	public function changePassword()
	{
		$validator = Validator::make(Request::only('currentPwd', 'password', 'password_confirmation'), [
			'currentPwd' => 'required',
			'password' => 'required|confirmed|min:6',
		]);
		if ($validator->fails()){
			return redirect()->back()->withErrors($validator);
		}else{
			$user = User::findOrFail(Request::input('user'));
			$hashedPassword = $user->password;
			if(Hash::check(Request::input('currentPwd'), $hashedPassword)){
				$user->password = bcrypt(Request::input('password'));
				$user->save();
				return redirect()->back()->with('success', true)->with('message','Password updated.');
			}else{
				return redirect()->back()->withErrors('Password Incorrect');
			}
		}
	}
}
