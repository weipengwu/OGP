<?php namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
		'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
		'Illuminate\Cookie\Middleware\EncryptCookies',
		'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
		'Illuminate\Session\Middleware\StartSession',
		'App\Http\Middleware\Language',
		'Illuminate\View\Middleware\ShareErrorsFromSession',
		'App\Http\Middleware\VerifyCsrfToken',
	];

	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
		'auth' => 'App\Http\Middleware\Authenticate',
		'auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
		'guest' => 'App\Http\Middleware\RedirectIfAuthenticated',
	];

	/**
	 * Throw a 404 is a model record isn't found
	 * @param  ModelNotFoundException
	 * @return [type]
	 */
    protected function renderModelNotFoundException(ModelNotFoundException $e)
    {
      if (view()->exists('errors.404'))
      {
        return response()->view('errors.404', [], 404);
      }
      else
      {
        return (new SymfonyDisplayer(config('app.debug')))
          ->createResponse($e);
      }
    }

}
