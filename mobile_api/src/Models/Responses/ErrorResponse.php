<?php


namespace gq\mobile\Models\Responses;


class ErrorResponse extends AbstractResponse implements \JsonSerializable
{
    public function getStatus()
    {
        return $this->status;
    }
    private $message;

    public function __construct($type,$status,$message)
    {
        $this->type=$type;
        $this->status=$status;
        $this->message = $message;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}