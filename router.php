<?php
class Router{
    private $static_folder;
    private $handler_folder;
    function __construct() {
        $this->static_folder = './assets';
        $this->handler_folder = './handlers';
    }
    
}