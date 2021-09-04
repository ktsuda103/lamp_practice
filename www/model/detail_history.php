<?php
function insert_detail_history(){
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
    return execute_query($db,$sql,[$user_id,$history_id,$amount,$price]);
}