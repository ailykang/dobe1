<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
$board['bo_prefer_width'] = 182;
$board['bo_prefer_height'] = 50;
?>

<div class="clearfix"></div>
<!-- 게시판 목록 시작 { -->
<div id="bo_prefer" class="noto">
    <div class="pull-left">
        <h2 class="title_texts"><?php echo $bo_subject; ?></h2>
    </div>
    <div class="pull-right">
        <a href="<?php echo G5_URL ?>/services.php" target="_blank" class="btn-service">서비스안내</a>
    </div>
	<div class="mar20"></div>
    <div class="clearfix"></div>
    <ul id="gall_ul">
        <?php for ($i=0; $i<$rows; $i++) {
            if($i>0 && ($i % 4 == 0))
                $style = 'clear:both;';
            else
                $style = '';
            if ($i == 0) $k = 0;
            $k += 1;
            if ($k % 4 == 0) $style .= "margin:-1px 0 0 0 !important;";        
        ?>
        <li class="gall_li" style="width:<?php echo $board['bo_prefer_width'] + 20?>px">
            <ul class="gall_con">
                <?php
                        $thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $board['bo_prefer_width'], $board['bo_prefer_height']);

                        if($thumb['src']) {
                            $img_content = '<li class="gall_href"><a href="'.$list[$i]['href'].'"><img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$board['bo_prefer_width'].'" height="'.$board['bo_prefer_height'].'" class="border"></a>';
                            echo $img_content;
                    ?>
                   
                    <li class="gall_text_href ellipsis">
                        <a href="<?php echo $list[$i]['href'] ?>&work_1st=<?php echo $list[$i]['work_1st']?>">
                           <?php echo $list[$i]['company'] ?>
                        </a>
                    </li>
                    <li class="gall_text_href2">
                        <span class="<?php echo ($list[$i]['sr_time12'] >= G5_TIME_YMD) ? " font700":"";?><?php echo ($list[$i]['sr_time13'] >= G5_TIME_YMD) ? " service_color":"";?><?php echo ($list[$i]['sr_time14'] >= G5_TIME_YMD) ? " service_bg":"";?>"><?php echo cut_str($list[$i]['wr_content'], 14, "...");?></span>
                    </li>
		
		
				
		<!--------------필드맞춰주세요 ㅠㅠ------------>
				<li class="data_view2">   <span class="main_color">D-<?php echo $list[$i]['wr_hit'] ?></span>  <span class="g_color">( ~ <?php echo $list[$i]['closing_date'] ?> )</span>
				
					
				</li>
					<div class="clearfix h10"></div>
				<div class="clearfix line"></div>
					<div class="clearfix h10"></div>
				<li>
					<span style=" float: left;">
				 <?php echo ($list[$i]['sr_time11'] >= G5_TIME_YMD) ? "<img src='".G5_THEME_URL."/images/prefer.png' height='15'>":"";?>
				</span>
				<img src="<?php echo G5_THEME_URL ?>/images/like.png" style=" float: right;">	
					
		</li>
                    <?php } else {
                                $img_content = '<li class="gall_href gall_href2"><a href="'.G5_URL.'/services.php"><span style="width:'.$board['bo_prefer_width'].'px;height:109px"><img src="'.G5_THEME_URL.'/images/none_img.gif"></span></a>';
                                echo $img_content;
                    ?>
                       
                    <?php } ?>
            </ul>
        </li>
        <?php } ?>
    </ul>

</div>