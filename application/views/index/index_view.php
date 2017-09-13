<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
	<title>index</title>
	<style>
		table{
	    	border-collapse: collapse;
	    	width: 100%;
	    	style="table-layout:fixed"
		}
	    td, th{
	    	border: 2px solid #dddddd;
	        text-align: left;
	        padding: 3px;
	    }
	    tr:nth-child(even){
	    	background-color: #dddddd;
	    }
	    tr{
	    	cursor:pointer;
	    }
	    span{
	    	display:-webkit-inline-box;
	        width:100%;
	    }
	    div h3{
	    	background:#bbb;
	    	width:100%;"
	    	color:black;
	    	padding:10px;"
	    }
	</style>
</head>

<body>		
	<div><h3>개발 page목록</h3></div>
	<table>
		<tr>
			<th>이름</th>
			<th>url</th>
			<th>worker</th>
		</tr>
		<?php 
			foreach ($indexes as $row){   
		?>
	    <tr>
	   		<td><?= $row->항목; ?></td>
	    	<td><a href="<?= $row->url?>" /><?= $row->url ?></a></td>
	    	<td><?= $row->작성자 ?></td>
		</tr>
		<?php  
			}
		?>
	</table>
</body>
</html>