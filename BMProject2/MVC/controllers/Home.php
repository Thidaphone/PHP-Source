<?php

class Home extends Controllers {
    function displayIntroduction(){
        echo "hello";
    }
    function displayUser(){
        echo "welcome Le Hai Binh";
    }
    function displayIndex(){
        //data chuyen vao master.php get tu page vao home
        $this->view("master",["Page" => "home"]);
    }
}
?>