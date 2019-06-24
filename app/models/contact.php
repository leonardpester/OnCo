<?php
    require_once '../app/core/ContactData.php';
    require_once '../app/views/navigation.php';
    require_once '../app/views/header.php';
    require_once '../app/views/contact.php';

    class ContactModel extends Model {
        protected $nav = null;
        protected $head = null;
        protected $view = null;
        protected $tags = [];
        protected $data = [];
        protected $contactId = null;

        public function loadModel() {
            $this->nav = new NavigationView;
            $this->view = new ContactView;
            $this->view->setContactId($this->contactId);
           
             $this->loadDefault();
        }

        


        public function loadDefault(){
            
            foreach ($this->nav->getHeadTags() as $tag) {
                array_push($this->tags, $tag);
            }
            foreach ($this->view->getHeadTags() as $tag) {
                array_push($this->tags, $tag);
            }

            //incarca tagul <head>
            $this->head = new Header($this->tags, "Profil");

            //Afiseaza bara de navigatie
            $this->nav->showBody();
            $data=$this->getContactData($this->contactId);
            $this->view->setValues($data);
            $this->view->constructBody();
            //Afiseaza pagina
            $this->view->showBody();

        }


        private function getContactData($contactId) {
            $contactId = $this->database->real_escape_string($contactId);
            $data = null;
            $query = 'SELECT * FROM contacts where contactId="'.$contactId.'"' ;
            $result = $this->database->query($query);
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $data = new ContactData;
                    $data -> id = $this->database->real_escape_string($row["contactId"]);
                    $data -> name = $this->database->real_escape_string($row["name"]);
                    $data -> phone = $this->database->real_escape_string($row["phoneNumber1"]);
                    $data -> phone2 = $this->database->real_escape_string($row["phoneNumber2"]);
                    $data -> email = $this->database->real_escape_string($row["email1"]);
                    $data -> email2 = $this->database->real_escape_string($row["email2"]);
                    $data -> description = $this->database->real_escape_string($row["description"]);
                    $data -> address = $this->database->real_escape_string($row["address"]);
                    $data -> birthDate = $this->database->real_escape_string($row["birthDate"]);
                    $data -> webAddress = $this->database->real_escape_string($row["webAddress1"]);
                    $data -> webAddress2 = $this->database->real_escape_string($row["webAddress2"]);
                    $data -> interests = $this->database->real_escape_string($row["interests"]);
                    $data -> studies = $this->database->real_escape_string($row["studies"]);
                    $data -> pictureURL = $this->database->real_escape_string($row["pictureAddress"]);
                    $data -> groupId = $this->database->real_escape_string($row["groupId"]);
                    $data -> userId = $this->database->real_escape_string($row["userId"]);
                }
            }
            return $data;
        }

        public function setContactId($id){
            $this->contactId=$this->database->real_escape_string($id);
            
        }

        public function edit($id) {
            header("Location: /public/contactedit/mode=edit/id=".$this->database->real_escape_string($id));
        }

    }
?>