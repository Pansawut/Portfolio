<?php
include("connection.php");

if(isset($_POST["view"])){
  $view = $_POST["view"];
  $id = $_POST["id"];
  $user_id = trim($_POST["user_id"]);
  $output = '';
// from here
  // if($view == ""){
    $query = "SELECT * FROM notifications WHERE member_num = '$user_id' AND NOW() >= msg_time ORDER BY msg_time DESC;";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_array($result)){ 
        if($row["click_status"] >0){
          $style = "background-color: #FFFFFF;";
        }else{
          $style = "background-color: #D3CCCC;";
        }
        // notification for assign case
        if($row["noti_type"] == "assign"){
          $output .= '
          <li class="assign_list" style="'.$style.'" id="'.$row["noti_ids"].'" onclick="return false;">
            <a class="dropdown-item"  href="">
              <strong>Case Assigned To You</strong><br />
              <small><em>'.$row["msg_text"].'</em></small><br/>
              <small data-livestamp="">'.$row["msg_time"].'</small>
              <input type="hidden" id="hidden_caseNum" value="'.$row["case_num"].'">
            </a>
          </li>
          <li class="divider"></li>';
        }
        // notification for server update logs
        // hidden version control used as caseNum column**
        if($row["noti_type"] == "update"){
          $output .= '
          <li class="update_list" style="'.$style.'" id="'.$row["noti_ids"].'" onclick="return false;">
            <a class="dropdown-item"  href="">
              <strong>System Updated '.$row["case_num"].'</strong><br />
              <small><em>Click here to checkout the changes log.</em></small><br/>
              <small data-livestamp="">'.$row["msg_time"].'</small>
              <input type="hidden" id="hidden_version" value="'.$row["case_num"].'">
            </a>
          </li>
          <li class="divider"></li>';
        }
      }
    }else{
      $output .= '<li><a href="" class="text-bold text-italic" >No Notification</a></li>';
    }
  // }
  if($view == "read"){
    $update_query_read = "UPDATE notifications SET read_stat=1 WHERE read_stat=0 AND member_num = '$user_id' AND NOW() >= msg_time";
    mysqli_query($conn, $update_query_read);
  }
  if($view == "clicked"){
    $update_query_clicked = "UPDATE notifications SET click_status=1 WHERE click_status=0 AND noti_ids=".$id.""; // set to black
    mysqli_query($conn, $update_query_clicked);
  }


// to there

  // if($view != ''){
  //   $update_query = "UPDATE notifications SET read_stat=1 WHERE read_stat=0 AND member_num = '$user_id' AND CURRENT_TIME >= msg_time";
  //   mysqli_query($conn, $update_query);
  // }
  // $query = "SELECT * FROM notifications WHERE member_num = '$user_id' AND CURRENT_TIME >= msg_time ORDER BY msg_time DESC";
  // $result = mysqli_query($conn, $query);
  // $output = '';

  // if(mysqli_num_rows($result) > 0){
  //   while($row = mysqli_fetch_array($result)){ 
  //     if($row["click_status"] >0){
  //       $style = "background-color: #FFFFFF;";
  //     }else{
  //       $style = "background-color: #D3CCCC;";
  //     }
  //     // notification for assign case
  //     if($row["noti_type"] == "assign"){
  //       $output .= '
  //       <li class="assign_list" style="'.$style.'" id="'.$row["noti_ids"].'" onclick="return false;">
  //         <a class="dropdown-item"  href="">
  //           <strong>Case Assigned To You</strong><br />
  //           <small><em>'.$row["msg_text"].'</em></small><br/>
  //           <small data-livestamp="">'.$row["msg_time"].'</small>
  //           <input type="hidden" id="hidden_caseNum" value="'.$row["case_num"].'">
  //         </a>
  //       </li>
  //       <li class="divider"></li>';
  //     }
  //     // notification for server update logs
  //     // hidden version control used as caseNum column**
  //     if($row["noti_type"] == "update"){
  //       $output .= '
  //       <li class="update_list" style="'.$style.'" id="'.$row["noti_ids"].'" onclick="return false;">
  //         <a class="dropdown-item"  href="">
  //           <strong>System Updated '.$row["case_num"].'</strong><br />
  //           <small><em>Click here to checkout the changes log.</em></small><br/>
  //           <small data-livestamp="">'.$row["msg_time"].'</small>
  //           <input type="hidden" id="hidden_version" value="'.$row["case_num"].'">
  //         </a>
  //       </li>
  //       <li class="divider"></li>';
  //     }
  //   }
  //   $update_query = "UPDATE notifications SET click_status=1 WHERE click_status=0 AND noti_ids=".$id.""; // set to black
  //   mysqli_query($conn, $update_query);
  // }else{
  //   $output .= '<li><a href="" class="text-bold text-italic" >No Notification</a></li>';
  // }

  $countNoti_Query = "SELECT * FROM notifications WHERE read_stat=0 AND member_num = '$user_id' AND NOW() >= msg_time";
  $countResult = mysqli_query($conn, $countNoti_Query);
  $count = mysqli_num_rows($countResult);

  // printf("error: %s\n", mysqli_error($conn));

  $data = array(
    'notification'   => $output,
    'unseen_notification' => $count
  );
  echo json_encode($data);

  mysqli_close($conn);

}
?>