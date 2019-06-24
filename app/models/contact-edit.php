<?php
    require_once '../app/core/ContactData.php';
    require_once '../app/views/navigation.php';
    require_once '../app/views/header.php';
    require_once '../app/views/contact-edit.php';

    class ContactEditModel extends Model {
        protected $nav = null;
        protected $head = null;
        protected $view = null;
        protected $tags = [];
        protected $data = [];
        protected $contactId = null;

        public function loadModel($mode) {
            $this->nav = new NavigationView;
            $this->view = new ContactEditView;
            if($mode == 'edit')
                $this->loadEdit();
            else
             $this->loadDefault();
        }

        public function loadEdit(){
            foreach ($this->nav->getHeadTags() as $tag) {
                array_push($this->tags, $tag);
            }
            foreach ($this->view->getHeadTags() as $tag) {
                array_push($this->tags, $tag);
            }

            //incarca tagul <head>
            $this->head = new Header($this->tags, "Editare Contact");

            //Afiseaza bara de navigatie
            $this->nav->showBody();

            $data=$this->getContactData($this->contactId);
            $this->view->setValues($data);
            $this->view->setNumePagina("edit");
            $this->view->setContactId($this->contactId);
            $this->view->constructBody();
            //Afiseaza pagina
            $this->view->showBody();


        }


        public function loadDefault(){
            foreach ($this->nav->getHeadTags() as $tag) {
                array_push($this->tags, $tag);
            }
            foreach ($this->view->getHeadTags() as $tag) {
                array_push($this->tags, $tag);
            }

            //incarca tagul <head>
            $this->head = new Header($this->tags, "Adaugare Contact");

            //Afiseaza bara de navigatie
            $this->nav->showBody();
            $this->view->setNumePagina("add");

           
            $this->view->constructBody();
            //Afiseaza pagina
            $this->view->showBody();

        }


        private function getContactData($contactId) {
            $data = null;
            $query = 'SELECT * FROM contacts where contactId="'.$contactId.'"' ;
            $result = $this->database->query($query);
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $data = new ContactData;
                    $data -> id = $row["contactId"];
                    $data -> name = $row["name"];
                    $data -> phone1 = $row["phoneNumber1"];
                    $data -> phone2 = $row["phoneNumber2"];
                    $data -> email = $row["email1"];
                    $data -> email2 = $row["email2"];
                    $data -> description = $row["description"];
                    $data -> address = $row["address"];
                    $data -> birthDate = $row["birthDate"];
                    $data -> webAddress = $row["webAddress1"];
                    $data -> webAddress2 = $row["webAddress2"];
                    $data -> interests = $row["interests"];
                    $data -> studies = $row["studies"];
                    $data -> pictureURL = $row["pictureAddress"];
                    $data -> groupId = $row["groupId"];
                    $data -> userId = $row["userId"];
                }
            }
            return $data;
        }

        public function setContactId($id){
            $this->contactId=$id;
            //print_r($this->contactId);
        }


        public function addContact($vector){
            if($vector["imagine"] == "")
                $vector["imagine"]="/../../public/styles/default_profile_icon.png";
            if($vector["data_nastere"] == "") {
                $vector["data_nastere"] = "1990-01-01";
            }
            $sql = 'INSERT INTO contacts (name,userId,phoneNumber1,phoneNumber2,address,email1,email2,description,birthDate,webAddress1,webAddress2,interests,studies,groupId,pictureAddress)
            VALUES (\'' .$vector["nume"]. '\',\''.$_SESSION["userId"].'\',\''.$vector["nr_telefon1"].'\',\''.$vector["nr_telefon2"].'\',\''.$vector["adresa"].'\',\''.$vector["email1"].'\',\''.$vector["email2"].'\',
            \''.$vector["descriere"].'\',\''.$vector["data_nastere"].'\',\''.$vector["adresa_web1"].'\',\''.$vector["adresa_web2"].'\',\''.$vector["interese"].'\'
            ,\''.$vector["studii"].'\',0,\''.$vector["imagine"].'\')';
            
            if($this->database->query($sql) !== TRUE)
                die("Eroare");
            
        }

        public function editContact($vector){
            $sql = '
            UPDATE contacts
            SET name= \''.$vector["nume"].'\',
            phoneNumber1= \''.$vector["nr_telefon1"].'\',
            phoneNumber2=\''.$vector["nr_telefon2"].'\',
            address=\''.$vector["adresa"].'\',
            email1=\''.$vector["email1"].'\',
            email2=\''.$vector["email2"].'\',
            description=\''.$vector["descriere"].'\',
            birthDate=\''.$vector["data_nastere"].'\',
            webAddress1=\''.$vector["adresa_web1"].'\',
            webAddress2=\''.$vector["adresa_web2"].'\',
            interests=\''.$vector["interese"].'\',
            studies=\''.$vector["studii"].'\',
            pictureAddress=\''.$vector["imagine"].'\' 
            WHERE contactId=\''.$vector["contactId"].'\';';

            if($this->database->query($sql) !== TRUE)
                die("Eroare");
            else echo "<script>window.location.assign(\"/public/contactedit/mode=edit/id=".$vector["contactId"]."\");</script>";

            $em = '
            UPDATE users
            SET 
            email= \''.$vector["email1"].'\'
            WHERE contactId=\''.$vector["contactId"].'\';';

            if($this->database->query($em) !== TRUE)
                die("Eroare");
            else
                echo "<script>window.location.assign(\"/public/contactedit/mode=edit/id=".$vector["contactId"]."\");</script>";
        }



    


    }
?>