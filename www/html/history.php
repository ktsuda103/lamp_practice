<?php 
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'history.php';
require_once MODEL_PATH . 'detail_history.php';

session_start();

if(is_logined() === false){
    redirect_to(LOGIN_URL);
}
  
$db = get_db_connect();

$user = get_login_user($db);

if($user['user_id'] === 4){
    $histories = get_all_histories($db);
} else {
    $histories = get_histories($db,$user['user_id']);
}
//dd($histories);

include_once "../view/history_view.php";