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
    echo $this->Html->css('bootstrap.css');
    echo $this->Html->css('jquery.bxslider.css');
    echo $this->Html->css('colorbox/' . 'colorbox.css');
    echo $this->Html->css('my_bootstrap.css' . "?date=" . date("YmdHis"));
    echo $this->Html->css('my_colorbox.css' . "?date=" . date("YmdHis"));
    echo $this->Html->css('loading.css' . "?date=" . date("YmdHis"));
	echo $this->Html->css('format.css' . "?date=" . date("YmdHis"));
	echo $this->Html->css($display . '.css?date=' . date("YmdHis"));

    echo $this->Html->script('jquery-1.11.3.min.js');
    echo $this->Html->script('jquery.color.js');
    echo $this->Html->script('bootstrap.js');
    echo $this->Html->script('jquery.bxslider.js');
    echo $this->Html->script('jquery.colorbox.js');
    echo $this->Html->script('ChartNew.js');
    echo $this->Html->script('my_colorbox.js' . "?date=" . date("YmdHis"));
    echo $this->Html->script('my_chart.js' . "?date=" . date("YmdHis"));
    echo $this->Html->script('loading.js' . "?date=" . date("YmdHis"));
    echo $this->Html->script('format.js' . "?date=" . date("YmdHis"));
    echo $this->Html->script('utils/codeConvert.js' . "?date=" . date("YmdHis"));
    echo $this->Html->script('utils/constants.js' . "?date=" . date("YmdHis"));
    echo $this->Html->script('utils/dateUtils.js' . "?date=" . date("YmdHis"));
    echo $this->Html->script('utils/stringUtils.js' . "?date=" . date("YmdHis"));
    echo $this->Html->script('utils/ajax.js' . "?date=" . date("YmdHis"));
	echo $this->Html->script($display . '.js?date=' . date("YmdHis"));
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

			<div class="submits">
				<a id="entry" href="#inline-entry">新規登録</a>
				<a id="login" href="#inline-login">ログイン</a>
			</div>
		</div>

		<div class="collapse navbar-collapse target">
			<ul class="nav navbar-nav navbar-left">
				<li <?php if((isset($display) and $display === "Homes") or !isset($display)){echo 'class="active"';} ?>><a href="./Homes">ホーム</a></li>
				<li <?php if(isset($display) and ($display === "Todays" or $display === "Analytics")){echo 'class="active"';} ?>><a href="./Todays">本日の開催</a></li>
				<li <?php if(isset($display) and $display === "RecentRaces"){echo 'class="active"';} ?>><a href="./RecentRaces">直近レース</a></li>
				<li <?php if(isset($display) and $display === "Rankings"){echo 'class="active"';} ?>><a href="./Rankings">ランキング</a></li>
				<li <?php if(isset($display) and $display === "Victorys"){echo 'class="active"';} ?>><a href="./Victorys">過去優勝者</a></li>
				<li <?php if(isset($display) and $display === "LotomotoMinis"){echo 'class="active"';} ?>><a href="./LotomotoMinis">モトロトmini</a></li>
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

</body>
</html>