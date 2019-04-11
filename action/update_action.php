<?php
    // DB 연결
    $connect = mysqli_connect("localhost", "root", "0724", "mindb") or die ("connect fail");

    $number = $_POST['number'];
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $date = date('Y-m-d H:i:s');

    // 레코드 업데이트 및 실행
    $query = "update board set title='$title', content='$content', date='$date' where number='$number'";
    $result = $connect->query($query);
    
    // 레코드 실행 결과
    if($result) {
?>
<script>
    alert("수정되었습니다.");
    location.replace("../static/view.php?number=<?php echo $number ?>");
</script>
<?php    
    }
    else {
        echo "오류 입니다.";
    }
?>