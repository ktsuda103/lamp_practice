<?php
function insert_history(){
    $sql = "
        INSERT INTO
            histories(
                user_id,
                created_at
            )
        VALUES(?,NOW());
    ";
    return execute_query($db,$sql,[$user_id]);
}