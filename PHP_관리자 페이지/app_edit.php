<?php
  $edit_num = $_POST[ 'edit_num' ];
  $jb_conn = mysqli_connect( 'localhost', 'root', '0000', 'test' );
  $jb_sql_edit = "SELECT * FROM user WHERE num = $edit_num;";
  $jb_result = mysqli_query( $jb_conn, $jb_sql_edit );
  $jb_row = mysqli_fetch_array( $jb_result );
?>

<!doctype html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <title>Edit Employee</title>
    <style>
      body {
        font-family: Consolas, monospace;
        font-family: 12px;
      }
    </style>
  </head>
  <body>
    <h1>정보 편집</h1>
    <form action="app_update.php" method="POST">
      <input type="hidden" name="num" value="<?php echo $jb_row[ 'num' ]; ?>">
      <p>NO <?php echo $jb_row[ 'num' ]; ?></p>
      <p>ID <?php echo $jb_row[ 'id' ]; ?></p>
      <p>Name <?php echo $jb_row[ 'name' ]; ?></p>    
      <p>Tier <select name="Tier" required>
        <option value="브론즈" <?php if ( $jb_row[ 'Tier' ] == 브론즈 ) { echo 'selected'; } ?>>브론즈</option>
        <option value="실버" <?php if ( $jb_row[ 'Tier' ] == 실버 ) { echo 'selected'; } ?>>실버</option>
        <option value="골드" <?php if ( $jb_row[ 'Tier' ] == 골드 ) { echo 'selected'; } ?>>골드</option>
      </select></p>
      <button>변경</button>
    </form>
  </body>
</html>