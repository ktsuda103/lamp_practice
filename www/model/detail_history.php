<?php
function insert_detail_history($db,$history_id,$item_id,$amount,$price){
    $sql = "
        INSERT INTO
            detail_histories(
                history_id,
                item_id,
                amount,
                price
            )
        VALUES(?,?,?,?);
    ";
    return execute_query($db,$sql,[$history_id,$item_id,$amount,$price]);
}

function get_detail_histories($db, $history_id){
    $sql = "
        SELECT 
            i.name,
            d.price,
            d.amount
        FROM
            detail_histories as d
        JOIN 
            items as i
        ON
            d.item_id = i.item_id
        WHERE
            d.history_id = ?
    ";
    return fetch_all_query($db, $sql, [$history_id]);
}