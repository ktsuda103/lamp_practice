<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  
  <title>商品一覧</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'index.css'); ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  

  <div class="container">
    <h1>商品一覧</h1>
    <p><?php echo $count_items['cnt']; ?>件中<?php echo (($page-1)*8)+1; ?>-
      <?php
      if($page*8 <= $count_items['cnt']){
        echo ($page)*8;
      }else{
        echo $count_items['cnt'];
      } ?>
    件目の商品</p>
    <form class="text-right">
      <select name="sort" id="">
        <option value="0" selected>新着順</option>
        <option value="1">価格の安い順</option>
        <option value="2">価格の高い順</option>
        <input type="submit" value="並べ替え">
      </select>
    </form>
    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <div class="card-deck">
      <div class="row">
      <?php foreach($items as $item){ ?>
        <div class="col-6 item">
          <div class="card h-100 text-center">
            <div class="card-header">
              <?php print($item['name']); ?>
            </div>
            <figure class="card-body">
              <img class="card-img" src="<?php print(IMAGE_PATH . h($item['image'])); ?>">
              <figcaption>
                <?php print(number_format(h($item['price']))); ?>円
                <?php if(h($item['stock']) > 0){ ?>
                  <form action="index_add_cart.php" method="post">
                    <input type="hidden" name="csrf_token" value="<?php print(h($token)); ?>">
                    <input type="submit" value="カートに追加" class="btn btn-primary btn-block">
                    <input type="hidden" name="item_id" value="<?php print(h($item['item_id'])); ?>">
                  </form>
                <?php } else { ?>
                  <p class="text-danger">現在売り切れです。</p>
                <?php } ?>
              </figcaption>
            </figure>
          </div>
        </div>
      <?php } ?>
      <a href="history.php">購入履歴画面へ</a>
      </div>
    </div>
    <div class="text-center">
      <?php if($page > 1): ?>
        <a href="index.php?sort=<?php echo $num; ?>&page=<?php echo $page-1; ?>">前のページへ</a>
      <?php else: ?>
        <p class="d-inline">前のページへ</p>
      <?php endif; ?>
      <?php for($i = 1; $i <= $count; $i++): ?>
        <a style="<?php if($page==$i){echo 'color:#cc66ff;';} ?>" href="index.php?sort=<?php echo $num; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
      <?php endfor; ?>
      <?php if($page+1 <= $count): ?>
        <a href="index.php?sort=<?php echo $num; ?>&page=<?php echo $page+1; ?>">次のページへ</a>
      <?php else: ?>
        <p class="d-inline">次のページへ</p>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>