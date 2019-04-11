<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Board</title>
    <link rel="stylesheet" type="text/css" href="../bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
    <?php
        // DB 연결
        $connect = mysqli_connect('localhost', 'root', '0724', 'mindb') or die ("connect fail");
        $number = $_GET['number'];

        // 조회수 업데이트
        $queryHit = "update board set hit=hit+1 where number='$number'";
        $result = $connect->query($queryHit);

        // board 조회 및 실행
        $query = "select id, password, title, content, date, hit from board where number='$number'";
        $result = $connect->query($query);

        // 레코드 리턴
        $rows = mysqli_fetch_assoc($result);

        $id = $rows['id'];
        $password = $rows['password'];
        $title = $rows['title'];
        $content = $rows['content'];
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
            <button class="btn btn-info btn-xs" onclick="location.href='./login.php'">로그인</button>
            <button class="btn btn-info btn-xs" onclick="location.href='./join.php'">회원가입</button>
        <?php
            }
        ?>
    </div>
    <div class="boardView">
        <h2><a onclick="location.href='../index.php'">Movie Board</a></h2>
        <form action="">
            <table class="table table-bordered">
                <tr>
                    <td>작성자</td>
                    <td><?php echo $id ?></td>
                </tr>
                <tr>
                    <td>제목</td>
                    <td><?php echo $title ?></td>
                </tr>
                <tr>
                    <td>내용</td>
                    <td style="height:400px; width:630px; "><?php echo $content ?></td>
                </tr>
            </table>
        </form>
        <?php
            // 로그인 시 활성화
            session_start();
            if (isset($_SESSION['root'])) {
        ?>
        <div style="text-align:center">
            <button class="btn btn-info btn-sm" onclick="location.href='../index.php?'">목록보기</button>
            <button class="btn btn-info btn-sm" onclick="location.href='./update.php?number=<?php echo $number?>'">수정하기</button>
            <button class="btn btn-info btn-sm" onclick="location.href='../action/delete_action.php?number=<?php echo $number ?>'">삭제하기</button>
        </div><br>
        <?php
            }
        ?>
    </div>
</body>
</html>