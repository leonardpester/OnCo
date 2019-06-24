<?php

class GroupsView extends View {

    protected $headTags = [];
    protected $body = '';
    protected $groups = null;
    protected $contacts = null;

    public function __construct() {
        array_push($this->headTags, '<link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">');
        array_push($this->headTags, '<link href="/../../public/styles/reseter.css" rel="stylesheet">');
        array_push($this->headTags, '<link href="/../../public/styles/groups.css" rel="stylesheet">');
    }

    public function constructBody() {
        $this->body = '<div id="grouped">';
        if($this->contacts != null) {
            foreach($this->groups as $group) {
                if($group->id > 0) {
                    $this->body = $this->body . '<ul class="group">
                    <li class="group-name">
                        <h5>' .$group->name. '</h5>
                    </li>';
                    foreach($this->contacts as $contact) {
                        if($contact->groupId == $group->id) {
                            $this->body = $this->body . '<li class="contact" data-id=' .$contact->id. ' onclick="mark(event)">
                            <img class="contact-picture" src="'.$contact->pictureURL.'" alt="Profile Picture" />
                            <h2 class="contact-name">'.$contact->name.'</h2>
                        </li>
                            ';
                        }
                    }
                    $this->body = $this->body . '</ul>';
                }
            }
        }
    $this->body = $this->body . '</div>
    <div id="transition">
        <button id="left">⏪</button>
        <select id="available-groups" name="newGroup">';
            foreach($this->groups as $group) {
                if($group->id > 0) {
                    $this->body = $this->body . '<option value="' . $group->id .'">' . $group->name . '</option>';
                }
            }
        $this->body = $this->body . '</select>
        <button id="new-group" onclick="inputGrup()">Grup nou</button>
        <button id="right">⏩</button>
    </div>
    <div id="ungrouped">';
    if($this->contacts != null) {
        foreach($this->groups as $group) {
            if($group->id == 0) {
                $this->body = $this->body . '<ul class="group">';
                foreach($this->contacts as $contact) {
                    if($contact->groupId == $group->id) {
                        $this->body = $this->body . '<li class="contact" data-id=' .$contact->id. ' onclick="mark(event)">
                        <img class="contact-picture" src="'.$contact->pictureURL.'" alt="Profile Picture" />
                        <h2 class="contact-name">'.$contact->name.'</h2>
                    </li>
                        ';
                    }
                }
                $this->body = $this->body . '</ul>';
                break;
            }
        }
    }
    $this->body = $this->body . '</div>
    <script src="/../../public/javascript/groups.js"></script>
    </body>';
    }

    public function getHeadTags(){
        return $this->headTags;
    }

    public function showBody() {
        echo $this->body;
    }

    public function setContacts($contacts) {
        $this->contacts = $contacts;
    }

    public function setGroups($groups) {
        $this->groups = $groups;
    }

}

?>