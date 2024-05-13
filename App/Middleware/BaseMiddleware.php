<?php
namespace App\Middleware;
use App\Middleware\Contract\MiddlewareInterface;

class BaseMiddleware implements MiddlewareInterface
{
    public function handle()
    {
        echo "ok";
        global $request;
        $request->go();
    }
}