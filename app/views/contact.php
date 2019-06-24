<?php

class ContactView extends View {
    protected $headTags = [];
    protected $body = '';
    protected $values = null;
    protected $numePagina = null;
    protected $contact = null;

    public function __construct() {

        array_push($this->headTags, '<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">');
        array_push($this->headTags, '<link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">');
        array_push($this->headTags, '<link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">');
        array_push($this->headTags, '<link href="/../../public/styles/reseter.css" rel="stylesheet">');
        array_push($this->headTags, '<link href="/../../public/styles/profile.css" rel="stylesheet">');
    }



    

    public function constructBody() {


        if($this->values == null) {

            $this->values = (object) [
                'name' => '',
                'description' => '',
                'phone' => '',
                'pictureURL' => '',
                'phone1' =>'',
                'phone2' => '',
                'email' => '',
                'email2' => '',
                'address' => '',
                'birthDate' => '',
                'webAddress' => '',
                'webAddress2' => '',
                'interests' => '',
                'studies' => ''
            ];
            // $this->values->name="";            
            // $this->values->description="";
            // $this->values->phone ="";
            // $this->values->pictureURL="";
            // $this->values->phone1="";
            // $this->values->phone2="";
            // $this->values->email = "";
            // $this->values->email2 = "";
            // $this->values->address = "";
            // $this->values->birthDate = "";
            // $this->values->webAddress = "";
            // $this->values->webAddress2 = "";
            // $this->values->interests = "";
            // $this->values->studies = "";
        }

        $this->body = '
        <div class="top">
        <div>
            <img id="image" src="' .$this->values->pictureURL. '" alt="profile">
        </div>
        <div>
            <h1>' .$this->values->name. '</h1>

        </div>
    </div>
    <div class="bottom" id="details">
        <div>
            <h2>Contact</h2>
            <p>📬 Adresa: ' .$this->values->address. '</p>
            <p>🧚‍♂️ Data nastere: ' .$this->values->birthDate. '</p>
            <p>👨‍🎓 Studii:' .$this->values->studies. '</p>
            <p>💌 Email:' .$this->values->email. '</p>';

            if($this->values->email2!="")
                $this->body = $this->body.'<p>💌 Email 2:' .$this->values->email2. '</p>';
            $this->body = $this->body.'


            <p>☎ Numar de telefon: ' .$this->values->phone1. '</p>';
            if($this->values->phone2!="")
                $this->body = $this->body.'<p>☎ Numar de telefon 2:' .$this->values->phone2. '</p>';
            $this->body = $this->body.'
            
            

            <p>💻 Adrese web: ' .$this->values->webAddress. '</p>';
            if($this->values->webAddress2!="")
                $this->body = $this->body.'<p>💻 Adrese web 2:' .$this->values->webAddress2. '</p>';
            $this->body = $this->body.'
        </div>
        <div class="card">
            <h2>Despre mine</h2>
            <p>📑 Descriere:  ' .$this->values->description. ' </p>
            <p>🏋️‍♂ Interese:' .$this->values->interests. '
            </p>
        </div>
    </div>
    <div id="bottom-butoane">
        <form action="/public/contact" method="post">
        <input id="id" name="id" value="'.$this->contact.'" hidden/>
            <div class="export">
                <button name="exp" type="submit" value="csv">Export CSV</button>
            </div>
            <div class="export">
                <button name="exp" type="submit" value="vcard">Export vCard</button>
            </div>
        </form>
        <form action="/public/contact" method="post">
            <div class="export">
                <input name="id" id="id" value="'.$this->contact.'" hidden />
                <button name="edit" type="submit" value="Editeaza">Editeaza</button>
            </div>
        <form>
    </div>
</body>';
    }

    public function showBody() {
        echo $this->body;
    }
    
    public function getHeadTags() {
        return $this->headTags;
    }

    public function setValues($val) {
        $this->values=$val;
    }

    public function setContactId($id) {
        $this->contact = $id;
    }
    
}

?>