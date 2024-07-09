<?php
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

	$sql = " SELECT * FROM {$g5['write_prefix']}{$getFrom} WHERE wr_id = {$formNum}";
	$result = sql_query($sql);
	while ($regForm = sql_fetch_array($result))
    {	
		$j = 0;
		for($i=1; $i<9; $i++){
			if($regForm['wr_'.$i]){
				$formContent[$j] = $regForm['wr_'.$i];
				$j++;
			}	
		}
?>

		<form method="post" action="<?=G5_HTTP_BBS_URL?>/write_update.php" name="regSetForm" onsubmit="return submitForm(this)" id="regFormList">
			<input type="hidden" name="itemCnt" value='<?=$j?>'>
			<input type="hidden" name="token" value='<?php echo get_write_token($regForm['wr_9']); ?>'>
			<input type="hidden" name="bo_table" value="<?=$regForm['wr_9']?>">
			<input type="hidden" name="wr_name" value="관리자">
			<input type="hidden" name="wr_subject" value="<?=$regForm['wr_subject']?>">
			<input type="hidden" name="wr_content" value="<?=$regForm['wr_link1']?>">
			<input type="hidden" name="wr_25" value="상담전">
			<div class="regFormFrame">
				<h2 class="text-center mb-4"><?=$regForm['wr_subject']?></h2>
				<p class="text-center"><?=$regForm['wr_link1']?></p>
				<div class="regFormList">
					<ul>
					<?
						
						for($k=0;$k<count($formContent);$k++){
							
							$formList=explode('|',$formContent[$k]);	
							
		
							echo '<li class="wr_'.($k+1).' '.$formList[1].'">';
							echo '<input type="hidden" id="wr_'.($k+1).'" name="wr_'.($k+1).'" value="">';
							
							/*
							if($formList[3] == 'yes'){
								echo '<span class="req">';
							}else{
								echo '<span>';
							}
							echo $formList[0].'</span>';*/
							

							if($formList[1]=='text'){
								echo '<input type="text" placeholder="'.$formList[2].'" >';
							}

							if($formList[1]=='select'){
								echo '<select >';
								echo '<option value="">선택해주세요</option>';
								$formListCont = explode(',',$formList[2]);
								
								for($h=0;$h<count($formListCont);$h++){
									echo '<option value="'.$formListCont[$h].'">'.$formListCont[$h].'</option>';
								}

								echo '</select>';
							}

							if($formList[1]=='checkbox'){
								$formListCont = explode(',',$formList[2]);
								for($h=0;$h<count($formListCont);$h++){
									echo '<label><input type="checkbox" name="wr_'.($k+1).'_checkbox"  value="'.$formListCont[$h].'"> '.$formListCont[$h].' </label>';
								}
							}

							if($formList[1]=='radio'){
								$formListCont = explode(',',$formList[2]);
								for($h=0;$h<count($formListCont);$h++){
									echo '<label><input type="radio" name="wr_'.($k+1).'_radio" value="'.$formListCont[$h].'"> '.$formListCont[$h].' </label>';
								}
							}

							if($formList[1]=='tel'){
								echo '<select class="tel1">';
								$formListCont = explode(',',$formList[2]);
								
								for($h=0;$h<count($formListCont);$h++){
									echo '<option value="'.$formListCont[$h].'">'.$formListCont[$h].'</option>';
								}

								echo '</select>';
								echo '- <input type="text" placeholder="" name="" class="tel2">';
								echo '- <input type="text" placeholder="" name="" class="tel3">';
							}

							if($formList[1]=='email'){
								echo '<input type="text" placeholder="" class="email1"> @ ';
								echo '<input type="text" placeholder="" class="email2"> ';
								echo '<select onchange="selMail(this)">';
								echo '<option value="">직접입력</option>';
								$formListCont = explode(',',$formList[2]);
								for($h=0;$h<count($formListCont);$h++){
									echo '<option value="'.$formListCont[$h].'">'.$formListCont[$h].'</option>';
								}
								echo '</select>';
							}

							if($formList[1]=='textarea'){
								echo '<textarea placeholder="'.$formList[2].'"></textarea>';
							}

							if($formList[1]=='date'){
								echo '<textarea placeholder="'.$formList[2].'"></textarea>';
							}

							echo '</li>';
						}
					?>
					</ul>
				</div>
				<div class="regFormAgree">
					<label><input type="checkbox" name="iptAgree" > 개인정보 수집 및 처리방침에 동의합니다. </label>
					<button class="btn privacyView" type="button">전문보기</button>				
				</div>
				<div class="regFormBtn">
					<?echo captcha_html();?>
				</div>
				<div class="regFormBtn">
					<input type="submit" value="신청하기" class="btn_submit btn">

					<button class="btn" type="button">취소</button>				
				</div>
				<div class="regFormPrivacy">
					<h2>개인정보처리방침 <button type="button" class="btn privacyCloseBtn">닫기</button></h2>
					<div class="regFormPrivacyCont"><?=conv_content($regForm['wr_content'],'')?></div>
				</div>
			</div><!--regFormFrame-->
			
		</form>
<?
	}
