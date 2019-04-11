<?php
    // DB 연결
    $connect = mysqli_connect("localhost", "root", "0724", "mindb") or die("fail");
    
    $id = $_POST['id'];
    $pw = $_POST['password'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $date = date('Y-m-d H:i:s');

    // 이미지 업로드
    $target_dir = "../uploads/";
    $target_file = $target_dir.basename($_FILES["fileToUpload"]["tmp_name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // 이미지 파일 확인
    if(isset($_POST['submit'])) {
        $check = getimagesize($_FILES["fileToUpload"]);
        if($check != false) {
            echo "이미지 파일입니다. = ".$check['mime'].".";
            $uploadOk = 1;
        } else {
            echo "이미지 파일이 아닙니다.";
            $uploadOk = 0;
        }
    }

    // 파일 크기 확인
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "파일 용량 초과했습니다.";
        $uploadOk = 0;
    }

    // 파일 형식 확인
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "허용된 이미지 파일 형식이 아닙니다.";
        $uploadOk = 0;
    }

    // 파일 업로드 에러 확인
    if ($uploadOk == 0) {
        echo "업로드 할 수 없습니다.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "<p>The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.</p>";
            echo "<br><img src=../uploads/". basename( $_FILES["fileToUpload"]["name"]). ">";
            echo "<br><button type='button' onclick='history.back()'>돌아가기</button>";
        } else {
            echo "<p>Sorry, there was an error uploading your file.</p>";
            echo "<br><button type='button' onclick='history.back()'>돌아가기</button>";


        }
    }

    // 레코드 삽입 및 실행
    $query = "insert into board (number, title, content, id, password, date, hit) 
            values(null, '$title', '$content', '$id', '$password','$date', 0)";
    $result = $connect->query($query);

    // 레코드 실행 결과
    if($result){
?>
<script>
    alert("<?php echo "글이 등록되었습니다." ?>");
    location.replace("../index.php");
</script>
<?php
    }
    else{
        echo "오류 입니다.";
    }

    mysqli_close($connect);
?>