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
    <div class="boardJoin">
    <h2><a onclick="location.href='../index.php'">Movie Board</a></h2>
        <form action="../action/join_action.php" method="post">
            <div>
                <table class="table table-bordered">
                    <tr>
                        <td><label for="id">아이디</label></td>
                        <td><input type="text" name="id" id="id"></td>
                    </tr>
                    <tr>
                        <td><label for="password">패스워드</label></td>
                        <td><input type="password" name="password" id="password"></td>
                    </tr>
                </table>
                <div style="text-align:center">
                    <input class="btn btn-info btn-sm" type="submit" value="가입">
                    <input class="btn btn-info btn-sm" type="reset" value="취소">
                </div>
            </div>
        </form>
    </div>
</body>
</html>