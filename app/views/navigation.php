<?php

class NavigationView extends View {
    protected $headTags = [];
    protected $body = '';
    public function __construct() {
        array_push($this->headTags, '<link href="/../../public/styles/navigation.css" rel="stylesheet">');
        array_push($this->headTags, '<script src="/../../public/javascript/nav.js"></script>');
        array_push($this->headTags, '<link rel="shortcut icon" type="image/x-icon" href="/public/favicon.ico" />');

        $this->body = '<body>
    <nav>
        <div class="navigation-bar">
            <button id="show-slider" onclick="showSlider()">Meniu</button>
            <h5 id="website-name">OnCo</h5>
            <a href="/public/contact/id='.$_SESSION["contactId"].'">Profil</a>
        </div>
        <div id="left-slider" class="slider">
            <div>
                <button onclick="closeSlider()">❌</button>
            </div>
            <a href="/public">Acasa</a>
            <a href="/public/contactedit/mode=add">Adauga un contact</a>
            <a href="/public/groups">Gestioneaza gruparile</a>
            <a href="/public/export/vcard">Export contacte vCard</a>
            <a href="/public/export/csv/">Export contacte CSV</a>
            <a href="#">Feed Atom</a>
            <a href="/public/contactedit/mode=edit/id='.$_SESSION["contactId"].'">Editeaza Profilul</a>
            <a href="/public/authentication/logout">Delogare</a>
        </div>
    </nav>
';
    }

    public function getHeadTags() {
        return $this->headTags;
    }

    public function getBody() {
        return $this->body;
    }

    public function showBody() {
        echo $this->body;
    }
}

?>