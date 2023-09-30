# Goorm
구름 실습 과제
# 로그인 기능이 포함된 PHP 페이지

- 로그인 기능이 포함된 소스코드의 git repository 주소
    - [https://github.com/y0x79min/Goorm](https://github.com/y0x79min/Goorm)

- 정상적으로 로그인이 성공했을때의 스크린샷 (repository 내 있어야함)
    
    121.153.24.76으로 접속을 하면
  
    ![Untitled](https://github.com/y0x79min/Goorm/assets/146512434/cc3dd4a2-4e18-41ea-87da-32f4a80cfa5f)

    main.php가 열리고
    ![Untitled 1](https://github.com/y0x79min/Goorm/assets/146512434/5fb1d43a-7fe5-4402-b7ac-7b78f4e45419)

    
    main.php에서 LoginSession이라는 쿠기가 없으면 자동으로 
    
    로그인 페이지인 /login.php로 리다이렉션이 된다.
    
    ![Untitled 2](https://github.com/y0x79min/Goorm/assets/146512434/3c305862-de66-44b8-bd09-e454283cc3ae)
    
    회원가입을 하면
    
    ![Untitled 3](https://github.com/y0x79min/Goorm/assets/146512434/9433a949-02ca-4764-bab8-22d1f8a7d889)
    
    입력 칸에는 영문과 숫자만 쓸 수 있고
    
    입력 여부와 닉네임, 아이디 중복 여부를 체크한다.
    
    그 후 db에 입력된 정보를 추가한다 (pw는 md5로)
    
    ![Untitled 4](https://github.com/y0x79min/Goorm/assets/146512434/751bcc93-509a-4151-965d-9b86f1721067)
    
    qwe의 비밀번호는 asd이므로 로그인을 해 보면
    ![Untitled 5](https://github.com/y0x79min/Goorm/assets/146512434/853c59b3-c712-4cee-b66d-bdb3e542ca6f)

    
    코드에 의해서 빈 칸 검사를 하고
    
    입력한 아이디의 비밀번호를 db에서 가져와서 비밀번호가 없으면 로그인 실패를 띄우고
    
    있으면 입력한 비밀번호를 md5해서 비교해서 같으면
    
    랜덤 값 세션을 생성 후 db에 저장하고 클라이언트 쿠키에 저장시킨 후 
    
    메인페이지로 리다이랙션 시킨다.
    
    ![Untitled 6](https://github.com/y0x79min/Goorm/assets/146512434/f4fd17a3-4f5c-443f-b35c-dd13036140c6)
    
    아까 main.php구문 중에 닉네임을 db에서 받아오는 게 있는데
    
    그것을 참고해서 닉네임을 띄워준다.
    ![Untitled 7](https://github.com/y0x79min/Goorm/assets/146512434/9a866cee-fdcf-44ef-8003-355b22c16778)
    
    쿠키를 보면 랜덤 값 세션이 저장되어 있고
    ![Untitled 8](https://github.com/y0x79min/Goorm/assets/146512434/9461f001-1b8a-4af9-adb3-a447d7304451)

    
    db에도 있다. 
    
    따로 서버를 구축해서 1분마다 time을 검사해 시간이 지났으면 지워주는 서버를 만들면 좋을것 같다.
    
    로그아웃을 누르면
    
    `echo "<button onclick='document.cookie= \"LoginSession=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;\";document.location = \"/\";'>로그아웃</button>";`
    
    쿠키를 지우고 새로고침 한다.
    
- 로그인이 실패 했을때의 스크린샷 (repository 내 있어야함)
    1. 아이디 비밀번호를 둘 다 틀렸을 때
        ![Untitled 9](https://github.com/y0x79min/Goorm/assets/146512434/845d62d3-9539-4583-b041-e9f9632338c7)

        ![Untitled 10](https://github.com/y0x79min/Goorm/assets/146512434/0cb5ce4b-e39a-458e-b470-0ea29707bdec)

        
    
    1. 아이디만 틀렸을 때
        ![Untitled 11](https://github.com/y0x79min/Goorm/assets/146512434/fc1b0ea5-e812-4dcf-8792-3fa55ec9826c)

        ![Untitled 12](https://github.com/y0x79min/Goorm/assets/146512434/ad7f2ee3-66c3-4e15-b786-e329bf0ee6d4)

        
    2. 비밀번호만 틀렸을 때
        ![Untitled 13](https://github.com/y0x79min/Goorm/assets/146512434/bca0c5e2-bb0a-439d-a006-cbc83ac57f86)
        ![Untitled 14](https://github.com/y0x79min/Goorm/assets/146512434/fac877fa-7670-4cf5-aeb3-5fa4eda6354d)

        
    
    아이디가 틀렸는지 비밀번호가 틀렸는지는 둘 중 하나는 맞다는 것을 유추 할 수도 있으니 보안이 약해질 수 있다고 생각했다.
