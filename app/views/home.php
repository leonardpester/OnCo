<?php

class HomeView extends View {
    protected $headTags = [];
    protected $body = '';
    protected $contacts = null;
    protected $groups = null;

    protected $locations = null;
    protected $studies = null;
    protected $interests = null;
    protected $params = null;

    public function __construct() {
        array_push($this->headTags, '<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">');
        array_push($this->headTags, '<link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">');
        array_push($this->headTags, '<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">');
        array_push($this->headTags, '<link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">');
        array_push($this->headTags, '<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">');
        array_push($this->headTags, '<link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">');
        array_push($this->headTags, '<link href="/../../public/styles/reseter.css" rel="stylesheet">');
        array_push($this->headTags, '<link href="/../../public/styles/index.css" rel="stylesheet">');
    }

    public function constructBody() {
        $this->body = 
        '<button id="show-filters" onclick="showFilters()">Filtre</button>
        <form class="filter-list" method="GET" action="/public">
            <button id="close-filters" onclick="closeFilters()">❌ Inchide</button>
            <input type="submit" id="apply-filters" value="Aplica"/>
            <div class="filter-list-object">
                <h1>Nume</h1>';
                if(isset($this->params["name"]))
                    $this->body = $this->body . '<input name="name" type="text" placeholder="Nume" value="' . $this->params["name"]. '"/>';
                else $this->body = $this->body . '<input name="name" type="text" placeholder="Nume" />';

            $this->body = $this->body . '</div>
            <div class="filter-list-object">
                <h1>Varsta</h1>';
                if(isset($this->params["minage"])) {
                    if(is_numeric($this->params["minage"]) && $this->params["minage"] >=8 && $this->params["minage"] <= 120)
                        $this->body = $this->body . '<input name="age-min" id="age-min-input" class="age" type="number" value="'. (int)$this->params["minage"] .'" min="8" max="120" />';
                    else $this->body = $this->body . '<input name="age-min" id="age-min-input" class="age" type="number" value="8" min="8" max="120" />';
                }
                else $this->body = $this->body . '<input name="age-min" id="age-min-input" class="age" type="number" value="8" min="8" max="120" />';

                if(isset($this->params["maxage"])) {
                    if(is_numeric($this->params["maxage"]) && $this->params["maxage"] >=8 && $this->params["maxage"] <= 120)
                        $this->body = $this->body . '<input name="age-max" id="age-max-input" class="age" type="number" value="'. (int)$this->params["maxage"] .'" min="8" max="120" />';
                    else $this->body = $this->body . '<input name="age-max" id="age-max-input" class="age" type="number" value="120" min="8" max="120" />';
                }
                else $this->body = $this->body . '<input name="age-max" id="age-max-input" class="age" type="number" value="120" min="8" max="120" />';

            $this->body = $this->body . '</div>';

            if($this->locations != null) {
                $this->body = $this->body . '<div class="filter-list-object">
                <h1>Locatie</h1>';
                foreach($this->locations as $location) {
                    if(isset($this->params["location"])) {
                        if(in_array($location, $this->params["location"]))
                            $this->body = $this->body. '<input name="location" id="'.$location.'" type="checkbox" value="'.$location.'" checked/>
                        <label for="'.$location.'" class="check-box">'.$location.'</label>';
                        else $this->body = $this->body. '<input name="location" id="'.$location.'" type="checkbox" value="'.$location.'"/>
                        <label for="'.$location.'" class="check-box">'.$location.'</label>';
                    }
                    else $this->body = $this->body. '<input name="location" id="'.$location.'" type="checkbox" value="'.$location.'"/>
                    <label for="'.$location.'" class="check-box">'.$location.'</label>';
                }
                $this->body = $this->body . '</div>';
            }
            if(count($this->studies) > 0) {
                $this->body = $this->body . '<div class="filter-list-object">
                <h1>Scoala / Facultate</h1>';
                $i = 0;
                foreach($this->studies as $study) {
                    if(isset($this->params["studies"]) && $study != "") {
                        if(in_array($study, $this->params["studies"]))
                            $this->body = $this->body . '
                            <input name="studies" id="'. $i .'" type="checkbox" value="'. $study .'" checked/>
                            <label for="' . $i . '" class="check-box">' . $study . '</label>';
                        else
                            $this->body = $this->body . '
                            <input name="studies" id="'. $i .'" type="checkbox" value="'. $study .'" />
                            <label for="' . $i . '" class="check-box">' . $study . '</label>';
                    }
                    else
                        $this->body = $this->body . '
                        <input name="studies" id="'. $i .'" type="checkbox" value="'. $study .'" />
                        <label for="' . $i . '" class="check-box">' . $study . '</label>';
                    $i = $i+1;
                }
                $this->body = $this->body . '</div>';
            }
            $this->body = $this->body . '
            <div class="filter-list-object">
                <h1>Interese</h1>';
                $intsStr = '';
                if(isset($this->params["interests"])) {
                    foreach($this->params["interests"] as $int)
                        $intsStr = $intsStr . $int . ' ';
                }
                $this->body = $this->body . '<input name="interests" type="text" placeholder="ceai filme" value="'.$intsStr.'"/>
            </div>
            <input type="submit" style="display:none" />
        </form>
        <ul class="contacts-list">';
        if($this->contacts != null && $this->groups != null) {
            foreach($this->groups as $group) {
                $showGroup = false;
                foreach($this->contacts as $card) {
                    if($card->groupId == $group -> id) {
                        $showGroup = true;
                        break;
                    }
                }
                if($showGroup == true) {
                    $this->body = $this->body . '
                    <li class="group-start">
                        <p>' . $group -> name . '</p>
                    </li>';
                    foreach($this->contacts as $card) {
                        if($card->groupId == $group -> id) {
                            $contactHTML = '
                            <li class="card">
                                <div class="card-up">
                                    <h1 class="description">'. $card -> description.'</h1>';
                            $contactHTML = $contactHTML . '
                            </div>
                                <div class="card-down">
                                <img src="' . $card -> pictureURL . '" alt="Profile picture" />';
                            $contactHTML = $contactHTML . '
                            <h3>' . $card -> name . '</h3>';
        
                            $contactHTML = $contactHTML . '
                            <h2>'. $card -> phone . '</h2>
                            </div>
                            <div class="card-hover">
                                <h3>'. $card -> name . '</h3>
                                <button data-number="'.$card->phone.'" onclick="copyPhone(event)">Copiaza numarul</button>
                                <a href="/public/contact/id='.$card->id.'">Profil</a>
                                </div>
                            </li>';
                            $this->body = $this->body . $contactHTML;
                        }
                    }
                }
            }
        }   
        else  {
            $this->body = $this->body . '<p>Nici un contact</p>';
        }

        $this->body = $this->body . '
        </ul>
        <script src="/../../public/javascript/home.js"></script>
        </body>
        ';
    }

    public function setContacts($contacts) {
        $this->contacts = $contacts;
    }

    public function setGroups($groups) {
        $this->groups = $groups;
    }

    public function setFilters($locations, $studies) {
        $this->locations = $locations;
        $this->studies = $studies;
    }

    public function setParams($params) {
        $this->params = $params;
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