<?php
    /*
        create table `maistat_log`(
            `id` int(11) unsigned not null auto_increment primary key,
            `username` varchar(255) NOT NULL, `password` VARCHAR(255) NOT NULL,
            `maistat` TEXT DEFAULT NULL,
            `last_checked` INT(11) UNSIGNED DEFAULT NULL
        );
    */
    define("__NAME__", "__MAISTAT__");
    require_once("init.php");
    $db = new Query();
    $db->connect("localhost", "gaming", "gaming", "gaming");
    if($db->check() == false) die("db down");
    if( time() >= strtotime("2019-09-01 00:00:00") ){
        include("template/end.php");
        @$db->query("DROP TABLE maistat_log;");
        exit;
    }
    if($_POST){
        if($_POST['username'] && $_POST['password']){
            $username = substr($db->filter($_POST['username'], 'sql'), 0, 255);
            $password = substr($db->filter($_POST['password'], 'sql'), 0, 255);
            $password = password_enc($password);
            $r = $db->query("SELECT * FROM maistat_log WHERE username='$username' AND password='$password'", 1);
            if($r['username'] == $username && $r['username'] === $username && $r['username'] != ""){
                $_SESSION['userid'] = $username;
                header("Location: ?". intval($r['id']));
                exit;
            }else{
                $maistat = retrieve_data($username, password_dec($password));
                if(is_int($maistat)){
                    if($maistat === -1) show_error("account_jam");
                    if($maistat === -2) show_error("incorrect_login");
                }
                $maistat = $db->filter(json_encode($maistat), 'text');
                $insert_stmt = "INSERT INTO maistat_log VALUES(NULL, '$username', '$password',";
                $insert_stmt .= "'$maistat', UNIX_TIMESTAMP());";
                $db->query($insert_stmt);
                $r = $db->query("SELECT * FROM maistat_log ORDER BY id DESC LIMIT 1", 1);
                $cnt = $r['id'];
                $_SESSION['userid'] = $username;
                header("Location: ?". intval($cnt));
            }
        }
    }
    if($_SERVER['QUERY_STRING'] != "" && (int)$_SERVER['QUERY_STRING'] == intval($_SERVER['QUERY_STRING'])){
        $query = $db->filter(intval((int)$_SERVER['QUERY_STRING']), "sql");
        $r = $db->query("SELECT * FROM maistat_log WHERE id='$query'", 1);
        $maistat = json_decode($r['maistat']);
        $last_checked = (int)$r['last_checked'];
        if($r['id'] != $query) show_error("invalid_user");
        if(time() >= $last_checked + (60 * 4)){
            $maistat = retrieve_data($r['username'], password_dec($r['password']));
            if(is_int($maistat)){
                if($maistat === -1){
                    show_error("account_jam");
                }
                if($maistat === -2){
                    $db->query("DELETE FROM maistat_log WHERE id='$query'");
                    show_error("incorrect_check");
                }
            }else{
                $maistat_update = $db->filter(json_encode($maistat), 'text');
                $db->query("UPDATE maistat_log SET maistat='$maistat_update', last_checked=UNIX_TIMESTAMP() WHERE id='$query'");
            }
            $maistat = json_decode(json_encode($maistat));
        }
        include("./template/result.php");
    }
    if($_SERVER['HTTP_HOST'] !== "gaming.harold.kim") {
        header("Location: https://gaming.harold.kim/tier/");
        exit;
    }

    include("./template/home.php");
?>
