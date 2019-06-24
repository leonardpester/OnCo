<?php

class FeedAtom {
    public function index($params = []) {
        if(count($params) > 0)
            header("Location: /public/feedatom");
        header("content-type: application/atom+xml");
        echo Application::$atomFeed->render();
    } 
}

?>