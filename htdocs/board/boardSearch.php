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
    <title>게시판</title>

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
        <section id="board" class="container">
            <h2>게시판 영역입니다.</h2>
            <div class="board__inner">
                <div class="board__title">
                    <h3>검색 결과 게시판</h3>
                </div>
<?php
    function msg($alert){
        echo "<p>총 ".$alert."건이 검색되었습니다.</p>";
    }

    $searchKeyword = $_GET['searchKeyword'];
    $searchOption = $_GET['searchOption'];
    
    $searchKeyword = $connect -> real_escape_string(trim($searchKeyword));
    $searchOption = $connect -> real_escape_string(trim($searchOption));

    $sql = "SELECT b.myBoardID, b.boardTitle, b.boardContents, m.youName, b.regTime, b.boardView FROM myBoard b JOIN myMember m ON(b.myMemberID = m.myMemberID) ";

    switch($searchOption){
        case "title":
            $sql .= "WHERE b.boardTitle LIKE '%{$searchKeyword}%' ORDER BY myBoardID DESC ";
            break;
        case "content":
            $sql .= "WHERE b.boardContents LIKE '%{$searchKeyword}%' ORDER BY myBoardID DESC ";
            break;
        case "name":
            $sql .= "WHERE m.youName LIKE '%{$searchKeyword}%' ORDER BY myBoardID DESC ";
            break;
    }

    $result = $connect -> query($sql);
    
    // 전체 게시글 갯수
    $count = $result -> num_rows;
    msg($count);
?>
                <div class="board__table">
                    <table>
                        <colgroup>
                            <col style="width: 5%">
                            <col>
                            <col style="width: 10%">
                            <col style="width: 10%">
                            <col style="width: 7%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>번호</th>
                                <th>제목</th>
                                <th>등록자</th>
                                <th>등록일</th>
                                <th>조회수</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
    if(isset($_GET['page'])){
        $page = (int)$_GET['page'];
    } else {
        $page = 1;
    }

    $viewNum = 10;
    $viewLimit = ($viewNum * $page) - $viewNum;

    $sql = $sql."LIMIT {$viewLimit}, {$viewNum}";
    $result = $connect -> query($sql);


    if($count > 0){
        for($i=1; $i <= $count; $i++){
            $info = $result -> fetch_array(MYSQLI_ASSOC);
            echo "<tr>";
            echo "<td>".$info['myBoardID']."</td>";
            echo "<td><a href='boardView.php?myBoardID={$info['myBoardID']}'>".$info['boardTitle']."<a/></td>";
            echo "<td>".$info['youName']."</td>";
            echo "<td>".date('Y-m-d', $info['regTime'])."</td>";
            echo "<td>".$info['boardView']."</td>";
            echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>게시글이 없습니다.</td></tr>";
        }
?>                      </tbody>
                    </table>
                </div>
                <div class="board__pages">
                    <ul>
<?php

?>                        
                    </ul>
                </div>
            </div>
        </section>
    </main>
    <!-- //main -->

    <?php include "../include/footer.php" ?>
    <!-- //footer -->
</body>
</html>