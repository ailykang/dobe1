<?php
include_once('../../../common.php');
	$sql = " SELECT bo_category_list,bo_use_category FROM {$g5['board_table']} WHERE bo_table = '$bo_table'";
	$result = sql_query($sql);
	
	
	while ($row = sql_fetch_array($result))
	{
		if($row['bo_use_category'] != 0){
			$ca_list_val = explode("|",$row['bo_category_list']);
			echo '<option value="">입력받을 게시판 카테고리 선택</option>';
			for($k=0;$k<count($ca_list_val);$k++){
			?>
				<option value="<?=$ca_list_val[$k]?>"><?=$ca_list_val[$k]?></option>
			<?
			}
		}else{
		}
	}
?>