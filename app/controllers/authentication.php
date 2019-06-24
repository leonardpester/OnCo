<?php
require_once '../app/models/authentication.php';

class Authentication extends Controller {
    protected $model = null;

    public function __construct() {
        $this->model = new AuthenticationModel;
    }

    public function index($params = []) {
        $param = $this->model->parseParams($params);
        $email = "";
        if(isset($param["checkEmail"])) {
            $email = $param["checkEmail"][0];
            $this->model->checkEmail($email);
        }
        else {
            if(isset($param[0]))
                die($param[0]);
        $this->model->loadModel($params);
        if(isset($_POST["submit"])) {
            switch($_POST['submit']) {
                case 'Submit_register':
                    if(isset($_POST['nume'])){
                        $vector = array();
                        $vector['nume']=$this->model->database->real_escape_string($_POST['nume']);
                        $vector['email1']=$this->model->database->real_escape_string($_POST['email']);
                        $vector['parola']=$this->model->database->real_escape_string($_POST['parola']);
                        $vector['adresa']='';
                        $vector['data_nastere']='';
                        $vector['email2']='';
                        $vector['descriere']='';
                        $vector['nr_telefon1']='';
                        $vector['nr_telefon2']='';
                        $vector['interese']='';
                        $vector['adresa_web2']='';
                        $vector['adresa_web1']='';
                        $vector['studii']='';
                        $vector['imagine']='/../../public/styles/default_profile_icon.png';
                        $this->model->register($vector);
                        header("Location: /public/home/"); 
                    }
                    break;

                case 'Submit_login':
                    if(isset($_POST['utilizator'])){
                        $vector = array();
                        $vector['email']=$this->model->database->real_escape_string($_POST['utilizator']);
                        $vector['parola']=$this->model->database->real_escape_string($_POST['parola']);
                        if($this->model->login($vector) == 1 )
                            header("Location: /public/home/");  
                    }
                    break;

                default:
                    break;
            }
        }
    }
        
    }

    public function logout($params = []){
        setcookie("authentication", null, -1, "/");
        unset($_SESSION["userId"]);
        header("Location: /public/authentication");
    }
}
?>