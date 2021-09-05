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

$history_id = get_get('history_id');

$history = get_history($db,$history_id);

if($user['user_id'] === 4){
    $detail_histories = get_detail_histories($db,$history_id);
} else {
    $detail_histories = get_detail_histories($db,$history_id);
}
//dd($history);

include_once "../view/detail_history_view.php";