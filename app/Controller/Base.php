<?php

namespace App\Controller;

use Slim\Container;

abstract class Base
{
    protected $app;

    /**
     * Base constructor.
     * @param Container $app
     * @throws \Interop\Container\Exception\ContainerException
     */
    public function __construct(Container $app)
    {
        $this->app = $app;
    }
}
