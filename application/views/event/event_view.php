<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>event</title>
</head>
<body>	
	<?php foreach ( $events as $event ) { ?>
		<img src="<?=경로_이벤트.$event->배너파일?>" alt="<?=htmlspecialchars($event->제목,ENT_QUOTES)?>" width="100%"/>
	<?php }	?>
</body>

</html>