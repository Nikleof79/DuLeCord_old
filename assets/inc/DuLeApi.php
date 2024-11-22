<?php 

class DuLeApi {
    public $ret_data;
    private $user_data;
    private $intercultor_data;
    
    function __construct(...$args){
        session_start();
        $checks = $this->checks();
        if($checks){
            try{
                $this->main(...$args);
            }catch(\Exception $e){
                $this->main();
            }
        }
    }

    private function checks(){
        $ret_data = false;
        if ($_SESSION['logined']) {
            $ret_data = true;
        }
        return $ret_data;
    }

    public function main(){

    }

    public function return(){
        echo json_encode($this->ret_data);
        header('Content-type: application/json');
        exit;
    }
}