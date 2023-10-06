<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            text-align: center;
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }

        #title {
            font-size: 120px;
            margin-top: 100px;
            margin-bottom: 100px;
            text-shadow: 4px 4px 8px #000;
        }

        #button-container {
            margin-top: 20px;
        }

        .button {
            display: inline-block;
            padding: 15px 30px;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            border-radius: 10px;
            margin: 0 10px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
        }

        .button-login {
            background-color: #4CAF50;
            color: #fff;
        }

        .button-signup {
            background-color: #FFA500;
            color: #fff;
        }

        .button:hover {
            background-color: #333;
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
        }

        /* 로그인과 회원가입 폼을 감추기 위한 스타일 */
        .form-container {
            margin-top: 20px;
        }

        /* 입력 폼 스타일 */
        input[type="text"], input[type="password"] {
            padding: 10px;
            font-size: 18px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin: 5px;
        }
    </style>
</head>
<body>
    <div id="title">영민이의 게시판</div>

	
    <form id="login-form" class="form-container" method="post" action="/login.php">
        <input type="text" name="userid" placeholder="아이디">
        <input type="password" name="password" placeholder="비밀번호">
		<input type="radio" style="display:none" name="type" value="login" checked="checked">
        <button class="button button-login" type="submit">로그인</button>
    </form>

    <form id="signup-form" class="form-container" method="post" action="/login.php">
        <input type="text" name="username" placeholder="닉네임">
        <input type="text" name="userid" placeholder="아이디">
        <input type="password" name="password" placeholder="비밀번호">
		<input type="radio" style="display:none" name="type" value="signup" checked="checked">
        <input type="password" name="password-re" placeholder="비밀번호 재확인">
        <button class="button button-signup" type="submit">회원가입</button>
    </form>
	
	<img style="width:500px;height:500px;" src="https://item.kakaocdn.net/do/6554be44bf80540c7afa12cf4d9b9b7e8f324a0b9c48f77dbce3a43bd11ce785"/>
</body>
</html>

<?php
	if($_SERVER['REQUEST_METHOD']==="POST"){
		if($_POST['type']==="login"){
			if($_POST['userid']==='') echo "<script>alert('아이디를 입력해주세요.');</script>";
			else{
				if($_POST['password']==='') echo "<script>alert('비밀번호를 입력해주세요.');</script>";
				else{
					
					$conn = mysqli_connect('localhost', 'root', '', 'test');
					if (mysqli_connect_errno())	{exit;}
					else{
						$sql = "SELECT * FROM users WHERE id = '". $_POST['userid']."'";
						$result = mysqli_query($conn, $sql);
						$row = mysqli_fetch_array($result);
						if (!isset($row)){echo "<script>alert('로그인 실패');</script>"; return;}
						if( $row['pw'] === md5($_POST['password'])){
							
							srand((double)microtime()*1000000); 
							$session_id = md5(uniqid(rand())); 
							
							$sql = "INSERT INTO sessions (session, id, name, time) VALUES ('".$session_id."', '".$_POST['userid']."' , '".$row['name']."' , '".(time() + 36000)."')";
							mysqli_query($conn, $sql);
							
							setcookie("LoginSession", $session_id, time() + 36000, "/");
							header("Location: /");
							
							
						}
						else{
							echo '<script>alert("로그인 실패")</script>';
						}
					}

				}
			}
		}
		else if($_POST['type']==="signup"){
			
			if ( !ctype_alnum( $_POST['username'].$_POST['userid'].$_POST['password'] ) ) {
				echo "<script>alert('영문 또는 숫자만 입력해주세요.');</script>"; return;
			}
			
			if($_POST['username']==='') {echo "<script>alert('닉네임을 입력해주세요.');</script>"; return;}
			if($_POST['userid']==='') {echo "<script>alert('아이디를 입력해주세요.');</script>"; return;}
			if($_POST['password']==='') {echo "<script>alert('비밀번호를 입력해주세요.');</script>"; return;}
			if($_POST['password-re']==='') {echo "<script>alert('비밀번호 재확인을 입력해주세요.');</script>"; return;}
			if( !($_POST['password'] === $_POST['password-re']) ) {echo "<script>alert('비밀번호가 일치하지 않습니다.');</script>"; return;}
			
			
			$conn = mysqli_connect('localhost', 'root', '', 'test');
				if (mysqli_connect_errno())
				{
					exit;
				}else{
					$sql = "SELECT * FROM users WHERE id = '". $_POST['userid']."'";
					$result = mysqli_query($conn, $sql);
					$row = mysqli_fetch_array($result);
					if (isset($row)){echo "<script>alert('이미 존재하는 아이디 입니다.');</script>"; return;}
					
					$sql = "SELECT * FROM users WHERE name = '". $_POST['username']."'";
					$result = mysqli_query($conn, $sql);
					$row = mysqli_fetch_array($result);
					if (isset($row)){echo "<script>alert('이미 존재하는 닉네임 입니다.');</script>"; return;}
					
					$sql = "INSERT INTO users ( id, pw, name) VALUES ('".$_POST['userid']."' , '".md5($_POST['password'])."' , '".$_POST['username']."')";
					mysqli_query($conn, $sql);
					echo "<script>alert('회원가입이 완료되었습니다.');</script>"; return;
				}
				
			
		}
	}
?>

