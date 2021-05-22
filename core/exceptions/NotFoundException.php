<?php

namespace app\core\exceptions;

/**
 * Class NotFoundException
 * @package app\core\exceptions
 */
class NotFoundException extends \Exception
{
    /**
     * @var string
     */
    protected $message = 'Page not found';
    /**
     * @var int
     */
    protected $code = 404;
}