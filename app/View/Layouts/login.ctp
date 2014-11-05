<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'Automated Liquidation Development Preview | ');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>
		Login
	</title>
	<?php
		echo $this->Html->meta('icon');

	//	echo $this->Html->css('cake.generic');
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('AdminLTE');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
		<style type="text/css">
			body { margin-top: 70px; }
		</style>
</head>
<body>
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Automated Liquidation <small>version 0.1 Albury</small></a>
			</div>
		</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div id="content">
					<?php echo $this->fetch('content'); ?>
				</div>
			</div>
		</div>
	</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>

	<?php
		echo $this->Html->script("jquery-1.10.2");
		echo $this->Html->script("bootstrap"); 
	?>
</body>
</html>
