<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class StudentMiddleware
{
	public function handle(Request $request, Closure $next): Response {

		if(Auth::check()){

			if(Auth::user()->role=='student')
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