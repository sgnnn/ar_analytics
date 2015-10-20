<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv='Pragma' content='no-cache'>
  <meta http-equiv='Cache-Control' content='no-cache'>

  <meta name='keywords' content='オートレース,予想,的中' >
  <meta name='description' content='オートレースの予想をサポートするサイトです。予想に役立つ情報を公開しています。データを分析して予想を的中させよう！' >

  <?php echo $this->Html->charset(); ?>
  <title>
    オートレース アナリティクス
  </title>
  <?php
    echo $this->Html->meta('icon');
    header('Content-Type: text/css; charset=utf-8');
    echo $this->Html->css('colorbox/' . 'colorbox.css');
    echo $this->Html->css('lib/bootstrap.css');
    echo $this->Html->css('lib/jquery.bxslider.css');
    echo $this->Html->css('lib/my_bootstrap.css' . "?date=" . date("YmdHis"));
    echo $this->Html->css('lib/my_colorbox.css' . "?date=" . date("YmdHis"));
    echo $this->Html->css('utils/loading.css' . "?date=" . date("YmdHis"));
	echo $this->Html->css('view/format.css' . "?date=" . date("YmdHis"));
	echo $this->Html->css('view/' . $display . '.css?date=' . date("YmdHis"));

    echo $this->Html->script('lib/jquery-1.11.3.min.js');
    echo $this->Html->script('lib/jquery.color.js');
    echo $this->Html->script('lib/bootstrap.js');
    echo $this->Html->script('lib/jquery.bxslider.js');
    echo $this->Html->script('lib/jquery.colorbox.js');
    echo $this->Html->script('lib/ChartNew.js');
    echo $this->Html->script('lib/my_colorbox.js' . "?date=" . date("YmdHis"));
    echo $this->Html->script('lib/my_chart.js' . "?date=" . date("YmdHis"));
    echo $this->Html->script('utils/loading.js' . "?date=" . date("YmdHis"));
    echo $this->Html->script('utils/codeConvert.js' . "?date=" . date("YmdHis"));
    echo $this->Html->script('utils/constants.js' . "?date=" . date("YmdHis"));
    echo $this->Html->script('utils/dateUtils.js' . "?date=" . date("YmdHis"));
    echo $this->Html->script('utils/stringUtils.js' . "?date=" . date("YmdHis"));
    echo $this->Html->script('utils/ajax.js' . "?date=" . date("YmdHis"));
	echo $this->Html->script('view/format.js' . "?date=" . date("YmdHis"));
	echo $this->Html->script('view/' . $display . '.js?date=' . date("YmdHis"));
    echo $scripts_for_layout;

	//echo '<meta name="google-site-verification" content="Knzi0l339fW2XBQdXgDNnQqVREQUoYFIchsQYG7uiNM" />';
  ?>
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="nabbar-header">
			<button class="navbar-toggle" data-toggle="collapse" data-target=".target">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<div class="logo">
				<span id="logo_autorace" class="logo_autorace">
					AutoRace
				</span>
				<span class="logo_analytics">Analytics</span>
			</div>

			<!--
			<div class="logo_sub"><span>オートレース アナリティクス</span></div>
			-->

			<?php if($auth->loggedIn()){ ?>
				<div class="submits">
					<?php echo h($auth->user('username')); ?>
					<a id="logout" href="<?php echo $this->Html->url('/Users/logout', true);?>">ログアウト</a>
				</div>
			<?php } else{ ?>
				<div class="submits">
					<!--<a id="entry" href="">新規登録</a>-->
					<a id="login" href="<?php echo $this->Html->url('/Users/login', true);?>">ログイン</a>
				</div>
			<?php }?>
		</div>

		<div class="collapse navbar-collapse target">
			<ul class="nav navbar-nav navbar-left">
				<?php $classActive = (isset($display) and $display === "Homes" or !isset($display)) ? 'class="active"' : ""; ?>
				<li <?php echo $classActive; ?>><a href="<?php echo $this->Html->url('/Homes/', true);?>">ホーム</a></li>

				<?php $classActive = (isset($display) and ($display === "Todays" or $display === "Analytics")) ? 'class="active"' : ""; ?>
				<li <?php echo $classActive; ?>><a href="<?php echo $this->Html->url('/Todays/', true);?>">本日の開催</a></li>

				<?php $classActive = (isset($display) and $display === "RecentRaces") ? 'class="active"' : ""; ?>
				<li <?php echo $classActive; ?>><a href="<?php echo $this->Html->url('/RecentRaces/', true);?>">過去レース</a></li>

				<?php $classActive = (isset($display) and $display === "Rankings") ? 'class="active"' : ""; ?>
				<li <?php echo $classActive; ?>><a href="<?php echo $this->Html->url('/Rankings/', true);?>">ランキング</a></li>

				<?php $classActive = (isset($display) and $display === "Victorys") ? 'class="active"' : ""; ?>
				<li <?php echo $classActive; ?>><a href="<?php echo $this->Html->url('/Victorys/', true);?>">優勝者</a></li>

				<?php $classActive = (isset($display) and $display === "LotomotoMinis") ? 'class="active"' : ""; ?>
