<!DOCTYPE html>
<html lang="ko">
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

        // 레코드 조회 및 실행
        $query = "select id, password, title, content from board where number='$number'";
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
    <div class="boardUpdate">
        <h2><a onclick="location.href='../index.php'">Movie Board</a></h2>
        <form action="../action/update_action.php" method="post">
            <table class="table table-bordered">
                <tr>
                    <td>작성자</td>
                    <td><input type="text" name="id" value="<?php echo $id ?>"></td>
                </tr>
                <tr>
                    <td>비밀번호</td>
                    <td><input type="password" name="password" value="<?php echo $password ?>"></td>
                </tr>
                <tr>
                    <td>제목</td>
                    <td><input type="text" name="title" value="<?php echo $title ?>"></td>
                </tr>
                <tr>
                    <td>내용</td>
                    <td><textarea name="content" rows="15" cols="80"><?php echo $content ?></textarea></td>
                </tr>
            </table>
            <div style="text-align:center">
                <input type="hidden" name="number" value="<?php echo $number ?>">
                <input class="btn btn-info btn-sm" type="submit" value="수정하기">
            </div>
        </form>
    </div>
</body>
</html>