<form method="get" action="login.php">
      <p><label>ID : <input type="text" name="id"></label></p>
      <p><label>PW : <input type="password" name="pw"></label></p>
      <p><input type="submit" value="Login"></p>
</form>

<?php
	$id = "asdf";
	$pw = md5("qwer");
	
	$fileName = "LoginLog.txt";
	$is_file_exist = file_exists($fileName);

	if (!$is_file_exist) {
		$file = fopen($fileName,"w");
		fwrite($file, "LoginLog");
		fclose($file);
	}
  
	$input_id = $_GET['id'];
	$input_pw = md5($_GET['pw']);
	$ip = $_SERVER['REMOTE_ADDR'];
	
	if($id===$input_id){
		echo "로그인 성공";
	}
	else{
		echo "로그인 실패";
		$file4 = fopen($fileName,"a");
		fwrite($file4, "\r\n[".$ip."] input_id: ".$input_id." input_pw: ".$input_pw);
		fclose($file4);
	}
?>