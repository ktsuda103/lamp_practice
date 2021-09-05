<?php
function insert_history($db,$user_id){
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

function get_all_histories($db){
    $sql = "
        SELECT 
            h.id,
            h.created_at,
            SUM(d.price*d.amount) as sum
        FROM
            histories as h
        JOIN
            detail_histories as d
        ON
            h.id = d.history_id
        GROUP BY 
            h.id
        ORDER BY
            created_at DESC
    ";
    return fetch_all_query($db,$sql);
}

function get_histories($db,$user_id){
    $sql = "
        SELECT 
            h.id,
            h.created_at,
            SUM(d.price*d.amount) as sum
        FROM 
            histories as h
        JOIN
            detail_histories as d
        ON
            h.id = d.history_id
        WHERE
            h.user_id = ?
        GROUP BY 
            h.id
        ORDER BY
            created_at DESC
    ";
    return fetch_all_query($db,$sql,[$user_id]);
}

function get_history($db,$history_id){
    $sql = "
        SELECT 
            h.id,
            h.created_at,
            h.user_id,
            SUM(d.price*d.amount) as sum
        FROM
            histories as h
        JOIN
            detail_histories as d
        ON
            h.id = d.history_id
        WHERE
            h.id = ?
        GROUP BY
            h.id
    ";
    return fetch_all_query($db,$sql,[$history_id]);
}