<?php
require_once '../app/models/contact-edit.php';

class ContactEdit extends Controller {
    protected $model = null;
    protected $contactId = null;

    public function __construct() {
        $this->model = new ContactEditModel;
    }

    public function index($params = []) {
        $parametru=$this->model->parseParams($params);
        $vector = null;
      
       

        if(isset($parametru["mode"])){
            if($parametru["mode"][0]== 'edit'){
                if(isset($parametru["id"])){
                    $this->model->setContactId($this->model->database->real_escape_string($parametru['id'][0]));
                    $this->model->loadModel('edit');  
                    
                }
                else
                $this->model->loadModel('add');
            }
            else
                $this->model->loadModel('add');
        }
        else
        $this->model->loadModel('add');
        
        if(isset($_POST['nume'])){
            
            $vector = array();
            $vector['nume']=$this->model->database->real_escape_string($_POST['nume']);
            $vector['adresa']=$this->model->database->real_escape_string($_POST['adresa']);
            $vector['data_nastere']=$this->model->database->real_escape_string($_POST['data_nastere']);
            $vector['email1']=$this->model->database->real_escape_string($_POST['email1']);
            $vector['email2']=$this->model->database->real_escape_string($_POST['email2']);
            $vector['descriere']=$this->model->database->real_escape_string($_POST['descriere']);
            $vector['nr_telefon1']=$this->model->database->real_escape_string($_POST['nr_telefon1']);
            $vector['nr_telefon2']=$this->model->database->real_escape_string($_POST['nr_telefon2']);
            $vector['interese']=$this->model->database->real_escape_string($_POST['interese']);
            $vector['adresa_web2']=$this->model->database->real_escape_string($_POST['adresa_web2']);
            $vector['adresa_web1']=$this->model->database->real_escape_string($_POST['adresa_web1']);
            $vector['studii']=$this->model->database->real_escape_string($_POST['studii']);
            $vector['imagine']=$this->model->database->real_escape_string($_POST['imagine']);
            $vector['contactId'] = $this->model->database->real_escape_string($_POST["contactid"]);


            
            if(isset($_POST['Editeaza']))
                $this->model->editContact($vector);
            else
                $this->model->addContact($vector);
        }
    }
}
?>