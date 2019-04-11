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
    <div class="boardCreate">
        <h2><a onclick="location.href='../index.php'">Movie Board</a></h2>
        <form action="../action/create_action.php" method="post">
            <table class="table table-bordered">
                <?php
                    // 로그인 시 활성화
                    session_start();
                    
                    if (isset($_SESSION['root'])) {
                ?>
                <tr>
                    <td>작성자</td>
                    <td><input type="text" name="id" value="<?php echo $_SESSION['root'] ?>"></td>
                </tr>
                <?php
                }
                ?>
                <tr>
                    <td>비밀번호</td>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <td>제목</td>
                    <td><input type="text" name="title"></td>
                </tr>
                <tr>
                    <td>내용</td>
                    <td>
                        <input type="file" name="upload"><br>
                        <textarea name="content" rows="15" cols="80"></textarea>
                    </td>
                </tr>
            </table>
            <div style="text-align:center">
                <input class="btn btn-info btn-sm" style="text-align:center" type="submit" name="submit" value="작성하기" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>
</html>