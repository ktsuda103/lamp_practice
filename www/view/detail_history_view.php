<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <?php include VIEW_PATH . 'templates/head.php'; ?>
    <title>購入履歴</title>
</head>
<body>
<?php 
include VIEW_PATH . 'templates/header_logined.php'; 
?>
<?php if($user['user_id'] === $history[0]['user_id'] || $user['user_id'] === 4): ?>
<h1>購入履歴画面</h1>
<table border=1 class="w-50">
    <tr>
        <th>注文番号</th>
        <th>購入日時</th>
        <th>合計金額</th>
    </tr>
    <tr>
        <td><?php echo h($history[0]['id']); ?></td>
        <td><?php echo h($history[0]['created_at']); ?></td>
        <td><?php echo number_format(h($history[0]['sum'])); ?></td>
    </tr>
</table>
<hr>

<h2>購入明細</h2>

<table border=1 class="w-50">
    <tr>
        <th>商品名</th>
        <th>価格</th>
        <th>数量</th>
        <th>小計</th>
    </tr>
    <?php foreach($detail_histories as $detail_history): ?>
    <tr>
        <td><?php echo h($detail_history['name']); ?></td>
        <td><?php echo number_format(h($detail_history['price'])); ?></td>
        <td><?php echo h($detail_history['amount']); ?></td>
        <td><?php echo number_format(h($detail_history['price']*$detail_history['amount'])); ?></td>
    </tr>
    <?php endforeach; ?>    
</table>
<?php else: ?>
<p>この履歴は閲覧出来ません。</p>
<?php endif; ?>
<a href="history.php">購入履歴画面へ</a>
</body>
</html>