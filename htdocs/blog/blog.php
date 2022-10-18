<?php
    include "../connect/connect.php";
    include "../connect/session.php";
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 사이트 만들기</title>

    <?php include "../include/link.php" ?>
</head>
<body>
    <div id="skip">
        <a href="#header">헤더 영역 바로가기</a>
        <a href="#main">컨텐츠 영역 바로가기</a>
        <a href="#footer">푸터 영역 바로가기</a>
    </div>
    <!-- //skip -->

    <?php include "../include/header.php" ?>
    <!-- //header -->

    <main id="main">
        <section id="banner">
        </section>
        <!-- //banner -->

        <section id="card" class="container">
            <h2>javascript topic</h2>
            <div class="card__inner">
<?php
    $sql = "SELECT * FROM myBlog WHERE blogDelete = 0 ORDER BY myBlogID DESC ";
    $result = $connect -> query($sql);
    foreach($result as $blog) {?>
        <figure>
        <img src="../assets/img/blog/<?=$blog['blogImgFile']?>" alt="사진4">
            <a href="#" class="go" title="컨텐츠 바로가기"></a>
        </figure>
        <div>
            <h3><?=$blog['blogTitle']?></h3>
            <p><?=$blog['blogContents']?></p>
        </div>
<?php
}
?>
                
            </div>
        </section>
        <!-- //card -->

    </main>
    <!-- //main -->

    <?php include "../include/footer.php" ?>
    <!-- //footer -->

    <?php include "../login/login.php" ?>
    <!-- //login -->
</body>
</html>