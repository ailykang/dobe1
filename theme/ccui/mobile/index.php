<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_MOBILE_PATH.'/head.php');
?>

<!-- 배너 최신글 -->
<?php
//echo latest('theme/banner', 'banner', 4, 150);
?>
<div id="index">
<p style="text-align:center;">
	<img src="<?php echo G5_IMG_URL ?>/intro.png" alt="도배드라마 견적문의">
</p>
<?php
$getFrom="regForm";
$formNum="1";
include_once(G5_PATH.'/reg_form.php');	
?>

<!--
<h2 class="text-center mb-4">견적문의</h2>
<div class="form-container">

    <form action="/submit_order" method="POST">
        <div class="form-group">
            <label for="reserver_name">예약자명:</label>
            <input type="text" id="reserver_name" name="reserver_name" required>
        </div>
        <div class="form-group">
            <label for="phone">연락처:</label>
            <select id="phone_prefix" name="phone_prefix">
                <option value="010">010</option>
                <option value="011">011</option>
                <option value="016">016</option>
                <option value="017">017</option>
                <option value="018">018</option>
                <option value="019">019</option>
            </select>
            <input type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}" required>
        </div>
        <div class="form-group">
            <label for="desired_date">희망 시공 일자:</label>
            <input type="date" id="desired_date" name="desired_date" required>
        </div>
        <div class="form-group">
            <label>엘리베이터 유무:</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="elevator_yes" name="elevator" value="yes">
                <label class="form-check-label" for="elevator_yes">있음</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="elevator_no" name="elevator" value="no">
                <label class="form-check-label" for="elevator_no">없음</label>
            </div>
        </div>
        <div class="form-group">
            <label for="wallpaper">벽지 색상 및 품번:</label>
            <input type="text" id="wallpaper" name="wallpaper">
        </div>
        <div class="form-group">
            <label for="flooring">장판 색상 및 품번:</label>
            <input type="text" id="flooring" name="flooring">
        </div>
        <div class="form-group">
            <label for="amount">금액:</label>
            <input type="text" id="amount" name="amount">
        </div>
        <div class="form-group">
            <label>결제 방법:</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="payment_card" name="payment_method" value="card">
                <label class="form-check-label" for="payment_card">카드</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="payment_cash" name="payment_method" value="cash">
                <label class="form-check-label" for="payment_cash">현금</label>
            </div>
        </div>
        <div class="form-group">
            <label for="other_notes">기타 사항:</label>
            <textarea id="other_notes" name="other_notes" rows="4"></textarea>
        </div>
        <div class="checkbox-group">
            <input type="checkbox" id="agree_policy" name="agree_policy" required>
            <label for="agree_policy">개인정보 수집 및 취급 방침에 동의합니다.</label>
        </div>
        <button type="submit" class="btn-submit">견적문의 제출</button>
    </form>
	-->
</div>


<?php
//echo latest('theme/about', 'sub_banner', 1, 33);
?>
</div>
<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>