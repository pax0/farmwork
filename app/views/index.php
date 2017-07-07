<!DOCTYPE html>
<html>
<head>
	<title>Framwork</title>

	<style>
		html, body {
			height: 100%;
		}

		body {
			margin: 0;
			padding: 0;
			width: 100%;
			display: table;
			font-weight: 100;
		}

		.container {
			text-align: center;
			display: table-cell;
			vertical-align: middle;
		}

		.content {
			text-align: center;
			display: inline-block;
		}

		.title {
			font-size: 96px;
		}

		.line {
			color: black;
		}
	</style>
</head>
<body>

<div class="container">
	<div class="content">
		<div class="title">Framework</div>
		<span class="line"><b><?= $name ?></b></span>
	</div>
</div>
<div>
<?php $this->view('test', array('test'=>array(1, 2, 3, 4, 5),'name' => 'vvke')) ?>
</div>
</body>
</html>