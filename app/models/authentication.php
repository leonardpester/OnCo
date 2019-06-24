<?php

    require_once '../app/views/navigation.php';
    require_once '../app/views/header.php';
    require_once '../app/views/authentication.php';

    class AuthenticationModel extends Model {
        protected $nav = null;
        protected $head = null;
        protected $view = null;
        protected $tags = [];
        protected $data = [];
        protected $contactId = null;

        public function loadModel() {
            $this->view = new AuthenticationView;
            $this->loadDefault();
        }



        public function loadDefault(){
            foreach ($this->view->getHeadTags() as $tag) {
                array_push($this->tags, $tag);
            }

            //incarca tagul <head>
            $this->head = new Header($this->tags, "Autentificare");

            $this->view->constructBody();
            //Afiseaza pagina
            $this->view->showBody();

        }
        public function loadParams($params = []) {
            $this->params = $this->parseParams($params);
        }

        public function register($vector){
            $sql = 'INSERT INTO contacts (name,phoneNumber1,phoneNumber2,address,email1,email2,description,birthDate,webAddress1,webAddress2,interests,studies,groupId,pictureAddress)
            VALUES (\'' .$vector["nume"]. '\',\''.$vector["nr_telefon1"].'\',\''.$vector["nr_telefon2"].'\',\''.$vector["adresa"].'\',\''.$vector["email1"].'\',\''.$vector["email2"].'\',
            \''.$vector["descriere"].'\',\''.$vector["data_nastere"].'\',\''.$vector["adresa_web1"].'\',\''.$vector["adresa_web2"].'\',\''.$vector["interese"].'\'
            ,\''.$vector["studii"].'\',0,\''.$vector["imagine"].'\')';
            if($this->database->query($sql) !== TRUE)
                die("Eroare add");

            $ctId =' SELECT contactId FROM contacts Where email1=\''.$vector["email1"].'\'' ;
            $result = $this->database->query($ctId);
            if($result->num_rows == 0)
                die("EROARE");
            else {
                $id = $result->fetch_assoc()["contactId"];

                $user = 'INSERT INTO users (name,email,contactId,password)
                VALUES (\'' .$vector["nume"]. '\',\''.$vector["email1"].'\',\''.$id.'\',\''.$vector["parola"].'\')';
                if($this->database->query($user) !== TRUE)
                    die("Eroare users");
            }

            $idUser =' SELECT userId FROM users Where email=\''.$vector["email1"].'\'' ;
            $result = $this->database->query($idUser);
            if($result->num_rows == 0)
                die("EROARE");
            else {
                $id1 = $result->fetch_assoc()["userId"];
                $update = '
                UPDATE contacts
                SET userId= \''.$id1.'\'
                WHERE contactId=\''.$id.'\';
                ';
                
                if($this->database->query($update) !== TRUE)
                    die('Eroare update userId');
            }

        }

        public function login($vector){

            $sql =' SELECT userId,contactId,email,password FROM users Where email=\''.$vector["email"].'\' and  password=\''.$vector["parola"].'\' ' ;
            $result = $this->database->query($sql);
    
            if($result->num_rows == 0)
                echo "<script>alert(\"Email sau parola incorecta!\");</script>";
            else
            {
                $row = $result->fetch_assoc();
                $id = $row["userId"];
                $contactId = $row["contactId"];
                $secret = "oParolaFoarteGrea";
                $head= self::base64url_encode('{"alg": "HS256","typ": "JWT"}');
                $time = new DateTime;
                $time->modify('+ 1 hour');
                $payload = self::base64url_encode('{"id": '.$id.', "cid": '.$contactId.', "exp": "'. $time->format('Y-m-d H:i:s').'"}');
                $concat = $head. '.' .$payload;
                $signature = hash_hmac('sha256', $concat, $secret);
              

                $value = $head.'.'.$payload.'.'.$signature;
                
                setcookie("authentication", null, -1, '/');
                setcookie("authentication",$value, time() + 3600, '/');
                return 1;
            }

        }

        public function checkEmail($email) {
            $sql =' SELECT userId FROM users Where email=\''.$email.'\'';
            $result = $this->database->query($sql);
    
            if($result->num_rows == 0)
                echo "Nu exista cont cu acest email.";
            else echo "Exista cont cu acest email! ";
        }

        public static function base64url_encode($data) { 
            return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
          } 
          
        public static function base64url_decode($data) { 
            return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
          } 

    }
?>