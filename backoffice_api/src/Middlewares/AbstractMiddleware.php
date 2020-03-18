<?php

namespace gq\backoffice\Middlewares;
class AbstractMiddleware
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }
}