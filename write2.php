
<?php
	if($_SERVER['REQUEST_METHOD']==="POST"){
		if(isset($_COOKIE["LoginSession"])){
			$session = $_COOKIE["LoginSession"];
			$conn = mysqli_connect('localhost', 'root', '', 'test');
			
			$sql = "SELECT name FROM sessions WHERE session = '". $session."'";
			
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result);
			if (isset($row)){				
				$sql = "INSERT INTO posts ( writer, title, content, pw, time,ip) VALUES ('".$row['name']."' , '".$_POST['title']."' , '".$_POST['content']."' , '".$_POST['pw']."'  , '".date("Y-m-d H:i:s")."' , '" . $_SERVER["REMOTE_ADDR"]."' )";
				$result = mysqli_query($conn, $sql);
				header("Location: /");
			}
			else{
				echo "세션만료";
			}
			
			
			echo "<button onclick='document.cookie= \"LoginSession=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;\";document.location = \"/\";'>로그아웃</button>";
		}
		else{
			header("Location: /login.php");
		}
	}
	else{
		header("Location: /");
	}
?>