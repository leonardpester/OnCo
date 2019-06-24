<?php

class ContactEditView extends View {
    protected $headTags = [];
    protected $body = '';
    protected $values = null;
    protected $numePagina = null;
    protected $contactId = null;

    public function __construct() {

        array_push($this->headTags, '<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">');
        array_push($this->headTags, '<link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">');
        array_push($this->headTags, '<link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">');
        array_push($this->headTags, '<link href="/../../public/styles/reseter.css" rel="stylesheet">');
        array_push($this->headTags, '<link href="/../../public/styles/add_contact.css" rel="stylesheet">');
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
      
            <div class="card">

                <div id="add_contact">

                    <h1>'.$this->numePagina.'</h1>

                    <form action="/public/contactedit/" method="post">
                        <input id="contactid" name="contactid" value="'.$this->contactId.'" hidden/>
                        <label for="nume_prenume">Nume complet</label><br>
                        <input id="nume_prenume" type="text" name="nume" placeholder="Introduceti numele si prenumele" value="' .$this->values->name. '"><br>
                        <label for="adresa">Oras</label><br>
                        <select name="adresa" id="adresa">
                            <option value="'.$this->values->address.'">'.$this->values->address.  '</option>
                            <option value="Abrud">Abrud</option>
                            <option value="Adjud">Adjud</option>
                            <option value="Agnita">Agnita</option>
                            <option value="Aiud">Aiud</option>
                            <option value="Alba Iulia">Alba Iulia</option>
                            <option value="Alesd">Alesd</option>
                            <option value="Alexandria">Alexandria</option>
                            <option value="Amara">Amara</option>
                            <option value="Anina">Anina</option>
                            <option value="Aninoasa">Aninoasa</option>
                            <option value="Arad">Arad</option>
                            <option value="Ardud">Ardud</option>
                            <option value="Avrig">Avrig</option>
                            <option value="Azuga">Azuga</option>
                            <option value="Babadag">Babadag</option>
                            <option value="Babeni">Babeni</option>
                            <option value="Bacau">Bacau</option>
                            <option value="Baia de Arama">Baia de Arama</option>
                            <option value="Baia de Aries">Baia de Aries</option>
                            <option value="Baia Mare">Baia Mare</option>
                            <option value="Baia Sprie">Baia Sprie</option>
                            <option value="Baicoi">Baicoi</option>
                            <option value="Baile Govora">Baile Govora</option>
                            <option value="Baile Herculane">Baile Herculane</option>
                            <option value="Baile Olanesti">Baile Olanesti</option>
                            <option value="Baile Tusnad">Baile Tusnad</option>
                            <option value="Bailesti">Bailesti</option>
                            <option value="Balan">Balan</option>
                            <option value="Balcesti">Balcesti</option>
                            <option value="Bals">Bals</option>
                            <option value="Baraolt">Baraolt</option>
                            <option value="Barlad">Barlad</option>
                            <option value="Bechet">Bechet</option>
                            <option value="Beclean">Beclean</option>
                            <option value="Beius">Beius</option>
                            <option value="Berbesti">Berbesti</option>
                            <option value="Beresti">Beresti</option>
                            <option value="Bicaz">Bicaz</option>
                            <option value="Bistrita">Bistrita</option>
                            <option value="Blaj">Blaj</option>
                            <option value="Bocsa">Bocsa</option>
                            <option value="Boldesti-Scaeni">Boldesti-Scaeni</option>
                            <option value="Bolintin-Vale">Bolintin-Vale</option>
                            <option value="Borsa">Borsa</option>
                            <option value="Borsec">Borsec</option>
                            <option value="Botosani">Botosani</option>
                            <option value="Brad">Brad</option>
                            <option value="Bragadiru">Bragadiru</option>
                            <option value="Braila">Braila</option>
                            <option value="Brasov">Brasov</option>
                            <option value="Breaza">Breaza</option>
                            <option value="Brezoi">Brezoi</option>
                            <option value="Brosteni">Brosteni</option>
                            <option value="Bucecea">Bucecea</option>
                            <option value="Bucuresti">Bucuresti</option>
                            <option value="Budesti">Budesti</option>
                            <option value="Buftea">Buftea</option>
                            <option value="Buhusi">Buhusi</option>
                            <option value="Bumbesti-Jiu">Bumbesti-Jiu</option>
                            <option value="Busteni">Busteni</option>
                            <option value="Buzau">Buzau</option>
                            <option value="Buzias">Buzias</option>
                            <option value="Cajvana">Cajvana</option>
                            <option value="Calafat">Calafat</option>
                            <option value="Calan">Calan</option>
                            <option value="Calarasi">Calarasi</option>
                            <option value="Calimanesti">Calimanesti</option>
                            <option value="Campeni">Campeni</option>
                            <option value="Campia Turzii">Campia Turzii</option>
                            <option value="Campina">Campina</option>
                            <option value="Campulung Moldovenesc">Campulung Moldovenesc</option>
                            <option value="Campulung">Campulung</option>
                            <option value="Caracal">Caracal</option>
                            <option value="Caransebes">Caransebes</option>
                            <option value="Carei">Carei</option>
                            <option value="Cavnic">Cavnic</option>
                            <option value="Cazanesti">Cazanesti</option>
                            <option value="Cehu Silvaniei">Cehu Silvaniei</option>
                            <option value="Cernavoda">Cernavoda</option>
                            <option value="Chisineu-Cris">Chisineu-Cris</option>
                            <option value="Chitila">Chitila</option>
                            <option value="Ciacova">Ciacova</option>
                            <option value="Cisnadie">Cisnadie</option>
                            <option value="Cluj-Napoca">Cluj-Napoca</option>
                            <option value="Codlea">Codlea</option>
                            <option value="Comanesti">Comanesti</option>
                            <option value="Comarnic">Comarnic</option>
                            <option value="Constanta">Constanta</option>
                            <option value="Copsa Mica">Copsa Mica</option>
                            <option value="Corabia">Corabia</option>
                            <option value="Costesti">Costesti</option>
                            <option value="Covasna">Covasna</option>
                            <option value="Craiova">Craiova</option>
                            <option value="Cristuru Secuiesc">Cristuru Secuiesc</option>
                            <option value="Cugir">Cugir</option>
                            <option value="Curtea de Arges">Curtea de Arges</option>
                            <option value="Curtici">Curtici</option>
                            <option value="Dabuleni">Dabuleni</option>
                            <option value="Darabani">Darabani</option>
                            <option value="Darmanesti">Darmanesti</option>
                            <option value="Dej">Dej</option>
                            <option value="Deta">Deta</option>
                            <option value="Deva">Deva</option>
                            <option value="Dolhasca">Dolhasca</option>
                            <option value="Dorohoi">Dorohoi</option>
                            <option value="Draganesti-Olt">Draganesti-Olt</option>
                            <option value="Dragasani">Dragasani</option>
                            <option value="Dragomiresti">Dragomiresti</option>
                            <option value="Drobeta-Turnu Severin">Drobeta-Turnu Severin</option>
                            <option value="Dumbraveni">Dumbraveni</option>
                            <option value="Eforie">Eforie</option>
                            <option value="Fagaras">Fagaras</option>
                            <option value="Faget">Faget</option>
                            <option value="Falticeni">Falticeni</option>
                            <option value="Faurei">Faurei</option>
                            <option value="Fetesti">Fetesti</option>
                            <option value="Fieni">Fieni</option>
                            <option value="Fierbinti-Targ">Fierbinti-Targ</option>
                            <option value="Filiasi">Filiasi</option>
                            <option value="Flamanzi">Flamanzi</option>
                            <option value="Focsani">Focsani</option>
                            <option value="Frasin">Frasin</option>
                            <option value="Fundulea">Fundulea</option>
                            <option value="Gaesti">Gaesti</option>
                            <option value="Galati">Galati</option>
                            <option value="Gataia">Gataia</option>
                            <option value="Geoagiu">Geoagiu</option>
                            <option value="Gheorgheni">Gheorgheni</option>
                            <option value="Gherla">Gherla</option>
                            <option value="Ghimbav">Ghimbav</option>
                            <option value="Giurgiu">Giurgiu</option>
                            <option value="Gura Humorului">Gura Humorului</option>
                            <option value="Harlau">Harlau</option>
                            <option value="Harsova">Harsova</option>
                            <option value="Hateg">Hateg</option>
                            <option value="Horezu">Horezu</option>
                            <option value="Huedin">Huedin</option>
                            <option value="Hunedoara">Hunedoara</option>
                            <option value="Husi">Husi</option>
                            <option value="Ianca">Ianca</option>
                            <option value="Iasi">Iasi</option>
                            <option value="Iernut">Iernut</option>
                            <option value="Ineu">Ineu</option>
                            <option value="Insuratei">Insuratei</option>
                            <option value="Intorsura Buzaului">Intorsura Buzaului</option>
                            <option value="Isaccea">Isaccea</option>
                            <option value="Jibou">Jibou</option>
                            <option value="Jimbolia">Jimbolia</option>
                            <option value="Lehliu Gara">Lehliu Gara</option>
                            <option value="Lipova">Lipova</option>
                            <option value="Liteni">Liteni</option>
                            <option value="Livada">Livada</option>
                            <option value="Ludus">Ludus</option>
                            <option value="Lugoj">Lugoj</option>
                            <option value="Lupeni">Lupeni</option>
                            <option value="Macin">Macin</option>
                            <option value="Magurele">Magurele</option>
                            <option value="Mangalia">Mangalia</option>
                            <option value="Marasesti">Marasesti</option>
                            <option value="Marghita">Marghita</option>
                            <option value="Medgidia">Medgidia</option>
                            <option value="Medias">Medias</option>
                            <option value="Miercurea Ciuc">Miercurea Ciuc</option>
                            <option value="Miercurea Nirajului">Miercurea Nirajului</option>
                            <option value="Miercurea Sibiului">Miercurea Sibiului</option>
                            <option value="Mihailesti">Mihailesti</option>
                            <option value="Milisauti">Milisauti</option>
                            <option value="Mioveni">Mioveni</option>
                            <option value="Mizil">Mizil</option>
                            <option value="Moinesti">Moinesti</option>
                            <option value="Moldova Noua">Moldova Noua</option>
                            <option value="Moreni">Moreni</option>
                            <option value="Motru">Motru</option>
                            <option value="Murfatlar">Murfatlar</option>
                            <option value="Murgeni">Murgeni</option>
                            <option value="Nadlac">Nadlac</option>
                            <option value="Nasaud">Nasaud</option>
                            <option value="Navodari">Navodari</option>
                            <option value="Negresti">Negresti</option>
                            <option value="Negresti-Oas">Negresti-Oas</option>
                            <option value="Negru Voda">Negru Voda</option>
                            <option value="Nehoiu">Nehoiu</option>
                            <option value="Novaci">Novaci</option>
                            <option value="Nucet">Nucet</option>
                            <option value="Ocna Mures">Ocna Mures</option>
                            <option value="Ocna Sibiului">Ocna Sibiului</option>
                            <option value="Ocnele Mari">Ocnele Mari</option>
                            <option value="Odobesti">Odobesti</option>
                            <option value="Odorheiu Secuiesc">Odorheiu Secuiesc</option>
                            <option value="Oltenita">Oltenita</option>
                            <option value="Onesti">Onesti</option>
                            <option value="Oradea">Oradea</option>
                            <option value="Orastie">Orastie</option>
                            <option value="Oravita">Oravita</option>
                            <option value="Orsova">Orsova</option>
                            <option value="Otelu Rosu">Otelu Rosu</option>
                            <option value="Otopeni">Otopeni</option>
                            <option value="Ovidiu">Ovidiu</option>
                            <option value="Panciu">Panciu</option>
                            <option value="Pancota">Pancota</option>
                            <option value="Pantelimon">Pantelimon</option>
                            <option value="Pascani">Pascani</option>
                            <option value="Patarlagele">Patarlagele</option>
                            <option value="Pecica">Pecica</option>
                            <option value="Petrila">Petrila</option>
                            <option value="Petrosani">Petrosani</option>
                            <option value="Piatra Neamt">Piatra Neamt</option>
                            <option value="Piatra-Olt">Piatra-Olt</option>
                            <option value="Pitesti">Pitesti</option>
                            <option value="Ploiesti">Ploiesti</option>
                            <option value="Plopeni">Plopeni</option>
                            <option value="Podu Iloaiei">Podu Iloaiei</option>
                            <option value="Pogoanele">Pogoanele</option>
                            <option value="Popesti-Leordeni">Popesti-Leordeni</option>
                            <option value="Potcoava">Potcoava</option>
                            <option value="Predeal">Predeal</option>
                            <option value="Pucioasa">Pucioasa</option>
                            <option value="Racari">Racari</option>
                            <option value="Radauti">Radauti</option>
                            <option value="Ramnicu Sarat">Ramnicu Sarat</option>
                            <option value="Ramnicu Valcea">Ramnicu Valcea</option>
                            <option value="Rasnov">Rasnov</option>
                            <option value="Recas">Recas</option>
                            <option value="Reghin">Reghin</option>
                            <option value="Resita">Resita</option>
                            <option value="Roman">Roman</option>
                            <option value="Rosiorii de Vede">Rosiorii de Vede</option>
                            <option value="Rovinari">Rovinari</option>
                            <option value="Roznov">Roznov</option>
                            <option value="Rupea">Rupea</option>
                            <option value="Sacele">Sacele</option>
                            <option value="Sacueni">Sacueni</option>
                            <option value="Salcea">Salcea</option>
                            <option value="Saliste">Saliste</option>
                            <option value="Salistea de Sus">Salistea de Sus</option>
                            <option value="Salonta">Salonta</option>
                            <option value="Sangeorgiu de Padure">Sangeorgiu de Padure</option>
                            <option value="Sangeorz-Bai">Sangeorz-Bai</option>
                            <option value="Sannicolau Mare">Sannicolau Mare</option>
                            <option value="Santana">Santana</option>
                            <option value="Sarmasu">Sarmasu</option>
                            <option value="Satu Mare">Satu Mare</option>
                            <option value="Saveni">Saveni</option>
                            <option value="Scornicesti">Scornicesti</option>
                            <option value="Sebes">Sebes</option>
                            <option value="Sebis">Sebis</option>
                            <option value="Segarcea">Segarcea</option>
                            <option value="Seini">Seini</option>
                            <option value="Sfantu Gheorghe">Sfantu Gheorghe</option>
                            <option value="Sibiu">Sibiu</option>
                            <option value="Sighetu Marmatiei">Sighetu Marmatiei</option>
                            <option value="Sighisoara">Sighisoara</option>
                            <option value="Simeria">Simeria</option>
                            <option value="Simleu Silvaniei">Simleu Silvaniei</option>
                            <option value="Sinaia">Sinaia</option>
                            <option value="Siret">Siret</option>
                            <option value="Slanic">Slanic</option>
                            <option value="Slanic-Moldova">Slanic-Moldova</option>
                            <option value="Slatina">Slatina</option>
                            <option value="Slobozia">Slobozia</option>
                            <option value="Solca">Solca</option>
                            <option value="Somcuta Mare">Somcuta Mare</option>
                            <option value="Sovata">Sovata</option>
                            <option value="Stefanesti, Arges">Stefanesti, Arges</option>
                            <option value="Stefanesti, Botosani">Stefanesti, Botosani</option>
                            <option value="Stei">Stei</option>
                            <option value="Strehaia">Strehaia</option>
                            <option value="Suceava">Suceava</option>
                            <option value="Sulina">Sulina</option>
                            <option value="Talmaciu">Talmaciu</option>
                            <option value="Tandarei">Tandarei</option>
                            <option value="Targoviste">Targoviste</option>
                            <option value="Targu Bujor">Targu Bujor</option>
                            <option value="Targu Carbunesti">Targu Carbunesti</option>
                            <option value="Targu Frumos">Targu Frumos</option>
                            <option value="Targu Jiu">Targu Jiu</option>
                            <option value="Targu Lapus">Targu Lapus</option>
                            <option value="Targu Mures">Targu Mures</option>
                            <option value="Targu Neamt">Targu Neamt</option>
                            <option value="Targu Ocna">Targu Ocna</option>
                            <option value="Targu Secuiesc">Targu Secuiesc</option>
                            <option value="Tarnaveni">Tarnaveni</option>
                            <option value="Tasnad">Tasnad</option>
                            <option value="Tautii-Magheraus">Tautii-Magheraus</option>
                            <option value="Techirghiol">Techirghiol</option>
                            <option value="Tecuci">Tecuci</option>
                            <option value="Teius">Teius</option>
                            <option value="Ticleni">Ticleni</option>
                            <option value="Timisoara">Timisoara</option>
                            <option value="Tismana">Tismana</option>
                            <option value="Titu">Titu</option>
                            <option value="Toplita">Toplita</option>
                            <option value="Topoloveni">Topoloveni</option>
                            <option value="Tulcea">Tulcea</option>
                            <option value="Turceni">Turceni</option>
                            <option value="Turda">Turda</option>
                            <option value="Turnu Magurele">Turnu Magurele</option>
                            <option value="Ulmeni">Ulmeni</option>
                            <option value="Ungheni">Ungheni</option>
                            <option value="Uricani">Uricani</option>
                            <option value="Urlati">Urlati</option>
                            <option value="Urziceni">Urziceni</option>
                            <option value="Valea lui Mihai">Valea lui Mihai</option>
                            <option value="Valenii de Munte">Valenii de Munte</option>
                            <option value="Vanju Mare">Vanju Mare</option>
                            <option value="Vascau">Vascau</option>
                            <option value="Vaslui">Vaslui</option>
                            <option value="Vatra Dornei">Vatra Dornei</option>
                            <option value="Vicovu de Sus">Vicovu de Sus</option>
                            <option value="Victoria">Victoria</option>
                            <option value="Videle">Videle</option>
                            <option value="Viseu de Sus">Viseu de Sus</option>
                            <option value="Vlahita">Vlahita</option>
                            <option value="Voluntari">Voluntari</option>
                            <option value="Vulcan">Vulcan</option>
                            <option value="Zalau">Zalau</option>
                            <option value="Zarnesti">Zarnesti</option>
                            <option value="Zimnicea">Zimnicea</option>
                            <option value="Zlatna">Zlatna</option>
                            
                           
                        </select>
                        <br>
                        <label for="data_nastere">Data nastere</label><br>
                        <input id="data_nastere" type="date" name="data_nastere" value="' .$this->values->birthDate. '"><br>
                        <label for="email1">E-mail</label><br>
                        <input id="email1" type="email" name="email1" placeholder="Introduceti un E-mail" value="' .$this->values->email. '"><br>
                        <input id="email2" type="email" name="email2" placeholder="* Introduceti un alt E-mail" value="' .$this->values->email2. '"><br>
                        <label for="nr_telefon1">Numar de telefon</label><br>
                        <input id="nr_telefon1" type="text" name="nr_telefon1" placeholder="0712345678" value="' .$this->values->phone1. '"><br>
                        <input id="nr_telefon2" type="text" name="nr_telefon2" placeholder="* 0712345678" value="' .$this->values->phone2. '"><br>
                        <label for="adresa_web1">Adresa web</label><br>
                        <input id="adresa_web1" type="text" name="adresa_web1" placeholder="https://web-adress.com" value="' .$this->values->webAddress. '"><br>
                        <input id="adresa_web2" type="text" name="adresa_web2" placeholder="* https://web-adress.com" value="' .$this->values->webAddress2. '"><br>
                        <label for="descriere">Descriere</label><br>
                        <textarea id="descriere" cols="54" rows="5" placeholder="Introduceti o descriere" name="descriere">' .$this->values->description. '</textarea><br>
                        <label for="interese">Interese</label><br>
                        <input id="interese" type="text" name="interese" placeholder="Introduceti interese" value="' .$this->values->interests. '"><br>
                        <label for="imagine">Poza de profil</label><br>
                        <input id="imagine" type="text" name="imagine" placeholder="Introduceti adresa linkului unei imagini de profil"  value="' .$this->values->pictureURL. '"><br>
                        <br>
                        <label for="studies">Studii</label><br>
                        <input id="studies" type="text" name="studii" placeholder=" Facultatea de .." value="' .$this->values->studies. '"><br>
                        <br>
                        <p>(*) - Optional</p>




                        <br><br>
                        <input type="submit" name="'.explode(' ',$this->numePagina)[0].'" value="Salveaza"><br>

                    </form>
                </div>
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

    public function setNumePagina($mode){
        if($mode == "edit")
            $this->numePagina="Editeaza un contact";
        else
            $this->numePagina="Adauga un contact";

    }

    public function setContactId($id){
        $this->contactId=$id;
        //print_r($this->contactId);
    }
    
}

?>