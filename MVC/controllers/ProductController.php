<?php
class ProductController extends Controller
{
    public $productModel;
    public function __construct()
    {
        $this->productModel = $this->model('productModel');
    }

    function displayIntrouction()
    {
        $this->view("master",["Page" => "home"]);
    }
}
?>