<script>

//var previewCode = false;

function get_list(a){
	
	$.get($(a).data('skinurl')+'/get_list.php','bo_table='+$(a).val(),function(res){
		if(!res){
			$("#wr_10").remove();
		}else{
			var caList = '';
			caList += '<select class="bo_w_select required" required name="wr_10" id="wr_10">';
			caList += res;
			caList += '</select>';
			$("#cateIpt").html(caList);
		}
		
	});
}

$(function() {
	
	$("#btn_submit").hide();
	$("#container").css({'z-index':'1000'});
	//regFormList

});

function preview(){

	$(".inphdd").remove();

	console.log($("#regFormList .write_div").length);

	var cnt = parseInt($("#regFormList .write_div").length) + 1;
	var divNum = '';
	var inpVal = '';
	var inpHtml_ = '';
	var carte = '';
	console.log(cnt);
	for(var i=1; i<cnt; i++){
		var divCall = $("#regFormList .write_div:nth-child("+i+")");
		inpVal = '';
		carte = '';
		
		if(!divCall.find('.reg_title').val()){
			alert('항목이름을 입력해주세요!');
			divCall.find('.reg_title').focus();
			return false;
		}else if(!divCall.find('.reg_sel').val()){
			alert('입력타입을 선택해주세요!');
			divCall.find('.reg_title').focus();
			return false;
		}
		
		inpVal += '<input type="hidden" name="wr_'+i+'" class="inphdd" value="';
		inpVal += divCall.find('.reg_title').val()+'|';
		inpVal += divCall.find('.reg_sel').val()+'|';
		inpVal += divCall.find('.type_input').val()+'|';
		inpVal += divCall.find('.reg_req').val();
		inpVal += '">';
	

		inpHtml_ += '<li>';
		
		if(divCall.find('.reg_req').val() == 'yes'){
			inpHtml_ += '<span class="req">';
		}else{
			inpHtml_ += '<span>';
		}

		inpHtml_ += divCall.find('.reg_title').val()+'</span>';
		
		if(divCall.find('.reg_sel').val() == 'text'){
			inpHtml_ += '<input type="text" placeholder="'+divCall.find('.type_input').val()+'" name="">';
		}

		if(divCall.find('.reg_sel').val() == 'select'){
			
			carte = divCall.find('.type_input').val().split(",");

			inpHtml_ += '<select>';
			inpHtml_ += '<option value="">선택해주세요</option>';
			for(var j = 0; j<carte.length; j++){
				inpHtml_ += '<option value="'+carte[j]+'">'+carte[j]+'</option>';
			}
			inpHtml_ += '</select>';
		}

		if(divCall.find('.reg_sel').val() == 'checkbox'){
			
			carte = divCall.find('.type_input').val().split(",");
		
			for(var j = 0; j<carte.length; j++){
				inpHtml_ += '<label><input type="checkbox" name="" value="'+carte[j]+'">'+carte[j]+'</label>';
			}
		}

		if(divCall.find('.reg_sel').val() == 'radio'){
			
			carte = divCall.find('.type_input').val().split(",");
		
			for(var j = 0; j<carte.length; j++){
				inpHtml_ += '<label><input type="radio" name="radioNm" value="'+carte[j]+'"> '+carte[j]+' </label>';
			}
		}

		if(divCall.find('.reg_sel').val() == 'tel'){
			
			carte = divCall.find('.type_input').val().split(",");
		
			inpHtml_ += '<select>';
			for(var j = 0; j<carte.length; j++){
				inpHtml_ += '<option value="'+carte[j]+'">'+carte[j]+'</option>';
			}
			inpHtml_ += '</select>';
			inpHtml_ += '- <input type="text" placeholder="" name="" class="tel">';
			inpHtml_ += '- <input type="text" placeholder="" name="" class="tel">';
		}

		if(divCall.find('.reg_sel').val() == 'email'){
			
			carte = divCall.find('.type_input').val().split(",");
		
			inpHtml_ += '<input type="text" placeholder="" name="" class="email"> @';
			inpHtml_ += '<input type="text" placeholder="" name="" class="email">';

			inpHtml_ += '<select>';
			inpHtml_ += '<option value="">직접입력</option>';
			for(var j = 0; j<carte.length; j++){
				inpHtml_ += '<option value="'+carte[j]+'">'+carte[j]+'</option>';
			}
			inpHtml_ += '</select>';
			
		}

		if(divCall.find('.reg_sel').val() == 'textarea'){
				
			inpHtml_ += '<textarea placeholder="'+divCall.find('.type_input').val()+'"></textarea>';
			
		}
		
		inpHtml_ += '</li>';
		

		console.log(i+':'+inpVal);
		$("#regFormList").append(inpVal);
	}

	$(".regFormFrame h2").html($("#wr_subject").val());
	$(".regFormFrame p").html($("#wr_link1").val());
	
//	console.log(i+':'+inpHtml_);

	$(".regFormList ul").html(inpHtml_);
	$(".regPreview").show();
}

