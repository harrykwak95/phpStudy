<?php
namespace Ijdb\Controller;
use \Hanbit\DatabaseTable;

class Register
{
    private $authorsTable;

    public function __construct(DatabaseTable $authorsTable){
        $this->authorsTable = $authorsTable;
        
    }

    public function showForm(){
        
    }
}