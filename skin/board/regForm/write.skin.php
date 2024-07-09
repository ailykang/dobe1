<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<section id="bo_w">
    <h2 class="sound_only"><?php echo $g5['title'] ?></h2>

    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) {
        $option = '';
        if ($is_notice) {
            $option .= "\n".'<input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'>'."\n".'<label for="notice">공지</label>';
        }

        if ($is_html) {
            if ($is_dhtml_editor) {
                $option_hidden .= '<input type="hidden" value="html1" name="html">';
            } else {
                $option .= "\n".'<input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'."\n".'<label for="html">HTML</label>';
            }
        }

        if ($is_secret) {
            if ($is_admin || $is_secret==1) {
                $option .= "\n".'<input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'>'."\n".'<label for="secret">비밀글</label>';
            } else {
                $option_hidden .= '<input type="hidden" name="secret" value="secret">';
            }
        }

        if ($is_mail) {
            $option .= "\n".'<input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'>'."\n".'<label for="mail">답변메일받기</label>';
        }
    }

    echo $option_hidden;
    ?>

    <?php if ($is_category) { ?>
    <div class="bo_w_select write_div">
        <label for="ca_name"  class="sound_only">분류<strong>필수</strong></label>
        <select name="ca_name" id="ca_name" required>
            <option value="">분류를 선택하세요</option>
            <?php echo $category_option ?>
        </select>
    </div>
    <?php } ?>

    <div class="bo_w_info write_div">
    <?php if ($is_name) { ?>
        <label for="wr_name" class="sound_only">이름<strong>필수</strong></label>
        <input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input required" placeholder="이름">
    <?php } ?>

    <?php if ($is_password) { ?>
        <label for="wr_password" class="sound_only">비밀번호<strong>필수</strong></label>
        <input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="frm_input <?php echo $password_required ?>" placeholder="비밀번호">
    <?php } ?>

    <?php if ($is_email) { ?>
            <label for="wr_email" class="sound_only">이메일</label>
            <input type="text" name="wr_email" value="<?php echo $email ?>" id="wr_email" class="frm_input email " placeholder="이메일">
    <?php } ?>
    </div>

    <?php if ($is_homepage) { ?>
    <div class="write_div">
        <label for="wr_homepage" class="sound_only">홈페이지</label>
        <input type="text" name="wr_homepage" value="<?php echo $homepage ?>" id="wr_homepage" class="frm_input full_input" size="50" placeholder="홈페이지">
    </div>
    <?php } ?>

<!--     <?php if ($option) { ?> -->
<!--     <div class="write_div"> -->
<!--         <span class="sound_only">옵션</span> -->
<!--         <?php echo $option ?> -->
<!--     </div> -->
<!--     <?php } ?> -->

    <div class="bo_w_tit write_div">
        <label for="wr_subject" class="sound_only">제목<strong>필수</strong></label>
        
        <div id="autosave_wrapper write_div">
            <input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input full_input required" size="50" maxlength="255" placeholder="제목">
            <?php if ($is_member) { // 임시 저장된 글 기능 ?>
            <script src="<?php echo G5_JS_URL; ?>/autosave.js"></script>
            <?php if($editor_content_js) echo $editor_content_js; ?>
            <button type="button" id="btn_autosave" class="btn_frmline">임시 저장된 글 (<span id="autosave_count"><?php echo $autosave_count; ?></span>)</button>
            <div id="autosave_pop">
                <strong>임시 저장된 글 목록</strong>
                <ul></ul>
                <div><button type="button" class="autosave_close">닫기</button></div>
            </div>
            <?php } ?>
        </div>
        
    </div>


    <div class="write_div">
        <label for="wr_link1" class="sound_only">내용<strong>필수</strong></label>
		<textarea name="wr_link1" id="wr_link1"><?=$write['wr_link1']?></textarea>        
    </div>
	
    <div class="write_div">
        <label for="wr_subject" class="sound_only">입력받을 게시판 Code</label>
		
		<select class="bo_w_select required" required name="wr_9" onchange="get_list(this)" data-skinurl="<?=$board_skin_url?>">
			<option value="">입력받을 게시판 선택</option>
			<?	
				$sql = " SELECT bo_table,bo_category_list,bo_use_category FROM {$g5['board_table']} WHERE 1";
				$result = sql_query($sql);
				$ca_list = '';
				while ($row = sql_fetch_array($result))
				{
					if($write['wr_9']==$row['bo_table'] && $row['bo_use_category'] != 0){
						$ca_list = $row['bo_category_list'];
					}
			?>
					<option value="<?=$row['bo_table']?>" <?if($write['wr_9']==$row['bo_table']){echo 'selected';}?>><?=$row['bo_table']?></option>
			<?
				}
			?>
		</select>
    </div>
	<div class="write_div" id="cateIpt">
	<?
	if(!$write['wr_9'] || $ca_list){
	?>
    
        <label for="wr_subject" class="sound_only">입력받을 게시판 카테고리</label>
		<select class="bo_w_select required" required name="wr_10" id="wr_10">
		<?
			if($ca_list){
				echo '<option value="">입력받을 게시판 카테고리 선택</option>';
				$ca_list_val = explode("|",$ca_list);
				for($k=0;$k<count($ca_list_val);$k++){
				?>
					<option value="<?=$ca_list_val[$k]?>" <?if($write['wr_10']==$ca_list_val[$k]){echo 'selected';}?>><?=$ca_list_val[$k]?></option>
				<?
				}
			}
		?>
		</select>    
	<?
		}
	?>
	</div>

	<?include('script.php');?>

	<div class="write_div">
		<button type="button" class="btn_submit btn" onclick="addCol()">추가</button>
	</div>
	
	<section id="regFormList">
