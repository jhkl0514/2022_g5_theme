<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/head.php');
    return;
}

if(G5_COMMUNITY_USE === false) {
    define('G5_IS_COMMUNITY_PAGE', true);
    include_once(G5_THEME_SHOP_PATH.'/shop.head.php');
    return;
}
include_once(G5_THEME_PATH.'/head.sub.php'); 
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
?>

<!-- 상단 시작 { -->
<div id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>
    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어 BBS게시판 경로
    }
    ?>
    
    <div id="hd_wrapper">

        <div id="logo">
            <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_IMG_URL ?>/logo.png" alt="<?php echo $config['cf_title']; ?>"></a>
        </div>


		 <nav id="gnb">
			<h2>메인메뉴</h2>
			<div class="gnb_wrap">
				<ul id="gnb_1dul">
					
					<?php
					$menu_datas = get_menu_db(0, true);
					$gnb_zindex = 999; // gnb_1dli z-index 값 설정용
					$i = 0;
					foreach( $menu_datas as $row ){
						if( empty($row) ) continue;
						$add_class = (isset($row['sub']) && $row['sub']) ? 'gnb_al_li_plus' : '';
					?>
					<li class="gnb_1dli <?php echo $add_class; ?>" style="z-index:<?php echo $gnb_zindex--; ?>">
						<a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?></a>
						<?php
						$k = 0;
						foreach( (array) $row['sub'] as $row2 ){

							if( empty($row2) ) continue; 

							if($k == 0)
								echo '<span class="bg">하위분류</span><div class="gnb_2dul"><ul class="gnb_2dul_box">'.PHP_EOL;
						?>
							<li class="gnb_2dli"><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="gnb_2da"><?php echo $row2['me_name'] ?></a></li>
						<?php
						$k++;
						}   //end foreach $row2

						if($k > 0)
							echo '</ul></div>'.PHP_EOL;
						?>
					</li>
					<?php
					$i++;
					}   //end foreach $row

					if ($i == 0) {  ?>
						<li class="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
					<?php } ?>
				</ul>				
			</div>
		 </nav>

    
     
        <ul class="hd_login">        
            <?php if ($is_member) {  ?>
            <li><a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php">정보수정</a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>

				<?php if ($is_admin) {  ?>
				<li class="tnb_admin"><a href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>">관리자</a></li>
				<?php }  ?>

            <?php } else {  ?>
            <li><a href="<?php echo G5_BBS_URL ?>/register.php">회원가입</a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/login.php">로그인</a></li>
            <?php }  ?>

        </ul>
    </div>
    
   
    <script>
    
    $(function(){
        $(".gnb_menu_btn").click(function(){
            $("#gnb_all, #gnb_all_bg").show();
        });
        $(".gnb_close_btn, #gnb_all_bg").click(function(){
            $("#gnb_all, #gnb_all_bg").hide();
        });
    });

    </script>
</div>
<!-- } 상단 끝 -->


<hr>

<!-- 콘텐츠 시작 { -->
<div id="wrapper">
    <div id="container_wr">

<?
if(defined('_INDEX_')) { // index에서만 실행
?>

	<ul class="slide">
	<li><img src="<? echo G5_THEME_IMG_URL?>/img1.jpg" alt=""></li>
	<li><img src="<? echo G5_THEME_IMG_URL?>/img2.jpg" alt=""></li>
	<li><img src="<? echo G5_THEME_IMG_URL?>/img3.jpg" alt=""></li>
	<li><img src="<? echo G5_THEME_IMG_URL?>/img4.jpg" alt=""></li>
	</ul>

	<script>
		$(".slide").bxSlider()
	</script>

<? } else{ ?>   

<div class="visualWrap">
	<?php echo get_head_title($g5['title']); ?>
</div>

<? } ?>


    <div id="container">
        <?php if (!defined("_INDEX_")) { ?><h2 id="container_title"><span title="<?php echo get_text($g5['title']); ?>"><?php echo get_head_title($g5['title']); ?></span></h2><?php }