<?php
    if(__NAME__ !== "__MAISTAT__") die('no');

    switch($message){
        case "invalid_user":
            $message = "Coult not find the user.<br>ユーザーを見つけることができませんでした。<br>사용자를 찾을 수 없었습니다.";
            break;
        case "account_jam":
            $message = "There are a lot of visitors so Please try again later.<br>接続者が多く利用が遅れています。しばらくして再度接続してください。<br>접속자가 많아 이용이 지연되고 있습니다. 잠시 후 다시 접속하세요.";
            break;
        case "incorrect_login":
            $message = "SEGA ID or Password is incorrect.<br>セガのIDまたはパスワードが間違っています。<br>SEGA ID 또는 비밀번호가 잘못되었습니다.";
            break;
        case "incorrect_check":
            $message = "Your account is now deleted from the database.<br>データベースからあなたのアカウントが削除されました。<br>데이터베이스에서 귀하의 계정이 삭제되었습니다.";
            break;
    }
?>
<!doctype html>
<html>
    <head>
        <title>maistat &raquo; error</title>
        <link rel="apple-touch-icon" href="favicon.png" />
        <link rel="shortcut icon" href="favicon.ico">
        <meta name="google" content="notranslate">
        <meta id="viewport" name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
        <meta name="robots" content="index, nofollow">
        <meta name="keywords" content="maimai, maistat, maimai status">
        <meta property="og:url" content="//gaming.harold.kim/maistat/">
        <meta property="og:title" content="maistat">
        <meta property="og:type" content="profile">
        <meta property="og:description" content="Check out my maimai status!">
        <meta property="og:image" content="./stuib/maimai_chan.png">
        <link rel="stylesheet" href="./stub/static.css" type="text/css">
        <link rel="stylesheet" href="//harold.kim/static/font/ubuntu.css" type="text/css">
        <style>
            @import url(//fonts.googleapis.com/earlyaccess/nanumgothic.css);
            a{text-decoration: none;}
            * { font-family: 'Ubuntu', 'Nanum Gothic', "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro",Osaka, "メイリオ", Meiryo, "ＭＳ Ｐゴシック", "MS PGothic", sans-serif; }
            body { background:#f7fcfe url(./stub/bg_bottom.png) repeat-x fixed bottom; }
            .text { width:40%; min-height:34px;padding:0px 6px;font-size:13px;color:#333;vertical-align:middle;background-color:#fff;background-repeat:no-repeat;background-position:right 8px center;border:1px solid #ddd;border-radius:3px;outline:none;box-shadow:inset 0 1px 2px rgba(0,0,0,0.075) }
            .btn{margin:0;} .btn{position:relative;display:inline-block;padding:6px 12px;font-size:13px;font-weight:bold;line-height:20px;color:#333;white-space:nowrap;vertical-align:middle;cursor:pointer;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;background-color:#eee;background-image:linear-gradient(#fcfcfc, #eee);border:1px solid #d5d5d5;border-radius:3px;-webkit-appearance:none}
        </style>
    </head>
    <body>
        <div class="lastlog" style="padding:10px; width:630px;">
            <br>
            <center>
                <?php echo $message; ?>
                <br><br>
                <button class="btn" onclick="history.go(-1)">&laquo; Back to Main Page</button>
            </center>
            <br>
        </div>
        <script>
            <!-- https://stackoverflow.com/questions/8735457/scale-fit-mobile-web-content-using-viewport-meta-tag -->
            (function(){
              function apply_viewport(){
                if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)   ) {
                  var ww = window.screen.width;
                  var mw = 680; // min width of site
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
<?php
exit;
?>