?>

<script>
$(function() {
    $(".privacyView").click(function(){
		$(".regFormPrivacy").show();
	});

	$(".privacyCloseBtn").click(function(){
		$(".regFormPrivacy").hide();
	});
});

function selMail(a){
	var matlList = $(a);
	if(matlList.val()){
		matlList.parent().find('.email2').val(matlList.val());
	}else{
		matlList.parent().find('.email2').val('');
	}
}

function submitForm(frm){
	
	var cnt = parseInt(frm.itemCnt.value) + 1;
	
	for(var i='1'; i<cnt; i++){
		
		var inpVal = '';

		$(".wr_"+i+" > span").removeClass('focus');
		
		if($(".wr_"+i).hasClass('text')){
			inpVal = $(".wr_"+i+" > input[type='text']").val();
		}

		if($(".wr_"+i).hasClass('tel')){
			
			var tel = '';
			
			if($(".wr_"+i+" .tel2").val() && $(".wr_"+i+" .tel3").val()){
				tel = $(".wr_"+i+" .tel1").val()+'-'+$(".wr_"+i+" .tel2").val()+'-'+$(".wr_"+i+" .tel3").val();
			}
			inpVal = tel;
		}

		if($(".wr_"+i).hasClass('email')){
			var email = '';
			if($(".wr_"+i+" .email1").val() && $(".wr_"+i+" .email2").val()){
				email = $(".wr_"+i+" .email1").val()+'@'+$(".wr_"+i+" .email2").val();
			}
			inpVal = email;
		}

		if($(".wr_"+i).hasClass('radio')){
			var st = '';
			if($(":input:radio[name=wr_"+i+"_radio]:checked").val()){
				st = $(":input:radio[name=wr_"+i+"_radio]:checked").val();
			}
			inpVal = st;
		}

		if($(".wr_"+i).hasClass('checkbox')){
			var check = '';
			
			$("input[name=wr_"+i+"_checkbox]:checked").each(function() { 
				if(!check){
					check += $(this).val();
				}else{
					check += ','+$(this).val();
				}
			});

			inpVal = check;
		}

		if($(".wr_"+i).hasClass('select')){
			inpVal = $(".wr_"+i+" > select").val();
		}

		if($(".wr_"+i).hasClass('textarea')){
			inpVal = $(".wr_"+i+" > textarea").val();
		}

		if( $("#wr_"+i).parent().find('span').hasClass('req') && !inpVal ){
				alert($(".wr_"+i+" > span").text()+' : 필수입력항목입니다.');
				$(".wr_"+i+" > span").addClass('focus');
				return false;
		}else{
			$("#wr_"+i).val($(".wr_"+i+" > span").text()+inpVal);
			console.log($("#wr_"+i).val());			
		}

	}

	if(!frm.iptAgree.checked){
		alert('개인정보 수집에 동의해주세요!');
		return false;
	 }else{
		alert('신청이 완료되었습니다! 빠른 시간 내 연락드리겠습니다.');
		return true;	
	 }

}

</script>
