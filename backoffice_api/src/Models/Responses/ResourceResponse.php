<?php


namespace gq\backoffice\Models\Responses;


class ResourceResponse extends AbstractResponse implements \JsonSerializable
{
    private $result;

    public function __construct($type,$status,$result)
    {
        $this->result = $result;
        $this->status=$status;
        $this->type=$type;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function getResult()
    {
        return $this->result;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}