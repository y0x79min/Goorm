<html>

</html>
<?php
	if(isset($_COOKIE["LoginSession"])){
		$session = $_COOKIE["LoginSession"];
		$conn = mysqli_connect('localhost', 'root', '', 'test');
		
		$sql = "SELECT * FROM sessions WHERE session = '". $session."'";
		
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result);
		if (isset($row)){
			echo "안녕하세요 ".$row['name']." 님";
		}
		else{
			echo "세션만료";
		}
		
		
		echo "<button onclick='document.cookie= \"LoginSession=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;\";document.location = \"/\";'>로그아웃</button>";
	}
	else{
		header("Location: /login.php");
	}
?>