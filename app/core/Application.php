<?php
session_start();
require_once "AtomFeed.php";

class Application {
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];

    public static $atomFeed = null; 

    public function __construct() {

        if(self::$atomFeed == null) {
            self::$atomFeed = new AtomFeed;
            self::$atomFeed->title = "Feed ATOM";
            self::$atomFeed->addcategories(["Adaugari contacte", "Modificari contacte"]);
            self::$atomFeed->addauthor("Server");
        }

        $tokenValid = false;

        if(isset($_COOKIE["authentication"]))
        {
            $cookie = $_COOKIE["authentication"];
            $value = explode(".",$cookie);
            if(isset($value[0]) && isset($value[1]) && isset($value[2])){
                $header = $value[0];
                $payload = $value[1];
                $signature = $value[2];

                $concat = $header. '.' .$payload;

                $newSig = hash_hmac('sha256', $concat, "oParolaFoarteGrea");
                if($signature != $newSig) {
                    setcookie("authentication", null, -1, "/");
                    unset($_SESSION["userId"]);
                    unset($_SESSION["contactId"]);
                    header("Location: /public/authentication");
                }
                else {
                    require_once '../app/models/authentication.php';
                    $payload = AuthenticationModel::base64url_decode($payload);
                    $vals = json_decode($payload);
                    $_SESSION["userId"]=$vals->id;
                    $_SESSION["contactId"]=$vals->cid;
                    
                    $tokenTime = new DateTime($vals->exp);
                    $currentTime = new DateTime();
                    if($currentTime > $tokenTime) {
                        setcookie("authentication", null, -1, "/");
                        unset($_SESSION["userId"]);
                        unset($_SESSION["contactId"]);
                        header("Location: /public/authentication");
                    }
                    else $tokenValid = true;
                }
            }
            else {
                setcookie("authentication", null, -1, "/");
                header("Location: /public/authentication");
            }
        }

        if($tokenValid == true) {
            if(strpos($_SERVER['REQUEST_URI'], "&") !== false) {
                $url = $this->parseUrl();

                if(file_exists('../app/controllers/'. $url[0] . '.php')) {
                    unset($url[0]);
                }

                if(isset($url[1])) {
                    if(method_exists($this->controller, $url[1])) {
                        unset($url[1]);
                    }
                }
                if($url[0][0] == "?")
                    $url[0] = substr($url[0], 1);
                header("Location: " . implode("/",$url));
            }
            else {
                $included = false;
                $url = $this->parseUrl();
                if(count($url) > 0) {
                    if(file_exists('../app/controllers/'. $url[0] . '.php')) {
                        $this->controller = $url[0];
                        unset($url[0]);
                        if(count($url) > 0) {
                            if(isset($url[1])) {
                                require_once '../app/controllers/' . $this->controller . '.php';
                                $this->controller = new $this->controller;
                                $included = true;
                                if(method_exists($this->controller, $url[1])) {
                                    $this->method = $url[1];
                                    unset($url[1]);
                                }
                            }
                        }
                    }
                }
                if($included == false) {
                    require_once '../app/controllers/' . $this->controller . '.php';
                    $this->controller = new $this->controller;
                }
                
                $this->params = $url ? array_values($url) : [];
                if(get_class($this->controller) != "Authentication" || (get_class($this->controller) == "Authentication" && $this->method == "logout"))
                    call_user_func_array([$this->controller, $this->method], array($this->params));
                else {
                    header("Location: /public");
                }
            }
        }
        else {
            require_once '../app/controllers/authentication.php';
            $controller = new Authentication;
            $uri = $_SERVER['REQUEST_URI'];
            $explval = explode("?",$uri);
            if(count($explval)>1) {
                $uri = $explval[1];
                $uri = explode("/",$uri)[0];
                call_user_func_array([$controller, "index"], array($uri));
            }
            else call_user_func_array([$controller, "index"], []);
        }
    }

    public function parseUrl() {
        $url = explode("/", $_SERVER['REQUEST_URI']);
        if($url[0] == "")
            unset($url[0]);
        if(isset($url[1]) && $url[1] == "public")
            unset($url[1]);
        $urls = "";
        foreach($url as $slash) {
            foreach(explode("&", $slash) as $item) {
                if(substr($item,-1) != "=")
                    $urls = $urls . "/" . $item;
            }
        }
        $url = explode('/', rtrim($urls, '/'));
        for($i=0;$i<count($url); $i++) {
            if($url[$i] == "")
                unset($url[$i]);
        }
        return array_values($url);
    }
}

?>