<!--				<li <?php echo $classActive; ?>><a href="<?php echo $this->Html->url('/LotomotoMinis/', true);?>">モトロトmini</a></li>
-->
			</ul>
		</div>
	</nav>

	<div class="container container_format main-container">
		<?php echo $content_for_layout; ?>
	</div>

	<div class="colorbox_init">
		<section id="inline-entry">
			<div class="btn_close"><a href="#">×</a></div>
			<div id="form">
				<p class="form-title">AutoRace Analytics 新規登録</p>
				<form action="post">
					<p>メールアドレス</p>
					<p class="mail"><input type="email" name="mail" /></p>
					<p class="submit"><input type="submit" value="新規登録" /></p>
				</form>
			</div>
		</section>
	</div>

	<div class="colorbox_init">
		<section id="inline-login">
			<div class="btn_close"><a href="#">×</a></div>
			<div id="form">
				<p class="form-title">AutoRace Analytics ログイン</p>
				<form action="post">
					<div class="post_input">
						<p>ユーザー名 または メールアドレス</p>
						<p class="mail"><input type="email" name="mail" /></p>
						<p>パスワード</p>
						<p class="pass"><input type="password" name="pass" /></p>
						<p class="check"><input type="checkbox" name="checkbox" />パスワードを保存</p>
					</div>
					<p class="submit"><input type="submit" value="ログイン" /></p>
				</form>
			</div>
		</section>
	</div>

	<div class="colorbox_init">
		<section id="inline-update">
			<div class="btn_close"><a href="#">×</a></div>
			<div id="form">
				<p class="form-title">AutoRace Analytics 会員情報変更</p>
				<form action="post">
					<div class="post_input">
						<p>ユーザー名 または メールアドレス</p>
						<p class="mail"><input type="email" name="mail" /></p>
						<p>パスワード</p>
						<p class="pass"><input type="password" name="pass" /></p>
						<p class="check"><input type="checkbox" name="checkbox" />パスワードを保存</p>
					</div>
					<p class="submit"><input type="submit" value="変更" /></p>
				</form>
			</div>
		</section>
	</div>

	<div class="colorbox_init">
		<section id="inline-logout">
			<div class="btn_close"><a href="#">×</a></div>
			<div id="form">
				<p class="form-title">AutoRace Analytics ログアウト</p>
				<form action="post">
					<p class="submit"><input type="submit" value="はい" /></p>
					<p class="submit"><input type="submit" value="いいえ" /></p>
				</form>
			</div>
		</section>
	</div>

	<div class="colorbox_init">
		<section id="inline-analytics">
			<div class="btn_close"><a href="#">×</a></div>
		</section>
	</div>

	<div class="colorbox_init">
		<section id="inline-race">
			<div class="btn_close"><a href="#">×</a></div>
			<div class="race_date_area">
				<div class="series_data">
					<div class="series_lg"></div>
					<div class="series_rank"></div>
					<div class="series_name"></div>
					<div class="race_data"></div>
				</div>
				<div class="race_data">
					<div class="race_date"></div>
					<div class="race_day"></div>
					<div class="race_name"></div>
					<div class="race_kyori"></div>
					<div class="race_runway"></div>
					<div class="race_heat"></div>
				</div>
				<div class="recode_data"></div>
			</div>
		</section>
	</div>

	<div class="colorbox_init">
		<section id="inline-racer">
			<div class="btn_close"><a href="#">×</a></div>
		</section>
	</div>

	<input type="hidden" id="url" value="<?php echo $this->Html->url('/', true);?>">
</body>
</html>