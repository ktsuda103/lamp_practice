<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';
require_once MODEL_PATH . 'history.php';
require_once MODEL_PATH . 'detail_history.php';

session_start();

$token = get_post('csrf_token');

if(is_valid_csrf_token($token) === false){
  exit('不正なリクエストです');
}

unset($_SESSION['csrf_token']);

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);

$carts = get_user_carts($db, $user['user_id']);

$db->beginTransaction();
try{
  if(purchase_carts($db, $carts) === false){
    set_error('商品が購入できませんでした。');
    redirect_to(CART_URL);
  } 
  insert_history($db,$user['user_id']);
  $history_id = $db->lastInsertId('histories');
  foreach($carts as $cart){
    $item = get_item($db,$cart['item_id']);
    insert_detail_history($db,$history_id,$cart['item_id'],$cart['amount'],$item['price']*$cart['amount']);
  }
  $db->commit();
} catch(PDOException $e) {
  $db->rollback();
  throw $e;
}


$total_price = sum_carts($carts);

include_once '../view/finish_view.php';