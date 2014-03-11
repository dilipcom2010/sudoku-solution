<html>
<head>
	<title>
	</title>
	<style>
	.mark1
	{
	   float:left;
	   height:42px;
	   width:50px;
	   font-family:arial;
	   font-weight:bold;
	   font-size:30px;
	   background-color:green;
	   border:1px solid white;
	   text-align:center;
	   padding-top:8px;
	}
	.mark2
	{
		height:470px;
		width:470px;
		border:1px solid black;
	}
	.btn
	{
		padding-top:10px; padding-bottom:10px; padding-left:20px; padding-right:20px;line-height:20px;
		font-style:verdana; font-size:17px; color:white;
		background-color:#0072c5;
		border-radius:5px;
		text-decoration:none;
	}
	</style>
</head>
<body>

<a class="btn" href="sudoku_problem.php">Back</a>

<?php
 $stack1[0][0]=0;  
 $top=-1;  
 $sud[0][0]=0;
 $given[0][0]=0;
 $top2=-1;

	for($i=0;$i<9;$i++)
	{
		for($j=0;$j<9;$j++)
		{
			$name=$i.$j;
			if($_POST[$name]==NULL)
			     $sud[$i][$j]=0;
			else
			{
				$sud[$i][$j]=$_POST[$name];
				$top2=$top2+1;
				$given[$top2][0]=$i;
				$given[$top2][1]=$j;
			}
		}
	}
	//below for loop is responsible for printing given sudoku problem
	/*for($i=0;$i<9;$i++)
	{
		for($j=0;$j<9;$j++)
		{
			echo $sud[$i][$j].' &nbsp';
		}
		echo '<br>';
	}*/
	echo '<br><br>';
	main1();
?>

<?php
function main1()
{
		$i; $j; $p; $q; $check;
		global $stack1;
        global $top; 
	    global $sud;
		
		for($i=1;$i<=9;$i++)
		{
			$p=0;  $q=0;
				while($p<9)
				{
					$check=fix($p,$q,$i,$stack1,$sud,$top);
					if($check==1)
					{
						$p++; $q=0;
					}	
					else
					{
						$p=$stack1[$top][0];
						$q=$stack1[$top][1];
						$i=$stack1[$top][2];
						$top=$top-1;
						$sud[$p][$q]=0;
						$q++;
					}
				}
		}	
		display($stack1,$sud,$top);
	return 0;	    
}

function fix($p , $q , $n)
{
		global $stack1;
        global $top; 
		global $sud;
		$i;  $j;  $z;  $s;  $t;  $u;  $v;  $x;  $y;
		for($i=$q;$i<9;$i++)
		    if($sud[$p][$i]==$n)
		        return 1;
		        
		for($i=$q;$i<9;$i++)
		{
			$z=0;
			if($sud[$p][$i]!=0)
			     continue;
			for($j=0;$j<9;$j++)
			    if($sud[$j][$i]==$n)
			     {$z=1; break;}
			     
			 
			  if($p<3 && $i<3)
			  {
				  $s=0; $t=2; $u=0; $v=2;
			  }
			  else if($p<3 && ($i<6 && $i>2))
			  {
				  $s=0; $t=2; $u=3; $v=5;
			  }
			  else if($p<3 && ($i<9 && $i>5))
			  {
				  $s=0; $t=2; $u=6; $v=8;
			  }
			  else if(($p>2 && $p<6) && $i<3)
			  {
				  $s=3; $t=5; $u=0; $v=2;
			  }
			  else if(($p>2 && $p<6) && ($i>2 && $i<6))
			  {
				  $s=3; $t=5; $u=3; $v=5;
			  }
			  else if(($p>2 && $p<6) && ($i<9 && $i>5))
			  {
				  $s=3; $t=5; $u=6; $v=8;
			  }
			  else if(($p>5 && $p<9)  && $i<3)
			  {
				  $s=6; $t=8; $u=0; $v=2;
			  }
			  else if(($p>5 && $p<9) && ($i>2 && $i<6))
			  {
				  $s=6; $t=8; $u=3; $v=5;
			  }
			  else
			  {
				  $s=6; $t=8; $u=6; $v=8;
			  }
			  
			  for($x=$s;$x<=$t;$x++)
			  {
				  for($y=$u;$y<=$v;$y++)
				  {
					  if($sud[$x][$y]==$n)
					  { $z=1;  break;}
				  }
			  }
			      
			     
			 if($z==0)
			 {
				push($p,$i,$n,$stack1,$sud,$top);
				return 1;
			 }    
		}
	return 0;	
}

function push($i , $j , $n)
{
		global $stack1;
		global $top; 
		global $sud;
	//echo 'hi';
	$top=$top+1;
	$stack1[$top][0]=$i;
	$stack1[$top][1]=$j;
	$stack1[$top][2]=$n;
	$sud[$i][$j]=$n;
	return 0;
}

function display()
{
	global $stack1;
    global $top; 
	global $sud;
	$i; $j;
	//echo '<br><br>';
	
	//below for loop is responsible for printing sudoku solution
	echo '<div class="mark2">';
	for($i=0;$i<9;$i++)
	{
		for($j=0;$j<9;$j++)
		{
			$status=checkx($i,$j);
			if($status==1)
			    echo '<div class="mark1" style="background-color:lightgreen; color:red">'.$sud[$i][$j].'</div>';
			else if($i<3 && $j<3)
			{
				echo '<div class="mark1" style="background-color:blue">'.$sud[$i][$j].'</div>';
			}
			else if($i<3 && ($j<6 && $j>2))
			    echo '<div class="mark1" style="background-color:lightblue">'.$sud[$i][$j].'</div>';
			else if($i<3 && ($j<9 && $j>5))
                echo '<div class="mark1" style="background-color:yellow">'.$sud[$i][$j].'</div>';
			else if(($i<6 && $i>2) && ($j<3))
                echo '<div class="mark1" style="background-color:green">'.$sud[$i][$j].'</div>';
			else if(($i<6 && $i>2) && ($j<6 && $j>2))
                echo '<div class="mark1" style="background-color:orange">'.$sud[$i][$j].'</div>';
			else if(($i<6 && $i>2) && ($j<9 && $j>5))
                echo '<div class="mark1" style="background-color:grey">'.$sud[$i][$j].'</div>';
			else if(($i<9 && $i>5) && ($j<3))
                echo '<div class="mark1" style="background-color:lightgrey">'.$sud[$i][$j].'</div>';
			else if(($i<9 && $i>5) && ($j<6 && $j>2))
                echo '<div class="mark1" style="background-color:pink">'.$sud[$i][$j].'</div>';
			else
                echo '<div class="mark1" style="background-color:blue">'.$sud[$i][$j].'</div>';
				
		}
	}
	
	echo '</div>';
	
}

function checkx($l,$m)
{
	global $given;
	global $top2;
	for($i=0;$i<=$top2;$i++)
	{
		if($given[$i][0]==$l && $given[$i][1]==$m)
		     return 1;
	}
	return 0;
}

?>
<br><br><br>

</body>
</html>