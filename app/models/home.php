<?php
require_once '../app/core/ContactData.php';
require_once '../app/views/navigation.php';
require_once '../app/views/header.php';
require_once '../app/views/home.php';


class HomeModel extends Model
{
    protected $nav = null;
    protected $head = null;
    protected $view = null;

    protected $params = [];
    protected $contacts = [];
    protected $tags = [];

    protected $lcts = [];
    protected $stds = [];
    protected $ints = [];

    public function loadModel($params = []) {
        $this->nav = new NavigationView;
        $this->view = new HomeView;
        if(count($params) == 0) {
            $this->params = [];
            $this->loadDefault();
        }
        else {
            $this->params = $this->parseParams($params);
            $this->loadFiltered();
        }
    }

    private function loadDefault() {
        // Incarca linkurile din head
        foreach ($this->nav->getHeadTags() as $tag) {
            array_push($this->tags, $tag);
        }
        foreach ($this->view->getHeadTags() as $tag) {
            array_push($this->tags, $tag);
        }

        //incarca tagul <head>
        $this->head = new Header($this->tags, "Index");

        //Afiseaza bara de navigatie
        $this->nav->showBody();

        $cts = $this->getContacts();
        $this->view->setContacts($cts);

        $gps = $this->getGroups();
        $this->view->setGroups($gps);

        $this->lcts = $this->getLocations();
        $this->stds = $this->getStudies();
        $this->checkFilters();

        $this->view->setFilters($this->lcts,$this->stds);
        $this->view->setParams($this->params);

        $this->view->constructBody();
        //Afiseaza pagina
        $this->view->showBody();
    }

    private function loadFiltered() {
        foreach ($this->nav->getHeadTags() as $tag) {
            array_push($this->tags, $tag);
        }
        foreach ($this->view->getHeadTags() as $tag) {
            array_push($this->tags, $tag);
        }

        //incarca tagul <head>
        $this->head = new Header($this->tags, "Index");

        //Afiseaza bara de navigatie
        $this->nav->showBody();

        $gps = $this->getGroups();
        $this->view->setGroups($gps);

        $this->lcts = $this->getLocations();
        $this->stds = $this->getStudies();
        $this->checkFilters();

        $query = "SELECT * FROM contacts WHERE userId = ".$_SESSION["userId"];;

        $nameQr = "";
        $addressQr = "";
        $studiesQr = "";
        $interestsQr = "";

        $somethingBefore = true;
        foreach($this->params as $key => $val) {
            if($key == 'name') {
                $nameQr = " AND name LIKE '%" . $val . "%'";
            }
        }

        if($nameQr != "") {
            $somethingBefore = true;
            $query = $query . $nameQr;
        }

        foreach($this->params as $key => $val) {
            if($key == 'location') {
                foreach($val as $single)
                    if($addressQr == "")
                        $addressQr = "(address LIKE '%" . $single . "%'";
                    else $addressQr = $addressQr . " OR address LIKE '%" . $single . "%'";
            break;
            }
        }

        if($addressQr != "") {
            if($somethingBefore == true) {
                $query = $query . " AND " . $addressQr . ")";
            }
            else $query = $query . $addressQr . ")";
            $somethingBefore = true;
        }


        foreach($this->params as $key => $val) {
            if($key == 'studies') {
                foreach($val as $single)
                    if($studiesQr == "")
                        $studiesQr = "(studies='" . $single . "'";
                    else $studiesQr = $studiesQr . " OR studies='" . $single . "'";
            break;
            }
        }

        if($studiesQr != "") {
            if($somethingBefore == true) {
                $query = $query . " AND " . $studiesQr . ")";
            }
            else $query = $query . $studiesQr . ")";
            $somethingBefore = true;
        }

        foreach($this->params as $key => $val) {
            if($key == 'interests') {
                foreach($val as $single)
                if($interestsQr == "")
                    $interestsQr = "(interests LIKE '%" . $single . "%'";
                else $interestsQr = $interestsQr . " OR interests LIKE '%" . $single . "%'";
                    break;
            }
        }

        if($interestsQr != "") {
            if($somethingBefore == true) {
                $query = $query . " AND " . $interestsQr . ")";
            }
            else $query = $query . $interestsQr . ")";
            $somethingBefore = true;
        }

        if ($somethingBefore == false) {
            $query = "SELECT * FROM contacts WHERE userId = " .$_SESSION["userId"];
        }
        $cts = $this->getContacts($query);
        $this->view->setContacts($cts);

        $this->view->setFilters($this->lcts,$this->stds);
        $this->view->setParams($this->params);

        $this->view->constructBody();
        //Afiseaza pagina
        $this->view->showBody();

    }

