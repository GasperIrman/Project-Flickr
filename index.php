<?php 	require_once('./Templates/header.php');?>

  <body>
    <?php 
    $query = "SELECT * FROM posts WHERE user_id IN (SELECT user_id FROM follows WHERE follower_id = ?) ORDER BY date DESC";
    if(isset($_GET['s'])){
    	$search = $_GET['s'];
    	if($search[0] == '#')
    	{
    		$query = "SELECT * FROM posts p INNER JOIN posts_tags pt ON pt.post_id = p.id INNER JOIN tags t ON t.id = pt.tag_id WHERE tag = '".$search."'";
    		    $stmt = $pdo->prepare($query);
    			$stmt->execute();

    		$line = $stmt->fetch();
		    for($i = 0; $i<$stmt->rowCount(); $i++)
		    {
		    	echo '<div style="text-align: center; margin-top: 50px; margin-botom: 50px"><img width="600" src="'.$line['url'].'" alt="Image missing">
		    	<p style="text-align: left">Description: '.$line['description'].'</p>
		    	</div>';
		    	$line = $stmt->fetch();
		    }
    	}
    	else
    	{
    		$query = "SELECT * FROM users WHERE name LIKE '%".$search."%' OR 
    		surname LIKE '%".$search."%'";
    		$stmt = $pdo->prepare($query);
    		$stmt->execute();
    		$line = $stmt->fetch();
		    for($i = 0; $i<$stmt->rowCount(); $i++)
		    {
    			echo '<div style="text-align: left; margin-top: 50px; margin-botom: 50px">
    			<p><a>'.$line['name'].' '.$line['surname'].'</a></p></div>';
		    	$line = $stmt->fetch();
		    }

    	}
    }
    else
    {
    	$stmt = $pdo->prepare($query);
    	$stmt->execute([$_SESSION['user_id']]);

    	$line = $stmt->fetch();
	    for($i = 0; $i<$stmt->rowCount(); $i++)
	    {
	    	echo '<div style="text-align: center; margin-top: 50px; margin-botom: 50px"><img width="600" src="'.$line['url'].'" alt="Image missing">
	    	<p style="text-align: left">Description: '.$line['description'].'</p>
	    	</div>';
	    	$line = $stmt->fetch();
	    }
    }
    


    
    ?>
    <div id="test"></div>
  </body>
  
<?php 	include_once('./Templates/footer.php');?>
