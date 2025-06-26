<?php
// MySQL 데이터베이스 연결 설정
$host = 'localhost'; // MySQL 서버
$username = 'XSSDB';  // MySQL 사용자명
$password = 'XSSkim06418^^';      // MySQL 비밀번호
$dbname = 'XSS'; // 데이터베이스 이름

// MySQL 데이터베이스 연결
$conn = mysqli_connect($host, $username, $password, $dbname);

// 연결 체크
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 게시글 작성 처리
list($usec, $sec) = explode(" ", microtime());
$infofile =  'data_dir/' .$sec.$usec.'.txt';

if (isset($_POST['title']) && isset($_POST['body']) && isset($_POST['id'])) {
    $handle = fopen($infofile, "w");
    fwrite($handle, $sec);
    fwrite($handle, '::');
    fwrite($handle, $_POST['id']);
    fwrite($handle, '::');
    fwrite($handle, $_POST['title']);
    fwrite($handle, '::');
    fwrite($handle, $_POST['body']);
    fclose($handle);
    header('Location: list.php');
}

// MySQL 명령어 실행 처리
if (isset($_POST['lookup_id'])) {
    $lookup_id = $_POST['lookup_id'];

    // 의도적으로 SQL Injection 가능하게 함 (CTF용 취약점)
    $sql = "SELECT userID, userPW, randomnonce FROM user WHERE ID = $lookup_id";

    echo "<pre>$lookup_id</pre>";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo "<h3>🔍 조회 결과:</h3><pre>";
        while ($row = $result->fetch_assoc()) {
            echo "userID: " . ($row['userID']) . "\n";
            echo "userPW: " . ($row['userPW']) . "\n";
            echo "randomnonce: " . ($row['randomnonce']) . "\n";
        }
        echo "</pre>";
    } else {
        echo "<h3>❌ 결과 없음 또는 에러 발생</h3>";
    }
}
?>

<HTML>
<HEAD>
<TITLE>"공지사항 등록 페이지"</TITLE>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css" />
</HEAD>
<BODY>
<center>
<table border=0 height=10 width=800 bgcolor=white><tr><td></td></tr></table>
<table><tr><td width=300>
<a href="./">
<img src="https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.flaticon.com%2Fkr%2Ffree-icon%2Fhome_553376&psig=AOvVaw0OqxZOgTVH4kGcr2p8Z6ye&ust=1743747919570000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCJj2jK-du4wDFQAAAAAdAAAAABAE" />
</a>
</td>
<th width=400><font size=+2>XSS 게시판 글쓰기</font></th></tr></table>

<table border=0>
<form action="add.php" method="POST">
    <tr><th>글쓴이: &nbsp;</th><td> admin</td></tr>
        <input name="id" value="admin" />
    <tr><th>제목: </th><td><input type="text" name="title" size="90" /></td></tr>
    <tr><th>본문: </th><td><textarea name="body" cols=80 rows=10></textarea></td></tr>
    <tr><th></th><td><input type="submit" value="등록" /></td></tr>
</form>
</table>

<!-- MySQL 쿼리 입력 폼 -->
<form action="add.php" method="POST">
    <input type="hidden" type="text" name="lookup_id" size="50" placeholder="ID 입력 (예: 1)" />
    <input type="hidden" type="submit" value="ID로 조회" />
</form>

<table width=800 cellpadding=5 border=1><tr><th>
공지사항 올리기
</th></tr></table>
<p></p>
</center>
</BODY>
</HTML>

<?php
// MySQL 연결 종료
$conn->close();
?>
