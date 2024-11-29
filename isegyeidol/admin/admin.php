<?php
include_once './includes/part/inc_common.php';
$menu_code = 'home';
$js_array = [''];
$css_array = [''];
$g_title = 'admin';
$logo = '../source/img/main-logo.png';
$footerLogo = '../source/img/Notion-logo.png';
$commonC = 'css/common.css';
include_once './includes/part/inc_header.php';

?>
<style>
	.text {
		font-size: 3rem;
		width: 100%;
		align-items: center;

	}
</style>
<main style="margin-top: 20rem;">
	<div class="d-flex">
		<img src="<?= $logo ?>" alt="" class="w-50">
		<span class="w-50 text">Admin Page</span>
	</div>
</main>
<?php
include_once './includes/part/inc_footer.php';
?>