<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Board</title>
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
    <div style="text-align:right">
        <?php
            // 세션 시작
            session_start();

            if (isset($_SESSION['root'])) {
                echo "<span style='color:#2e6da4'>".$_SESSION['root']." 님 안녕하세요.</span>";
        ?>
        <button onclick="location.href='./action/logout_action.php'" class="btn btn-default btn-xs">로그아웃</button><br>
        <?php
            } else {
        ?>
            <button class="btn btn-info btn-xs" onclick="location.href='./static/login.php'">로그인</button>
            <button class="btn btn-info btn-xs" onclick="location.href='./static/join.php'">회원가입</button>
        <?php
            }
        ?>
    </div>
    <div class="boardIndex">
    <h2><a onclick="location.reload()">Movie Board</a></h2>
    <?php
        if (isset($_SESSION['root'])) {
    ?>
            <div style="text-align:right;"><button onclick="location.href='./static/create.php?id=<?php echo $_SESSION['root'] ?>'" class="btn btn-info btn-sm">글쓰기</button></div><br>
    <?php
        }
    ?>
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
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
            </ul>
        </nav>
    </div>
</body>
</html>