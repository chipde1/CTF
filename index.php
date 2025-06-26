<HTML>
<HEAD>
<TITLE>XSS CTF TEST HOMEPAGE</TITLE>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css" />
<script>
MathJax = {
  tex: {
    inlineMath: [['$', '$'], ['\\(', '\\)']]
  },
  svg: {
    fontCache: 'global'
  }
};
</script>
<script type="text/javascript" id="MathJax-script" async
  src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-svg.js">
</script>
</HEAD>
<center>
<BODY>
<table>
<table border=0 height=10 width=800 bgcolor=white><tr><td></td></tr></table>
<table><tr><th><font size=+2>XSS-CTF PAGE</font></th></tr></table>

<table border=0 hright=5 width=800 bgcolor=black><tr><td></td></tr></table>
<table border=0 hright=5 width=800 bgcolor=white><tr><td></td></tr></table>

<td width=800><tr><td><TABLE>
    <font size=+2></font>
    <table border=0 height=15><td><tr></tr></td></table>
    <font size=+1></font>
    <TABLE>
    <TR><TD HEIGHT=7 COLSPAN=2></TD></TR>
    <TR><TD VALIGN=TOP>1.</TD><TD WIDTH=5></TD><TD>
        Cryptography
        <font size=-1>
        <br>- 정보를 보호하기 위한 수학적, 언어학적인 방법을 다루는 학문
        <br>- 고전암호: Caesar Cipher, Vigenere Cipher
        <br>- 현대암호: DES, AES, SEED
        </font>
    </TD></TR>
    <TR><TD HRIGHT=7 COLSPAN=2></TD></TR>
    <TR><TD VALIGN=TOP>2.</TD><TD WIDTH=5></TD><TD>
        Hash
        <font size=-1>
        <br>- 임의의 길이를 갖는 임의의 데이터를 고정된 길이의 데이터로 매핑하는 단방향 함수를 말함.
        <br>- 해시는 one-wayness 특성에 의해 해시값만으로 이전의 데이터를 알 수 없기에 보안적으로 좋은 역할을 해줌.
        <br>- 알고리즘: SHA, MD5
    </font>
    </TD></TR>
    <TR><TD HEIGHT=7 COLSPAN=2></TD></TR>
    <TR><TD VALIGN=TOP>3.</TD><TD WIDTH=5></TD><TD>
        Hash Chain
        <font size=-1>
        <br>- Hash Chain은 Seed값으로부터 해시함수를 여러 번 적용하여 다수의 일회용 키를 생성하는 방법을 말함.
        <br>- <i>$H_{1}=h(seed), H_{2}=h(H_{1})=h(h(seed)), ··· , H_{n}=h(H_{n-1})$</i>
        <br>- one-wayness 특성에 의해 <i>$H_{n-1}$</i>로 <i>$H_{n}$</i>을 구하는 것은 쉽지만 <i>$H_{n}$</i>을 가지고 <i>$H_{n-1}$</i>을 구하는 것은 쉽지않음
        </font>
    </TD></TR>
    <TR><TD HEIGHT=7 COLSPAN=2></TD></TR>
    <TR><TD VALIGN=TOP>4.</TD><TD WIDTH=5></TD><TD>
<!-- H10000.txt -->
        $M_{n}$ ※$p = password$
        <font size=-1>
        <br>- <i>$M_{1}=userID⨁K⨁H_{9999}$</i>
        <br>- <i>$M_{2}=serverID⨁K⨁H_{9999}$</i>
        <br>- <i>$M_{3}=H_{10000}⨁p$</i>
        <br>- <i>$M_{4}=H_{9999}⨁p$</i>
        </font>
    </TD></TR>
    </TABLE>
    &nbsp;<br><b>
    reference: MACHINE TO MACHINE AUTHENTICATED KEY
AGREEMENT WITH FORWARD SECRECY FOR
INTERNET OF THINGS

    </b>
</td>
<td> &nbsp;
</td>
<td>
<img src~~/>

</td></tr></table>

<table border=0 height=5 width=800 bgcolor=white><td><tr></tr></td></table>
<table border=0 height=5 width=800 bgcolor=black><td><tr></tr></td></table>
<table border=0 height=5 width=800 bgcolor=white><td><tr></tr></td></table>

<table border=1 width=800 bgcolor=white><tr>
<td>

<TABLE BORDER=0 WIDTH=100%>
<TR><TD>
<img src ~~~~/>

</TD>
<TD>
[<A GREF="list.php">+ 더보기</A>] &nbsp;
</TD></TR>
<?php
    $handle=opendir('data_dir');
    $filelist = array();
    while( ($file = readdir($handle)) !== false) {
        if ($file == '.'|| $file == '') continue;
        if (preg_match('/.txt/', $file) == false) continue;
        $filelist[] = $file;
    }
    closedir($handle);
    rsort($filelist);
    $count = 0;
    foreach($filelist as $file) {
        $info = file_get_contents('data_dir/' .$file);
        list($date, $id, $title, $body) = explode('::', $info);
        if (strlen($title)>90) $title = substr($title,0,90).'eee';
        echo '<tr><td><font size=-1>&bullet; '.$title."</font></td>\n";
        echo '<td><font size=-1>[' .date("Y-m-d", $date)."]</font></td></tr>\n";
        if (++$count > 4) break;
    }
?>
</TABLE>
</td></tr></table>

<table border=0 height=5 width=800 bgcolor=white><td><tr></tr></td></table>
<table border=0 height=5 width=800 bgcolor=black><td><tr></tr></td></table>
<table border=0 height=5 width=800 bgcolor=white><td><tr></tr></td></table>
<table width=800 cellpadding=5 border=1><tr><th>
TEAM: XSS<br>
LEADER: Moon<br>
ACE: Jeong<br>
DEVELOPER: Park<br>
DEVELOPER: Lee<br>

</th></tr></table>
<p>
</center>
</BODY>
</HTML>