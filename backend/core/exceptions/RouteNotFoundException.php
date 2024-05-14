<?php


namespace app\core\exceptions;


class RouteNotFoundException extends \Exception
{
    protected $message = 'Route Not Found!';
    protected $code = 404;
}
