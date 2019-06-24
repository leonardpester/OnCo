<?php
require_once '../app/models/home.php';

class Home extends Controller {
    protected $model = null;

    public function __construct() {
        $this->model = new HomeModel;
    }

    public function index($params) {
        $this->model->loadModel($params);
    }
}
?>