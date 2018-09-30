<?php 	require_once('./Templates/header.php');?>

  <body>
    <?php 
    //SELECT objave vseh, ki jih sledimo
    if($_SESSION['admin'])
    {
        $query = "SELECT * FROM posts WHERE NOT(user_id = ?) ORDER BY date DESC";
    }
    else
    {
        $query = "SELECT * FROM posts WHERE user_id IN (SELECT user_id FROM follows WHERE follower_id = ?) ORDER BY date DESC";
    }
    if(isset($_GET['s'])){
    	$search = $_GET['s'];
    	if($search[0] == '#')
    	{

            //SELECT objav z določenimi tagi
    		$query = "SELECT * FROM posts p INNER JOIN posts_tags pt ON pt.post_id = p.id INNER JOIN tags t ON t.id = pt.tag_id WHERE tag = '".substr($search, 1)."'";
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
            //SELECT upodabnikov iz searcha
    		$query = "SELECT * FROM users WHERE name LIKE '%".$search."%' OR 
    		surname LIKE '%".$search."%'";
    		$stmt = $pdo->prepare($query);
    		$stmt->execute();
    		$line = $stmt->fetch();
		    for($i = 0; $i<$stmt->rowCount(); $i++)
		    {
    			echo '<div style="text-align: left; margin-top: 50px; margin-botom: 50px">
    			<p><a href="profile.php?username='.$line['username'].'">'.$line['name'].' '.$line['surname'].'</a></p></div>';
		    	$line = $stmt->fetch();
		    }

    	}
    }
    //Če $_GET['s'] ni nastavljen gre po default
    else
    {
    	$stmt = $pdo->prepare($query);
    	$stmt->execute([$_SESSION['user_id']]);

    	$line = $stmt->fetch();
        if(!empty($line))
        {
	    for($i = 0; $i<$stmt->rowCount(); $i++)
	    {
            if($_SESSION['admin'])
	    	echo '<div style="overflow: hidden"><h3 style="float: left; display: block; margin-right: 20px">'.$line['title'].'</h3><button id="'.$i.'" onclick="TitleOn(this.id)" style="float: left;height:48px;">Edit</button><form id="editTitle'.$i.'" style="display: inline-block; float:left; margin-left: 10px; visibility: hidden"><input style="left: 10px;" type="text" name="title"></form><h3 style="float: right"><a href="nekedit">Delete</a></h3></div><img width="600" src="'.$line['url'].'" alt="Image missing">
	    	<div style="overflow: hidden"><p style="float: left; margin-right: 10px">Description: This is the first image</p><button id="'.$i.'" onclick="ContentOn(this.id)" style="float: left; font-size: 10px">Edit</button><form id="editContent'.$i.'" style="display: inline-block; float_left; margin-left: 10px;visibility: hidden"><input type="text" name="content"></form></div>';
            else
                echo '<div style="text-align: center; margin-top: 50px; margin-botom: 50px"><h3 style="text-align: left">'.$line['title'].'</h3><img width="600" src="'.$line['url'].'" alt="Image missing">
            <p style="text-align: left">Description: '.$line['description'].'</p>';
	    	$line = $stmt->fetch();
	    }
    }
    }
    


    
    ?>
    <script>
        function TitleOn(id)
        {
            var form = "editTitle" + id;
            console.log(form);
            document.getElementById(form).style.visibility="visible";
        }
        function ContentOn(id)
        {
            var form = "editContent" + id;
            console.log(form);
            document.getElementById(form).style.visibility="visible";
        }
    </script>
    <div id="test"></div>
  </body>
  
<?php 	include_once('./Templates/footer.php');?>
