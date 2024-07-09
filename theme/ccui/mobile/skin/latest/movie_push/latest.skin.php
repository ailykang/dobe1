<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
$board['bo_movie_push_width'] = 580;
$board['bo_movie_push_height'] = 430;
?>


<!-- 게시판 목록 시작 { -->
<div id="bo_movie_push">
    <h2><a href="<?php echo get_pretty_url($bo_table); ?>" class="lt_title"><?php echo $bo_subject ?></a></h2>
	<p>기독문화통일연구원의 예배 영상과 함께<br>은혜 넘치는 날  함께하세요.</p>
	<a class="a_btn" href="/bbs/board.php?bo_table=worship">더 보기 →</a>
    <ul id="gall_ul">
        <?php for ($i=0; $i<count($list); $i++) {
            if($i>0 && ($i % 4 == 0))
               $style = 'clear:both;';
            else
              $style = '';
            if ($i == 0) $k = 0;
			  $k += 1;
            if ($k % 4 == 0) $style .= "margin:-1px 0 0 0 !important;";        
        ?>
        <li class="gall_li">
            <ul class="gall_con">
          <div style="width:100%;text-align: left;">
<?php
$youtube_link = $list[$i]['wr_link1'];
if($youtube_link != ""){
$youtube_url = explode("/", $youtube_link);
$movieimg = "https://img.youtube.com/vi/".$youtube_url[3]."/maxresdefault.jpg"; 
echo '<div class="video-container"><iframe width="100%" height="430" src="https://www.youtube.com/embed/'.$youtube_url[3].'?autoplay=1&mute=1"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>';
}
?>
            </ul>
        </li>		
        <?php } ?>
    </ul>

</div>