<?php
    if(__NAME__ !== "__MAISTAT__") die('no');
    $rank = retrieve_rank();
?>
<!doctype html>
<html>
    <head>
        <title>maistat</title>
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
        <br>
        <div class="lastlog" style="padding:10px; width:630px;">
            <br>
            <h1 style="margin:0; text-align:center; line-height:16px;">maistat<br><span style="font-size:8pt;">v1.0b-180724</span></h2><br>
            <center>
                <form method="POST">
                    <input type=text name=username placeholder="SEGA ID" class="text">
                    <input type=password name=password placeholder="Password" class="text">
                    <input type=submit value="Sign In" class="btn" width=20%>
                </form>
            </center>
            <br>
        </div>
        <br>
        <div class="lastlog" style="width:650px;">
            <div style="font-size:10pt;">
                <h3 style="border:0; font-size: 20px;"><center>User Guide</center></h3>
                <br>
                <b>1.</b><br>
                &emsp;maimai-net에 표시된 사용자의 정보를 주기적으로 업데이트하여 보여줍니다.<br>
                &emsp;User's status from maimai-net is periodically gathered and shown to public.<br>
                &emsp;maimai-netから出力されるユーザの情報を定期的にアップデートして示しています。<br>
                <b>2.</b><br>
                &emsp; 공개적으로 자신의 정보를 보여줄 수 있습니다.<br>
                &emsp; You can now publicily show your skills to the public.<br>
                &emsp; 公開的に自分の情報を示すことができます。<br>
                <b>3.</b><br>
                &emsp; 생성된 프로필 프레임는 사진 형식이며, 사진은 주기적으로 업데이트됩니다.<br>
                &emsp; The generated profile frame is in an image format and is updated periodically.<br>
                &emsp; 生成されたプロファイルフレームは画像形式であり、定期的にアップデートされます。<br>
                <b>4.</b><br>
                &emsp; 게시글 작성시 프레임URL을 첨부하시면 추후 정보가 변경되어도 기존 게시글에 반영됩니다.<br>
                &emsp; By adding the frame URL when writing on BBS, image will change whenever status changes.<br>
                &emsp; スレッドの作成時にフレームURLを添付すると、今後の情報が変更されても既存スレッドに反映されます。<br>
                <span style="color:green">
                <b>5.</b><br>
                &emsp;제공하신 개인정보는 암호화되어 데이터베이스에 안전하게 저장됩니다.<br>
                &emsp;Your personal information provided are encrypted and securely stored in the database.<br>
                &emsp;提供されたお客様の個人情報は暗号化され、安全にデータベースに保存されます。<br>
                <br>
                </span>
            </div>
        </div>
        <br>
        <div class="lastlog" style="width:650px;">
            <div style="font-size:10pt;">
                <h3 style="border:0; font-size: 20px;"><center>TOP 50 Ranking</center></h3>
            </div>
            <table border=1 width=100% class="ranking_table">
                <thead>
                    <tr>
                        <th align=center width=10>#</th><th>Nickname</th><th width=10%>Rating</th>
                    </tr>
                </thead>
                <tbody>
<?php
    $v = count($rank) >= 50 ? 50 : count($rank);
    for($i=0;$i<$v;$i++){
?>
                    <tr onclick="document.location.href='?<?php echo $rank[$i]['id']; ?>';">
                        <td align=center><?php echo $i + 1; ?></td><td class="_ranking_nickname"><img src="<?php echo $rank[$i]['icon']; ?>" width=32> <?php echo $rank[$i]['nick']; ?></b></td><td><?php echo trim(number_format($rank[$i]['rate'], 2)); ?></td>
                    </tr>
<?php
    }
?>
                </tbody>
            </table>
        </div>
        <br>
        <div class="lastlog" style="padding:10px; width:630px;">
            <center>
                <div style="font-size:10pt; line-height: -10px;">
                    <a href="http://gall.dcinside.com/mgallery/board/lists/?id=maimai1">DCInside maimai(Korean)</a> &middot; <a href="https://www.facebook.com/groups/MaiMaiAsia/">MaiMaiAsia(English)</a> &middot; <a href="https://maimai-net.com/">maimai-net(Japanese)</a><br>
                    Made by <a href="//twitter.com/hayakudesu">@hayakudesu</a> (<a href="?8">maistat</a>). Contact twitter for further inquiries and bug reports!
                </div>
            </center>
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
