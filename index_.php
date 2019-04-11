<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="./bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <script src="./bootstrap.min.js"></script>
</head>
<body>
    <?php
        // DB 연결
        $connect = mysqli_connect('localhost', 'root', '0724', 'mindb') or die ("connect fail");

        // 레코드 조회 및 실행
        $query ="select * from board order by number desc";
        $result = $connect->query($query);

        // 레코드 개수
        $rowsNumber = mysqli_num_rows($result);
    ?>
    
    <?php
        // 세션 시작
        session_start();

        if (isset($_SESSION['root'])) {
            echo $_SESSION['root'];
    ?>
    <button onclick="location.href='./action/logout_action.php'" class="btn btn-default">로그아웃</button><br>
    <?php
        } else {
    ?>
        <button onclick="location.href='./static/login.php'">로그인</button>
        <button onclick="location.href='./static/join.php'">회원가입</button>
    <?php
        }
    ?>

    <div class="board">
        <h2><a onclick="location.reload()">Movie Board</a></h2>
        <div><button onclick="location.href='./static/create.php?id=<?php echo $_SESSION['root'] ?>'" class="btn btn-info btn-sm">글쓰기</button></div><br>
        <table class="table table-hover">
            <tr>
                <td>번호</td>
                <td>제목</td>
                <td>작성자</td>
                <td>날짜</td>
                <td>조회수</td>
            </tr>

        <?php
            // 레코드 리턴
            while($rows = mysqli_fetch_assoc($result)){
        ?>               
            <tr>
                <td><?php echo $rowsNumber ?></td>
                <td><a href="./static/view.php?number=<?php echo $rows['number']?>" name="link"><?php echo $rows['title'] ?></a></td>
                <td><?php echo $rows['id'] ?></td>
                <td><?php echo $rows['date'] ?></td>
                <td><?php echo $rows['hit'] ?></td>
            </tr>
            <?php
                // 레코드 개수 -1씩 (레코드 개수 = 게시글 개수 = 게시글 번호)
                $rowsNumber--;
            }
            ?>
        </table>
    </div>
    <div class="page" style="text-align:center">
        <?php

            //페이지 get 변수가 있다면 받아오고, 없다면 1페이지를 보여준다.
            if(isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }

            // 페이지 설정
            $queryCount ="select count(*) as cnt from board";
            $result = $connect->query($queryCount);
            $rowsCount = mysqli_fetch_assoc($result);

            // 게시글 페이지 개수
            $totalLine = $rowsCount['cnt'];
            $linePerPage = 5;
            $totalPage = ceil($totalLine / $linePerPage);

            if ($page<1 || $page>$totalPage) {
        ?>
        <script>
            alert("페이지 오류");
            history.back();
        </script>
        <?php
                exit;
            }   

            // 보여지는 페이지 개수
            $pagePerBlock = 5;
            $nowBlock = ceil($page / $pagePerBlock);
            $totalBlock = ceil($totalPage / $pagePerBlock);

            // 블록의 첫 페이지
            $firstPage = ($nowBlock * $pagePerBlock) - ($pagePerBlock);

            if ($nowBlock == $totalBlock) {
                $lastPage = $totalPage;
            } else {
                $lastPage = $nowBlock * $pagePerBlock;
            }

            // 페이지 이동
            $prePage = (($nowBlock - 1) * $pagePerBlock);
            $nextPage = (($nowBlock + 1) * $pagePerBlock) - ($pagePerBlock - 1);



            // 페이징을 저장할 변수
            $paging = '<ul>';
            // 첫 페이지가 아니라면 처음 버튼을 생성
            if ($page != 1) {
                $paging .= '<li class="page page_start"><a href="./index.php?page=1">처음</a></li>';
            }
            // 첫 블록이 아니라면 이전 버튼을 생성
            if ($nowBlock != 1) {
                $paging .= '<li class="page page_prev"><a href="./index.php?page='.$prePage.'">이전</a></li>';
            }
            for ($i=$firstPage; $i<=$lastPage; $i++) {
                if ($i == $page) {
                    $paging .= '<li class="page current">'.$i.'</li>';
                } else {
                    $paging .= '<li class="page"><a href=./index.php?page='.$i.'">'.$i.'</a></li>';
                }
            }
            // 마지막 블록이 아니라면 다음 버튼을 생성
            if ($page != $totalPage) {
                $paging .='<li class="page page_end"><a href="./index.php?page='.$totalPage.'">끝</a></li>';
            }
            $paging .= '</ul>';

            

            // SQL 변경 및 출력
            $currentLimit = ($linePerPage * $page) - $linePerPage; // 몇 번째의 글부터 가져오는지
            $sqlLimit = 'limit'.$currentLimit.','.$linePerPage;

            $queryLimit = 'select * from board order by desc'.$sqlLimit;
            $result = $connect->query($queryLimit);
        ?>
        <div class="paging">
            <?php echo $paging ?>
        </div>

        <!-- <nav aria-label="Page navigation">
            <ul class="pagination">
                <li><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
            </ul>
        </nav> -->
    </div>
</body>
</html>