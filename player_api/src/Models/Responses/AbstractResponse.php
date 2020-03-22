<?php

namespace gq\player\Models\Responses;
class AbstractResponse
{
    protected $status;
    protected $type;
    public function __construct($status, $type)
    {
        $this->status = $status;
        $this->type = $type;
    }

}