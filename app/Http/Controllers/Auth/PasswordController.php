<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Password Reset Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password reset requests
	| and uses a simple trait to include this behavior. You're free to
	| explore this trait and override any methods you wish to tweak.
	|
	*/

	use ResetsPasswords;

	/**
	 * Create a new password controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\PasswordBroker  $passwords
	 * @return void
	 */
	public function __construct(Guard $auth, PasswordBroker $passwords)
	{
		$this->auth = $auth;
		$this->passwords = $passwords;

		$this->middleware('guest');
	}

	public function changepwdindex()
	{
		return view('auth.changepassword');
	}

	public function changePassword()
	{
		$validator = Validator::make(Request::only('currentPwd', 'newPwd'), [
			'currentPwd' => 'required',
			'newPwd' => 'required|confirmed|min:6',
		]);
		if ($validator->fails()){
			return redirect()->back()->withErrors($validator);
		}else{
			$user = User::findOrFail(Request::input('user'));
			$hashedPassword = $user->password;
			if(Hash::check(Request::input('currentPwd'), $hashedPassword)){
				$user->password = Request::input('newPwd');
				$user->save();
				return redirect()->back()->with('success', true)->with('message','Password updated.');
			}else{
				return redirect()->back()->withErrors('Password Incorrect');
			}
		}
	}
}
