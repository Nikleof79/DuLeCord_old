<?php
include '/library/bulbaPHP.php';

$app = new BulbaApp();

function oneOf($array,$target){
    $ret_data = false;
    foreach ($array as $kay => $value) {
        if ($value == $target) {
            $ret_data = true;
            break;
        }
    }
    return $ret_data;
}

$app->use(['/'],'',function($req,$res){
    $req->redirect('/index.php');
});

$app->use([],'*',function($req,$res){
    $pages = ['account','friends','index','start'];
    $url_splited = explode('/', $req->url);
    if ($url_splited[0] == '/assets') {
        $res->sendFile($req->url);
    }else if($url_splited[0] == '/handlers'){
        $res->sendFile($req->url);
    }else if(oneOf($pages , $req->url)){
        $res->sendFile($req->url + '.php');
    }else if(oneOf($pages , $req->url + '.php')){
        $res->sendFile($req->url);
    }
});