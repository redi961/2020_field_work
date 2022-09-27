<?php
    $id = $_POST[ 'id' ];
    $password = $_POST[ 'pw' ]; 

  if ( !is_null( $id ) ) {
    $jb_conn = mysqli_connect(  'my8001.gabiadb.com', 'daytem', 'aassdd44**', 'ddubucks' );
    $jb_sql = "SELECT pw FROM manager WHERE id = '" . $id . "';";
    $jb_result = mysqli_query( $jb_conn, $jb_sql );
    while ( $jb_row = mysqli_fetch_array( $jb_result ) ) {
      $re_password = $jb_row[ 'pw' ];
    }

    if ( is_null( $re_password ) ) {
      $is_current_id = 1;
    } else {
      $password_hash = password_hash($re_password, PASSWORD_DEFAULT);
      if ( password_verify( $password, $password_hash ) ) {
        header( 'Location: app.php' );
      } else {
        $is_current_pw = 1;
      }
    }
  }
?>
<!doctype html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <title>로그인</title>
    <style>
      body { font-family: sans-serif; font-size: 14px; }
      input, button { font-family: inherit; font-size: inherit; }
    </style>
  </head>
  <body>
    <h1>로그인</h1>
    <form action="login.php" method="POST">
      
      <p><input type="text" name="id" placeholder="사용자이름" required></p>
      <p><input type="password" name="pw" placeholder="비밀번호" required></p>
      <p><input type="submit" value="로그인"></p>
      <?php
        if ( $is_current_id == 1 ) {
          echo "<p>사용자이름이 존재하지 않습니다.</p>";
        }
        if ( $is_current_pw == 1 ) {
          echo "<p>비밀번호가 틀렸습니다.</p>";
        }
      ?>
    </form>
  </body>
</html>