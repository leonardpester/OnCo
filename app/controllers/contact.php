<?php
require_once '../app/models/contact.php';

class Contact extends Controller {
    protected $model = null;
    protected $contactId = null;

    public function __construct() {
        $this->model = new ContactModel;
    }

    public function index($params = []) {
        $parametru=$this->model->parseParams($params);

        if(isset($_POST["exp"]))
            header("Location: /public/export/".$this->model->database->real_escape_string($_POST["exp"])."/id=".$this->model->database->real_escape_string($_POST["id"]));

        if(isset($parametru["id"])){
            $this->model->setContactId($this->model->database->real_escape_string($parametru['id'][0]));
            $this->model->loadModel();
        }
        else if(isset($_POST["edit"])) {
            $this->model->edit($this->model->database->real_escape_string($_POST["id"]));
        }
        //$this->model->loadParams($params);
    }
}
?>