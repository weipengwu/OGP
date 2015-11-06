<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ( $this->excludedRoutes($request) )
        {
            return $next($request);
        }
		return parent::handle($request, $next);
	}

	protected $routes = ['ogppay' ];

   //add to the handler function
    protected function excludedRoutes($request)
    {
        foreach($this->routes as $route)
        {
            if ($request->is($route))
                return true;
        }
        return false;
    }

}