<?
	$j = 0;
	for($i=1; $i<9; $i++){
		if($write['wr_'.$i]){
			$formContent[$j] = $write['wr_'.$i];
			$j++;
		}	
	}
	if(!$formContent){
		$listCnt= 2;
	}else{
		$listCnt= count($formContent);
	}
	for($k=0;$k<$listCnt;$k++){
		$formList=explode('|',$formContent[$k]);
?>		
		<div class="write_div ">
			<input type="text" name="reg_title" value="<?=$formList[0]?>" id="" class="frm_input reg_title" placeholder="항목이름" >
			<select class="bo_w_select reg_sel" name="reg_sel" id="" onchange="selType(this)">
				<option value="">입력타입선택</option>
				<option <?if($formList[1]=='text'){ echo 'selected'; }?> value="text">text</option>
				<option <?if($formList[1]=='select'){ echo 'selected'; }?> value="select">select</option>
				<option <?if($formList[1]=='checkbox'){ echo 'selected'; }?> value="checkbox">checkbox</option>
				<option <?if($formList[1]=='radio'){ echo 'selected'; }?> value="radio">radio</option>
				<option <?if($formList[1]=='tel'){ echo 'selected'; }?> value="tel">tel</option>
				<option <?if($formList[1]=='email'){ echo 'selected'; }?> value="email">email</option>
				<option <?if($formList[1]=='textarea'){ echo 'selected'; }?> value="textarea">textarea</option>
			</select>
			<input type="text" name="reg_type" value="<?=$formList[2]?>" id="" class="frm_input type_input" placeholder="< 입력타입선택" size="50" >
			<select class="bo_w_select reg_req" name="reg_req" id="">
				<option <?if($formList[3]=='yes'){ echo 'selected'; }?> value="yes">필수입력</option>
				<option <?if($formList[3]=='no'){ echo 'selected'; }?> value="no">선택입력</option>
			</select>
			<button type="button" onclick="addCol(this)" class="btn">바로아래추가</button>
			<button type="button" onclick="delCol(this)" class="btn_submit btn">삭제</button>
		</div>
<?
	}
?>
	</section>

	<div class="regPreview">
		<div class="regFormBox">
			<div class="regFormFrame">
				<h2>빠른상담신청</h2>
				<p>빠른상담신청을 남겨주시면, 바로 연락드리겠습니다.</p>
				<div class="regFormList">
					<ul>
					</ul>
				</div>
				<div class="regFormAgree">
					<label><input type="checkbox" name=""> 개인정보 수집 및 처리방침에 동의합니다. </label>
					<button class="btn" type="button">전문보기</button>				
				</div>
				<div class="regFormBtn">
					<button class="btn_submit btn" type="button">신청하기</button>				
					<button class="btn" type="button">취소</button>				
				</div>
				<div class="regFormBtn" style="margin-top:30px;">
					<button class="btn" type="button" onclick='preview_close()'>닫기</button>				
				</div>
			</div><!--regFormFrame-->
		</div>
	</div>




	<div class="write_div">
		<h2>개인정보처리방침 <a class="btn" href="https://www.privacy.go.kr/a3sc/per/inf/perInfStep01.do" target="_blank">개인정보처리방침 만들기</a>  </h2>
		<textarea name="wr_content" class="privacy"><?
		if(!$write['wr_content']){
			include('privacy.php');
		}else{
			echo $write['wr_content'];
		}
		?></textarea>
	</div>

    <?php if ($is_use_captcha) { //자동등록방지  ?>
    <div class="write_div">
        <?php echo $captcha_html ?>
    </div>
    <?php } ?>


    <div class="btn_confirm write_div">
        
		<a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel btn">취소</a>
        <input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn_submit btn">
		<button type="button" class="btn_submit btn" onclick="preview()">미리보기</button>
    </div>
    </form>

    <script>
    <?php if($write_min || $write_max) { ?>
    // 글자수 제한
    var char_min = parseInt(<?php echo $write_min; ?>); // 최소
    var char_max = parseInt(<?php echo $write_max; ?>); // 최대
    check_byte("wr_content", "char_count");

    $(function() {
        $("#wr_content").on("keyup", function() {
            check_byte("wr_content", "char_count");
        });
    });

    <?php } ?>
    function html_auto_br(obj)
    {
        if (obj.checked) {
            result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
            if (result)
                obj.value = "html2";
            else
                obj.value = "html1";
        }
        else
            obj.value = "";
    }

    function fwrite_submit(f)
    {
        <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

        var subject = "";
        var content = "";
        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: {
                "subject": f.wr_subject.value,
                "content": f.wr_content.value
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                subject = data.subject;
                content = data.content;
            }
        });
		
		

        if (subject) {
            alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
            f.wr_subject.focus();
            return false;
        }

        if (content) {
            alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
            if (typeof(ed_wr_content) != "undefined")
                ed_wr_content.returnFalse();
            else
                f.wr_content.focus();
            return false;
        }

        if (document.getElementById("char_count")) {
            if (char_min > 0 || char_max > 0) {
                var cnt = parseInt(check_byte("wr_content", "char_count"));
                if (char_min > 0 && char_min > cnt) {
                    alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                    return false;
                }
                else if (char_max > 0 && char_max < cnt) {
                    alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                    return false;
                }
            }
        }

        <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

        document.getElementById("btn_submit").disabled = "disabled";
		
        return true;
    }
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->