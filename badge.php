<?php
    define("__NAME__", "__MAISTAT__");
    require_once("init.php");
    $db = new Query();
    $db->connect("localhost", "gaming", "gaming", "gaming");
    if($db->check() == false) die("db down");

    if($_SERVER['QUERY_STRING'] != "" && (int)$_SERVER['QUERY_STRING'] == intval($_SERVER['QUERY_STRING'])){
        $query = $db->filter(intval((int)$_SERVER['QUERY_STRING']), "sql");
        $r = $db->query("SELECT * FROM maistat_log WHERE id='$query'", 1);
        $maistat = json_decode($r['maistat']);
        $last_checked = (int)$r['last_checked'];
        if($r['id'] != $query) retrieve_badge_error("  Account does not exist.\nアカウントは存在しません。");
        if(time() >= $last_checked + (60 * 4)){
            // update if not checked
            $maistat = retrieve_data($r['username'], password_dec($r['password']));
            if(is_int($maistat)){
                // delete if not able to get access
                if($maistat === -1){
                    retrieve_badge_error("        Please reconnect.\n   再度接続してください。");
                }
                if($maistat === -2){
                    $db->query("DELETE FROM maistat_log WHERE id='$query'");
                    retrieve_badge_error("        Please reconnect.\n   再度接続してください。");
                }
            }else{
                $maistat_update = $db->filter(json_encode($maistat), 'text');
                $db->query("UPDATE maistat_log SET maistat='$maistat_update', last_checked=UNIX_TIMESTAMP() WHERE id='$query'");
            }
            $maistat = json_decode(json_encode($maistat));
        }
        retrieve_badge($maistat);
    }
?>
