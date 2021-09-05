<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';

header("X-FRAME-OPTIONS: DENY");

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$token = get_csrf_token();

$db = get_db_connect();
$user = get_login_user($db);

$num = get_get('sort');
if(!preg_match('/^[0-2]$/',$num)){
  $num = 0;
} 
$count_items = count_items($db,true);
$count = count_pages($count_items);
$page = get_get('page');

if($page === ''){
  $page = 1;
}

if($page > $count){
  $page = $count;
} elseif($page < 1){
  $page = 1;
}

$page_num = get_page($page);

$items = get_open_items($db,$num,$page_num);

$ranking = get_ranking($db);
//dd($ranking[0]);

include_once VIEW_PATH . 'index_view.php';