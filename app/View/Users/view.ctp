<?php
	//print_r($user);
	echo '<h2>' . $user['User']['fname'] . ' ' . $user['User']['lname'];
	echo '<small> '.$user['User']['role'].'</small></h2>';
	echo '<br />';
	//print_r($orgs);
?>
	<h2>Organisations</h2>
<?php
	foreach ($orgs as $org) 
	{
		echo '<p>' . $org['Organisation']['name'] . '</p>';
	}
?>
<?php
    $this->start('sidebar');
    echo $this->Html->link("<span class=\"glyphicon glyphicon-chevron-tag\"></span> Add or Remove Organisations", array('action'=>'organisations',$user['User']['id']),array('escape' => false, 'class' => 'btn btn-info') );
    echo '<br />';
    echo '<br />';
    echo $this->Html->link("<span class=\"glyphicon glyphicon-chevron-left\"></span> Back to Liquidations Index", array('action'=>'index'),array('escape' => false, 'class' => 'btn btn-primary') );
    $this->end();
?>