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
<h1>購入履歴画面</h1>
<?php if($histories): ?>
<table border=1 class="w-50">
    <tr>
        <th>注文番号</th>
        <th>購入日時</th>
        <th>合計金額</th>
        <th></th>
    </tr>
    <?php foreach($histories as $history): ?>
    <tr>
        <td><?php echo h($history['id']); ?></td>
        <td><?php echo h($history['created_at']); ?></td>
        <td><?php echo number_format(h($history['SUM(d.price*d.amount)'])); ?></td>
        <td><a href="detail_history.php?history_id=<?php echo h($history['id']); ?>">購入明細表示</a></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php else: ?>
    <p>購入履歴はありません</p>
<?php endif; ?>
</body>
</html>