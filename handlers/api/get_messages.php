<?php
// session_start();
include '../../assets/inc/mysql.php';
include '../../assets/inc/DuLeApi.php';

class Get_messages_API extends DuLeApi
{
    private function checks()
    {
        $ret_data = false;
        $req = $_POST;
        if (isset($req['intercultor'])) {
            if ($_SESSION['logined']) {

            }
        }
        return $ret_data;
    }

    public function main()
    {
        // $this->ret_data = $_POST;
        // $this->return();
        $req = $_POST;
        $intercultor = $req['intercultor'];
        $user = $_SESSION['login-data']['username'];
        $mysql = new BulbaSqlConn('../../security/passsql.json');
        $sql = "
            SELECT body, timestamp, requester, reciever 	
            FROM messages
            WHERE (requester = '{$intercultor}' AND reciever = '{$user}')
            OR (requester = '{$user}' AND reciever = '{$intercultor}');
        ;";
        $messages = $mysql->query($sql);

        if ($messages) {
            $this->ret_data = $messages->fetch_all(1);
            $this->ret_data['status'] = true;
        } else {
            $this->ret_data = [
                'status' => false
            ];
        }
        $this->return();
    }
}
;

$api = new Get_messages_API();

$api->main();