function preview_close(){
	$(".regPreview").hide();
	$("#btn_submit").show();
}

function insertValue(a){
	
	var inputBox = $(a);
	var reg_title=inputBox.parent().find('.reg_title').val();
	var reg_sel=inputBox.parent().find('.reg_sel').val();
	var type_input=inputBox.parent().find('.type_input').val();
	var reg_req=inputBox.parent().find('.reg_req').val();
	var inpVal = reg_title+'|'+reg_sel+'|'+type_input+'|'+reg_req;
	
	var divNum = inputBox.parent().index() + 1;
	console.log(inpVal);
	$("#wr_"+divNum).val(inpVal);
}

function addCol(a){
	var cnt = $("#regFormList .write_div").length;

	var formHtml_ = '';


	formHtml_ += '<input type="text" name="reg_title" value="" id="" class="frm_input reg_title" placeholder="항목이름" >\n';
	formHtml_ += '<select class="bo_w_select reg_sel" name="reg_sel" id="" onchange="selType(this)">';
	formHtml_ += '<option value="">입력타입선택</option>';
	formHtml_ += '<option value="text">text</option>';
	formHtml_ += '<option value="select">select</option>';
	formHtml_ += '<option value="checkbox">checkbox</option>';
	formHtml_ += '<option value="radio">radio</option>';
	formHtml_ += '<option value="tel">tel</option>';
	formHtml_ += '<option value="email">email</option>';
	formHtml_ += '<option value="textarea">textarea</option>';
	formHtml_ += '</select>\n';
	formHtml_ += '<input type="text" name="reg_type" value="" id="" class="frm_input type_input" placeholder="< 입력타입선택" size="50" >\n';
	formHtml_ += '<select class="bo_w_select reg_req" name="reg_req" id="">';
	formHtml_ += '<option value="yes">필수입력</option>';
	formHtml_ += '<option value="no">선택입력</option>';
	formHtml_ += '</select>\n';
	formHtml_ += '<button type="button" onclick="addCol(this)" class="btn">바로아래추가</button>\n';
	formHtml_ += '<button type="button" onclick="delCol(this)" class="btn_submit btn">삭제</button>';


	if(cnt > 7){
		alert('항목은 최대 8개까지 입력가능합니다.');
	}else{
	
		var add = $(a);
		var _form = '';
		_form += '<div class="write_div">\n';
		_form += formHtml_;
		_form += '</div>';

		if(a){
			add.parent().after(_form);
		}else{
			$("#regFormList").append(_form);
		}
	}
}

function delCol(a){
	
	var cnt = $("#regFormList .write_div").length;
	if(cnt < 3){
		alert('최소 2가지는 입력항목을 유지해야 합니다.');
	}else{
		var del = $(a);
		del.parent().remove();
	}
}

function selType(a){
	var sel = $(a);
	$(a).parent().find('.type_input').val('');
	var typeVal = sel.val();

	if(sel.val() == ''){
		$(a).parent().find('.type_input').attr('placeholder','< 입력타입선택');
	}

	if(sel.val() == 'text'){
		$(a).parent().find('.type_input').attr('placeholder','placeholder 입력 ex) 이름을 입력해주세요!');
	}

	if(sel.val() == 'select' || sel.val() == 'checkbox' || sel.val() == 'radio'){
		$(a).parent().find('.type_input').attr('placeholder','항목입력 "," 로 구분 입력 ex) option1,option2');
	}

	if(sel.val() == 'tel'){
		$(a).parent().find('.type_input').val('010,011,016,017,018,019');
	}

	if(sel.val() == 'email'){
		$(a).parent().find('.type_input').val('naver.com,nate.com,gmail.com,daum.net,hotmail.com');
	}

	if(sel.val() == 'textarea'){
		$(a).parent().find('.type_input').attr('placeholder','placeholder 입력 ex) 내용을 입력해주세요!');
	}

}

</script>
