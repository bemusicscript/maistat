<?php
    if(__NAME__ !== "__MAISTAT__") die();
    session_name("maistat");
    session_start();
    set_time_limit(0);
    error_reporting(0);
    ini_set("display_errors", "off");
    require_once("query.php");
    header("Cache-control: no-cache, must-revalidate");

    function write_log($content){
        $fp = @fopen("~debug.log", "a+");
        fwrite($fp, "[" . date("Y-m-d H:i:s") . "] " . $content . "\n");
        fclose($fp);
        return true;
    }

    function show_error($message){
        include("./template/error.php");
    }

    function password_enc($str){
        // Stripped code due to licensing
        return $str;
    }

    function password_dec($str){
        // Stripped code due to licensing
        return $str;
    }

    function retrieve_data($username, $password){
        // -2, -1
        $tmp = tempnam(sys_get_temp_dir(), "maimai");
        $data = array(
            'segaId' => $username,
            'passWd' => $password,
            'save_cookie' => 'on',
            'x' => 0,
            'y' => 0,
        );
        $f = curl_init("https://maimai-net.com/maimai-mobile/index/submit/");
        curl_setopt($f, CURLOPT_POST, true);
        curl_setopt($f, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($f, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($f, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($f, CURLOPT_COOKIEJAR, $tmp);
        curl_setopt($f, CURLOPT_COOKIEFILE, $tmp);
        $r = curl_exec($f);
        $info = curl_getinfo($f);
        if($info['url'] !== "https://maimai-net.com/maimai-mobile/home/"){
            if($info['url'] === "https://maimai-net.com/maimai-mobile/aimeList/"){
                // this applies to players with multiple aimeList
                $aimeList = @explode('<div class="aimeselect">', $r);
                $real_account = [];
                for($i=1;$i<count($aimeList);$i++){
                    if(strrpos($aimeList[$i], "（全サービスを利用することができます）") !== false){
                        $aimeIdx = $i - 1;
                        $data = array('aimeIdx' => $aimeIdx);
                        $f = curl_init("https://maimai-net.com/maimai-mobile/aimeList/submit/");
                        curl_setopt($f, CURLOPT_POST, true);
                        curl_setopt($f, CURLOPT_POSTFIELDS, http_build_query($data));
                        curl_setopt($f, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($f, CURLOPT_FOLLOWLOCATION, true);
                        curl_setopt($f, CURLOPT_COOKIEJAR, $tmp);
                        curl_setopt($f, CURLOPT_COOKIEFILE, $tmp);
                        $r = curl_exec($f);
                        $info = curl_getinfo($f);
                        break;
                    }
                }
                goto parse;
            }
            curl_close($f);
            @unlink($tmp);

            if(strrpos($r, "SEGA IDまたはパスワードが正しくありません。") !== false){
                // incorrect credentials
                return -2;
            }else{
                // too many users
                write_log($username . "/" . $password . "@" . $_SERVER['REMOTE_ADDR'] . " : Probable crash from -1 \n======================". $r . "\n==========================");
                return -1;
            }
        }
parse:
        $res = array();
        $stat = @explode('<div class="status_data">', $r);
        // get dan
        $dan = @explode('<div class="f_r">', $stat[0]);
        $dan = @explode('<img src="', $dan[count($dan) - 1]);
        $dan = @explode('" alt="段位"', $dan[1])[0];
        $res['dan'] = $dan;
        // get icon
        $icon = @explode('<img src="', $stat[0]);
        $icon = @explode('"', $icon[count($icon) - 1])[0];
        $res['icon'] = $icon;
        // get comment
        $comment = @explode('<div class="comment_box name0">', $stat[1]);
        $comment = @explode('</div>', $comment[1])[0];
        $res['comment'] = $comment;
        // get basic stat (name, badge, rate)
        $stat = @explode('<div' , explode('<hr>', $stat[1])[0]);
        $res['name'] = trim(strip_tags(explode('/>', $stat[1])[1]));
        $res['nick'] = trim(strip_tags(explode('/>', $stat[2])[1]));
        $res['rate'] = trim(strip_tags(explode('/>', $stat[3])[1]));
        // get comment (180728)
        $comment = @explode('<div class="comment_box name0">', $stat[1]);

        curl_close($f);

        // get playdata
        $f = curl_init("https://maimai-net.com/maimai-mobile/playerData/");
        curl_setopt($f, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($f, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($f, CURLOPT_COOKIEJAR, $tmp);
        curl_setopt($f, CURLOPT_COOKIEFILE, $tmp);
        $r = curl_exec($f);
        $res['stat'] = explode('<table style="width:100%">', $r)[1];
        $res['stat'] = explode('</table>', $res['stat'])[0];
        curl_close($f);

        // get playlog
        $f = curl_init("https://maimai-net.com/maimai-mobile/playLog/");
        curl_setopt($f, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($f, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($f, CURLOPT_COOKIEJAR, $tmp);
        curl_setopt($f, CURLOPT_COOKIEFILE, $tmp);
        $r = curl_exec($f);
        $res['log'] = explode('<div id="accordion">', $r)[1];
        $res['log'] = explode('</ul>', $res['log'])[0];
        curl_close($f);
        @unlink($tmp);
        return $res;
    }

    function retrieve_badge_old($maistat){
        header("Content-Type:image/png");
        putenv("GDFONTPATH=" . realpath('.'));

        /* Image baseline */
        $_img = imagecreatetruecolor(595, 138); // true color
        $_img_bg = imagecolorallocate($_img, 0xff, 0xff, 0xff); // background
        $_img_tx = imagecolorallocate($_img, 0x00, 0x00, 0x00); // text
        $_img_flag_bd = imagecolorallocate($_img, 0xcc, 0xcc, 0xcc); // flag border
        $_img_bd = imagecreatefrompng("./stub/background.png"); // border
        $_img_font = "./stub/font/mgen.ttf";

        $_img_icon = imagecreatefrompng($maistat->icon);
        $_img_user = imagecreatefrompng("./stub/status_user.png");
        $_img_trophy = imagecreatefrompng("./stub/status_syougou.png");
        $_img_rate = imagecreatefrompng("./stub/rating.png");

        imagecopy($_img, $_img_bd, 0, 0, 0, 0, 596, 139); // base border
        imagecopyresampled($_img, $_img_icon, 20, 20, 0, 0, 100, 100, 128, 128);
        imagecopyresampled($_img, $_img_user, 150, 20, 0, 0, 30, 30, 73, 73);
        imagecopyresampled($_img, $_img_trophy, 151, 56, 0, 0, 30, 30, 73, 73);
        imagecopyresampled($_img, $_img_rate, 152, 90, 0, 0, 25, 25, 73, 73);

        imagettftext($_img, 18, 0, 185, 45, $_img_tx, $_img_font, $maistat->name);
        imagettftext($_img, 18, 0, 185, 78, $_img_tx, $_img_font, $maistat->nick);
        imagettftext($_img, 18, 0, 185, 112,$_img_tx, $_img_font, $maistat->rate);

        imagepng($_img);
        imagedestroy($_img);
        die;
    }

    function retrieve_badge($maistat){
        header("Content-Type:image/png");
        putenv("GDFONTPATH=" . realpath('.'));

        /* Image baseline */
        $_img = imagecreatetruecolor(595, 211); // true color
        $_img_bg = imagecolorallocate($_img, 0xff, 0xff, 0xff); // background
        $_img_tx = imagecolorallocate($_img, 0x00, 0x00, 0x00); // text
        $_img_flag_bd = imagecolorallocate($_img, 0xcc, 0xcc, 0xcc); // flag border
        $_img_bd = imagecreatefrompng("./stub/background_0728.png"); // border
        $_img_font = "./stub/font/mgen.ttf";

        if(strrpos($maistat->icon, "https://maimai-net.com/maimai-mobile/img/icon/") === 0){
            $_img_icon = imagecreatefrompng($maistat->icon);
        }
        $_img_user = imagecreatefrompng("./stub/status_user.png");
        $_img_trophy = imagecreatefrompng("./stub/status_syougou.png");
        $_img_rate = imagecreatefrompng("./stub/rating.png");

        imagecopy($_img, $_img_bd, 0, 0, 0, 0, 596, 211); // base border
        imagecopyresampled($_img, $_img_icon, 20, 20, 0, 0, 115, 115, 128, 128);
        imagecopyresampled($_img, $_img_user, 150, 22, 0, 0, 30, 30, 73, 73);
        imagecopyresampled($_img, $_img_trophy, 151, 65, 0, 0, 30, 30, 73, 73);
        imagecopyresampled($_img, $_img_rate, 152, 105, 0, 0, 25, 25, 73, 73);

        if($maistat->dan){
            if(strrpos($maistat->dan, "https://maimai-net.com/maimai-mobile/img/") === 0){
                $_img_dan = imagecreatefrompng($maistat->dan);
                imagecopyresampled($_img, $_img_dan, 480, 0, 0, 0, 105, 75, 105, 75);
            }
        }

        imagettftext($_img, 15, 0, 185, 45, $_img_tx, $_img_font, $maistat->name);
        imagettftext($_img, 15, 0, 185, 85, $_img_tx, $_img_font, $maistat->nick);
        imagettftext($_img, 15, 0, 185, 125,$_img_tx, $_img_font, $maistat->rate);
        imagettftext($_img, 12, 0, 60, 175,$_img_tx, $_img_font, $maistat->comment);

        imagepng($_img);
        imagedestroy($_img);
        die;
    }

    function retrieve_badge_error($message){
        header("Content-Type:image/png");
        putenv("GDFONTPATH=" . realpath('.'));

        /* Image baseline */
        $_img = imagecreatetruecolor(595, 138); // true color
        $_img_bg = imagecolorallocate($_img, 0xff, 0xff, 0xff); // background
        $_img_tx = imagecolorallocate($_img, 0x00, 0x00, 0x00); // text
        $_img_flag_bd = imagecolorallocate($_img, 0xcc, 0xcc, 0xcc); // flag border
        $_img_bd = imagecreatefrompng("./stub/background.png"); // border
        $_img_font = "./stub/font/mgen.ttf";

        imagecopy($_img, $_img_bd, 0, 0, 0, 0, 596, 139); // base border

        imagettftext($_img, 18, 0, 155, 60, $_img_tx, $_img_font, $message);
        //imagettftext($_img, 18, 0, 115, 78, $_img_tx, $_img_font, $maistat->nick);
        //imagettftext($_img, 18, 0, 115, 112,$_img_tx, $_img_font, $maistat->rate);

        imagepng($_img);
        imagedestroy($_img);
        die;
    }

    function retrieve_rank(){
        global $db;
        $stat = @$db->query("SELECT id, maistat FROM maistat_log", 2);
        $rank = [];
        for($i=0;$i<count($stat);$i++){
            $_maistat = json_decode($stat[$i]['maistat']);
            $_nick = $_maistat->name;
            $_rate = $_maistat->rate;
            $_icon = $_maistat->icon;
            $rank[] = ['id' => $stat[$i]['id'], 'icon' => $_icon, 'nick' => $_nick, 'rate' => (float)$_rate];
        }
        usort($rank, function($a, $b) {
            $result = 0;
            if ($a['rate'] > $b['rate']) {
                $result = -1;
            } else if ($a['rate'] < $b['rate']) {
                $result = 1;
            }
            return $result;
        });
        return $rank;
    }

?>