    private function getContacts($qr = null) {
        $contacts = null;
        $query = "";
        if($qr == null)
            $query = "SELECT * FROM contacts WHERE userId = " .$_SESSION["userId"];
        else $query = $qr;
        $result = $this->database->query($query);
        if (!$result) {
            trigger_error('Invalid query: ' . $this->database->error);
        }
        else {
            if($result->num_rows > 0) {
                $contacts = array();
                while($row = $result->fetch_assoc()) {
                    $data = new ContactData;
                    $data -> id = $row["contactId"];
                    $data -> name = $row["name"];
                    $data -> phone = $row["phoneNumber1"];
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
                    array_push($contacts, $data);
                }
            }
        }
        return $contacts;
    }

    private function getGroups() {
        $groups = null;
        $query = "SELECT * FROM groups WHERE groupId = 0 OR userId = " .$_SESSION["userId"];
        $result = $this->database->query($query);
        if($result->num_rows > 0) {
            $groups = array();
            while($row = $result->fetch_assoc()) {
                $data = (object)[
                    'id' => $row["groupId"],
                    "name" => $row["name"]
                ];
                array_push($groups, $data);
            }
        }
        return $groups;
    }

    private function getLocations() {
        $locations = null;
        $query = "SELECT address FROM contacts WHERE userId = " .$_SESSION["userId"];
        $result = $this->database->query($query);
        if($result->num_rows > 0) {
            $locations = array();
            while($row = $result->fetch_assoc()) {
                if($row["address"] != null)  
                    array_push($locations, $row["address"]);
            }
        }
        if($locations != null) {
            $locations = array_unique($locations);
        }
        return $locations;
    }

    private function getStudies() {

        $studies = null;
        $query = "SELECT studies FROM contacts WHERE userId = " .$_SESSION["userId"];
        $result = $this->database->query($query);
        if($result->num_rows > 0) {
            $studies = array();
            while($row = $result->fetch_assoc()) {
                if($row["studies"] != null)
                    array_push($studies, $row["studies"]);
            }
        }
        if($studies!= null) {
            $studies = array_unique($studies);
        }
        return $studies;
    }

    private function checkFilters() {
        $newArr = [];
        if($this->params != null) {
            foreach($this->params as $key => $val) {
                if($key == "age-max" || $key == "age-min")
                    $newArr[$key] = $this->database->real_escape_string($val[0]);
                else if($key == "name") {
                    $newArr[$key] = implode(" ", explode("+",$this->database->real_escape_string($val[0])));
                }
                else if($key == "location") {
                    $newArr[$key] = array();
                    foreach($val as $value) {
                        $value = implode(" ", explode("+", $this->database->real_escape_string($value)));
                        if(in_array($value,$this->lcts))
                            array_push($newArr[$key], $value);
                    }
                }
                else if($key == "studies") {
                    $newArr[$key] = array();
                    foreach($val as $value) {
                        $value = implode(" ", explode("+", $this->database->real_escape_string($value)));
                        if(in_array($value,$this->stds))
                            array_push($newArr[$key], $value);
                    }
                }
                else if($key == "interests")
                    $newArr[$key] = explode("+",$this->database->real_escape_string($val[0]));
            }
        }
        $this->params = $newArr;
    }
}
