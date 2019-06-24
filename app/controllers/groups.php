<?php
require_once '../app/models/groups.php';

class Groups extends Controller {
    protected $model = null;

    public function __construct() {
        $this->model = new GroupsModel;
    }

    public function index($params) {
        $pars = $this->model->parseParams($params);
        if(isset($pars["newgroup"])) {
            $this->model->loadModel($this->model->database->real_escape_string($pars["newgroup"][0]));
        }
        else if(isset($pars["move"])) {
            if(isset($pars["to"])) {
                $this->model->updateContactGroup($this->model->database->real_escape_string($pars["move"][0]),$this->model->database->real_escape_string($pars["to"][0]));
            }
        }
        else $this->model->loadModel();
    }
}
?>