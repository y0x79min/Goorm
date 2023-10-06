<html>
	<div style="margin:auto; width:1500px;border:0;">
	<img src="./img/title.png" / style="width:100%;margin-top:-30px"><br>
	
	<button class='gptBtn' onclick='document.location = "/";'>돌아가기</button>
	<button id='rmBtn' class='gptBtn' style="float:right;background:rebeccapurple;display:none" onclick='remove()'>삭제하기</button>
	
	<script>
		function remove(){
			if (confirm("정말 삭제하시겠습니까??") == true){    //확인
				 document.location += "&remove=1";
			 }else{   //취소
				 return false;
			 }
		}
	</script>
<?php
	if(isset($_COOKIE["LoginSession"])){
		$session = $_COOKIE["LoginSession"];
		$conn = mysqli_connect('localhost', 'root', '', 'test');
		
		$sql = "SELECT name FROM sessions WHERE session = '". $session."'";
		
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result);
		if (isset($row)){				
		
			$mynick = $row['name'];
			
			$sql = "SELECT * FROM posts WHERE no = '".$_GET["no"]."'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result);
			
			
			if ($row['rm']){
				echo '<script>alert("삭제된 게시글 입니다.")</script>';
				return;
			}
			
			if ($row['pw']){
				if(isset($_POST['post_pw'])){
					if($_POST['post_pw']==$row['pw']){
						
					}
					else{
						echo '<script>alert("비밀번호가 틀립니다.")</script>';
						echo '<form method="post" >';
						echo '<input name="post_pw" placeholder="게시글 비밀번호 입력"></input>';
						echo '<button class="button button-login" type="submit">전송</button>';
						echo '</form>';
						return;
					}
				}
				else{
					echo '<script>alert("비밀글입니다.")</script>';
					echo '<form method="post" >';
					echo '<input name="post_pw" placeholder="게시글 비밀번호 입력"></input>';
					echo '<button class="button button-login" type="submit">전송</button>';
					echo '</form>';
					return;
				}
			}
			
			$title = $row['title'];
			$title = str_replace("<", "&lt;",$title);
			$writer = $row['writer'];
			$content = $row['content'];
			$content = str_replace("<", "&lt;",$content);
			$view = $row['view'];
			echo "<script>var no = ".$_GET["no"].";</script>";
			//삭제
			if($mynick == $writer){
				echo "<script>document.querySelector('#rmBtn').style.display='';</script>";
				if(isset($_GET['remove'])){
					$sql = "update posts set rm = 1 where no = '".$_GET["no"]."' ";
					mysqli_query($conn, $sql);
					header("Location: /");
				}
			}				
				
			$sql = "update posts set view = view+ 1 where no = '".$_GET["no"]."' ";
			mysqli_query($conn, $sql);
				
				
			echo '<div><strong>제목:  </strong>'.$title.'</div>'.
			'<div><strong>글쓴이:  </strong>'.$writer.' <span style="float:right"><strong>조회수: </strong>'.$view.'</span></div>'.
			'<div style="padding:10px;height:500px"><pre style="white-space: break-spaces;">'.$content.'</pre></div>';
		}
		else{
			echo "세션만료";
		}
		
		
	}
	else{
		echo "<script>alert('로그인을 해야 볼 수 있습니다.')</script>";
		header("Location: /login.php");
	}

?>
	<div>
		
		<form id="write-form" method="post" style="width:100%; height:50px; display: flex;" action="/CMwrite.php">
			<textarea name="content2" style="width:90%;height:50px;resize: none;" placeholder="댓글입력" ></textarea>
			<input id="FormNo" type="radio" style="display:none" name="no" value="no" checked="checked">
			<button style="width:10%;height:50px;">댓글 쓰기</button>
		</form>
		<?php
			$sql = "SELECT * FROM comment WHERE postno = ".$_GET["no"]." ORDER BY no DESC";
			$result_set = mysqli_query($conn, $sql);

		    while ($row = mysqli_fetch_array($result_set)){
				if(!$row['rm']){
					$onclick = "&quot;/view.php?no=".$row['no']."&quot;";
					$writer = $row['writer'];
					$content = $row['content'];
					$content = str_replace("<", "&lt;",$content);
					$text = "<div style='margin-bottom:5px;border-radius: 10px;'><div><strong>".$writer."</strong><span style='float:right;'>".$row['time']."</span></div><div>".$content."</div></div>";
					echo $text;
				}
		    }
		?>
		
	</div>


	<button class='gptBtn' onclick='document.location = "/";'>돌아가기</button>
</div>
	<script>
		document.querySelector('#FormNo').value = no;
	</script>
</html>
<style>
 div{
	 border: 1px solid green;
 }
 
.logout{
	background-color:#ff7229;
}
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
</style>