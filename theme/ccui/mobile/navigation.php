<?php if($pgr_id == "1" ){?>
	<div class="sub_navi sub_navi_1 pc_view wow fadeInDown" data-wow-delay="0.4s">
		<ul>
			<li><a href="/cont/0101.php">인사의 말씀</a></li>
			<li><a href="/cont/0102.php">정관</a></li>
			<li><a href="/cont/0103.php">개요</a></li>
			<li><a href="/cont/0104.php">연혁</a></li>
			<li><a href="/cont/0105.php">심볼 및 로고</a></li>
			<li><a href="/cont/0106.php">찾아오시는 길</a></li>
		</ul>
	</div>
<?}?>

<?php if($pgr_id == "2"){?>
	<div class="sub_navi sub_navi_2 pc_view wow fadeInDown" data-wow-delay="0.4s">
		<ul>
			<li><a href="/cont/0201.php">조직도</a></li>
			<li><a href="/cont/0202.php">역대대표회장</a></li>
			<li><a href="/cont/0203.php">임원</a></li>
			<li><a href="/cont/0204.php">연구위원장</a></li>
		</ul>
	</div>

<?}?>

<?php if($pgr_id == "3"){?>
	<div class="sub_navi sub_navi_3 pc_view wow fadeInDown" data-wow-delay="0.4s">
		<ul>
			<li><a href="/cont/0301.php">주요사업소개</a></li>
		</ul>
	</div>
<?}?>

<?php if($gr_id == "community"){?>
<?php if($bo_table == "free"){?>
<style>
.sub_navi_4 li:nth-child(1){background:#666;}
.sub_navi_4 li:nth-child(1) a{color:#fff; font-family:WOFF_4;}
</style>
<?}?>

<?php if($bo_table == "gallery"){?>
<style>
.sub_navi_4 li:nth-child(2){background:#666;}
.sub_navi_4 li:nth-child(2) a{color:#fff; font-family:WOFF_4;}
</style>
<?}?>

<?php if($bo_table == "chairman"){?>
<style>
.sub_navi_4 li:nth-child(3){background:#666;}
.sub_navi_4 li:nth-child(3) a{color:#fff; font-family:WOFF_4;}
</style>
<?}?>

<?php if($bo_table == "notice"){?>
<style>
.sub_navi_4 li:nth-child(4){background:#666;}
.sub_navi_4 li:nth-child(4) a{color:#fff; font-family:WOFF_4;}
</style>
<?}?>

	<div class="sub_navi sub_navi_4 pc_view wow fadeInDown" data-wow-delay="0.4s">
		<ul>
			<li><a href="/bbs/board.php?bo_table=free">자유게시판</a></li>
			<li><a href="/bbs/board.php?bo_table=gallery">사진자료실</a></li>
			<li><a href="/bbs/board.php?bo_table=chairman">위원장실</a></li>
			<li><a href="/bbs/board.php?bo_table=notice">공지사항</a></li>
		</ul>
	</div>
<?}?>

<?php if($gr_id == "movie"){?>


<?php if($bo_table == "worship"){?>
<style>
.sub_navi_5 li:nth-child(1){background:#666;}
.sub_navi_5 li:nth-child(1) a{color:#fff; font-family:WOFF_4;}
</style>
<?}?>

<?php if($bo_table == "event"){?>
<style>
.sub_navi_5 li:nth-child(2){background:#666;}
.sub_navi_5 li:nth-child(2) a{color:#fff; font-family:WOFF_4;}
</style>
<?}?>

<?php if($bo_table == "etc"){?>
<style>
.sub_navi_5 li:nth-child(3){background:#666;}
.sub_navi_5 li:nth-child(3) a{color:#fff; font-family:WOFF_4;}
</style>
<?}?>

	<div class="sub_navi sub_navi_5 pc_view wow fadeInDown" data-wow-delay="0.4s">
		<ul>
			<li><a href="/bbs/board.php?bo_table=worship">예배 영상</a></li>
			<li><a href="/bbs/board.php?bo_table=event">행사 영상</a></li>
			<li><a href="/bbs/board.php?bo_table=etc">기타 영상</a></li>
		</ul>
	</div>
<?}?>