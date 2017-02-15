<!DOCTYPE HTML>
<!-- Josh Fish-->
<html>
	<head>
		<title></title>
			
		<style>
			#d
			{
				position:fixed;
				left: 28%;
				top: 15%;
				width: 40%;
				height: 28%;
				margin:auto;
				border:outset;
				border-color:blue;
				border-width: 8px;
				padding:8px;
				font-size: 23px;
				z-index:1;
			}
			#gray
			{
				display:none;
				opactiy:0.8;
				position:fixed;
				left:0px;
				top:0px;
				width:100%;
				height:100%;
				background-color:#F8F8F8;
			}
			#in
			{
				width:100%;
				height: 100px;
			}
			#send{
				position:relative;
				width: 10%;
				left:42%;
			}
			h1>span
			{
				color:blue;
			}
			h1
			{
				margin:auto;
				width: 50%;
				font-size: 40px;
				font-family:Palatino;
				text-align:center;
			}
			#messagespace
			{
				width: 80%;
				margin:auto;
				height: 80%;
				border: solid;
				border-radius:12px;
				padding:5px;
				background-color:#F8F8F8;
			}
			.new
			{
				background-color: #CCFFFF;
				width:100%;
				font-size: 23px;
				text-align:left;
				 border  : inset;
				 padding: 5px;
				 margin-top: 15px;
				 border-color:blue;
			}
			.old
			{
				background-color: white;
				width:100%;
				font-size: 23px;
				text-align:left;
				 border  : inset;
				  padding: 5px;
				  margin-top: 15px;
				   border-color:blue;
			}
			#return
			{
				width:10%;
				margin:auto;
			}
			html, body { height: 100%; width: 100%; margin: 0; }
			#exit>button
			{
				width:5%
				background-color:white;
				border:  solid red;
			}
			#exit
			{
				
				text-align:center;
				margin-right:4%;
				margin-top:30%;
			}
		</style>
		<?php
			$pageName = $_POST['prof'];
			$contactName = $_POST['artist'];
			$direct = $_POST['open'];
			$message = $_POST['inp'];
			
			$conn = new PDO("mysql:hostname=localhost;dbname=josh fish", "root", "");
			function getDatabaseResults($cmd, $arrayType = PDO::FETCH_BOTH)
				{
					//Use the global database connection.
					global $conn;
					
					//Prepare and execute the SQL command.
					$result = $conn->prepare($cmd);
					$result->execute();

					//Fetch all of the data and return the resulting 2D array.
					return $result->fetchAll($arrayType);
				}
			if($message != "first" && $message !="n" )
			{
				$mes = "$pageName: $message" ;
				if($message[0] == "r")
				{
					$mes2 = ltrim($mes,"$pageName: r");
					$cmd = "INSERT INTO `messages` VALUES ('$pageName','$mes2','old')";
					getDatabaseResults($cmd);
			
					$cmd2 = "DELETE FROM `messages` WHERE `message` = '$mes2' && `status` = 'new'";
					getDatabaseResults($cmd2);
				}
				else
				{
					$cmd = "INSERT INTO `messages` VALUES ('$contactName','$mes','new')";
			getDatabaseResults($cmd);
				}
			}
				
		?>
		<script>
		function initialize()
		{
			messageSpace = document.getElementById("messagespace");
			backg = document.getElementById("gray");
			dm = document.getElementById('d');
			text = document.getElementById("in");
			<?php echo "directState = '$direct' ;"; ?>
			<?php echo "pageN = '$pageName' ;"; ?>
			<?php echo "contactN = '$contactName' ;"; ?>
			if(directState == 'direct')
			{
				dm.style.display = "block";
				backg.style.display="block";
			}
			else
			{
				dm.style.display = "none";
				backg.style.display="none";
			}
			
			<?php
			global $pageName;
				$cmd = "SELECT `message` FROM `messages` WHERE `uname` ='$pageName'";
				$cmd2 = "SELECT `status` FROM `messages` WHERE `uname` ='$pageName'";
				$aa = getDatabaseResults($cmd);
				$bb = getDatabaseResults($cmd2);
				echo "messageArray = ".json_encode($aa).";";
				echo "statusArray = ".json_encode($bb).";";
			?>
			for(i=0; i< messageArray.length; i++)
				{
				var theMessage = messageArray[i][0];
				var stat = statusArray[i][0];
				var n = theMessage.substring(0,theMessage.indexOf(":"));
					my_form=document.createElement('FORM');
					my_form.name='myForm';
					my_form.method='POST';
					my_form.action='message.php';
					
					in1 = document.createElement("input");
					in1.type = "hidden";
					in1.name = "inp";
					in1.value = "r" + theMessage;
					my_form.appendChild(in1);
					
					in2 = document.createElement("input");
					in2.type = "hidden";
					in2.name = "prof";
					in2.value = pageN;
					my_form.appendChild(in2);
					
					in3 = document.createElement("input");
					in3.type = "hidden";
					in3.name = "artist";
					in3.value = n;
					my_form.appendChild(in3);
					
					in4 = document.createElement("input");
					in4.type = "hidden";
					in4.name = "open";
					in4.value = "direct";
					my_form.appendChild(in4);
					
					msg = document.createElement("input");
					msg.type = "submit";
					msg.value = theMessage;
					msg.className = stat;
					my_form.appendChild(msg);
					//artpiece.setAttribute("onclick","show(this.src);");
					messageSpace.appendChild(my_form);
				}
		}
		
		function exit()
		{
			dm.style.display = "none";
			backg.style.display="none";
		}
		</script>
		
		
	</head>
		
	<body onload = "initialize();">
	<h1> <span><?php echo $pageName ; ?>'s</span> messages </h1>
	<hr/>
	<div id = "messagespace" >
	</div>
	<div id = "gray">
	<div id = "d">
		To <span><?php echo $contactName ; ?> </span>
		<hr />
		From <span><?php echo $pageName ; ?> </span>
		<br/>
		<form method = "post" action = "message.php" >
		<input id = "in" type = 'text' name ="inp" />
		<input type="hidden" name="prof" value="<?php echo $pageName ; ?>" />
		<input type="hidden" name="artist" value="<?php echo $contactName ; ?>" />
		<input type="hidden" name="open" value="not" />
		<input id="send" type = "submit" value = "send" />
		</form>
		<br/>
		
	</div>
	<!--<div id ="exit"><button  onclick="exit();"> exit</button></div>-->
	</div>
	<br/>
	<form id ="return" action="home.php" method="post">
		 <input type="hidden" name="name" value="<?php echo $pageName; ?>">
		 <input  type="hidden" name="first" value ="<?php echo $contactName; ?>" />
		<input  id = "back" type = "submit" value = "return"/>
		</form>
	</body>
</html>