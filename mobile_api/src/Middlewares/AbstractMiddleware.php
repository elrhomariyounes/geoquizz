<?php

namespace gq\mobile\Middlewares;
class AbstractMiddleware
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }
}