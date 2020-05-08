<?php
    if(__NAME__ !== "__MAISTAT__") die('no');
    if($maistat->stat){
        $maistat->stat = str_replace("\">プレイ回数", "\"><b><font size=2>プレイ回数<br>Play Count</b>", $maistat->stat);
        $maistat->stat = str_replace("\">対戦勝ち数", "\"><b><font size=2>対戦勝ち数 / Battle Win / 대전 승수</font></b>", $maistat->stat);
        $maistat->stat = str_replace("\">SYNC プレイ回数", "\"><b><font size=2>SYNC プレイ回数 / SYNC Play Count / SYNC 플레이 횟수</font></b>", $maistat->stat);
        $maistat->stat = str_replace("\">SYNC お手伝い数", "\"><b><font size=2>SYNC お手伝い数 / SYNC Assistance Count / SYNC 도움 횟수</font></b>", $maistat->stat);
    }
    if($maistat->log){
        $maistat->log = str_replace("<form ", "<form onsubmit='return false;' ", $maistat->log);
    }
?>
<!doctype html>
<html>
    <head>
        <title>maistat &raquo; <?php echo $maistat->name; ?></title>
        <link rel="apple-touch-icon" href="favicon.png" />
        <link rel="shortcut icon" href="favicon.ico">
        <meta name="google" content="notranslate">
        <meta id="viewport" name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
        <meta name="robots" content="index, nofollow">
        <meta name="keywords" content="maimai, maistat, maimai status">
        <meta property="og:url" content="//gaming.harold.kim/maistat/?<?php echo $query; ?>">
        <meta property="og:title" content="maistat &mdash; <?php echo $maistat->name; ?>">
        <meta property="og:type" content="profile">
        <meta property="og:description" content="Check out my maimai status!">
        <meta property="og:image" content="<?php echo $maistat->icon; ?>">
        <link rel="stylesheet" href="./stub/static.css" type="text/css">
        <link rel="stylesheet" href="//harold.kim/static/font/ubuntu.css" type="text/css">
        <style>
            @import url(//fonts.googleapis.com/earlyaccess/nanumgothic.css);
        </style>
    </head>
    <body>
        <div class="lastlog" style="padding:10px; width:565px;">
            maimai finale가 2019년 9월 4일부터 종료됨에 따라, maistat또한 9월 1일에 자동 종료될 예정입니다. 서비스 종료시 기존에 있던 데이터는 전부 파기될 예정입니다.<br>
            <hr>
            maimai finale network is going to be stopped from September 4th, maistat will also be terminated in September 1st. All existing data will be destroyed on termination.<br>
            <hr>
            maimai finaleが2019年9月4日から終了されたことによって、maistatは9月1日に自動終了予定です。
            <br>
            <hr>
            Reference:
            <a href="https://maimai.sega.jp/news/2019-08-10/">Information #1</a> <a href="https://twitter.com/maimai_official/status/1160159042292969472">Tweet #1</a>
        </div>
<?php if($_SESSION['userid'] == $r['username']){ ?>
         <div class="lastlog">
            <h3 style="border:0; font-size: 20px;"><center>Guide to share your maistat</center></h3>
            <br>
            현재 페이지 URL / 現在のページのURL / Current URL<br>
            <input type='text' style='width:80%; background:#fff;' value="https://gaming.harold.kim/maistat/?<?php echo $query;?>" readonly='readonly'><br><br>
            프로필 프레임 URL / プロフィールフレーム URL / Profile Frame URL<br>
            <input type='text' style='width:80%; background:#fff;' value="https://gaming.harold.kim/maistat/badge.php?<?php echo $query; ?>" readonly='readonly'><br><br>

            <hr>
            <br>
            아래는 게시글 작성시 사용할 수 있는 코드입니다.<br>
            You can use following codes to share your maistat on BBS, forums, etc.<br>
            次のコードを使用してあなたのmaistatを共有することができます。
            <br><br>
            <b>BBCode:</b><br>
            <textarea readonly="readonly" style="width:80%; min-width:80%; max-width:80%;">
[url=https://gaming.harold.kim/maistat/?<?php echo $query;?>][img]https://gaming.harold.kim/maistat/badge.php?<?php echo $query; ?>[/img][/url]</textarea><br><br>
            <b>HTML:</b><br>
            <textarea readonly="readonly" style="width:80%; min-width:80%; max-width:80%;">
<a href="https://gaming.harold.kim/maistat/?<?php echo $query;?>"><img src="https://gaming.harold.kim/maistat/badge.php?<?php echo $query; ?>"></a>
            </textarea><br><br>
         </div>
<?php }?><br>
        <img src="badge.php?<?php echo $query; ?>" class="badge" align="middle"><br>
<?php if($maistat->log && $maistat->stat){ ?>
        <table class="stat" align=center>
            <?php echo $maistat->stat; ?>
        </table>
        <br>
        <div class="lastlog">
        <?php echo $maistat->log; ?>
        </div>
<?php }else{ ?>
        <div class="lastlog" style="padding-top:10px; padding-bottom: 10px;">
            <center>
                사용 권한이 없어 최근 내역을 확인할 수 없습니다.<br>
                Service is not available because you've lost the usage right.<br>
                利用権が無いため、サービスをご利用いただけません。<br><br>

                maimai를 여러번 플레이 하시면 다시 이용하실 수 있습니다.<br>
                You have to play maimai a few times to use the service.<br>
                maimaiを規定回数プレイすることで、サービスを利用できるようになります<br>
            </center>
        </div>
<?php } ?>

        <br>
        <center>
            <a href="https://twitter.com/share?text=Check+out+my+maimai+status!&url=https://gaming.harold.kim/maistat/%3f<?php echo $query;?>" id="twitter_share" class="twitter-share-button" data-show-count="false">Share on Twitter</a><br>
            &nbsp;<div class="fb-share-button" style="margin:0; padding:0;" data-href="https://gaming.harold.kim/maistat/?<?php echo $query;?>" data-layout="button" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fgaming.harold.kim/maistat/%3f<?php echo $query; ?>" class="fb-xfbml-parse-ignore">Share on facebook</a></div>
            <br>
            <span style="font-size:8pt;>by <a href="//twitter.com/hayakudesu">@hayakudesu</a></span>
        </center>
        <hr style="border:0;">
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0&appId=1396031963822025&autoLogAppEvents=1";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

        <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
        <script type="text/javascript">
            <!-- https://stackoverflow.com/questions/8735457/scale-fit-mobile-web-content-using-viewport-meta-tag -->
            (function(){
              function apply_viewport(){
                if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)   ) {
                  var ww = window.screen.width;
                  var mw = 610; // min width of site
                  var ratio =  ww / mw; //calculate ratio
                  var viewport_meta_tag = document.getElementById('viewport');
                  if( ww < mw){ //smaller than minimum size
                    viewport_meta_tag.setAttribute('content', 'initial-scale=' + ratio + ', maximum-scale=' + ratio + ', minimum-scale=' + ratio + ', user-scalable=no, width=' + mw);
                  }
                  else { //regular size
                    viewport_meta_tag.setAttribute('content', 'initial-scale=1.0, maximum-scale=1, minimum-scale=1.0, user-scalable=yes, width=' + ww);
                  }
                }
              }
              window.addEventListener('resize', function(){
                apply_viewport();
              });
              apply_viewport();
            }());
        </script>
    </body>
    </html>
<?php exit; ?>
