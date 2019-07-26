<?php
namespace App\Http\Middleware;

use Closure;

class Cors
{
    public function handle($request, Closure $next)
    {
        Header('Access-Control-Allow-Origin:*');
        //ALLOW OPTIONS METHOD
        $headers = [
            'Access-Control-Allow-Methods' => 'POST,GET,OPTIONS,PUT,DELETE',
            'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Origin, X-CSRF-TOKEN, Authorization',
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Allow-Max-Age' => '1728000',
        ];
        if ($request->getMethod() == "OPTIONS"){
            //The client-side application can set only headers allowed in Access-Control-Allow-Headers
            return response()->json('OK',200,$headers);
        }
        $response = $next($request);
        foreach ($headers as $key => $value) {
            $response->header($key, $value);
        }
        return $response;

    }
}
  
  
   