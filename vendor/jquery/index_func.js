$(document).ready(function(){
	// notification from here
	var view = "";
	var noti_id = "";
	var user_ID = $("#hidden_session_id").val();

	load_unseen_notification(view,noti_id,user_ID);
 
	setInterval(function(){ 
		load_unseen_notification(view,noti_id,user_ID); 
	}, 5000);

	function load_unseen_notification(view, id, user_id){
		$.ajax({
			url:"notifications.php",
			method:"POST",
			data:{view:view, id:id, user_id:user_ID},
			dataType:"json",
			success:function(data){
				$('.btn1').html(data.notification);
				if(data.unseen_notification > 0){
					$('.count').html("&nbsp"+data.unseen_notification+"&nbsp");
					$('.titleNoti').html("("+data.unseen_notification+") Jump Starter Co.,Ltd || CS Management System.");
				}
			}
		});
	}

	$('.btn2').on("click", function(event){
		$('.count').html('');
		$('.titleNoti').html('Jump Starter Co.,Ltd || CS Management System.');
		load_unseen_notification('read',noti_id,user_ID);
	});

	$(document).on('click', '.assign_list', function(event){
		var text = ($(this).attr('id'));
		load_unseen_notification('clicked', text,user_ID );
		var selected_caseNum = $(this).find("input[id='hidden_caseNum']").val();
		editCase_func(selected_caseNum);
	});
	$(document).on('click', '.update_list', function(event){
		var text = ($(this).attr('id'));
		load_unseen_notification('clicked', text,user_ID );
		var version = $(this).find("input[id='hidden_version']").val();
		var type = "update";
		get_announcement(type,version);
	});

	function get_announcement(type, version){
		$.ajax({
			url:"get_announcement.php",
			method:"POST",
			data:{type:type, version:version, user_id:$("#hidden_session_id").val()},
			dataType:"json",
			success:function(response){
				$("#update_detail_txt").empty();
				$("#update_detail_txt").html(response[0]["msg_text"]);
			}
		});
		$("#update_detail_modal").modal("show");
	}
	function announce_func(type){
		var select_announce_topic = type;
		var txt_announce = $("#txt_announce").val();
		var version = $("#version_input").val();
		$.ajax({
			url:"announces.php",
			method:"POST",
			data:{type:type, txt_announce:txt_announce, version:version},
			dataType:"json",
			success:function(response){
				$("#announce_modal").modal("hide");
				$("#messageDiv").removeClass('alert alert-warning alert-success alert-danger');
			    if(response.type == 'success') {
					$('#messageDiv').addClass('alert alert-success').text(response.message);
				}else {
					$('#messageDiv').addClass('alert alert-danger').text(response.message);
				}
				$("#alertModal").modal('show');
			}
		});
	}
	$("#announce_form").submit(function(event){
		event.preventDefault();
		var type = $("#select_announce_topic").val();
		announce_func(type);
	});

	$('[data-toggle="tooltip"]').tooltip();
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();
	if(dd<10){
		dd='0'+dd;
	} 
	if(mm<10){
		mm='0'+mm;
	} 
	var today = dd+'/'+mm+'/'+yyyy;
	$("#CopyrightYear").text(yyyy);
	$("#new_dateSpan").text("Date: "+today);
	$("#old_dateSpan").text("Date: "+today);
	$("#new_clientFnameInput, #new_clientLnameInput, #new_clientPhoneNum, #new_CaseTopic, #new_caseCat, #new_caseInfo_txt, #new_orderNum, #new_clientEmail, #new_callBackNum, #new_Priority, #new_saveBtn, #new_closeCase_checkbox, #new_remark, #new_company").prop("disabled", true);
	$("#old_clientFnameInput, #old_clientLnameInput, #old_clientPhoneNum, #old_CaseTopic, #old_caseCat, #old_caseInfo_txt, #old_orderNum, #old_clientEmail, #old_callBackNum, #old_Priority, #old_saveBtn, #old_closeCase_checkbox").prop("disabled", true);

	$("#new_radio_inboundCall, #new_radio_outboundCall").change(function(){
		$("#new_clientFnameInput, #new_clientLnameInput, #new_clientPhoneNum, #new_CaseTopic, #new_caseCat, #new_caseInfo_txt, #new_orderNum, #new_clientEmail, #new_callBackNum, #new_Priority, #new_saveBtn, #new_closeCase_checkbox, #new_remark, #new_company").prop("disabled", false);
	});
	$("#old_radio_inboundCall, #old_radio_outboundCall").change(function(){
		$("#old_clientFnameInput, #old_clientLnameInput, #old_clientPhoneNum, #old_CaseTopic, #old_caseCat, #old_caseInfo_txt, #old_orderNum, #old_clientEmail, #old_callBackNum, #old_Priority, #old_saveBtn, #old_closeCase_checkbox").prop("disabled", false);
	});

	if($("#hidden_session_role").val() == "USER"){
		$("#edit_select_priority").prop("disabled",true);
	}
	if($("#hidden_session_role").val() != "SADMIN"){
		$("#checkSharedDiv, #sharedCompDiv, #edit_select_clientComp").hide();
	}

	// $("#report_div").hide();
	$("#newCaseBtn").hide();
	$("#oldRecordDiv").hide();
	$( "#oldClientInfoDiv" ).hide();
	$( "#newClientInfoDiv" ).hide();
	$("#sharedCompDiv").hide();

	$("#newCaseBtn").click(function(){
		$( "#oldClientInfoDiv" ).show( "blind" );
	});
	function hideOldDiv(){
		$('#old_CaseTopic, #old_caseCat, #old_caseInfo_txt, #old_orderNum,#old_Priority').val("");
		$("#old_radio_inboundCall, #old_radio_outboundCall, #old_closeCase_checkbox").prop('checked', false);
		$("#old_clientFnameInput, #old_clientLnameInput, #old_clientPhoneNum, #old_CaseTopic, #old_caseCat, #old_caseInfo_txt, #old_orderNum, #old_clientEmail, #old_callBackNum, #old_Priority, #old_saveBtn, #old_closeCase_checkbox").prop("disabled", true);
		$("#old_clientCase_form").removeClass("was-validated");
	};
	function hideNewDiv(){
		$('#new_clientCase_form').find("input[type=text],input[type=number], textarea, select, email").val("");
		$("#new_radio_inboundCall, #new_radio_outboundCall, #new_closeCase_checkbox").prop('checked', false);
		$("#new_clientFnameInput, #new_clientLnameInput, #new_clientPhoneNum, #new_CaseTopic, #new_caseCat, #new_caseInfo_txt, #new_orderNum, #new_clientEmail, #new_callBackNum, #new_Priority, #new_saveBtn, #new_closeCase_checkbox, #new_remark,#new_company").prop("disabled", true);
		$("#new_clientCase_form").removeClass("was-validated");
	};
	$("#old_cancelBtn").click(function(){
		$( "#oldClientInfoDiv" ).hide("blind", hideOldDiv() );
	});
	$("#new_cancelBtn").click(function(){
		$( "#newClientInfoDiv" ).hide("blind", hideNewDiv() );
	});
	$("#newClientBtn").click(function(){
		$("#mainSearchInput").val("");
		$("#oldRecordDiv, #newCaseBtn, #oldClientInfoDiv, #report_div, #pieChart, #lineChart,#menu_graph").hide();
		$("#dashboard_user").hide("blind");
		$("#show_clicked_dashboard").empty();
		$( "#newClientInfoDiv" ).show("blind");
		var userId = $("#hidden_session_id").val();
		$.ajax({
			url: 'getWorkOnComp.php',
			type: 'post',
			data: {user_id:userId},
			dataType: 'json',
			success:function(response){
				var len =  response.length;
				if(response != ""){
					$("#new_company").append("<option value='' selected>---Select---</option>");
					for( var i = 0; i<len; i++){
						$("#new_company").append("<option value="+response[i]['comp_id']+">"+response[i]['comp_name']+"</option>");
					}
				}
			}
		});
		hideNewDiv();
	});
	$("#mainSearchInput").keydown(function(){
		$("#mainSearchInput").autocomplete({
			minLength: 1,
			autoFocus: true,
			autoFill: true,
			source: function(request, response) {
				$.ajax({
					url: "getClient.php",
					dataType: "json",
					type: "post",
					data: {term:request.term, userId: $("#hidden_session_id").val(), role:$("#hidden_session_role").val()},                    
					success: function (data) {
						// if has matching result response array result
						if (data.length != 0) {
							response(data);
						}else{
							$('#mainSearchInput').autocomplete("close");
							$("#oldRecordDiv, #newCaseBtn, #oldClientInfoDiv").hide("slide");
						}
					}
				});
			},
			dataType: "json",
			select: function(event, ui){
				$("#mainSearchInput").val(ui.item.value);
				// Fill in all related inputs
				$("#hidden_client_id").val(ui.item.id);
				// new case form
				$("#old_clientFnameInput").val(ui.item.fname);
				$("#old_clientLnameInput").val(ui.item.lname);
				$("#old_clientPhoneNum").val(ui.item.value);
				$("#old_clientEmail").val(ui.item.email);
				$("#old_callBackNum").val(ui.item.value);
				//end new case form
				// customer detail card
				$("#client_name_card").text("คุณ  "+ui.item.fname+" "+ui.item.lname);
				$("#client_comp_card").text(ui.item.company);
				$("#hidden_client_refId").val(ui.item.company_id);
				$("#client_phone_card").text(ui.item.value);
				$("#client_email_card").text(ui.item.email);
				$("#client_remark_card").text(ui.item.remark);
				$("#newClientInfoDiv,#report_div, #pieChart, #lineChart,#menu_graph").hide();
				$("#dashboard_user").hide("blind");
				$("#show_clicked_dashboard").empty();
				$("#oldRecordDiv, #newCaseBtn, #oldClientInfoDiv").hide("slide",600);
				$("#hidden_clicked_dashboard").val("");
				hideOldDiv();
				showOldRec();
				$('html,body').animate({
        scrollTop: $("#newCaseBtn").offset().top},
        'slow');
			}
		}).autocomplete( "instance" )._renderItem = function( ul, item ) {
			return $( "<li>" )
				.append( "<div>"+ item.value + " - คุณ " + item.fname + " " + item.lname + " " +"<small>("+item.company+")</small></div>" )
				.appendTo( ul );
		};
	});

	function showOldRec(){
		$("#lastCallDiv").empty();
		$("#oldRecordDiv, #newCaseBtn").show("slide");
			var clientId = $("#hidden_client_id").val();
			if(clientId != "" ) {
				$.ajax({
					url: 'getCases.php',
					type: 'post',
					data: {client_id:clientId},
					dataType: 'json',
					success:function(response){

					var len = response.length;
					// total case = response's length
					$("#client_total_case_card").text(len);
					if(response != '' && len > 0) {
						$("#caseCard_div,#show_clicked_dashboard").empty();
						$("#caseCard_div").append("<div class='pagination justify-content-center' id='pagination-container'></div>");
						var pageSize = 20;
						var pageCount =  (len*2) / pageSize;
						if(pageCount%1 != 0){
							pageCount = pageCount+1;
						}
						$('#pagination-container').twbsPagination({
					        totalPages: pageCount,
					        visiblePages: 7,
					        onPageClick: function (event, page) {
							    showPage(page); 
					        }
					    });
						function showPage(page) {
						    $(".cardContent").hide();
						    $(".cardContent").each(function(n) {
						        if (n >= (pageSize * (page - 1)) && n <(pageSize * page)){
						            $(this).show();
						        }
						    });        
						}

						for( var i = 0; i<len; i++){
							var caseNum = response[i]['case_number'];
							var callType = response[i]['call_type'];
							var caseTopic = response[i]['case_topic'];
							var caseInfo = response[i]['case_info'];
							var caseCat = response[i]['case_category'];
							var priority = response[i]['priority'];
							var issuedDate = response[i]['issued_date'];
							var mostRecentDate = response[0]['issued_date'];
							var issuedDateFormated = response[i]['issued_date_format'];
							var raiseFname = response[i]['raise_fname'];
							var raiseLname = response[i]['raise_lname'];
							var raisedBy = raiseFname+" "+raiseLname;
							var assignFname = response[i]['assign_fname'];                  
							var assignLname = response[i]['assign_lname'];
							if(assignFname == null || assignLname == null){
								var assignedTo = "not set";
							}else{
								var assignedTo = assignFname+" "+assignLname;
							}
							var status = response[i]['status'];
							var callbackNum = response[i]['callback_number'];
							var orderNum = response[i]['order_num'];
							var updateTime = response[i]['update_time'];
							var client_fname = response[i]['client_fname'];
							var client_lname = response[i]['client_lname'];
							var updateTimeLapse = "<div class='text-center card-text' id='last_update'><span data-livestamp='"+updateTime+"'></span></div>";

							if (priority == "CRITICAL") {
								var priority_check = "<span style='font-size: 14px;' class='badge badge-pill badge-danger' id='priority_small'>Critical</span>";
							}
							if (priority == "HIGH") {
								var priority_check = "<span style='font-size: 14px;' class='badge badge-pill badge-warning' id='priority_small'>High</span>";
							}
							if (priority == "NORMAL") {
								var priority_check = "<span style='font-size: 14px;' class='badge badge-pill badge-info' id='priority_small'>Normal</span>";
							}
							if (priority == "LOW") {
								var priority_check = "<span style='font-size: 14px;' class='badge badge-pill badge-secondary' id='priority_small'>Low</span>";
							}
							if(status == "OPEN"){
								var check_status = "<div class='card font-weight-bold' id='case_status' style='background-color: gold;'>OPEN</div>"
							}
							if(status == "PENDING"){
								var check_status = "<div class='card bg-warning font-weight-bold' id='case_status'>PENDING</div>"
							}
							if(status == "CLOSED"){
								var check_status = "<div class='card bg-success font-weight-bold' id='case_status'>CLOSED</div>"
							}
							if(status == "DELETED"){
								var check_status = "<div class='card text-white bg-dark font-weight-bold' id='case_status'>DELETED</div>"
							}
							
							$("#caseCard_div")
							.append("<div class='card-group w-75 mx-auto cardStyle cardContent'>"+
							"<div class='card col-md-2 text-center border-right-0' style='padding: 30px 0;'>"+
								"<div>"+
									"<small id='case_number'>#"+caseNum+"</small><br>"+
									check_status+
									"<small id='client_name'>"+client_fname+" "+client_lname+"</small><br>"+
								"</div>"+
							"</div>"+
							"<div class='card col-md-8 border-left-0 border-right-0'>"+
								"<div class='card-body'>"+
									"<div>"+
										"<h5 class='card-title' id='case_title'>"+caseTopic+" <sup><span class='badge badge-pill badge-info'>"+callType+"</span><sup></h5>"+
										"<p class='card-text text-truncate' style='max-width: 540px'; id='case_info'>"+caseInfo+"</p>"+
									"</div>"+
								"</div>"+
							"</div>"+
							"<div class='card col-md-2 border-left-0' style='padding: 30px 0;''>"+
									"<small style='font-style: italic;'>Last updated:</small>"+
									updateTimeLapse+
							"</div>"+
						"</div>"+
						"<div class='card-group bg-light mx-auto w-75 mb-3 cardStyle cardContent'>"+
								"<div class='col-md-2 border-right border-secondary rounded'>"+
									"<small style='font-style: italic;'>Issued date:</small><br>"+
										"<div class='text-center'>"+
											"<small id='issued_date_small'>"+issuedDateFormated+"</small>"+
										"</div>"+
								"</div>"+
								"<div class='col-md-2 border-right border-secondary rounded'>"+
									"<small style='font-style: italic;'>Raised by:</small><br>"+
										"<div class='text-center'>"+
											"<small id='raised_by_small'>"+raisedBy+"</small>"+
										"</div>"+
								"</div>"+
								"<div class='col-md-3 border-right border-secondary rounded'>"+
									"<small style='font-style: italic;'>Category:</small><br>"+
										"<div class='text-center'>"+
											"<small id='cat_small'>"+caseCat+"</small>"+
										"</div>"+
								"</div>"+
								"<div class='col-md-2 border-right border-secondary rounded'>"+
									"<small style='font-style: italic;'>Assigned to:</small><br>"+
										"<div class='text-center'>"+
											"<small id='assigned_to_small'>"+assignedTo+"</small>"+
										"</div>"+
								"</div>"+
								"<div class='col-md-2 border-right border-secondary rounded'>"+
									"<small style='font-style: italic;'>Priority:</small><br>"+
										"<div class='text-center'>"+
											"<small>"+priority_check+"</small>"+
										"</div>"+
								"</div>"+
								"<div class='col-md-1'>"+
									"<div class='text-center' style='padding-top: 11px; font-size:17px;'>"+
										"<span id='editC_"+caseNum+"' class='fake-link'><i class='fas fa-edit'></i></span>"+
									"</div>"+
								"</div>"+
						"</div>");
						}
						$("#lastCallDiv").append("Last Call : <span data-livestamp='"+mostRecentDate+"'></span>");
					}else{
						$("#caseCard_div, #lastCallDiv").empty();
						$("#lastCallDiv").append("Last Call : -No Data-");
					}
				}
			});
		}
	};

	$(document).on("click",".fake-link",function(){
		if($("#hidden_session_role").val() == "USER"){
			$("#edit_select_priority").prop("disabled",true);
		}
	var id = this.id;
    var splitid = id.split('_');
    var index = splitid[1];
    $("#editCaseModal").text('Edit Case #'+index);
    $("#hidden_case_num").val(index);
    editCase_func(index);
	});

	function editCase_func(caseNum){
		$.ajax({
			url: 'getSingleCase.php',
			type: 'post',
			data: {caseId:caseNum},
			dataType: 'json',
			success:function(response){
				if (response != '') {
					var clientFname = response[0]['clientFname'];
					var clientLname = response[0]['clientLname'];
					var callType = response[0]['call_type'];
					var caseTopic = response[0]['case_topic'];
					var caseInfo = response[0]['case_info'];
					var caseCat = response[0]['case_category'];
					var priority = response[0]['priority'];
					var raiseFname = response[0]['raise_fname'];
					var raiseLname = response[0]['raise_lname'];
					var assignedTo = response[0]['assigned_to'];
					var caseStat = response[0]['status'];
					var callBack = response[0]['callback_number'];
					var orderNum = response[0]['order_num'];
					var issuedDateFormated = response[0]['issued_date_format'];
					var closedFname = response[0]['close_fname'];
					var closedLname = response[0]['close_lname'];
					var compNumber = response[0]['comp_num'];

					$("#edit_select_type").val(callType);
					$("#cust_name_label").text(clientFname+" "+clientLname);
					$("#edit_caseTopic").val(caseTopic);
					if(orderNum == null){
						$("#edit_orderNum").val('');
					}else{
						$("#edit_orderNum").val(orderNum);
					}
					$("#edit_selectCat").val(caseCat);
					$.ajax({
						url: 'getWorkOnUser.php',
						type: 'post',
						data: {comp_id:compNumber, role:$("#hidden_session_role").val()},
						dataType: 'json',
						success:function(response){
							if(response != ''){
								$("#edit_select_assign").empty();
								$("#edit_select_assign").append("<option value=''>-Not Set-</option>");
								var len = response.length;
								for (var i = 0; i < len ; i++) {
									$("#edit_select_assign").append("<option value="+response[i]['user_id']+">"+response[i]['user_fname']+" "+response[i]['user_lname']+"</option>");
								}
								if (assignedTo == null) {
									$("#edit_select_assign").val("");	
								}else{
									$("#edit_select_assign").val(assignedTo);
								}
							}else{
								$("#edit_select_assign").append("<option>error</option>");
							}
						}
					});
					$("#edit_select_priority").val(priority);
					$("#edit_select_status").val(caseStat);
					$("#edit_issueDate").text(issuedDateFormated);
					$("#edit_raisedBy").text(raiseFname+" "+raiseLname);
					$("#edit_callback").val(callBack);
					$("#edit_caseInfo").val(caseInfo+"\n---------------\n");
					if(caseStat == "DELETED"){
						$("#edit_select_type, #edit_caseTopic, #edit_orderNum, #edit_selectCat, #edit_select_assign,#edit_select_priority, #edit_select_status, #edit_callback, #edit_update_caseInfo, #saveEdit_case").prop("disabled",true);
					}
					if(caseStat == "CLOSED" && $("#hidden_session_role").val() == "USER"){
						$("#edit_select_type, #edit_caseTopic, #edit_orderNum, #edit_selectCat, #edit_select_assign,#edit_select_priority, #edit_select_status, #edit_callback, #edit_update_caseInfo, #saveEdit_case").prop("disabled",true);
					}
					$("#edit_case_modal").modal('show');
				}else{
					alert("connection error.");
				}
			}
		});
	}

	$("#edit_case_modal").on('hidden.bs.modal', function () {
		$("#edit_select_type, #edit_caseTopic, #edit_orderNum, #edit_selectCat, #edit_select_assign,#edit_select_priority, #edit_select_status, #edit_callback, #edit_update_caseInfo, #saveEdit_case").prop("disabled",false);
	});

	// $("#mainSearchInput").keyup(function(){
	// 	if($(this).val() == ""){
	// 		$("#hidden_client_id").val("");
	// 		$("#oldRecordDiv, #newCaseBtn, #oldClientInfoDiv").hide("slide");
	// 		$("#dashboard_user,#menu_graph").show("blind");
	// 	}
	// });

	$("#new_saveBtn").click(function(){
		if(
			$("#new_clientFnameInput").val() == "" || 
			$("#new_clientPhoneNum").val() == "" ||
			$("#new_CaseTopic").val() == "" ||
			$("#new_caseCat").val() == "" ||
			$("#new_caseInfo_txt").val() == "" || 
			$("#new_Priority").val() == "" ||
			$("#new_callBackNum").val() == "" ||
			$("#new_company").val() == "") 
		{
			$("#new_clientCase_form").addClass('was-validated');
			 $(this).popover({
					trigger: 'focus',
					content: "Check required fields."
				});
			 $(this).popover('show');
		}else{
			$(this).popover('hide');
			$("#new_clientCase_form").submit();
		}
	});

	$("#old_saveBtn").click(function(){
		if(
			$("#old_CaseTopic").val() == "" ||
			$("#old_caseCat").val() == "" ||
			$("#old_caseInfo_txt").val() == "" || 
			$("#old_Priority").val() == "" ||
			$("#old_callBackNum").val() == "") 
		{
			$("#old_clientCase_form").addClass('was-validated');
			 $(this).popover({
					trigger: 'focus',
					content: "Check required fields."
				});
			 $(this).popover('show');
		}else{
			$(this).popover('hide');
			$("#old_clientCase_form").submit();
		}
	});

	$("#old_clientCase_form").submit(function(e){
		$("#messageDiv").removeClass('alert alert-warning alert-success alert-danger');
		if ($("#old_radio_inboundCall").is(':checked')) {
			var call_type = "INBOUND";
		}else{
			var call_type = "OUTBOUND";
		}
		if ($("#old_closeCase_checkbox").is(':checked')) {
			var status = "CLOSED";
		}else{
			var status = "OPEN";
		}
		var user_id = $("#hidden_session_id").val();
		var formData = {
			userId : user_id,
			callType : call_type,
			client_id : $("#hidden_client_id").val(),
			case_topic : $("#old_CaseTopic").val(),
			caseCat : $("#old_caseCat").val(),
			caseInfo : $("#old_caseInfo_txt").val(),
			orderNum : $("#old_orderNum").val(),
			priority : $("#old_Priority").val(),
			callbackNum : $("#old_callBackNum").val(),
			caseStat : status,
			caseNumber : "CS"+dd+mm+yyyy
		};
		$.ajax({
			url: 'save_old_case.php',
			type: 'post',
			data: formData,
			dataType: 'json',
			success:function(response){
				if(response.type == 'success') {
					$( "#oldClientInfoDiv" ).hide("fold");
					hideOldDiv();
					showOldRec();
					$('#messageDiv').addClass('alert alert-success').text(response.message);

				} else {
					$('#messageDiv').addClass('alert alert-danger').text(response.message);
				}
				$("#alertModal").modal('show');
			}
		});
		e.preventDefault();
	});

	$("#new_clientCase_form").submit(function(e){
		if ($("#new_radio_inboundCall").is(':checked')) {
			var call_type = "INBOUND";
		}else{
			var call_type = "OUTBOUND";
		}
		if ($("#new_closeCase_checkbox").is(':checked')) {
			var status = "CLOSED";
		}else{
			var status = "OPEN";
		}
		var user_id = $("#hidden_session_id").val();
		var formData = {
			userId : user_id,
			callType : call_type,
			fname : $("#new_clientFnameInput").val(),
			lname : $("#new_clientLnameInput").val(),
			pnumber : $("#new_clientPhoneNum").val(),
			case_topic : $("#new_CaseTopic").val(),
			caseCat : $("#new_caseCat").val(),
			caseInfo : $("#new_caseInfo_txt").val(),
			orderNum : $("#new_orderNum").val(),
			priority : $("#new_Priority").val(),
			email : $("#new_clientEmail").val(),
			callbackNum : $("#new_callBackNum").val(),
			remark : $("#new_remark").val(),
			caseStat : status,
			caseNumber : "CS"+dd+mm+yyyy,
			company : $("#new_company").val()
		};
		$.ajax({
			url: 'save_new_case.php',
			type: 'post',
			data: formData,
			dataType: 'json',
			success:function(response){
				$("#messageDiv").removeClass('alert alert-warning alert-success alert-danger');
				$( "#newClientInfoDiv" ).hide("fold");
				hideNewDiv();
				if(response.type == 'success') {
					$('#messageDiv').addClass('alert alert-success').text(response.message);
				} else if(response.type == 'error1' || response.type == 'error2' || response.type == 'error3'){
					$('#messageDiv').addClass('alert alert-danger').text(response.message)
				}
				$("#alertModal").modal('show');
			}
		});
		e.preventDefault();
	});

	$("#edit_client_span").click(function(){
		$("#edit_fname_input").val($("#old_clientFnameInput").val());
		$("#edit_lname_input").val($("#old_clientLnameInput").val());
		$("#edit_email_input").val($("#old_clientEmail").val());
		$("#edit_pnum_input").val($("#old_clientPhoneNum").val());
		$("#edit_remark_input").val($("#client_remark_card").text());
		$("#edit_company_select").val($("#hidden_client_refId").val());
		$("#edit_client_modal").modal('show');
	});

	$("#edit_client_form").submit(function(e){
		e.preventDefault();
		$("#messageDiv").removeClass('alert alert-warning alert-success alert-danger');
		$("#edit_client_modal").modal('hide');
		var formData = {
			client_id : $("#hidden_client_id").val(),
			edit_fname :  $("#edit_fname_input").val(),
			edit_lname : $("#edit_lname_input").val(),
			edit_email : $("#edit_email_input").val(),
			edit_pnum : $("#edit_pnum_input").val(),
			edit_remark : $("#edit_remark_input").val(),
			edit_company : $("#edit_company_select").val()
		};
		$.ajax({
			url: 'save_edit_client.php',
			type: 'post',
			data: formData,
			dataType: 'json',
			success:function(response){
				$( "#oldClientInfoDiv" ).hide("fold");
				hideOldDiv();
				if(response.type == 'success') {
					$('#messageDiv').addClass('alert alert-success').text(response.message);
					$("#mainSearchInput").data('ui-autocomplete')._trigger('select', 'autocompleteselect', {
						item:{
							value:response.client_phone,
							fname:response.client_fname,
							lname:response.client_lname,
							email:response.client_email,
							remark:response.client_remark,
							id:response.client_id,
							company:response.edit_company_name,
							company_id:response.edit_company
						}
					});
				} else {
					$('#messageDiv').addClass('alert alert-danger').text(response.message);
				}
				$("#alertModal").modal('show');
			}
		});
	});

	$("#edit_case_form").submit(function(e){
		e.preventDefault();
		$("#messageDiv").removeClass('alert alert-warning alert-success alert-danger');
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1; //January is 0!
		var yyyy = today.getFullYear();
		var hour = today.getHours();
		var min = today.getMinutes();
		var second = today.getSeconds();
		if(dd<10){
			dd='0'+dd;
		} 
		if(mm<10){
			mm='0'+mm;
		}
		if (hour<10) {
			hour='0'+hour;
		}
		if (min<10) {
			min='0'+min;
		}
		if (second<10) {
			second='0'+second;
		}
		var today = dd+'/'+mm+'/'+yyyy;
		var timeNow = hour+":"+min+":"+second;
		$("#edit_case_modal").modal('hide');
		if($("#edit_select_status").val() == "CLOSED"){
			var newCaseUpdateInfo = $("#edit_caseInfo").val()+$("#edit_update_caseInfo").val()+
				"\nClosed By: "+$("#hidden_session_name").val()+"\n"+today+" "+timeNow;	
		}else if($("#edit_select_status").val() == "DELETED"){
			var newCaseUpdateInfo = $("#edit_caseInfo").val()+$("#edit_update_caseInfo").val()+
				"\nDeleted By: "+$("#hidden_session_name").val()+"\n"+today+" "+timeNow;	
		}else{
			var newCaseUpdateInfo = $("#edit_caseInfo").val()+$("#edit_update_caseInfo").val()+
				"\nUpdated By: "+$("#hidden_session_name").val()+"\n"+today+" "+timeNow;
		}

		var formData = {
			sessionName : $("#hidden_session_name").val(),
			sessionId : $("#hidden_session_id").val(),
			caseNum : $("#hidden_case_num").val(),
			callType : $("#edit_select_type").val(),
			case_topic : $("#edit_caseTopic").val(),
			orderNum : $("#edit_orderNum").val(),
			caseCat : $("#edit_selectCat").val(),
			assignedTo : $("#edit_select_assign").val(),
			priority : $("#edit_select_priority").val(),
			caseStat : $("#edit_select_status").val(),
			callbackNum : $("#edit_callback").val(),
			caseUpdateInfo : newCaseUpdateInfo
		};
		$.ajax({
			url: 'save_edit_case.php',
			type: 'post',
			data: formData,
			dataType: 'json',
			success:function(response){
				if(response.type == 'success') {
					hideOldDiv();
					if($("#hidden_clicked_dashboard").val() == ""){		
						showOldRec();
					}else{
						var clickedAt = $("#hidden_clicked_dashboard").val();
						showClickedDashboard(clickedAt);
						$( "#oldClientInfoDiv" ).hide("fold");
					}
					$("#edit_update_caseInfo").val("");
					$('#messageDiv').addClass('alert alert-success').text(response.message);
				} else {
					$('#messageDiv').addClass('alert alert-danger').text(response.message);
				}
				$("#alertModal").modal('show');
			}
		})
	});
	$("#new_closeCase_checkbox , #old_closeCase_checkbox").change(function(){
		if(this.checked) {
			$("#alertModal").modal('show');
			$('#messageDiv').addClass('alert alert-warning').text("By checking this box, this case will be closed\nClick anywhere to proceed...");
		}
	});
	// var sessionId = $("#hidden_session_id").val();
	$(document).on("click","#edit_account_link",function(){
		$.ajax({
			url: 'getUser.php',
			type: 'post',
			data: {user_id : $("#hidden_session_id").val(), type:"get1user"},
			dataType: 'json',
			success:function(response){
				$("#edit_fname_account").val(response[0]["user_fname"]);
				$("#edit_lname_account").val(response[0]["user_lname"]);
				$("#edit_username_account").val(response[0]["user_username"]);
				$("#edit_email_account").val(response[0]["user_email"]);
				$("#edit_password_account").val(response[0]["user_password"]);
			}
		})
	});
	$("#edit_account_form").submit(function(e){
		e.preventDefault();
		$("#messageDiv").removeClass('alert alert-warning alert-success alert-danger');
		$("#edit_account_modal").modal("hide");
		var user_id = $("#hidden_session_id").val();
		var formData = {
			user_id : user_id,
			user_fname : $("#edit_fname_account").val(),
			user_lname : $("#edit_lname_account").val(),
			user_username : $("#edit_username_account").val(),
			user_email : $("#edit_email_account").val(),
			user_password : $("#edit_password_account").val()
		};
		$.ajax({
			url: 'save_edit_user.php',
			type: 'post',
			data: formData,
			dataType: 'json',
			success:function(response){
				if(response.type == 'success') {
					$('#messageDiv').addClass('alert alert-success').text(response.message);
				} else {
					$('#messageDiv').addClass('alert alert-danger').text(response.message);
				}
				$("#alertModal").modal('show');
			}
		})
	});

	$("#add_account_form").submit(function(e){
		e.preventDefault();
		$("#messageDiv").removeClass('alert alert-warning alert-success alert-danger');
		$("#add_account_modal").modal("hide");
		var formData = {
			user_fname : $("#add_fname_account").val(),
			user_lname : $("#add_lname_account").val(),
			user_username : $("#add_username_account").val(),
			user_email : $("#add_email_account").val(),
			user_password : $("#add_password_account").val(),
			user_role : $("#add_role_account").val(),
			user_comp_id : $("#add_company").val(),
			user_share1 : $("#sharedComp1").val(),
			user_share2 : $("#sharedComp2").val(),
			user_share3 : $("#sharedComp3").val()
		};
		$.ajax({
			url: 'save_add_user.php',
			type: 'post',
			data: formData,
			dataType: 'json',
			success:function(response){
				if(response.type == 'success') {
					$('#messageDiv').addClass('alert alert-success').text(response.message);
				} else {
					$('#messageDiv').addClass('alert alert-danger').text(response.message);
				}
				$("#alertModal").modal('show');
			}
		})
	});
	$("#add_company_link, #add_account_link").click(function(){
		$("#add_account_form, #add_company_form").trigger('reset');
	});
	$("#manage_account_link").click(function(){
		$("#manage_account_form").trigger('reset');
		$("select").prop("disabled",false);
		$("#manage_account_select").empty();
		$("#save_manageAcc").prop("disabled",true);
		$.ajax({
			url: 'getUser.php',
			type: 'post',
			data: {type:"getalluser"},
			dataType: 'json',
			success:function(response){
				var len = response.length;
				$("#manage_account_select").append("<option value=''>--Select--</option>");
				for(var i=0; i<len; i++){
					$("#manage_account_select").append("<option value="+response[i]['user_ids']+">"+response[i]['user_fname']+" "+response[i]['user_lname']+" ("+response[i]['user_username']+")</option>");

				}
			}
		})
	});

	$("#add_company_form").submit(function(e){
		e.preventDefault();
		$("#messageDiv").removeClass('alert alert-warning alert-success alert-danger');
		$("#add_company_modal").modal("hide");
		var comp_name = $("#add_comp_name").val();
		$.ajax({
			url: 'save_add_company.php',
			type: 'post',
			data: {compName:comp_name},
			dataType: 'json',
			success:function(response){
				if(response.type == 'success') {
					$('#messageDiv').addClass('alert alert-success').text(response.message);
				} else {
					$('#messageDiv').addClass('alert alert-danger').text(response.message);
				}
				$("#alertModal").modal('show');
			}
		})
	});

	function showClickedDashboard(type){
		$('html,body').animate({
	      scrollTop: $("#dashboard_user").offset().top},'slow'
    	);
    	$("#newClientInfoDiv").hide();
		$("#show_clicked_dashboard").hide("slide",500);
		$("#show_clicked_dashboard, #caseCard_div").empty();
			var user_id = $("#hidden_session_id").val();
			if(user_id != "" ) {
				$.ajax({
					url: 'getRelateCases.php',
					type: 'post',
					data: {user_id:user_id, clickType:type},
					dataType: 'json',
					success:function(response){

					var len = response.length;
					// total case = response's length
					if(response != '' && len > 0) {
						var pageSize = 0;

						function showPage(page) {
						    $(".cardContent").hide();
						    $(".cardContent").each(function(n) {
						        if (n >= (pageSize * (page - 1)) && n <(pageSize * page)){
						            $(this).show();
						        }
						    });        
						}

						$("#show_clicked_dashboard").append("<div class='pagination justify-content-center' id='pagination-container'></div>");
						$("#show_clicked_dashboard").append(
							"<div class='text-center mb-3'><span class='myCase_link' style='color:blue;text-decoration:underline;cursor:pointer;'>My Case(s)</span></div>");
						var cardArr = [];
						for( var i = 0; i<len; i++){
							var caseNum = response[i]['case_number'];
							var callType = response[i]['call_type'];
							var caseTopic = response[i]['case_topic'];
							var caseInfo = response[i]['case_info'];
							var caseCat = response[i]['case_category'];
							var priority = response[i]['priority'];
							var issuedDate = response[i]['issued_date'];
							var mostRecentDate = response[0]['issued_date'];
							var issuedDateFormated = response[i]['issued_date_format'];
							var raiseFname = response[i]['raise_fname'];
							var raiseLname = response[i]['raise_lname'];
							var raisedBy = raiseFname+" "+raiseLname;
							var assignFname = response[i]['assign_fname'];                  
							var assignLname = response[i]['assign_lname'];
							if(assignFname == null || assignLname == null){
								var assignedTo = "not set";
							}else{
								var assignedTo = assignFname+" "+assignLname;
							}
							var status = response[i]['status'];
							var callbackNum = response[i]['callback_number'];
							var orderNum = response[i]['order_num'];
							var updateTime = response[i]['update_time'];
							var client_fname = response[i]['client_fname'];
							var client_lname = response[i]['client_lname'];
							var comp_name = response[i]['comp_name'];
							var updateTimeLapse = "<div class='text-center card-text' id='last_update'><span data-livestamp='"+updateTime+"'></span></div>";

							if (priority == "CRITICAL") {
								var priority_check = "<span style='font-size: 14px;' class='badge badge-pill badge-danger' id='priority_small'>Critical</span>";
							}
							if (priority == "HIGH") {
								var priority_check = "<span style='font-size: 14px;' class='badge badge-pill badge-warning' id='priority_small'>High</span>";
							}
							if (priority == "NORMAL") {
								var priority_check = "<span style='font-size: 14px;' class='badge badge-pill badge-info' id='priority_small'>Normal</span>";
							}
							if (priority == "LOW") {
								var priority_check = "<span style='font-size: 14px;' class='badge badge-pill badge-secondary' id='priority_small'>Low</span>";
							}
							if(status == "OPEN"){
								var check_status = "<div class='card font-weight-bold' id='case_status' style='background-color: gold;'>OPEN</div>"
							}
							if(status == "PENDING"){
								var check_status = "<div class='card bg-warning font-weight-bold' id='case_status'>PENDING</div>"
							}
							if(status == "CLOSED"){
								var check_status = "<div class='card bg-success font-weight-bold' id='case_status'>CLOSED</div>"
							}
							if(status == "DELETED"){
								var check_status = "<div class='card text-white bg-dark font-weight-bold' id='case_status'>DELETED</div>"
							}
							$("#show_clicked_dashboard").show("slide");
							var html ='';
							html += "<div class='card-group w-75 mx-auto cardStyle cardContent'>";
							html += 	"<div class='card col-md-2 text-center border-right-0' style='padding: 30px 0;'>";
							html += 		"<div>";
							html += 			"<small id='case_number'>#"+caseNum+"</small><br>";
							html += 			check_status;
							html += 			"<small id='client_name'>"+client_fname+" "+client_lname+"</small><br>";
							html += 		"</div>";
							html += 	"</div>";
							html += 	"<div class='card col-md-8 border-left-0 border-right-0'>";
							html += 		"<div class='card-body'>";
							html += 			"<div>";
							html += 				"<h5 class='card-title' id='case_title'>"+caseTopic+" <sup><span class='badge badge-pill badge-info'>"+callType+"</span><sup></h5>";
							html += 				"<p class='card-text text-truncate' style='max-width: 540px'; id='case_info'>"+caseInfo+"</p>";
							html += 			"</div>";
							html += 			"<div>";
							html += 				"<small style='color:gray;font-style: italic;'>Reference: "+comp_name+"</small>";
							html += 			"</div>";
							html += 		"</div>";
							html += 	"</div>";
							html += 	"<div class='card col-md-2 border-left-0' style='padding: 30px 0;''>";
							html += 			"<small style='font-style: italic;'>Last updated:</small>";
							html += 			updateTimeLapse;
							html += 	"</div>";
							html += "</div>";
							html += "<div class='card-group bg-light mx-auto w-75 mb-3 cardStyle cardContent'>";
							html += 	"<div class='col-md-2 border-right border-secondary rounded'>";
							html += 		"<small style='font-style: italic;'>Issued date:</small><br>";
							html += 			"<div class='text-center'>";
							html += 				"<small id='issued_date_small'>"+issuedDateFormated+"</small>";
							html += 			"</div>";
							html += 	"</div>";
							html += 	"<div class='col-md-2 border-right border-secondary rounded'>";
							html += 		"<small style='font-style: italic;'>Raised by:</small><br>";
							html += 			"<div class='text-center'>";
							html += 				"<small id='raised_by_small'>"+raisedBy+"</small>"
							html += 			"</div>";
							html += 	"</div>";
							html += 	"<div class='col-md-3 border-right border-secondary rounded'>";
							html += 		"<small style='font-style: italic;'>Category:</small><br>";
							html += 			"<div class='text-center'>";
							html += 				"<small id='cat_small'>"+caseCat+"</small>";
							html += 			"</div>";
							html += 	"</div>";
							html += 	"<div class='col-md-2 border-right border-secondary rounded'>";
							html += 		"<small style='font-style: italic;'>Assigned to:</small><br>";
							html += 			"<div class='text-center'>";
							html += 				"<small id='assigned_to_small'>"+assignedTo+"</small>";
							html += 			"</div>";
							html += 	"</div>";
							html += 	"<div class='col-md-2 border-right border-secondary rounded'>";
							html += 		"<small style='font-style: italic;'>Priority:</small><br>";
							html += 			"<div class='text-center'>";
							html += 				"<small>"+priority_check+"</small>";
							html += 			"</div>";
							html += 	"</div>";
							html += 	"<div class='col-md-1'>";
							html += 		"<div class='text-center' style='padding-top: 11px; font-size:17px;'>";
							html += 			"<span id='editC_"+caseNum+"' class='fake-link'><i class='fas fa-edit'></i></span>";
							html += 		"</div>";
							html += 	"</div>";
							html += "</div>";
							$("#show_clicked_dashboard").append(html);
							cardArr.push(html);
						}
						showPage(1);
						pageSize = 20;
						var pageCount =  (len*2) / pageSize;
						if(pageCount%1 != 0){
							pageCount = pageCount+1;
						}
						$('#pagination-container').twbsPagination({
					        totalPages: pageCount,
					        visiblePages: 7,
					        onPageClick: function (event, page) {
							    showPage(page); 
					        }
					    });
						
					}else{
						$("#show_clicked_dashboard").empty();
						alert("No Case Available.")
					}
				}	
			});
		}
	};

	$("#open_case_card").click(function(){
		showClickedDashboard("openedCase");
		$("#hidden_clicked_dashboard").val("openedCase");
	});
	$("#pending_case_card").click(function(){
		showClickedDashboard("pendingCase");
		$("#hidden_clicked_dashboard").val("pendingCase");
	});
	$("#assigned_case_card").click(function(){
		showClickedDashboard("assignMe");
		$("#hidden_clicked_dashboard").val("assignMe");
	});
	$("#closed_case_card").click(function(){
		showClickedDashboard("closedCase");
		$("#hidden_clicked_dashboard").val("closedCase");
	});

	$(document).on("click",".myCase_link",function(event){
		if($("#hidden_clicked_dashboard").val() == "openedCase"){
			showClickedDashboard("openedCase_byme");
		}
		if($("#hidden_clicked_dashboard").val() == "pendingCase"){
			showClickedDashboard("pendingCase_byme");
			console.log($("#show_clicked_dashboard").val());
		}
		//assigne to me already dedicated to user himself//
		if($("#hidden_clicked_dashboard").val() == "closedCase"){
			showClickedDashboard("closedCase_byme");
			console.log($("#show_clicked_dashboard").val());
		}
	});

	// super admin function
	$("#checkShared").change(function(event){
		if($("#checkShared").is(':checked')){
			$("#sharedCompDiv").show("blind");
		}else{
			$("#sharedCompDiv").hide("blind");
			$("#sharedComp1, #sharedComp2, #sharedComp3").val("");
		}
	});
	$(".selectComp").on("change", function(event){
		 //restore previously selected value
       var prevValue = $(this).data('previous');
       $('.selectComp').not(this).find('option[value="'+prevValue+'"]').show();
       //hide option selected                
       var value = $(this).val();
       //update previously selected data
       if(value != ""){
	       $(this).data('previous',value);
	       $('.selectComp').not(this).find('option[value="'+value+'"]').hide();
       }
	});

	$("#manage_account_select").change(function(){
		var selectedUser = $("#manage_account_select").val();
		$("#save_manageAcc").prop("disabled",false);
		for( var i = 1; i<7; i++){
			$("#manageCompSelect_"+i).val("").attr("disabled",false);
		}
		$.ajax({
			url: 'getUser.php',
			type: 'post',
			data: {user_id:selectedUser, type:"get1user"},
			dataType: 'json',
			success:function(response){
				var len =  response.length;
				if(response != ""){
					$("#user_fname").val(response[0]["user_fname"]);
					$("#user_lname").val(response[0]["user_lname"]);
					$("#user_username").val(response[0]["user_username"]);
					$("#user_password").val(response[0]["user_password"]);
					$("#user_email").val(response[0]["user_email"]);
					$("#user_role").val(response[0]["user_role"]);
				}else{
					$("#user_fname, #user_lname, #user_username, #user_password, #user_email, #user_role").val("");
					$("#save_manageAcc").prop("disabled",true);
				}
			}
		});
		$.ajax({
			url: 'getWorkOnComp.php',
			type: 'post',
			data: {user_id:selectedUser},
			dataType: 'json',
			success:function(response){
				var len =  response.length;
				if(response != ""){
					$('.manageSelectComp').find('option').show();
					for( var i = 0; i<len; i++){
						$("#manageCompSelect_"+(i+1)).val(response[i]['comp_id']);
						$('.manageSelectComp').find('option[value="'+response[i]['comp_id']+'"]').hide();
					}
				}

			}
		});
	});

	$(".manageSelectComp").on("change", function(event){
		//restore previously selected value
       	var prevValue = $(this).data('previous');
		$('.manageSelectComp').not(this).find('option[value="'+prevValue+'"]').show();
		//hide option selected            
		var value = $(this).val();
		//update previously selected data
		if(value != ""){
			$(this).data('previous',value);
			$('.manageSelectComp').not(this).find('option[value="'+value+'"]').hide();
		}
	});

	
	$("#manage_account_form").submit(function(e){
		e.preventDefault();
		var comp1 = $("#manageCompSelect_1").val();
		var comp2 = $("#manageCompSelect_2").val();
		var comp3 = $("#manageCompSelect_3").val();
		var comp4 = $("#manageCompSelect_4").val();
		var comp5 = $("#manageCompSelect_5").val();
		var comp6 = $("#manageCompSelect_6").val();

		var formData = {
			type: "update",
			user_id : $("#manage_account_select").val(),
			firstName : $("#user_fname").val(),
			lastName : $("#user_lname").val(),
			Username : $("#user_username").val(),
			Password : $("#user_password").val(),
			Email : $("#user_email").val(),
			Role : $("#user_role").val(),
			comp1 : comp1,
			comp2 : comp2,
			comp3 : comp3,
			comp4 : comp4,
			comp5 : comp5,
			comp6 : comp6
		};

		$.ajax({
			url: 'save_manage_user.php',
			type: 'post',
			data: formData,
			dataType: 'json',
			success:function(response){
				if(response.type == 'success') {
					$('#messageDiv').addClass('alert alert-success').text(response.message);
				} else {
					$('#messageDiv').addClass('alert alert-danger').text(response.message);
				}
				if ($('.manageSelectComp option[value=""]:selected').length == 6) {
					$("#confirmDelUser_Modal").modal("show");
				}else{
					$("#alertModal").modal('show');
				}
			}
		});
	});

	$("#confirm_del_user_btn").click(function(){
		var selectedUser = $("#manage_account_select").val();
		$.ajax({
			url: 'save_manage_user.php',
			type: 'post',
			data: {user_id:selectedUser, type:"delete"},
			dataType: 'json',
			success:function(response){
				if(response != ""){
					$("#confirmDelUser_Modal, #manage_account_modal").modal("hide");
					$("#messageDiv").removeClass('alert alert-warning alert-success alert-danger');
					$('#messageDiv').addClass('alert alert-success').text(response.message);
					$("#alertModal").modal('show');
				}else{
					$('#messageDiv').addClass('alert alert-danger').text(response.message);
				}
			}
		})
	});

	$("#keep_user_btn").click(function(){
		$("#confirmDelUser_Modal, #manage_account_modal").modal("hide");
		$("#messageDiv").removeClass('alert alert-warning alert-success alert-danger');
		$('#messageDiv').addClass('alert alert-success').text("Save Successful");
		$("#alertModal").modal('show');
	});

	////chart function goes here////
	$(".datePicker").datepicker({
		autoclose: true,
		format: "dd/mm/yyyy",
		todayHighlight: true
	});

	var ctx_pie = document.getElementById("pieChart").getContext('2d');
	var ctx_line = document.getElementById("lineChart").getContext('2d');
	var myPieChart;
	var myLineChart;
	var from_date = 0;
    var to_date = 0;
    var new_fromDate =0;
	var new_toDate =0;
    var range = 0;

	function showPieGraph(date,month,year,comp_id,range,type,from_date,to_date){
		var formData = {
			month:month, 
			year:year, 
			date:date,
			chartType:"pie", 
			comp_id:comp_id, 
			range:range, 
			type:type,
			from_date: from_date,
			to_date: to_date
		};
		$.ajax({
			url: "getChart.php",
			method: "POST",
			dataType: "json",
			data: formData,
			success: function(response) {
				var len =  response.length;
				var label = [];
				var data1 = [];
				if(response != ""){
					for( var i = 0; i<len; i++){
						label.push(response[i]['cat_name']);
						data1.push(response[i]['amount']);
					}
					bgColor = ['#EA5B55','#FACE49','#319FDC','#3CAF84','#844E9A'];
				}else{
					label = ["No Data","No Data","No Data","No Data","No Data"];
					data1 = ["1","1","1","1","1"];
					bgColor = ['grey','grey','grey','grey','grey'];
				}
				var data = {
				    labels: label,
				    datasets: [
				        {
				            fill: true,
				            backgroundColor: bgColor,
				            data: data1,
							// Notice the borderColor 
				            borderColor: ['white', 'white', 'white', 'white', 'white'],
				            borderWidth: [2,2]
				        }
				    ]
				};

				// Notice the rotation from the documentation.
				var options = {
			        responsive: true,
			        title: {
						display: true,
						text: 'Top 5 Categories',
						position: 'top'
						},
			        rotation: -0.7 * Math.PI,
			        plugins: {
			        	labels: {
					        // render 'label', 'value', 'percentage', 'image' or custom function, default is 'percentage'
					        render: 'percentage',
					         // precision for percentage, default is 0
					        precision: 0,
					        // identifies whether or not labels of value 0 are displayed, default is false
					        showZero: true,
					        fontColor: 'white',
						    fontStyle: 'bold'
					    }
			        },
				};
				// Chart declaration:
				myPieChart = new Chart(ctx_pie, {
				    type: 'pie',
				    data: data,
				    options: options
				});
			}
		});
	}
	function showLineGraph(date,month,year,comp_id,range,type,from_date,to_date){
		var formData = {
			month:month, 
			year:year, 
			date:date,
			chartType:"line", 
			comp_id:comp_id, 
			range:range, 
			type:type,
			from_date: from_date,
			to_date: to_date
		};
		$.ajax({
			url: "getChart.php",
			method: "POST",
			dataType: "json",
			data: formData,
			success: function(response) {
				var len =  response.length;
				var label = [];
				var data1 = [];
				var data2 = [];
				if(response != ""){
					for( var i = 0; i<len; i++){
						label.push(response[i]['Label']);
						data1.push(response[i]['INB']);
						data2.push(response[i]['OUTB']);
					}
				}else{
					label = ["January","February","March","April","May","June","July","August","September","October","November","December"];
					data1 = ["0","0","0","0","0","0","0","0","0","0","0","0",];
					data2 = ["0","0","0","0","0","0","0","0","0","0","0","0",];
				}
				var data = {
				    labels: label,
				    datasets: [
				        {
				            label: "Inbound",
							data: data1,
							borderColor: "rgba(142, 94, 162, 1)",
							fill: false
				        },
				        {
				        	label: "Outbound",
							data:data2,
							borderColor: "rgba(206, 61, 92, 1)",
							fill: false
				        }
				    ]
				};

				// Notice the rotation from the documentation.
				var options = {
					// maintainAspectRatio: false,
					responsive: true,
			        title: {
						display: true,
						text: 'Calls Report',
						position: 'top'
						},
			        // responsive: true,
					tooltips: {
					  mode: 'index',
					  intersect: false,
					},
					hover: {
					  mode: 'nearest',
					  intersect: true
					},
					scales: {
					  xAxes: [{
					    display: true,
					    ticks: {
					    autoSkip : true
					    },
					    scaleLabel: {
					      display: false,
					      labelString: 'Date'
					    }
					  }],
					  yAxes: [{
					    display: true,
					    scaleLabel: {
					      display: true,
					      labelString: 'Calls Amount'
					    }
					  }]
					}
				};
				// Chart declaration:
				myLineChart = new Chart(ctx_line, {
				    type: 'line',
				    data: data,
				    options: options
				});

			}
		});
	}

	$("#graph_selectComp").change(function(){
		$('#fromDate, #toDate').val("");
		var selectComp_graph = $("#graph_selectComp").val();
		if($("#pieChart").is(":visible") && $("#lineChart").is(":hidden")){
			new_fromDate=0;
			new_toDate=0;
			myPieChart.destroy();
			range = parseInt(mm);
			var type = "monthYear";
			showPieGraph(dd,mm,yyyy,selectComp_graph,range,type,from_date,to_date);
		}
		if($("#lineChart").is(":visible") && $("#pieChart").is(":hidden")){
			new_fromDate=0;
			new_toDate=0;
			myLineChart.destroy();
			range = parseInt(mm);
			var type = "month";
			showLineGraph(dd,mm,yyyy,selectComp_graph,range,type,from_date,to_date);
		}
	});

	$("#showTop5_link").click(function(){
		// default show 1 month result
		new_fromDate=0;
		new_toDate=0;
		$('#fromDate, #toDate').val("");
		var selectComp_graph = $("#graph_selectComp").val();
		range = parseInt(mm);
		var type = "monthYear";
		if($("#report_div, #pieChart").is(":hidden")){
			showPieGraph(dd,mm,yyyy,selectComp_graph,range,type,from_date,to_date);
			$("#report_div, #pieChart").show("blind");
		}else{
			$("#report_div, #pieChart").hide("blind");
			myPieChart.destroy();
		}
		if($("#lineChart").is(":visible")){
			$("#lineChart").hide("blind");
			$("#pieChart").show("blind");
			myLineChart.destroy();
		}
		
	});
	$("#showCall_link").click(function(){
		$('#fromDate, #toDate').val("");
		new_fromDate=0;
		new_toDate=0;
		var selectComp_graph = $("#graph_selectComp").val();
		range = parseInt(mm);
		var type = "month";
		if($("#report_div, #lineChart").is(":hidden")){
			showLineGraph(dd,mm,yyyy,selectComp_graph,range,type,from_date,to_date);
			$("#report_div, #lineChart").show("blind");
		}else{
			$("#report_div, #lineChart").hide("blind");
			myLineChart.destroy();
		}
		if ($("#pieChart").is(":visible")) {
			$("#pieChart").hide("blind");
			$("#lineChart").show("blind");
			myPieChart.destroy();
		}
	});
		
	$("#1m").click(function(){
		$('#fromDate, #toDate').val("");
		new_fromDate=0;
		new_toDate=0;
		var selectComp_graph = $("#graph_selectComp").val();
		range = parseInt(mm);
		if($("#pieChart").is(":visible") && $("#lineChart").is(":hidden")){
			myPieChart.destroy();
			var type = "monthYear";
			showPieGraph(dd,mm,yyyy,selectComp_graph,range,type,from_date,to_date);
		}
		if($("#lineChart").is(":visible") && $("#pieChart").is(":hidden")){
			myLineChart.destroy();
			var type = "month";
			showLineGraph(dd,mm,yyyy,selectComp_graph,range,type,from_date,to_date);
		}
	});	
	$("#3m").click(function(){
		$('#fromDate, #toDate').val("");
		new_fromDate=0;
		new_toDate=0;
		var selectComp_graph = $("#graph_selectComp").val();
		range = mm-2;
		if($("#pieChart").is(":visible") && $("#lineChart").is(":hidden")){
			myPieChart.destroy();
			var type = "monthYear";
			showPieGraph(dd,mm,yyyy,selectComp_graph,range,type,from_date,to_date);
		}
		if($("#lineChart").is(":visible") && $("#pieChart").is(":hidden")){
			myLineChart.destroy();
			var type = "month";
			showLineGraph(dd,mm,yyyy,selectComp_graph,range,type,from_date,to_date);
		}
	});
	$("#6m").click(function(){
		$('#fromDate, #toDate').val("");
		new_fromDate=0;
		new_toDate=0;
		var selectComp_graph = $("#graph_selectComp").val();
		range = mm-5;
		if($("#pieChart").is(":visible") && $("#lineChart").is(":hidden")){
			myPieChart.destroy();
			var type = "monthYear";
			showPieGraph(dd,mm,yyyy,selectComp_graph,range,type,from_date,to_date);
		}
		if($("#lineChart").is(":visible") && $("#pieChart").is(":hidden")){
			myLineChart.destroy();
			var type = "month";
			showLineGraph(dd,mm,yyyy,selectComp_graph,range,type,from_date,to_date);
		}
	});
	$("#1y").click(function(){
		$('#fromDate, #toDate').val("");
		new_fromDate=0;
		new_toDate=0;
		var selectComp_graph = $("#graph_selectComp").val();
		range = 1;
		if($("#pieChart").is(":visible") && $("#lineChart").is(":hidden")){
			var type = "monthYear";
			myPieChart.destroy();
			showPieGraph(dd,mm,yyyy,selectComp_graph,range,type,from_date,to_date);
		}
		if($("#lineChart").is(":visible") && $("#pieChart").is(":hidden")){
			myLineChart.destroy();
			var type = "year";
			showLineGraph(dd,mm,yyyy,selectComp_graph,range,type,from_date,to_date);
		}
	});
	$("#1d").click(function(){
		$('#fromDate, #toDate').val("");
		new_fromDate=0;
		new_toDate=0;
		var selectComp_graph = $("#graph_selectComp").val();
		range = parseInt(mm);
		if($("#pieChart").is(":visible") && $("#lineChart").is(":hidden")){
			var type = "daily";
			myPieChart.destroy();
			showPieGraph(dd,mm,yyyy,selectComp_graph,range,type,from_date,to_date);
		}
		if($("#lineChart").is(":visible") && $("#pieChart").is(":hidden")){
			myLineChart.destroy();
			var type = "today";
			showLineGraph(dd,mm,yyyy,selectComp_graph,range,type,from_date,to_date);
		}
	});
	$('#filter_btn').click(function(e){ 
	    range = 0;
	    var from_date_raw = $('#fromDate').val();  
	    var to_date_raw = $('#toDate').val();  
	    var split_from_date = from_date_raw.split("/");
	    var split_to_date = to_date_raw.split("/");
	    var date = split_from_date[0];
	    var month = split_from_date[1];
	    var year = split_from_date[2];
	    var date2 = split_to_date[0];
	    var month2 =split_to_date[1];
	    var year2 = split_to_date[2];
	    new_fromDate = (year+"-"+month+"-"+date);
	    new_toDate = (year2+"-"+month2+"-"+date2);
	    var from_date = new Date (year+"-"+month+"-"+date);
	    var to_date = new Date(year2+"-"+month2+"-"+date2);
	    var timeDiff = Math.abs(to_date.getTime() - from_date.getTime());
	    var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 

		if($("#pieChart").is(":visible") && $("#lineChart").is(":hidden")){
			var selectComp_graph = $("#graph_selectComp").val();
	        if(from_date_raw != '' && to_date_raw != ''){ 
				myPieChart.destroy();
				type = "filter_btn"; 
				showPieGraph(dd,mm,yyyy,selectComp_graph,range,type,new_fromDate,new_toDate);
	        }else{  
	            alert("Please Select Date");  
	        } 
	    }
	    if($("#lineChart").is(":visible") && $("#pieChart").is(":hidden")){
	    	var selectComp_graph = $("#graph_selectComp").val();
	    	if(from_date_raw != '' && to_date_raw != '' && diffDays >2){ 
				myLineChart.destroy();
				var type = "filter_btn1";
				showLineGraph(dd,mm,yyyy,selectComp_graph,range,type,new_fromDate,new_toDate);
	        }else if (from_date_raw != '' && to_date_raw != '' && diffDays <=2 && diffDays>0) {
	        	myLineChart.destroy();
				var type = "filter_btn2";
				showLineGraph(dd,mm,yyyy,selectComp_graph,range,type,new_fromDate,new_toDate);
	        }else{  
	            alert("Please Select Date");  
	        }
		}
     });
     //export graph script from here  
	function downloadGraph(link, canvasId, filename) {
	    link.href = document.getElementById(canvasId).toDataURL();
	    link.download = filename;
	}
	// export JPG
	document.getElementById('export_jpg').addEventListener('click', function() {
		if($("#pieChart").is(":visible")){
			downloadGraph(this, 'pieChart', 'top5_report.jpg');
		}
		if($("#lineChart").is(":visible")){
			downloadGraph(this, 'lineChart', 'call_report.jpg');
		}
	},false);
	// export PNG
	document.getElementById('export_png').addEventListener('click', function() {
		if($("#pieChart").is(":visible")){
			downloadGraph(this, 'pieChart', 'top5_report.png');
		}
		if($("#lineChart").is(":visible")){
			downloadGraph(this, 'lineChart', 'call_report.png');
		}
	},false);

	// export Xlsx
	$("#export_xlsx").click(function(){	
		var form = document.createElement("form");
		form.setAttribute("method", "post");
		form.setAttribute("action", "export_xlsx.php");

		var hiddenField1 = document.createElement("input"); 
			hiddenField1.setAttribute("type", "hidden");
			hiddenField1.setAttribute("name", "comp_id");
			hiddenField1.setAttribute("value", $("#graph_selectComp").val());
		form.appendChild(hiddenField1);
		document.body.appendChild(form);
		var hiddenField2 = document.createElement("input"); 
			hiddenField2.setAttribute("type", "hidden");
			hiddenField2.setAttribute("name", "range");
			hiddenField2.setAttribute("value", range);
		form.appendChild(hiddenField2);
		document.body.appendChild(form);
		var hiddenField3 = document.createElement("input"); 
			hiddenField3.setAttribute("type", "hidden");
			hiddenField3.setAttribute("name", "year");
			hiddenField3.setAttribute("value", yyyy);
		form.appendChild(hiddenField3);
		document.body.appendChild(form);			
		var hiddenField4 = document.createElement("input"); 
			hiddenField4.setAttribute("type", "hidden");
			hiddenField4.setAttribute("name", "fromDate");
			hiddenField4.setAttribute("value", new_fromDate);
		form.appendChild(hiddenField4);
		document.body.appendChild(form);
		var hiddenField5 = document.createElement("input"); 
			hiddenField5.setAttribute("type", "hidden");
			hiddenField5.setAttribute("name", "toDate");
			hiddenField5.setAttribute("value", new_toDate);
		form.appendChild(hiddenField5);
		document.body.appendChild(form);

		form.submit();
	});

	// import script from here
	$("#import_customer_form").submit(function(event){
		event.preventDefault();
		var form = $('#import_customer_form')[0];
		var postData = new FormData(form);
		$.ajax({
		   url: "import_customer.php",
		   type: "POST",
		   data: postData,
		   dataType: "json",
		   processData: false,  // tell jQuery not to process the data
		   contentType: false,
		   success:function(response){
		   	if(response!=''){
				$('#import_customer_modal').modal('hide');
				$("#messageDiv").removeClass('alert alert-warning alert-success alert-danger');
			    if(response.type == 'success') {
					$('#messageDiv').addClass('alert alert-success').text(response.message);
				}else if(response.type == 'warning'){
					$('#messageDiv').addClass('alert alert-warning').text(response.message);
				}else {
					$('#messageDiv').addClass('alert alert-danger').text(response.message);
				}
				$("#alertModal").modal('show');
		   	}
		   }
        });
    });

});

