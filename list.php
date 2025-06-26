<HTML>
<HEAD>
<TITLE>XSS-CTF_list.php</TITLE>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css" />
</HEAD>
<BODY>
<center>
<table border=0 height=10 width=770><tr><td></td></tr></table>
<table width=800><tr>
<td width=100>
<a href="./">
<img src />
</a>
</td>
<td><font size=+3>XSS 게시판</font></td>
<td width=10></td>
<td valign=bottom>재밌는 이야기들을 볼 수 있습니다.</td></tr></table>
<table border=0 height=5 width=800 bgcolor=black><tr><td></td></tr></table>
<?php
    $handle=opendir('data_dir');
    $filelist=array();
    while(($file=readdir($handle)) !== false) {
        if($file =='.' || $file == '..') continue;
        if(preg_match('/.txt/',$file) == false) continue;
        $filelist[] = $file;
    }
    closedir($handle);
    rsort($filelist);

    echo '<table border=0 height=5><tr><th> </th></tr></table>'. "\n";
    echo '<table width=800 border=1 cellpadding=5><tr><th bgcolor=lightgray width=40>번호</th><th bgcolor=lightgray>제목</th><th bgcolor=lightgray width=100>작성자</th><th width=100 bgcolor=lightgray>등록일</th><th width=100 bgcolor=lightgray>삭제</th></tr'."\n";
    $count = 0;
    foreach($filelist as $file){
        $info = file_get_contents('data_dir/'.$file);
        list($date,$id,$title,$body) = explode('::', $info);

        $id = str_replace("<", "&lt", $id);
        $id = str_replace(">", "&gt", $id);
        $title = str_replace("<", "&lt", $title);
        $title = str_replace(">", "&gt", $title);
        $body = str_replace("<", "&lt", $body);
        $body = str_replace(">", "&gt", $body);
        $body = str_replace("\n", "<br />\n", $body);

        echo "<tr><th rowspan=2>".++$count."</th>\n";
        echo '<td>'.$title."</td>\n";
        echo "<th>".$id."</th>\n";
        echo "<th>".date("Y-m-d", $date)."</th>\n";
        // Add delete button with post identifier
        echo "<th><a href='XSS_delete.php?file=".$file."'>삭제</a></th></tr>\n";
        echo "<tr><td colspan=3 bgcolor=#efefd0>\n";
        echo $body."\n";
        echo "</td></tr>\n";
    }
?>
</td></tr></table>

<table border=0 height=5><tr><th> </th></tr></table>
<table width=800 cellpadding=5 border=1><tr><th>
TEAM: XSS<br>
LEADER: Moon<br>
ACE: Jeong<br>
DEVELOPER: Park<br>
DEVELOPER: Lee<br>
<br>
XSS@test.net
</th></tr></table>
<p></p>
</center>
</BODY>
</HTML>
