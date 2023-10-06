
<html>
<body style=" background: radial-gradient(white, #60c896);">
	<div id="titleBar" style="position: absolute;"></div>
	<div style="margin:auto; width:1500px;height:100%;">
		<img src="./img/title.png" / style="width:100%;margin-top:-30px"><br>
		<button class='gptBtn' onclick="document.location = '/write.php'">글쓰기</button>
		<div style="overflow-y: scroll; max-height: 50%;">
			<table border=1 style="width:100%;" class='table'>
			<th> no </th><th> 작성자 </th><th> 제목 </th><th> 조회수 </th><th> 날짜 </th>
			
			</table>
		</div>
	</div>
</body>
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

/* 테이블 헤더 스타일 */
.table th {
    background-color: #4CAF50; /* 헤더 배경색 (초록색) */
    color: #fff; /* 헤더 글자색 (흰색) */
    padding: 10px;
	
}

/* 테이블 셀 스타일 (짝수 행) */
.table tr:nth-child(even) {
    background-color: #f2f2f2; /* 짝수 행 배경색 (연한 회색) */
}

/* 테이블 셀 스타일 (홀수 행) */
.table tr:nth-child(odd) {
    background-color: #fff; /* 홀수 행 배경색 (흰색) */
}

/* 테이블 셀 스타일 (호버 효과) */
.table tr:hover {
    background-color: #ddd; /* 마우스 호버 시 배경색 (회색) */
}
.logout{
	background-color:#ff7229;
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
			echo "<script>document.querySelector('#titleBar').innerHTML = '안녕하세요 ".$row['name']."님'</script>";
			
			$sql = "SELECT * FROM posts ORDER BY no DESC";
			$result_set = mysqli_query($conn, $sql);

		    while ($row = mysqli_fetch_array($result_set)){
				if(!$row['rm']){
					$onclick = "&quot;/view.php?no=".$row['no']."&quot;";
					$title = $row['title'];
					$title = str_replace("<", "&lt;",$title);
					
					$sql = "SELECT COUNT(*) FROM comment WHERE postno=".$row['no'];
					$result_set2 = mysqli_query($conn, $sql);
					$row2 = mysqli_fetch_row($result_set2);
					if($row2[0]>0)
						$text = "<tr onclick='document.location=".$onclick."'><td style='width:8%'>".$row['no']."</td> <td style='width:10%'>".$row['writer']."</td>  <td style='width:60%'>".$title."<span style='color:orangered;'> [".$row2[0]."]</span></td> <td style='width:8%'>".$row['view']."</td> <td style='width:14%'>".$row['time']."</td></tr>";
					else
						$text = "<tr onclick='document.location=".$onclick."'><td style='width:8%'>".$row['no']."</td> <td style='width:10%'>".$row['writer']."</td>  <td style='width:60%'>".$title."</td> <td style='width:8%'>".$row['view']."</td> <td style='width:14%'>".$row['time']."</td></tr>";
					echo "<script>document.querySelector('.table').innerHTML +=\"" .$text."\"</script>";
				}
		    }
		}
		else{
			echo "세션만료";
			header("Location: /login.php");
		}
		
		
		echo "<button style='position:absolute;bottom:0;left:0;' class='gptBtn logout' onclick='document.cookie= \"LoginSession=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;\";document.location = \"/\";'>로그아웃</button>";
	}
	else{
		header("Location: /login.php");
	}
?>