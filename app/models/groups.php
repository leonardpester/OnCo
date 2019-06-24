<?php
require_once '../app/core/ContactData.php';
require_once '../app/views/navigation.php';
require_once '../app/views/header.php';
require_once '../app/views/groups.php';


class GroupsModel extends Model {

    protected $nav = null;
    protected $header = null;
    protected $view = null;

    protected $tags = [];

    public function loadModel($newgroup = null) {

        if($newgroup != null) {
            $this->createNewGroup($newgroup);
        }

        $this->nav = new NavigationView;
        $this->view = new GroupsView;

        foreach ($this->nav->getHeadTags() as $tag) {
            array_push($this->tags, $tag);
        }

        foreach ($this->view->getHeadTags() as $tag) {
            array_push($this->tags, $tag);
        }

        $this->header = new Header($this->tags,"Grupari");
        $cts = $this->getContacts();
        $gps = $this->getGroups();

        $this->view->setContacts($cts);
        $this->view->setGroups($gps);

        $this->view->constructBody();
        $this->nav->showBody();
        $this->view->showBody();
    }

    public function updateContactGroup($contact, $group){
        $query = 'UPDATE contacts SET groupId=' . $group . ' WHERE contactId=' . $contact. ' AND userId = ' .$_SESSION["userId"];
        if(!($this->database->query($query) === TRUE)) {
            die("An error occured! Please try again!");
        }
        else header("Location: /public/groups");
    }

    private function getContacts() {
        $contacts = null;
        $query = "SELECT * FROM contacts WHERE userId = ". $_SESSION["userId"];
        $result = $this->database->query($query);
        if($result->num_rows > 0) {
            $contacts = array();
            while($row = $result->fetch_assoc()) {
                $data = new ContactData;
                $data -> id = $row["contactId"];
                $data -> name = $row["name"];
                $data -> pictureURL = $row["pictureAddress"];
                $data -> groupId = $row["groupId"];
                $data -> userId = $row["userId"];
                array_push($contacts, $data);
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

    private function createNewGroup($groupName) {
        $query = 'INSERT INTO groups(name, userId) VALUES ("' . utf8_decode(urldecode($groupName)) . '","'.$_SESSION["userId"].'")';
        if(!($this->database->query($query) === TRUE)) {
            die("An error occured! Please try again!");
        }
        else header("Location: /public/groups");
    }

}

?>