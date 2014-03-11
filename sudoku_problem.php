<html>
<head>
	<title>
	</title>
	
	<style>
		[title=box]
		{
			height:45px;
			width:50px;
			font-size:30px;
			font-weight:bold;
			font-family:arial;
			text-align:center;
	        padding-top:5px;
		}
	</style>
</head>
<body>
<h1>Enter any sudoku problem and click to submit button you will get the answer</h1>
<form action="sudoku_solution.php" method="post">
<table border="2">
<?php
	for($i=0;$i<9;$i++)
	{
		echo '<tr>';
		for($j=0;$j<9;$j++)
		{
			echo '<td>';
			
			if($i<3 && $j<3)
			{
				echo '<input type="text" title="box" name='.$i.$j.' style="background-color:blue">';
			}
			else if($i<3 && ($j<6 && $j>2))
                echo '<input type="text" title="box" name='.$i.$j.' style="background-color:red">';
			else if($i<3 && ($j<9 && $j>5))
                echo '<input type="text" title="box" name='.$i.$j.' style="background-color:yellow">';
			else if(($i<6 && $i>2) && ($j<3))
                echo '<input type="text" title="box" name='.$i.$j.' style="background-color:green">';
			else if(($i<6 && $i>2) && ($j<6 && $j>2))
                echo '<input type="text" title="box" name='.$i.$j.' style="background-color:orange">';
			else if(($i<6 && $i>2) && ($j<9 && $j>5))
                echo '<input type="text" title="box" name='.$i.$j.' style="background-color:grey">';
			else if(($i<9 && $i>5) && ($j<3))
                echo '<input type="text" title="box" name='.$i.$j.' style="background-color:lightgrey">';
			else if(($i<9 && $i>5) && ($j<6 && $j>2))
                echo '<input type="text" title="box" name='.$i.$j.' style="background-color:pink">';
			else
                echo '<input type="text" title="box" name='.$i.$j.' style="background-color:blue">';
			echo '</td>';
		}
		echo '</tr>';
	}
?>
</table>
<input type="submit" value="submit">
</form>
</body>
</html>