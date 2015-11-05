<?php namespace App\Http\Controllers;
use Stripe\Stripe;

class StripeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Stripe Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function charge()
	{
		Stripe::setApiKey(Config::get('stripe.stripe.secret'));

		// Get the credit card details submitted by the form
		$token = Input::get('stripeToken');

		// Create the charge on Stripe's servers - this will charge the user's card
		try {
		    $charge = Stripe_Charge::create(array(
		      "amount" => 2000, // amount in cents
		      "currency" => "cad",
		      "card"  => $token,
		      "description" => 'Charge for my product')
		    );

		} catch(Stripe_CardError $e) {
		    $e_json = $e->getJsonBody();
		    $error = $e_json['error'];
		    // The card has been declined
		    // redirect back to checkout page
		    return Redirect::to('ogppay')
		        ->withInput()->with('stripe_errors',$error['message']);
		}
		// Maybe add an entry to your DB that the charge was successful, or at least Log the charge or errors
		// Stripe charge was successfull, continue by redirecting to a page with a thank you message
		return Redirect::to('ogppay/success');
	}

}
