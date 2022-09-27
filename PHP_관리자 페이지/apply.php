<!doctype html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <title>Employees</title>
    <style>
      body {
        font-family: Consolas, monospace;
        font-family: 12px;
      }
      table {
        width: 60%;
      }
      th, td, h3 {
        padding: 10px;
        border-bottom: 1px solid #dadada;
        text-align: center;
      }
    </style>
  </head>
  <body>
    <div style="border:2px; float:left;">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>이름</th>
          <th>번호</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php

          $jb_conn = mysqli_connect( '192.168.0.106', 'NewTest2', '1q2w3e4r!!', 'test'  );
          $delete_emp_no = $_POST[ 'delete_emp_no' ];
          if ( isset( $delete_emp_no ) ) {
            $jb_sql_delete = "DELETE FROM user WHERE id = '$delete_emp_no';";
            mysqli_query( $jb_conn, $jb_sql_delete );
            echo '<p style="color: red;">Employee ' . $delete_emp_no . ' is deleted.</p>';
          }
          $jb_sql = "SELECT * FROM user LIMIT 5;";
          $jb_result = mysqli_query( $jb_conn, $jb_sql );
          while( $jb_row = mysqli_fetch_array( $jb_result ) ) {
            $jb_edit = '
              <form action="app_edit.php" method="POST">
                <input type="hidden" name="edit_emp_no" value="' . $jb_row[ 'emp_no' ] . '">
                <input type="submit" value="Edit">
              </form>
            ';
            $jb_delete = '
              <form action="employees.php" method="POST">
                <input type="hidden" name="delete_emp_no" value="' . $jb_row[ 'emp_no' ] . '">
                <input type="submit" value="Delete">
              </form>
            ';
            echo '<tr><td>' . $jb_row[ 'id' ] . '</td><td>'. $jb_row[ 'name' ] . '</td><td>' . $jb_row[ 'num' ] . '</td><td>' . $jb_edit . '</td><td>' . $jb_delete . '</td></tr>';
          }

          if(isset($_POST["test"])) { //버튼 클릭시 증가하는 쿼리
          $var = $_POST["var"]; 
          mysqli_query($jb_conn,"UPDATE user
          SET num = num + '".$var."'  
          WHERE ID='aaaa'");
}
        ?>
      </tbody>
    </table>
    </div>
     <div style="width:30%; height:300px; border:2px; float:right;">
          <h3>적립 부분</h3>
      <form method="post">
     <input type=text name=var value=0>
     <input type="button" value="증가" onClick="javascript:this.form.var.value++;" />
     <input type="submit" name="test" id="test" value="전달" />
    </form>
    </div>

   

  </body>
</html>