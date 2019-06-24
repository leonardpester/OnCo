<?php

class Model
{
    public $database = null;

    public function __construct()
    {
        if ($this->database == null) {
            $this->database = new mysqli('localhost', 'root', '', 'onco');
            if($this->database->connect_errno) {
                die("<br><br>Conexiunea la baza de date nu a putut fi realizata! :(<br>" . $this->database->connect_error);
            }
        }
    }

    public function parseParams($params = [])
    {
        $result = null;
        if ($params != []) {
            $result = [];
            foreach ((array)$params as $item) {
                $split  = explode("=", $item);
                if(!isset($result[$split[0]]))
                    $result[$split[0]] = array($split[1]);
                else array_push($result[$split[0]], $split[1]);
            }
        }
        return $result;
    }
}
