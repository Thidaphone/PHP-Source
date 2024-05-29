<?php
class Home extends Controller
{
    function displayIntroduction()
    {
        echo "Hello";
    }

    function displayUser()
    {
        echo "Welcome Tran Sy Luong";
    }

    function displayIndex()
    {
        $this->view("master",[  "Page" => "home" ]); 
    }
}

?>