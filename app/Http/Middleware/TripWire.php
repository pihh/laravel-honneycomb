<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class TripWire
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(isset($request->pihhtw)){

            if(strlen($request->pihhtw) > 0){

                $warning = new \stdClass();
                $warning->trigger = 'HonneyPot Alert: ';
                if(Auth::user()){
                    $warning->user = Auth::user();
                }else{
                    $warning->user = 'Unknown user';
                }
                $warning->browser = browserInfo();
                $warning->ip = $request->ips();
                $warning->url = $request->url();
                $warning->input_value = $request->pihhtw;

                Log::warning(json_encode($warning));

                // TODO if requested: Blacklist ip
                // TODO if requested: Could log in separate files

            }
        }
        return $next($request);
    }
}
