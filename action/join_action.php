<?php
    // DB 연결
    $connect = mysqli_connect("localhost", "root", "0724", "mindb") or die("fail");

    $id = $_POST['id'];
    $password = $_POST['password'];
    $date = date('Y-m-d H:i:s');

    // 레코드 삽입 및 실행
    $query = "insert into users (id, password, date) values ('$id', '$password', '$date')";
    $result = $connect->query($query);

    if ($result) {
?>
<script>
    alert("회원가입 되었습니다.");
    location.replace("../index.php");
</script>
<?php
    } else {
?>
<script>
    alert("가입오류 입니다.");
    location.reload();
</script>
<?php
    }
?>