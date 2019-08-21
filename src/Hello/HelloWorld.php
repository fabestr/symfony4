<?php

namespace App\Hello;


class HelloWorld
{
    private $prenom;
    private $magnifier;

    public function __construct(string $p, Magnifier $m)
    {
        $this->prenom = $p;
        $this->magnifier = $m;
    }

    public function yo()
    {
        return 'yo '.$this->prenom.'!';
    }

    public function yoUpper()
    {
        return $this->magnifier->upper($this->yo());
    }


    
}