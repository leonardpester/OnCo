<?php

    require_once '../app/views/navigation.php';
    require_once '../app/views/header.php';

    class ExportModel extends Model {
        protected $nav = null;
        protected $head = null;
        protected $view = null;
        protected $tags = [];
        protected $data = [];
        protected $contactId = null;

        public function loadModel() {
            $this->view = new ExportView;
            $this->loadDefault();
        }



        public function loadDefault(){
            foreach ($this->view->getHeadTags() as $tag) {
                array_push($this->tags, $tag);
            }

            //incarca tagul <head>
            $this->head = new Header($this->tags, "Export");

            $this->view->constructBody();
            //Afiseaza pagina
            $this->view->showBody();

        }
        public function loadParams($params = []) {
            $this->params = $this->parseParams($params);
        }

        public function exportCSV($id = -1){
            $fisier = 'export.csv';
            $fp = fopen($fisier,'w');
            $sql = '';
            if($id != -1)
                $sql = 'SELECT * FROM contacts WHERE contactId=\''.$id.'\';';
            else $sql = 'SELECT * FROM contacts WHERE userId=\''.$_SESSION["userId"].'\';';

            $result = $this->database->query($sql);
            if(!$result){
                die($this->database->error);
            }
            else
            {
                while($row = $result->fetch_assoc()) 
                {
                    
                    $date = array($row["contactId"],$row["name"],$row["phoneNumber1"],$row["phoneNumber2"],$row["email1"],
                                $row["email2"],$row["description"],$row["address"],$row["birthDate"],$row["webAddress1"],$row["webAddress2"],
                                $row["interests"],$row["studies"],$row["pictureAddress"],$row["groupId"],$row["userId"]);
                    fputcsv($fp, $date, ',', '"');
                
                }
               
            }
            fclose($fp);
            $file_url = 'http://localhost:8080/public/export.csv';
            header('Content-Type: application/octet-stream');
            header("Content-Transfer-Encoding: Binary"); 
            header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
            echo readfile($file_url);
        }

        public function exportVCARD($id = -1) {
            $sql = '';
            if($id != -1)
                $sql = 'SELECT * FROM contacts WHERE contactId=\''.$id.'\';';
            else $sql = 'SELECT * FROM contacts WHERE userId=\''.$_SESSION["userId"].'\';';

            $result = $this->database->query($sql);
            if(!$result){
                die($this->database->error);
            }
            else
            {
                include_once("../app/core/VCardIFL-PHP5.php");
                $cards = "";
                $i=0;
                $lname = "";
                while($row = $result->fetch_assoc()) 
                {
                    $lname = $row["name"];
                    $dataArray=array(
                        "fileName"=>"contact", //file name
                        "saveTo"=>"upload",  //upload dir
                        
                        "vcard_birtda"=> '\"' .$row["birthDate"] . '\"',              
                        "vcard_f_name"=>'\"'.explode(" ", $row["name"])[0].'\"',
                        "vcard_s_name"=>'\"'.count(explode(" ", $row["name"]))>1?explode(" ", $row["name"])[1]:"".'\"',                 
                        "vcard_uri"=>'\"'.$row["webAddress1"].'\"',
                        "vcard_note"=>'\"'.$row["description"].'\"',
                        "vcard_cellul"=>'\"'.$row["phoneNumber1"].'\"',
                        
                        "vcard_h_city"=>'\"'.$row["address"].'\"',
                        "vcard_h_mail"=>'\"'.$row["email1"].'\"',
                        );

                        $vcard=new VCardIFL($dataArray);
                        
                        //Create Vcart By Your Setup or array
                        $vcard->createVcard();
                        $cards = $cards . $vcard->getText();
                        $i++;
                }
                $name = "";
                if($i>1) $name = "contacts";
                else $name = $lname;
                header("Content-type: text/directory");
                header("Content-Disposition: attachment; filename=".$name.".vcf"."");
                header("Pragma: public");
                print $cards;
            }
        }

    }

?>