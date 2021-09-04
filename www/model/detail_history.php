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