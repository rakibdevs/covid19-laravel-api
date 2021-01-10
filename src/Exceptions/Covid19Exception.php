<?php
namespace RakibDevs\Covid19\Src\Exceptions;

use Exception;

class Covid19Exception extends \Exception
{
	private $e;

    public function __construct($e){
        $this->e = $e;
    }

    public function render()
    {
        return $this->e->getResponse() == null?'Nothing found':$this->e->getResponse()->getBody(true);
    } 
    
}