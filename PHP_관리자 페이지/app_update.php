<!doctype html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <title>Update</title>
    <style>
      body {
        font-family: Consolas, monospace;
        font-family: 12px;
      }
    </style>
  </head>
  <body>
    <?php
      $num = $_POST[ 'num' ];
      $birth_date = $_POST[ 'birth_date' ];
      $name = $_POST[ 'name' ];
      $Tier = $_POST[ 'Tier' ];
      if ( is_null( $num ) ) {
        echo '<h1>Fail!</h1>';
      } else {
        $jb_conn = mysqli_connect( 'localhost', 'root', '0000', 'test'  );
        $jb_sql = "UPDATE user SET Tier = '$Tier' WHERE num = $num;";
        mysqli_query( $jb_conn, $jb_sql );
        echo '<h1>Success!</h1>';
      }
    ?>
    <p>
      <a href="app.php">회원관리 페이지로</a>
     </p>
  </body>
</html>