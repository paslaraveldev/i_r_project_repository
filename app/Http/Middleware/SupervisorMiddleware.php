<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class SupervisorMiddleware
{
	public function handle(Request $request, Closure $next): Response {

		if(Auth::check()){

			if(Auth::user()->role=='supervisor')
			{
				return $next($request);
			}
			else
			{
				Auth::logout();
				return redirect(url('login'));
			}

		}
		else{
			Auth::logout();
				return redirect(url('login'));


		}
	}




}