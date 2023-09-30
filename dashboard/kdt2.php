
<?php
	$num= $_GET['v'];
	print($num . "은 ");
	if($num > 5){
		echo "5보다큼";
	}
	else{
		echo "5이하";
	}
	
	$fileName = "test.txt";
	$is_file_exist = file_exists($fileName);

	if ($is_file_exist) {
		echo "<br>".$fileName.' 파일이 존재하므로 생성하지 않았습니다.';
	}
	else {
		$file = fopen($fileName,"w");
		fwrite($file, "hello");
		fclose($file);
		echo "<br>".$fileName." 생성 & 파일쓰기가 완료";
	}
  
	
	$file2 = fopen($fileName,"r");
	$content = fread($file2, filesize($fileName));
	fclose($file2);
	
	echo "<br>파일 내용은: ".$content;
	
	$ip = $_SERVER['REMOTE_ADDR'];
	echo "<br>당신의 아이피: ".$ip;
	
	
	
	$file4 = fopen($fileName,"a");
	fwrite($file4, "\r\n".$ip);
	fclose($file4);
	
	$file3 = fopen($fileName,"r");
	$content = fread($file3, filesize($fileName));
	fclose($file3);
	echo "<br><br>파일 내용은: ".$content;
?>