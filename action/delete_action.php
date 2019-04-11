<?php
    // DB 연결
    $connect = mysqli_connect('localhost', 'root', '0724', 'mindb') or die ("connect fail");

    $number = $_GET['number'];

    // 레코드 삭제 및 실행
    $query = "delete from board where number=$number";
    $result = $connect->query($query);
    
    // 레코드 실행 결과
    if($result) {
?>
<script>
    alert("삭제되었습니다.");
    location.replace("../index.php");
</script>
<?php    
    }
    else {
        echo "오류 입니다.";
    }
?>