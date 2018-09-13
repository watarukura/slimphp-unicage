<?php

namespace App\Controller;

use Slim\Container;

abstract class Base
{
    protected $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }
}
