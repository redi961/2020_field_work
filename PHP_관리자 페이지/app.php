<!doctype html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <title>회원정보 관리</title>
   <script>

  function search1(){
    if(frm1.search.value){
      frm1.submit();
    }else{
      location.href="app.php";
    }
  }


    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    } /* 새로 고칠 때 양식 다시 제출을 방지 */ /*필요시 사용*/


</script>  <!-- 검색함수 -->

    <style>

      body {
        font-family: Consolas, monospace;
        font-family: 12px;
      }
      table {
        width: 100%;
      }
      th, td {
        padding: 10px;
        border-bottom: 1px solid #dadada;
        text-align: center;
      }
    </style>
  </head>
  <body>

    <h1>회원정보 관리</h1>
  <div> 
                
                <form method=GET name=frm1 action='app.php'>
    검    색 
      <select name=kind>
      <option value=id selected>아이디
      <option value=name>이름
      </select>
      <input type=text size=45 name=search>
      <input type=button name=byn1 onclick="search1()" value="찾기">
      <input type=hidden name="no" value=0>
    </form>
 
               
 </div>

</form>
    <table>
      <thead>
        <tr>
          <th>회원번호</th>
          <th>아이디</th>
          <th>이름</th>
          <th>등급</th>
          <th>등급 변경</th>
          <th>적립</th>
        </tr>
      </thead>
      <tbody>

        <?php
          $jb_conn = mysqli_connect( 'my8001.gabiadb.com', 'daytem', 'aassdd44**', 'ddubucks' );
          $delete_num = $_POST[ 'delete_num' ];
          if ( isset( $delete_num ) ) {
            $jb_sql_delete = "DELETE FROM member WHERE num = '$delete_id';";
            mysqli_query( $jb_conn, $jb_sql_delete );
            echo '<p style="color: red;">Employee ' . $delete_num . ' is deleted.</p>';
          }
          $jb_sql = "SELECT * FROM member;";
          $jb_result = mysqli_query( $jb_conn, $jb_sql );
                   
           

           /*------------- 마일리지 (시험)-------*/
          if(isset($_POST["jb_test"])) { //버튼 클릭시 증가하는 쿼리
          $var = $_POST["var"];
          $add_num = $_POST[ 'add_num' ];
          mysqli_query($jb_conn,
          "UPDATE member SET num = num + '".$var."' WHERE num = $add_num;");
          header("Location: app.php");
} 
            /*------------- 마일리지 (시험)-------*/   

            /*------------- 검색기능------------- */
        if(isset($_GET['search'])){
                 $sel = $_GET['kind'];
                 $search = $_GET['search'];
        $jb_sql_search = "SELECT * FROM member WHERE $sel like '$search'";
        $jb_result = mysqli_query($jb_conn, $jb_sql_search);
        $jb_search_result = mysqli_fetch_array( $jb_result );
         $jb_edit = '
              <form action="app_edit.php" method="POST">
                <input type="hidden" name="edit_num" value="' . $jb_search_result[ 'num' ] . '">
                <input type="submit" value="Edit">
              </form>
            ';
            $jb_delete = '
              <form action="app.php" method="POST">
                <input type="hidden" name="delete_num" value="' . $jb_search_result[ 'num' ] . '">
                <input type="submit" value="Delete">
              </form>
            ';
            $jb_add = '
            <form action ="app.php" method="post">
            <input type=text name=var value= "0">
            <input type="hidden" name="add_num" value="' . $jb_search_result[ 'num' ] . '">
            <input type="button" value="증가" onClick="javascript:this.form.var.value++">
            <input type="submit" name="jb_test"  value="전달">
            </form>
             ';

            if($jb_search_result[ 'num' ] == null) {  
              echo'<br>검색 결과가 없습니다.' ;
            } else {
        echo '<tr><td>' . $jb_search_result[ 'num' ] . '</td><td>'. $jb_search_result[ 'id' ] . '</td><td>' . $jb_search_result[ 'name' ] .  '</td><td>'. $jb_search_result[ 'Tier' ] . '</td><td>' . $jb_edit . '</td><td>' . $jb_add . '</td></tr>';}
    }


            /*------------- 검색기능------------- */  
          
            

          while( $jb_row = mysqli_fetch_array( $jb_result ) ) {
            $jb_edit = '
              <form action="app_edit.php" method="POST">
                <input type="hidden" name="edit_num" value="' . $jb_row[ 'num' ] . '">
                <input type="submit" value="Edit">
              </form>
            ';
            $jb_delete = '
              <form action="app.php" method="POST">
                <input type="hidden" name="delete_num" value="' . $jb_row[ 'num' ] . '">
                <input type="submit" value="Delete">
              </form>
            ';
            $jb_add = '
            <form action ="app.php" method="post">
            <input type=text name=var value= "0">
            <input type="hidden" name="add_num" value="' . $jb_row [ 'num' ] . '">
            <input type="button" value="증가" onClick="javascript:this.form.var.value++">
            <input type="submit" name="jb_test"  value="전달">
            </form>
             ';
                     
            echo '<tr><td>' . $jb_row[ 'num' ] . '</td><td>'. $jb_row[ 'id' ] . '</td><td>' . $jb_row[ 'name' ] .  '</td><td>'. $jb_row[ 'Tier' ] . '</td><td>' . $jb_edit . '</td><td>'  . $jb_add . '</td></tr>';
          }


        
        ?>

      </tbody>
    </table>
  </body>
</html>