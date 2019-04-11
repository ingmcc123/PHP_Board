<?php
    // DB 연결
    $connect = mysqli_connect("localhost", "root", "0724", "mindb") or die("fail");

    // 세션 시작
    session_start();

    $id = $_POST['id'];
    $password = $_POST['password'];

    // 레코드 조회 및 실행
    $query = "select * from users where id='$id'";  
    $result = $connect->query($query);
    
    // 레코드 개수 및 배열 리턴
    $num = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

    if ($num == 1) {

        // 패스워드 확인 세션 생성
        if ($row['password'] == $password) {

            $_SESSION['root'] = $id;
?>
<script>
    location.replace("../index.php");
</script>
<?php
        } else {
            echo "session fail!!!";
        }
    }
?>