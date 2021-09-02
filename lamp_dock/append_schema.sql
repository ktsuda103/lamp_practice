--購入履歴テーブル

CREATE TABLE histories (
    id int(11) AUTO_INCREMENT,
    user_id int(ii) NOT NULL,
    created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    primary key(id)
);

--購入明細テーブル

CREATE TABLE detail_histories (
    id int(11) AUTO_INCREMENT,
    history_id int(11) NOT NULL,
    item_id int(11) NOT NULL,
    amount int(11) NOT NULL,
    primary key(id)
);