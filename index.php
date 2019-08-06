<?php session_start(); 
// ob_start();
require ("connection.php");
include ("include/check_session.php");
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title class="titleNoti">Jump Starter Co.,Ltd || CS Management System.</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="debug/toastr.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link rel="shortcut icon" type="image/x-icon" href="vendor/images/LOGO-Jumpstarter-180.png">
    <link href="css/logo-nav.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/fontawesome-all.css" rel="stylesheet" type="text/css">
    <style>
      .ui-autocomplete {
        max-height: 200px;
        overflow-y: auto;
        /* prevent horizontal scrollbar */
        overflow-x: hidden;
      }

          #container {
      width: 700px;
    }
    h1 { font-size: 3.8em; color: #257ce9; margin-bottom: 3px; }
    h1 .small { font-size: 0.4em; }
    h1 a { text-decoration: none }
    h2 { font-size: 1.5em; color: #257ce9; }
    h3 { text-align: center; color: #257ce9; }
    a { color: #257ce9; }
    .description { font-size: 1.2em; margin-bottom: 30px; margin-top: 30px; font-style: italic;}
    .download { float: right; }
    pre { background: #000; color: #fff; padding: 15px;}
    hr { border: 0; width: 80%; border-bottom: 1px solid #aaa}
    .footer { text-align:center; padding-top:30px; font-style: italic; }




      .cardStyle {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        width: 40%;
        border-radius: 5px;
      }
      .cardStyle:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
      }
      .fake-link {
        color: blue;
        text-decoration: underline;
        cursor: pointer;
      }
      .cardStyle1 {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        border-radius: 5px;
      }
      .cardStyle1:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        cursor: pointer;
      }
      .deleteComp{
        cursor: pointer;
        color: red;
      }
      a.chartType{
        background:#bg-light;
        color:#1AAB8A;
        border:none;
        position:relative;
        height:60px;
        font-size:1.6em;
        padding:0 2em;
        cursor:pointer;
        transition:800ms ease all;
        outline:none;
        text-decoration: none;

      }

      a.chartType:before,a.chartType:after{
        content:'';
        position:absolute;
        top:0;
        right:0;
        height:2px;
        width:0;
        background: #1AAB8A;
        width:100%;
        transition:400ms ease all;
      }
      a.chartType:after{
        right:inherit;
        top:inherit;
        left:0;
        bottom:0;
        width:100%;
      }
      a.chartType:hover:before,a.chartType:hover:after{
        width:0%;
        transition:800ms ease all;
      }
      #report_graph_div{
        width:90% !important;
        height:70% !important;
      }
      .divider {
        margin-top: .1rem;
        margin-bottom: .1rem;
        border: 0;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
      }
      .gg{
        font-weight: bold;
        color: black;
        background: #FF0000;
        border-radius: 15px;
        /* width: 10px;*/
        letter-spacing: 2px;
      }
      .dropdown-menu > li > a:hover {
        background-color: #837676;
      }
      .notification {
          display: inline-block;
          position: relative;
          padding: 0.6em;
          background: #3498db;
          border-radius: 0.2em;
          font-size: 1.3em;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      }

      .notification::before, 
      .notification::after {
          color: #fff;
          text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
      }

      .notification::before {
          display: block;
          content: "\f0f3";
          font-family: "FontAwesome";
          transform-origin: top center;
      }

      .notification::after {
          font-family: Arial;
          font-size: 0.7em;
          font-weight: 700;
          position: absolute;
          top: -15px;
          right: -15px;
          padding: 5px 8px;
          line-height: 100%;
          border: 2px #fff solid;
          border-radius: 60px;
          background: #3498db;
          opacity: 0;
          content: attr(data-count);
          opacity: 0;
          -webkit-transform: scale(0.5);
          transform: scale(0.5);
          transition: transform, opacity;
          transition-duration: 0.3s;
          transition-timing-function: ease-out;
      }

      .notification.notify::before {
          -webkit-animation: ring 1.5s ease;
          animation: ring 1.5s ease;
      }

      .notification.show-count::after {
          -webkit-transform: scale(1);
          transform: scale(1);
          opacity: 1;
      }
      #style-1::-webkit-scrollbar-track{
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        border-radius: 10px;
        background-color: #F5F5F5;
      }

      #style-1::-webkit-scrollbar{
        width: 12px;
        background-color: #F5F5F5;
      }

      #style-1::-webkit-scrollbar-thumb{
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color: #555;
      }
    </style>
  </head>
  <body class="bg-light">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-info fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php">
          <img src="vendor/images/LOGO-Jumpstarter-180.png" width="70" height="50" alt="logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <!-- notification bell -->
            <li class="nav-item dropdown">
              <a class="nav-link btn2" href="#" data-toggle="dropdown"><span class="count gg"></span> <i class="fas fa-bell"></i></a>
              <div class="dropdown-menu dropdown-menu-right">
                <div id="style-1" class="dropdown-item btn1" style=" max-height:250px; overflow:auto; "></div>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" id="accountDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="fas fa-fw fa-user" style="font-size:18px;"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <?php 
                if ($_SESSION["role"] == "SADMIN") {
                  echo "<a class='dropdown-item' href='' id='add_company_link' data-toggle='modal' data-target='#add_company_modal'>Add Company</a>";
                  echo "<a class='dropdown-item' href='' id='add_account_link' data-toggle='modal' data-target='#add_account_modal'>Add Account</a>";
                  echo "<a class='dropdown-item' href='' id='manage_account_link' data-toggle='modal' data-target='#manage_account_modal'>Manage User</a>";
                  echo "<a class='dropdown-item' href='' id='announce_link' data-toggle='modal' data-target='#announce_modal'>Announce User(s)</a>";
                }
                ?>
                <a class="dropdown-item" href="" id="edit_account_link" data-toggle="modal" data-target="#edit_account_modal">Edit Account</a>
                <?php 
                if ($_SESSION["role"] == "SUPERVISOR") {
                  echo "<a class='dropdown-item' href='' id='add_company_link' data-toggle='modal' data-target='#add_company_modal'>Add Company</a>";
                  echo "<a class='dropdown-item' href='' id='add_account_link' data-toggle='modal' data-target='#add_account_modal'>Add Account</a>";
                  echo "<a class='dropdown-item' href='' id='manage_account_link' data-toggle='modal' data-target='#manage_account_modal'>Manage User</a>";
                }
                ?>
                <?php 
                if ($_SESSION["role"] == "MANAGER") {
                  echo "<a class='dropdown-item' href='' id='add_company_link' data-toggle='modal' data-target='#add_company_modal'>Add Company</a>";
                }
                ?>
                <?php
                if ($_SESSION["role"] == "SADMIN" || $_SESSION["role"] == "ADMIN" || $_SESSION["role"] == "SUPERVISOR" || $_SESSION["role"] == "AGENT" || $_SESSION["role"] == "MANAGER") {
                  echo "<a class='dropdown-item' href='' id='import_customer_link' data-toggle='modal' data-target='#import_customer_modal'>Import Customers</a>";
                }
                ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">Log Out</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="jumbotron text-center">
      <h1 class="display-4">Welcome!</h1>
      <?php 
      if ($_SESSION['role'] == "SADMIN") {
        $loggedAs = "Super Admin";
      }else if ($_SESSION['role'] == "ADMIN") {
        $loggedAs = "Admin";
      }else if ($_SESSION['role'] == "SUPERVISOR") {
        $loggedAs = "SUPERVISOR";
      }else if ($_SESSION['role'] == "AGENT") {
        $loggedAs = "AGENT";
      }else if ($_SESSION['role'] == "MANAGER") {
        $loggedAs = "MANAGER";
      }else{
        $loggedAs = "User";
      }
      echo "<p class='lead'>You are logged in as: ".$loggedAs." </p>";
      ?>
      <p class="lead">This is a Client Management System for Customer Service.</p>
      <hr class="my-4">
      <p>Start by searching for Client's phone number or Name.</p>
      <div class="input-group">
        <div class="input-group-prepend">
          <button class="btn btn-outline-primary" id="searchBtn" name="searchBtn" type="button" disabled>Search</button>
        </div>
        <input type="text" class="form-control" id="mainSearchInput" name="mainSearchInput" placeholder="phone number or name...">
        <input type="hidden" name="hidden_client_id" id="hidden_client_id">
        <input type="hidden" name="hidden_session_id" id="hidden_session_id" value="<?php echo $_SESSION['user_ids']; ?>">
        <input type="hidden" name="hidden_session_role" id="hidden_session_role" value="<?php echo $_SESSION['role']; ?>">
        <input type="hidden" name="hidden_user_compId" id="hidden_user_compId" value="<?php echo $_SESSION['company_number']; ?>">
        <input type="hidden" name="hidden_clicked_dashboard" id="hidden_clicked_dashboard">
        <?php 
        $sessionId = $_SESSION['user_ids'];
        $strSQL = "SELECT * FROM members WHERE user_ids = '$sessionId'";
        $objQuery = mysqli_query($conn,$strSQL);
        while($objResult = mysqli_fetch_array($objQuery))
        {
          echo '<input type="hidden" name="hidden_session_name" 
          id="hidden_session_name" value="'.$objResult["fname"].' '.$objResult["lname"].'">';
        }
        ?>
      </div>
      <div>
        <br>
        <a href="#" id="newClientBtn" name="newClientBtn" onclick=" return false;">New Client?</a>
      </div>
    </div>
    <div class="text-center mb-3">
      <button type="button" id="newCaseBtn" name="newCaseBtn" class="btn btn-outline-info">New Case <i class="fas fa-plus-circle"></i></button>
    </div>
    <!-- display graph here -->
    <div class="text-center mb-3 col-md-12" id="menu_graph">
      <a class="chartType" href="#" id="showTop5_link" onclick=" return false;">Top 5 Categories</a>
      <a class="chartType" href="#" id="showCall_link" onclick=" return false;">Call Report</a>
    </div>
    <div class="content-wrapper mb-3" id="report_div" style="display: none;">
      <div class="container-fluid">
        <div class="form-row col">
          <div id="range-selector">
            <input type="button" id="1m" class="period btn btn-secondary" data-toggle="tooltip" 
            data-placement="bottom" title="*First day of last month till now" value="1m" />
            <input type="button" id="3m" class="period btn btn-secondary" data-toggle="tooltip" 
            data-placement="bottom" title="*First day of last 2 months till now" value="3m"/>
            <input type="button" id="6m" class="period btn btn-secondary" data-toggle="tooltip" 
            data-placement="bottom" title="*First day of last 5 months till now" value="6m"/>
            <input type="button" id="1y" class="period btn btn-secondary" data-toggle="tooltip" 
            data-placement="bottom" title="*First day of the year till now" value="1y"/>
            <input type="button" id="1d" class="period btn btn-secondary" data-toggle="tooltip" 
            data-placement="bottom" title="*Start of the day till now" value="Today"/>
          </div>
          <div class="mx-auto">
           <select class="form-control" id="graph_selectComp">
            <?php 
            if($_SESSION['role'] == "SADMIN"){
              $strSQL = "SELECT * FROM company";
              $objQuery = mysqli_query($conn,$strSQL);
              while($objResult = mysqli_fetch_array($objQuery))
              {
                echo '<option value="'.$objResult["comp_ids"].'">'.$objResult["comp_name"].'</option>';
              }
            }else{
              $sessionId = $_SESSION['user_ids'];
              $strSQL = "SELECT c.* FROM company AS c INNER JOIN work_on AS w ON w.comp_workon_id = c.comp_ids WHERE w.member_id = '$sessionId'";
              $objQuery = mysqli_query($conn,$strSQL);
              while($objResult = mysqli_fetch_array($objQuery))
              {
                echo '<option value="'.$objResult["comp_ids"].'">'.$objResult["comp_name"].'</option>';
              }
            }
            ?>
           </select>
          </div>
          <div id="date-selector" style="float:right;"  class="form-inline">
            <div class="form-group">
              <input type="text" id="fromDate" class="form-control datePicker" placeholder="From:">
              <input type="text" id="toDate" class="form-control datePicker" placeholder="To:">
              <input type="button" class="btn btn-primary" id="filter_btn" value="Filter">
            </div>
            <div class="form-group">
              <button class="btn btn-info" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-download"></i>
              </button>
              <div class="dropdown-menu" id="download-dropdown">
                <a class="dropdown-item" style="cursor:pointer;" id="export_jpg">Export .JPEG</a>
                <a class="dropdown-item" style="cursor:pointer;" id="export_png">Export .PNG</a>
                <a class="dropdown-item" style="cursor:pointer;" id="export_xlsx">Export .xlsx</a>
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="container-fluid" id="report_graph_div">
            <canvas id="pieChart" class="text-center" style="display: none;">PIE CHART</canvas>
            <canvas id="lineChart" class="text-center" style="display: none;">LINE CHART</canvas>
            <input type="hidden" id="hidden_linechart_range" name="hidden_linechart_range">
            <input type="hidden" id="hidden_piechart_range" name="hidden_piechart_range">
          </div>
        </div>
      </div>
    </div>
    <!-- end graph div -->
    <div class="content-wrapper" id="dashboard_user">
      <div class="container-fluid">
        <div class="row mb-3">
          <div class="col-xl-3 col-lg-6 col-12" id="open_case_card">
            <div class="card cardStyle1">
              <div class="card-content">
                <div class="media align-items-stretch">
                  <div class="p-2 text-white media-body text-left rounded-left" style="background: linear-gradient(to right,gold,gold,gold,gold,white );">
                    <h5 class="text-white">OPENED CASE(s)</h5>
                    <h5 class="text-white text-bold-400 mb-0">
                    <?php 
                    $strSQL = "SELECT COUNT(case_number) AS openedCase FROM client_cases AS cc
                      LEFT JOIN clients AS c ON c.client_ids = cc.case_client_id
                      WHERE c.comp_number in (SELECT comp_workon_id from work_on where member_id = '$sessionId') AND status='OPEN' ";
                    $objQuery = mysqli_query($conn,$strSQL);
                    while($objResult = mysqli_fetch_array($objQuery))
                    {
                      echo $objResult["openedCase"];
                    }
                    ?>
                    </h5>
                  </div>
                  <div class="p-2 text-center  bg-darken-2 rounded-right" style="background-color: gold;">
                    <i class="fas fa-folder-open text-white" style="font-size: 48px;"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-12" id="pending_case_card">
            <div class="card cardStyle1">
              <div class="card-content">
                <div class="media align-items-stretch">
                  <div class="p-2 text-white media-body text-left rounded-left"style="background: linear-gradient(to right,orange,orange,orange,orange,white);">
                    <h5 class="text-white">PENDING CASE(s)</h5>
                    <h5 class="text-white text-bold-400 mb-0">
                      <?php 
                      $strSQL = "SELECT COUNT(case_number) AS pendingCase FROM client_cases AS cc
                        LEFT JOIN clients AS c ON c.client_ids = cc.case_client_id
                        WHERE c.comp_number in (SELECT comp_workon_id from work_on where member_id = '$sessionId') AND status='PENDING' ";
                      $objQuery = mysqli_query($conn,$strSQL);
                      while($objResult = mysqli_fetch_array($objQuery))
                      {
                        echo $objResult["pendingCase"];
                      }
                      ?>
                    </h5>
                  </div>
                  <div class="p-2 text-center bg-warning bg-darken-2 rounded-right">
                    <i class="fas fa-clock text-white" style="font-size: 48px;"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-12" id="assigned_case_card">
            <div class="card cardStyle1">
              <div class="card-content">
                <div class="media align-items-stretch">
                  <div class="p-2 text-white media-body text-left rounded-left" style="background: linear-gradient(to right, red ,red ,red ,red , white);">
                    <h5 class="text-white">ASSIGNED TO ME</h5>
                    <h5 class="text-white text-bold-400 mb-0">
                      <?php 
                      $strSQL = "SELECT COUNT(case_number) AS assignMe FROM client_cases WHERE assigned_to='$sessionId' AND (status='PENDING' OR status='OPEN') ";
                      $objQuery = mysqli_query($conn,$strSQL);
                      while($objResult = mysqli_fetch_array($objQuery))
                      {
                        echo $objResult["assignMe"];
                      }
                      ?>
                    </h5>
                  </div>
                  <div class="p-2 text-center bg-danger bg-darken-2 rounded-right">
                    <i class="fas fa-clipboard-list text-white" style="font-size: 48px;"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-12" id="closed_case_card">
            <div class="card cardStyle1">
              <div class="card-content">
                <div class="media align-items-stretch">
                  <div class="p-2 text-white media-body text-left rounded-left" style="background: linear-gradient(to right, green ,green ,green ,green , white);">
                    <h5 class="text-white">CLOSED CASE(s)</h5>
                    <h5 class="text-white text-bold-400 mb-0">
                      <?php 
                      $strSQL = "SELECT COUNT(case_number) AS closedCase FROM client_cases AS cc
                        LEFT JOIN clients AS c ON c.client_ids = cc.case_client_id
                        WHERE c.comp_number in (SELECT comp_workon_id from work_on where member_id = '$sessionId') AND status='CLOSED'";
                      $objQuery = mysqli_query($conn,$strSQL);
                      while($objResult = mysqli_fetch_array($objQuery))
                      {
                        echo $objResult["closedCase"];
                      }
                      ?>
                    </h5>
                  </div>
                  <div class="p-2 text-center bg-success bg-darken-2 rounded-right">
                    <i class="fas fa-clipboard-check text-white" style="font-size: 48px;"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- jquery show old clients' details -->
    <div class="content-wrapper" id="oldClientInfoDiv">
      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-body">
            <h3 class="card-title">Old client & Case</h3>
            <!-- form from here -->
            <form class="needs-validation" novalidate id="old_clientCase_form" action="" m(ethod="POST" autocomplete="off">
              <div class="form-row mb-3">
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="old_radio_inboundCall" name="old_radio_inboundCall" class="custom-control-input">
                  <label class="custom-control-label" for="old_radio_inboundCall">Inbound Call</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="old_radio_outboundCall" name="old_radio_inboundCall" class="custom-control-input">
                  <label class="custom-control-label" for="old_radio_outboundCall">Outbound Call</label>
                </div>
              </div>
              <div class="mb-2">
                <span id="old_dateSpan"></span>
              </div>
              <div class="form-row mb-3">
                <div class="input-group col-md-8">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="">First and last name <span style="color: red">*</span></span>
                  </div>
                  <input type="text" class="form-control" id="old_clientFnameInput" name="old_clientFnameInput" minlength="1" placeholder="first name..." readonly required>
                  <input type="text" class="form-control" id="old_clientLnameInput" name="old_clientLnameInput" minlength="1" placeholder="last name..." readonly>
                </div>
                <div class="input-group col-md-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="">Phone Number <span style="color: red">*</span></span>
                  </div>
                  <input type="text" class="form-control" id="old_clientPhoneNum" name="old_clientPhoneNum" oninput="this.value=this.value.replace(/[^0-9]/g,'');" minlength="9" placeholder="phone number..." readonly required>
                </div>
              </div>
              <div class="form-row mb-3">
                <div class="input-group col-md-8">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="">Case Topic <span style="color: red">*</span></span>
                  </div>
                  <input type="text" class="form-control" id="old_CaseTopic" name="old_CaseTopic" minlength="6" maxlength="50" placeholder="topic..." required>
                </div>
                <div class="input-group col-md-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="">Category<span style="color: red">*</span></span>
                  </div>
                  <select class="form-control" id="old_caseCat" name="old_caseCat" required>
                    <option value="" selected="">---Select---</option>
                    <?php 
                    $strSQL = "SELECT * FROM category ORDER BY cat_ids";
                    $objQuery = mysqli_query($conn,$strSQL);
                    while($objResult = mysqli_fetch_array($objQuery))
                    {
                      echo '<option value="'.($objResult["cat_ids"]).'">'.$objResult["cat_name"].'</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-2"></div>
                <div class="input-group col-md-8">
                  <div class="input-group-prepend">
                    <span class="input-group-text">I<br>N<br>F<br>O</span>
                  </div>
                  <textarea class="form-control" id="old_caseInfo_txt" name="old_caseInfo_txt" rows="5" placeholder="information of case..." required></textarea>
                </div>
                <div class="col-md-2"></div>
              </div>
              <div class="form-row mb-3">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Order Number</span>
                    </div>
                    <input type="text" class="form-control" id="old_orderNum" name="old_orderNum" placeholder="order number...">
                  </div>
                </div>
                <div class="col-md-2"></div>
              </div>
              <div class="form-row mb-3">
                <div class="input-group col-md-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="">Priority<span style="color: red">*</span></span>
                  </div>
                  <select class="form-control" id="old_Priority" name="old_Priority" required>
                    <option value="" selected>--- Select ---</option>
                    <option value="CRITICAL">Critical</option>
                    <option value="HIGH">High</option>
                    <option value="NORMAL">Normal</option>
                    <option value="LOW">Low</option>
                  </select>
                </div>
                <div class="input-group col-md-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="">Email</span>
                  </div>
                  <input type="email" class="form-control" id="old_clientEmail" name="old_clientEmail" placeholder="- no email -" readonly>
                </div>
                <div class="input-group col-md-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="">Call Back Number<span style="color: red">*</span></span>
                  </div>
                  <input type="number" class="form-control" id="old_callBackNum" name="old_callBackNum" placeholder="phone number..." required>
                </div>
                <div class="input-group col-md-2" style="padding-left: 25px;">
                  <div class="input-group-prepend">
                    <span class="input-group-text border-success">Close Case?</span>
                  </div>
                  <div class="input-group-text border-success">
                    <input type="checkbox" id="old_closeCase_checkbox">
                  </div>
                </div>
              </div>
              <div class="text-center mb-3">
                <button type="button" class="btn btn-primary" style="width: 130px" id="old_saveBtn">Save</button>
                <button type="button" class="btn btn-secondary" id="old_cancelBtn">Cancel</button>
              </div>
            </form>
            <!-- end form -->
          </div>
        </div>
      </div>
    </div>
    <!-- end old client wrapper -->

    <!-- show old records -->
    <div class="content-wrapper" id="oldRecordDiv">
      <div class="container-fluid">
        <div class="card w-80 mx-auto cardStyle mb-3">
          <div class="card-header text-center">
            Customer Detail
            <span class="float-right" id='edit_client_span' style="cursor: pointer;color: blue;"><i class='fas fa-user-edit'></i></span>
          </div>
          <div class="card-body">
            <h5 class="card-title" id="client_name_card"></h5>
            <div class="card-text">
              <div><span>Reference: </span><span id="client_comp_card"></span></div>
              <div><input type="hidden" name="hidden_client_refId" id="hidden_client_refId"></div>
              <div><span>Email: </span><span id="client_email_card"></span></div>
              <div><span>Phone number: </span><span id="client_phone_card"></span></div>
              <!-- <div><span>Phone number 2: </span></div> -->
              <div><span>Total case(s): </span><span id="client_total_case_card"></span></div>
              <div><span>Remark: </span><span id="client_remark_card"> </span></div>
            </div>
          </div>
          <div class="card-footer text-center text-muted" id="lastCallDiv">
          </div>
        </div>
        <!-- loop record cards goes here -->
        <div id="caseCard_div" class="mb-3">
          <!-- jquery display card(s) here -->
        </div>
      </div>
    </div>
    <!-- end old record -->

    <!-- jquery show new clients' input form -->
    <div class="content-wrapper"  id="newClientInfoDiv">
      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-body">
            <h3 class="card-title">New client & Case</h3>
            <!-- form from here -->
            <form class="needs-validation" novalidate id="new_clientCase_form" action="" method="POST" autocomplete="off">
              <div class="form-row mb-3">
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="new_radio_inboundCall" name="new_radio_inboundCall" class="custom-control-input">
                  <label class="custom-control-label" for="new_radio_inboundCall">Inbound Call</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="new_radio_outboundCall" name="new_radio_inboundCall" class="custom-control-input">
                  <label class="custom-control-label" for="new_radio_outboundCall">Outbound Call</label>
                </div>
              </div>
              <div class="mb-2">
                <span id="new_dateSpan"></span>
              </div>
              <div class="form-row mb-3">
                <div class="input-group col-md-8">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="">First and last name <span style="color: red">*</span></span>
                  </div>
                  <input type="text" class="form-control" id="new_clientFnameInput" name="new_clientFnameInput" minlength="1" placeholder="first name..." required>
                  <input type="text" class="form-control" id="new_clientLnameInput" name="new_clientLnameInput" minlength="1" placeholder="last name...">
                </div>
                <div class="input-group col-md-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="">Phone Number <span style="color: red">*</span></span>
                  </div>
                  <input type="text" class="form-control" id="new_clientPhoneNum" name="new_clientPhoneNum" oninput="this.value=this.value.replace(/[^0-9]/g,'');" minlength="9" placeholder="phone number..." required>
                </div>
              </div>
              <div class="form-row mb-3">
                <div class="input-group col-md-8">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="">Case Topic <span style="color: red">*</span></span>
                  </div>
                  <input type="text" class="form-control" id="new_CaseTopic" name="new_CaseTopic" minlength="6" maxlength="50" placeholder="topic..." required>
                </div>
                <div class="input-group col-md-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="">Company<span style="color: red">*</span></span>
                  </div>
                  <select class="form-control" id="new_company" name="new_company" required>
                    
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-2"></div>
                <div class="input-group col-md-8">
                  <div class="input-group-prepend">
                    <span class="input-group-text">I<br>N<br>F<br>O</span>
                  </div>
                  <textarea class="form-control" id="new_caseInfo_txt" name="new_caseInfo_txt" rows="5" placeholder="information of case..." required></textarea>
                </div>
                <div class="col-md-2"></div>
              </div>
              <div class="form-row mb-3">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Order Number</span>
                    </div>
                    <input type="text" class="form-control" id="new_orderNum" name="new_orderNum" placeholder="order number...">
                  </div>
                </div>
                <div class="col-md-2"></div>
              </div>
              <div class="form-row mb-3">
                <div class="input-group col-md-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="">Priority<span style="color: red">*</span></span>
                  </div>
                  <select class="form-control" id="new_Priority" name="new_Priority" required>
                    <option value="" selected>--- Select ---</option>
                    <option value="CRITICAL">Critical</option>
                    <option value="HIGH">High</option>
                    <option value="NORMAL">Normal</option>
                    <option value="LOW">Low</option>
                  </select>
                </div>
                <div class="input-group col-md-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="">Email</span>
                  </div>
                  <input type="email" class="form-control" id="new_clientEmail" name="new_clientEmail" placeholder="name@example.com">
                </div>
                <div class="input-group col-md-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="">Call Back Number<span style="color: red">*</span></span>
                  </div>
                  <input type="text" class="form-control" id="new_callBackNum" name="new_callBackNum" placeholder="Callback number..." oninput="this.value=this.value.replace(/[^0-9]/g,'');" required>
                </div>
                <div class="input-group col-md-2" style="padding-left: 25px;">
                  <div class="input-group-prepend">
                    <span class="input-group-text border-success">Close Case?</span>
                  </div>
                  <div class="input-group-text border-success">
                    <input type="checkbox" name="new_closeCase_checkbox" id="new_closeCase_checkbox">
                  </div>
                </div>
              </div>
              <div class="form-row mb-3">
                <div class="input-group col-md-8">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="">Remark</span>
                  </div>
                <input class="form-control" type="text" name="new_remark" id="new_remark" placeholder="client's remark...">
                </div>
                <div class="input-group col-md-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="">Category<span style="color: red">*</span></span>
                  </div>
                  <select class="form-control" id="new_caseCat" name="new_caseCat" required>
                    <option value="" selected="">---Select---</option>
                    <?php 
                    $strSQL = "SELECT * FROM category ORDER BY cat_ids";
                    $objQuery = mysqli_query($conn,$strSQL);
                    while($objResult = mysqli_fetch_array($objQuery))
                    {
                      echo '<option value="'.($objResult["cat_ids"]).'">'.$objResult["cat_name"].'</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="text-center mb-3">
                <button type="button" class="btn btn-primary" style="width: 130px" id="new_saveBtn">Save</button>
                <button type="button" class="btn btn-secondary" id="new_cancelBtn">Cancel</button>
              </div>
            </form>
            <!-- end form -->
          </div>
        </div>
      </div>
    </div>
    <!-- end new client wrapper -->
    <!-- display accord to clicked card start -->
    <div class="mb-3" id="show_clicked_dashboard">
      
    </div>
    <!-- display accord to clicked card end -->
    <!-- /.container -->

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to leave the system.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- end logout modal -->
    <!-- edit client detail modal -->
    <div class="modal fade" id="edit_client_modal" tabindex="-1" role="dialog" aria-labelledby="editClientModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editClientModal">Edit Client Detail</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <form id="edit_client_form" action="" method="POST">
              <div class="modal-body">
                <div class="form-row">
                  <label for="edit_fname_input">First Name: </label>
                  <input type="text" class="form-control" id="edit_fname_input" name="edit_fname_input" required>
                </div>
                <div class="form-row">
                  <label for="edit_lname_input">Last Name: </label>
                  <input type="text" class="form-control" id="edit_lname_input" name="edit_lname_input">
                </div>
                <div class="form-row">
                  <label for="edit_email_input">Email: </label>
                  <input type="text" class="form-control" id="edit_email_input" name="edit_email_input">
                </div>
                <div class="form-row">
                  <label for="edit_pnum_input">Phone Number: </label>
                  <input type="text" class="form-control" id="edit_pnum_input" name="edit_pnum_input" required>
                </div>
                <div class="form-row">
                  <label for="edit_remark_input">Remark: </label>
                  <textarea class="form-control" id="edit_remark_input" name="edit_remark_input" rows="2" style="overflow-y: scroll;"></textarea>
                </div>
                <div class="form-row" id="edit_select_clientComp">
                  <label for="edit_company_select">Reference: </label>
                  <select class="form-control" id="edit_company_select" name="edit_company_select">
                    <?php 
                      $strSQL = "SELECT * FROM company ORDER BY comp_name";
                      $objQuery = mysqli_query($conn,$strSQL);
                      while($objResult = mysqli_fetch_array($objQuery))
                      {
                        echo '<option value="'.($objResult["comp_ids"]).'">'.$objResult["comp_name"].'</option>';
                      }
                      ?>
                  </select>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" id="saveEdit_client">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- end edit client modal -->
    <!-- edit case modal -->
    <div class="modal fade" id="edit_case_modal" tabindex="-1" role="dialog" aria-labelledby="editCaseModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editCaseModal">Edit Case #</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="edit_case_form" action="" method="POST">
            <div class="modal-body">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="edit_select_type">Call Type: </label>
                <div class="col-sm-8">
                  <select class="form-control" id="edit_select_type">
                    <option value="INBOUND">INBOUND</option>
                    <option value="OUTBOUND">OUTBOUND</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Name: </label>
                <div class="col-sm-8">
                  <label class="col-form-label" id="cust_name_label"></label>
                </div>
                <input type="hidden" name="hidden_case_num" id="hidden_case_num">
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="edit_caseTopic">Topic: </label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="edit_caseTopic" id="edit_caseTopic" maxlength="50" required>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="edit_orderNum">Order#: </label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="edit_orderNum" id="edit_orderNum" placeholder="Order Number...">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Category: </label>
                <div class="col-sm-8">
                  <select class="form-control" id="edit_selectCat">
                    <?php 
                    $strSQL = "SELECT * FROM category";
                    $objQuery = mysqli_query($conn,$strSQL);
                    while($objResult = mysqli_fetch_array($objQuery))
                    {
                      echo '<option value="'.$objResult["cat_ids"].'">'.$objResult["cat_name"].'</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Issued Date: </label>
                <div class="col-sm-8 col-form-label">
                  <label id="edit_issueDate"></label>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Raised By: </label>
                <div class="col-sm-8 col-form-label">
                  <label id="edit_raisedBy"></label>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="edit_select_assign">Assigned To: </label>
                <div class="col-sm-8">
                  <select class="form-control" id="edit_select_assign">
                    
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="edit_select_priority">Priority: </label>
                <div class="col-sm-8">
                  <select class="form-control" id="edit_select_priority">
                    <option value="CRITICAL">CRITICAL</option>
                    <option value="HIGH">HIGH</option>
                    <option value="NORMAL">NORMAL</option>
                    <option value="LOW">LOW</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="edit_select_status">Status: </label>
                <div class="col-sm-8">
                  <select class="form-control" id="edit_select_status">
                    <option value='OPEN'>OPEN</option>
                    <option value='PENDING'>PENDING</option>
                    <option value='CLOSED'>CLOSED</option>
                    <?php 
                      if ($_SESSION['role'] != "USER") {
                        echo "<option value='DELETED'>DELETED</option>";
                      }else{
                        echo "<option value='DELETED' disabled>DELETED</option>";
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="edit_callback">Callback: </label>
                <div class="col-sm-8">
                  <input type="number" class="form-control" name="edit_callback" id="edit_callback" required>
                </div>
              </div>
              <div class="form-row">
                <label class="col-form-label" for="edit_caseInfo">Case Info: </label>
                <textarea type="text" class="form-control" id="edit_caseInfo" name="edit_caseInfo" rows="7" style="overflow-y: scroll;" readonly></textarea>
              </div>
              <div class="form-row">
                <label class="col-form-label" for="edit_update_caseInfo">Update Info: </label>
                <textarea type="text" class="form-control" id="edit_update_caseInfo" name="edit_update_caseInfo" rows="7" minlength="10" style="overflow-y: scroll;" placeholder="Any updates or changes to the case..." required></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" id="saveEdit_case">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- end edit case modal -->
    <!-- edit my account modal -->
    <div class="modal fade" id="edit_account_modal" tabindex="-1" role="dialog" aria-labelledby="editAccountModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editAccountModal">Edit Profile</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="edit_account_form" action="" method="POST">
            <div class="modal-body">
              <div class="form-row">
                <label for="edit_fname_account">First Name: </label>
                <input type="text" class="form-control" id="edit_fname_account" name="edit_fname_account" required>
              </div>
              <div class="form-row">
                <label for="edit_lname_account">Last Name: </label>
                <input type="text" class="form-control" id="edit_lname_account" name="edit_lname_account" required>
              </div>
              <div class="form-row">
                <label for="edit_username_account">Username: </label>
                <input type="text" class="form-control" id="edit_username_account" name="edit_username_account" required>
              </div>
              <div class="form-row">
                <label for="edit_password_account">Password: </label>
                <input type="password" class="form-control" id="edit_password_account" name="edit_password_account"        
                onmousedown="this.type='text'"
                onmouseup="this.type='password'"
                onmousemove="this.type='password'" required>
              </div>
              <div class="form-row">
                <label for="edit_email_account">Email: </label>
                <input type="text" class="form-control" id="edit_email_account" name="edit_email_account">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" id="saveEdit_account">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- end edit my account modal -->
    <!-- add account modal -->
    <div class="modal fade" id="add_account_modal" tabindex="-1" role="dialog" aria-labelledby="addAccountModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addAccountModal">New Account</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="add_account_form" action="" method="POST">
            <div class="modal-body">
              <div class="form-row">
                <label for="add_fname_account">First Name: </label>
                <input type="text" class="form-control" id="add_fname_account" name="add_fname_account" required>
              </div>
              <div class="form-row">
                <label for="add_lname_account">Last Name: </label>
                <input type="text" class="form-control" id="add_lname_account" name="add_lname_account" required>
              </div>
              <div class="form-row">
                <label for="add_username_account">Username: </label>
                <input type="text" class="form-control" id="add_username_account" name="add_username_account" required>
              </div>
              <div class="form-row">
                <label for="add_password_account">Password: </label>
                <input type="text" class="form-control" id="add_password_account" name="add_password_account" required>
              </div>
              <div class="form-row">
                <label for="add_email_account">Email: </label>
                <input type="text" class="form-control" id="add_email_account" name="add_email_account">
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-4">
                    <label for="add_role_account">Role: </label>
                    <select class="form-control" id="add_role_account" name="add_role_account">
                      <option value="USER">USER</option>
                      <option value="AGENT">AGENT</option>
                      <option value="MANAGER">MANAGER</option>
                      <option value="SUPERVISOR">SUPERVISOR</option>
                      <option value="ADMIN">ADMIN</option>
                      <option value="SADMIN">SUPER ADMIN</option>
                    </select>
                  </div>
                  <div class="col-md-8">
                    <label for="add_company">Company: </label>
                    <select class="form-control selectComp" id="add_company" name="add_company" required>
                      <option value="" selected="">---Select---</option>
                      <?php 
                      $strSQL = "SELECT * FROM company ORDER BY comp_name";
                      $objQuery = mysqli_query($conn,$strSQL);
                      while($objResult = mysqli_fetch_array($objQuery))
                      {
                        echo '<option value="'.($objResult["comp_ids"]).'">'.$objResult["comp_name"].'</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group" id="checkSharedDiv">
                <div class="form-row">
                  <div class="form-check mx-auto">
                    <input class="form-check-input" type="checkbox" id="checkShared">
                    <label class="form-check-label" for="checkShared">Shared Agent?</label>
                  </div>
                </div>
              </div>
              <div class="container-fluid" id="sharedCompDiv">
                <div class="form-group row">
                  <label class="col-md-4 col-form-label">Shared 1:</label>
                  <div class="col-md-8">
                    <select class="form-control selectComp" id="sharedComp1" name="sharedComp1">
                      <option value="" selected>--Select--</option>
                      <?php 
                      $strSQL = "SELECT * FROM company ORDER BY comp_name";
                      $objQuery = mysqli_query($conn,$strSQL);
                      while($objResult = mysqli_fetch_array($objQuery))
                      {
                        echo '<option value="'.($objResult["comp_ids"]).'">'.$objResult["comp_name"].'</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-4 col-form-label">Shared 2:</label>
                  <div class="col-md-8">
                    <select class="form-control selectComp" id="sharedComp2" name="sharedComp2">
                      <option value="" selected>--Select--</option>
                      <?php 
                      $strSQL = "SELECT * FROM company ORDER BY comp_name";
                      $objQuery = mysqli_query($conn,$strSQL);
                      while($objResult = mysqli_fetch_array($objQuery))
                      {
                        echo '<option value="'.($objResult["comp_ids"]).'">'.$objResult["comp_name"].'</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-4 col-form-label">Shared 3:</label>
                  <div class="col-md-8">
                    <select class="form-control selectComp" id="sharedComp3" name="sharedComp3">
                      <option value="" selected>--Select--</option>
                      <?php 
                      $strSQL = "SELECT * FROM company ORDER BY comp_name";
                      $objQuery = mysqli_query($conn,$strSQL);
                      while($objResult = mysqli_fetch_array($objQuery))
                      {
                        echo '<option value="'.($objResult["comp_ids"]).'">'.$objResult["comp_name"].'</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" id="saveAdd_account">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- end add account modal -->
    <!-- add company modal -->
    <div class="modal fade" id="add_company_modal" tabindex="-1" role="dialog" aria-labelledby="addCompanyModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addCompanyModal">New Company</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="add_company_form" action="" method="POST">
            <div class="modal-body">
              <div class="form-row">
                <label for="add_comp_name">Company Name: </label>
                <input type="text" class="form-control" id="add_comp_name" name="add_comp_name" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" id="saveAdd_company">Confirm</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- end add company modal -->
    <!-- manage account modal -->
    <div class="modal fade" id="manage_account_modal" tabindex="-1" role="dialog" aria-labelledby="manageAccModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="manageAccModal">Manage User for Shared Agent</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="manage_account_form" action="" method="POST">
            <div class="modal-body">
              <div class="form-row mb-2">
                <div class="col">
                  <label for="manage_account_name">Account Name: </label>
                  <select class="form-control" id="manage_account_select">
                    <option value="" selected>--Select--</option>
                  </select>
                </div>
              </div>
              <div class="form-row mb-2">
                <div class="col-md-6">
                  <label for="user_fname">First name</label>
                  <input type="text" class="form-control" id="user_fname" required>
                </div>
                <div class="col-md-6">
                  <label for="user_lname">Last name</label>
                  <input type="text" class="form-control" id="user_lname" required>
                </div>
              </div>
              <div class="form-row mb-2">
                <div class="col-md-6">
                  <label for="user_username">Username</label>
                  <input type="text" class="form-control" id="user_username" required>
                </div>
                <div class="col-md-6">
                  <label for="user_password">Password</label>
                  <input type="text" class="form-control" id="user_password" required>
                </div>
              </div>
              <div class="form-row mb-2">
                <div class="col-md-8">
                  <label for="user_email">Email</label>
                  <input type="text" class="form-control" id="user_email">
                </div>
                <div class="col-md-4">
                  <label for="user_role">Role</label>
                    <select class="form-control" id="user_role">   
                    <option value="SUPERVISOR">Supervisor</option>
                    <option value="MANAGER">MANAGER</option>
                    <option value="ADMIN">Admin</option>
                    <option value="AGENT">AGENT</option>
                    <option value="USER">User</option>
                  </select>
                </div>
              </div>
              <hr>
              <div class="form-row">
                <label class="mx-auto">Works On:</label>
              </div>
              <div class=" row mb-2">
                <div class="input-group col-md-6">
                  <select class="custom-select manageSelectComp" id="manageCompSelect_1" name="manageCompSelect_1">
                    <option value="" selected>--Select--</option>
                      <?php 
                      $strSQL = "SELECT * FROM company ORDER BY comp_name";
                      $objQuery = mysqli_query($conn,$strSQL);
                      while($objResult = mysqli_fetch_array($objQuery))
                      {
                        echo '<option value="'.($objResult["comp_ids"]).'">'.$objResult["comp_name"].'</option>';
                      }
                      ?>
                  </select>
                </div>
                <div class="input-group col-md-6">
                  <select class="custom-select manageSelectComp" id="manageCompSelect_2" name="manageCompSelect_2">
                    <option value="" selected>--Select--</option>
                      <?php 
                      $strSQL = "SELECT * FROM company ORDER BY comp_name";
                      $objQuery = mysqli_query($conn,$strSQL);
                      while($objResult = mysqli_fetch_array($objQuery))
                      {
                        echo '<option value="'.($objResult["comp_ids"]).'">'.$objResult["comp_name"].'</option>';
                      }
                      ?>
                  </select>
                </div>
              </div>
              <div class="row mb-2">
                <div class="input-group col-md-6">
                  <select class="custom-select manageSelectComp" id="manageCompSelect_3" name="manageCompSelect_3">
                    <option value="" selected>--Select--</option>
                      <?php 
                      $strSQL = "SELECT * FROM company ORDER BY comp_name";
                      $objQuery = mysqli_query($conn,$strSQL);
                      while($objResult = mysqli_fetch_array($objQuery))
                      {
                        echo '<option value="'.($objResult["comp_ids"]).'">'.$objResult["comp_name"].'</option>';
                      }
                      ?>
                  </select>
                </div>
                <div class="input-group col-md-6">
                  <select class="custom-select manageSelectComp" id="manageCompSelect_4" name="manageCompSelect_4">
                    <option value="" selected>--Select--</option>
                      <?php 
                      $strSQL = "SELECT * FROM company ORDER BY comp_name";
                      $objQuery = mysqli_query($conn,$strSQL);
                      while($objResult = mysqli_fetch_array($objQuery))
                      {
                        echo '<option value="'.($objResult["comp_ids"]).'">'.$objResult["comp_name"].'</option>';
                      }
                      ?>
                  </select>
                </div>
              </div>
              <div class="row mb-2">
                <div class="input-group col-md-6">
                  <select class="custom-select manageSelectComp" id="manageCompSelect_5" name="manageCompSelect_5">
                    <option value="" selected>--Select--</option>
                      <?php 
                      $strSQL = "SELECT * FROM company ORDER BY comp_name";
                      $objQuery = mysqli_query($conn,$strSQL);
                      while($objResult = mysqli_fetch_array($objQuery))
                      {
                        echo '<option value="'.($objResult["comp_ids"]).'">'.$objResult["comp_name"].'</option>';
                      }
                      ?>
                  </select>
                </div>
                <div class="input-group col-md-6">
                  <select class="custom-select manageSelectComp" id="manageCompSelect_6" name="manageCompSelect_6">
                    <option value="" selected>--Select--</option>
                      <?php 
                      $strSQL = "SELECT * FROM company ORDER BY comp_name";
                      $objQuery = mysqli_query($conn,$strSQL);
                      while($objResult = mysqli_fetch_array($objQuery))
                      {
                        echo '<option value="'.($objResult["comp_ids"]).'">'.$objResult["comp_name"].'</option>';
                      }
                      ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" id="save_manageAcc">Save Changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- end manage account modal -->
    <!-- confirm delete comp modal-->
    <div class="modal fade" id="confirmDelComp_Modal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Confirm Delete</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">By clicking confirm, selected company will be instantly removed.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="button" id="confirm_del_btn">Confirm</button>
          </div>
        </div>
      </div>
    </div>
    <!-- end confirm delete comp modal -->
    <!-- confirm delete user modal-->
    <div class="modal fade" id="confirmDelUser_Modal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete User?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">This user does not belong to any company. Do you want to delete this user?</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" id="keep_user_btn">Keep</button>
            <button class="btn btn-primary" type="button" id="confirm_del_user_btn">Delete</button>
          </div>
        </div>
      </div>
    </div>
    <!-- end confirm delete user -->
    <!-- import customer modal -->
    <div class="modal fade" id="import_customer_modal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Import Customers</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form id="import_customer_form" name="import_customer_form" method="POST" action="">
            <div class="modal-body">
              <div class="text-center">
                Please download and use this form to import customers.
              </div>
              <div class="text-center">
                <label class="">Click <a href="files/import_customer_form.xlsx" download>HERE</a> to download form.</label>
              </div>
              <div class="form-group row mb-3">
                <label for="select_importTo_comp" class="col-sm-3 col-form-label">Import to:</label>
                <div class="col-sm-9">
                  <select class="form-control" id="select_importTo_comp" name="select_importTo_comp">
                    <?php 
                    if($_SESSION['role'] == "SADMIN"){
                      $strSQL = "SELECT comp_ids AS comp_workon_id, comp_name FROM company";  
                    }else{
                      $strSQL = "SELECT comp_workon_id, c.comp_name FROM work_on LEFT JOIN company AS c ON comp_workon_id = c.comp_ids 
                      WHERE member_id ='$sessionId' ";
                    }
                    $objQuery = mysqli_query($conn,$strSQL);
                    while($objResult = mysqli_fetch_array($objQuery))
                    {
                      echo '<option value="'.($objResult["comp_workon_id"]).'">'.$objResult["comp_name"].'</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="custom-file">
                <input type="file" class="form-control" id="import_file" name="import_file" enctype="multipart/form-data" accept=".xls,.xlsx,.csv" required>
                <!-- <label class="custom-file-label text-truncate" for="custoimport_filemFile">Choose file</label> -->
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <input class="btn btn-primary" type="submit" name="import_btn" id="import_btn" value="Import">
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- end import customer modal -->
    <!-- announce users modal -->
    <div class="modal fade" id="announce_modal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Announce User(s)</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form id="announce_form" name="announce_form" method="POST" action="">
            <div class="modal-body">
              <div class="row mb-2">
                <div class="col-md-8">
                  <select class="form-control" id="select_announce_topic">
                    <option value="maintainance">Server Maintainance</option>
                    <option value="update">System Update</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <input type="text" class="form-control" name="version_input" id="version_input" placeholder="version...">
                </div>
              </div>
              <div>
                <textarea class="form-control" id="txt_announce" rows="6" required></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <input class="btn btn-primary" type="submit" name="submit_announce" id="submit_announce" value="Announce!">
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- end announce users modal -->
    <!-- annouce detail modal -->
    <div class="modal fade" id="update_detail_modal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Change Logs</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
            <div class="modal-body">
              <div>
                <pre id="update_detail_txt">
                  <!-- update info goes here -->
                </pre>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
      </div>
    </div>
    <!-- end announce detail modal -->
    <!-- alert modal -->
    <div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered ">
        <div style="margin: 0 auto; white-space:pre-wrap;" class="text-center" id="messageDiv">
          ...
        </div>
      </div>
    </div>
    <!-- end alert modal -->
    <div class="container">
      <div class="footer" style="padding-top: 18px;">
        <p style="float: right;">Copyright © Jump-Starter Co.,Ltd <span id="CopyrightYear"></span></p>
      </div>
    </div>


<!--       <div id="toast-container" class="toast-bottom-right">
        <div class="toast toast-warning" aria-live="assertive" style="display: block;">
          <button type="button" class="toast-close-button" role="button">×</button>
            <div class="toast-title">
              Workloads
            </div>
              <div class="toast-message">
                <?php 
                  $strSQL = "SELECT COUNT(*) as openCase from client_cases where status = 'OPEN';"
                   ?>
              </div>
            </div>
          </div> -->


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-ui/jquery-ui.js"></script>
    <link rel="stylesheet" href="vendor/datepicker/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="vendor/jquery-ui/jquery-ui.css">
    <script src="vendor/jquery/moment.js"></script>
    <script src="vendor/jquery/livestamp.min.js"></script>
    <script src="js/jquery.twbsPagination.min.js"></script>
    <script src="js/Chart.js"></script>
    <script src="js/chartjs-plugin-labels.js"></script>
    <script src="vendor/datepicker/js/bootstrap-datepicker.js"></script>
    <script src="debug/toastr.js"></script>
    <script src="vendor/jquery/index_func.js"></script>



    <script>


      var low =    <?php 
                    $strSQL = "SELECT COUNT(case_number) AS LowCase FROM client_cases AS cc
                      LEFT JOIN clients AS c ON c.client_ids = cc.case_client_id
                      WHERE c.comp_number in (SELECT comp_workon_id from work_on where member_id = '$sessionId') AND status='OPEN' AND priority ='LOW' ";
                    $objQuery = mysqli_query($conn,$strSQL);
                    while($objResult = mysqli_fetch_array($objQuery))
                    {
                      echo $objResult["LowCase"];
                    }
                    ?>

      var norm =    <?php 
                    $strSQL = "SELECT COUNT(case_number) AS NormCase FROM client_cases AS cc
                      LEFT JOIN clients AS c ON c.client_ids = cc.case_client_id
                      WHERE c.comp_number in (SELECT comp_workon_id from work_on where member_id = '$sessionId') AND status='OPEN' AND priority ='NORMAL' ";
                    $objQuery = mysqli_query($conn,$strSQL);
                    while($objResult = mysqli_fetch_array($objQuery))
                    {
                      echo $objResult["NormCase"];
                    }
                    ?>

      var high =    <?php 
                    $strSQL = "SELECT COUNT(case_number) AS HighCase FROM client_cases AS cc
                      LEFT JOIN clients AS c ON c.client_ids = cc.case_client_id
                      WHERE c.comp_number in (SELECT comp_workon_id from work_on where member_id = '$sessionId') AND status='OPEN' AND priority ='NORMAL' ";
                    $objQuery = mysqli_query($conn,$strSQL);
                    while($objResult = mysqli_fetch_array($objQuery))
                    {
                      echo $objResult["HighCase"];
                    }
                    ?>

      var crit =    <?php 
                    $strSQL = "SELECT COUNT(case_number) AS CritCase FROM client_cases AS cc
                      LEFT JOIN clients AS c ON c.client_ids = cc.case_client_id
                      WHERE c.comp_number in (SELECT comp_workon_id from work_on where member_id = '$sessionId') AND status='OPEN' AND priority ='NORMAL' ";
                    $objQuery = mysqli_query($conn,$strSQL);
                    while($objResult = mysqli_fetch_array($objQuery))
                    {
                      echo $objResult["CritCase"];
                    }
                    ?>







      var opened = "<?php echo $objResult['openedCase']?>" 

      function mktoast() {
        toastr.warning(crit+" CRITICAL priority")
        toastr.warning(high+" HIGH priority")
        toastr.warning(norm+" NORMAL priority")
        toastr.warning(low+" LOW priority")
        toastr.warning("Cases Remaining")
      }
      $(function() {
          var dur = $.fn.toast.defaults.duration;
          setInterval(mktoast, dur*540);
          mktoast();
      });
    </script>

<!--     <script>
      var mysql = require('jscmscom_cmsdb1');

      var con = mysql.createConnection({
        host = "localhost",
        user = "root",
        password = "",
        database = "jscmscom_cmsdb1"
      });

      con.connect(function(toasting){
        if(toasting) throw toasting;
        con.query("SELECT COUNT(*) as openCase from client_cases where status = 'OPEN' AND priority = 'LOW';" function (toasting, result, fields){
          if (toasting) throw toasting;
          console.log(result);
        });
      });
    </script> -->



  <link rel=stylesheet href="./jquery.toaster.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
  <script src="./jquery.toaster.js"></script>

  </body>

</html>
