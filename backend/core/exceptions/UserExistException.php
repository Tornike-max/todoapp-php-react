<?php


namespace app\core\exceptions;


class UserExistException extends \Exception
{
    protected $message = 'User Already Exists!';
    protected $code = 409;
}
