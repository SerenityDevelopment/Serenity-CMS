<?php

namespace Application\Model\Rowset;

abstract class AbstractModel
{
    protected $baseUrl;
    
    public $id;
    
    public $username;
    
    public $email;
    
    public function __construct($baseUrl = null)
    {
        $this->baseUrl = $baseUrl;
    }
}