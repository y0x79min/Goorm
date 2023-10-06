
<html>
	<div style="margin:auto; width:1500px;">
	<img src="./img/title.png" / style="width:100%;margin-top:-30px"><br>
	
	<form id="write-form" method="post" action="/write2.php">
		<input name="title" placeholder="제목" style="height:30px;"></input>
		<input name="pw" placeholder="비밀글 비밀번호(선택)" style="height:30px;"></input>
		<input type="submit" class="submit-button" value="작성하기"></input>
		<br>
		<textarea name="content" placeholder="내용을 입력하세요" style="width:100%;min-height:500px; border:1px solid black;"></textarea>
	</form>
	
	</div>
</html>


<style>
.gptBtn {
    display: inline-block;
    padding: 10px 20px; /* 버튼 내부 패딩 조절 */
    font-size: 16px; /* 글자 크기 조절 */
    font-weight: bold;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s, color 0.3s, transform 0.3s, box-shadow 0.3s;
    background-color: #4CAF50; /* 초록색 배경 */
    color: #fff; /* 흰색 글자 */
}
.gptBtn:hover {
    background-color: #45a049; /* 마우스 호버 시 색상 변화 */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* 버튼에 그림자 효과 */
}
.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    font-size: 16px;
}

.submit-button {
	height: 30px;
	padding: 0 15px;
	background-color: #4CAF50;
	color: #fff;
	border: none;
	border-radius: 5px;
	font-size: 16px;
	cursor: pointer;
	float: right;
}

/* 버튼에 호버 효과 추가 */
.submit-button:hover {
	background-color: #45a049;
}

</style>
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
		
		
		echo "<button class=\"logout\" onclick='document.cookie= \"LoginSession=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;\";document.location = \"/\";'>로그아웃</button>";
	}
	else{
		header("Location: /login.php");
	}
?>