<?php
class Application {
    protected $controller = "Home";
    protected $action = "displayIntroduction";
    protected $params = [];

    function urIProcess() {
        //kiểm tra xem có đường dẫn không, chạy thật thì bỏ
        if(isset($_SERVER["REQUEST_URI"])){
            echo $_SERVER["REQUEST_URI"],"<br>";
            //xóa khoảng trắng và trả về 1 mảng dữ liệu phân cách = /
            
            return explode("/",filter_var(trim($_SERVER["REQUEST_URI"],"/")));
        }
        
    }
     //phương thức khởi tạo
    function __construct(){
        $arr = $this->urIProcess();
        $n = count($arr);
        if(file_exists("./MVC/controllers/" . $arr[$n-2] . ".php"))
        {
            $this->controller = $arr[$n-2];
            unset($arr[$n-2]);
        }

    require_once"./MVC/controllers/".$this->controller.".php";
    $this->controller = new $this->controller;
    //xử lí action
    if(isset($arr[$n-1]))
    {
        if(method_exists($this->controller,$arr[$n-1])){
            $this->action = $arr[$n-1];
        }
        unset($arr[$n-1]);
    }
    //xử lí params
    $this->params = $arr ? array_values($arr) : [];
    call_user_func_array([new $this->controller, $this->action],$this->params);
    }
    
    
}
?>