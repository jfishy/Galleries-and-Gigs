<!-- Josh Fish -->
<!DOCTYPE HTML>
<html>
	<head>
		<title>galleries & gigs</title>
		<style>
		.work
		{
			width: 15%;
			margin: 1%;
			border: thin solid;
		}
		#top>span
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
		html, body { height: 100%; width: 100%; margin: 0; }
		#artspace
		{
			border-radius: 12px;
			border: thin solid;
			width: 90%;
			height: 80%;
			background-color: #F8F8F8;
			margin:auto;
		}
		#disp
		{
			display:none;
			opacity: 0.9;
			position: fixed;
			z-index: 1;
			width: 100%;
			height: 100%;
			left: -1px;
			top:-1px;
			background-color:black;
		}
		#in
		{
			position:absolute;
			opacity:1;
			width: 50%;
			height: 60%;
			left: 25%;
			top:15%;
		}
		#return
			{
				width:10%;
				margin:auto;
			}
		</style>
		<?php 
			$conn = new PDO("mysql:hostname=localhost;dbname=josh fish", "root", "");
			$aname = $_POST["artist"];
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
			$cmd2 = "SELECT `uname` FROM `art`";
			$list = getDatabaseResults($cmd2);
			$rand =mt_rand(0,count($list));
			$rndName = $list[$rand][0];
				?>
		<script>
		function initialize()
		{
			artSpace = document.getElementById("artspace");
			big = document.getElementById("disp");
			bigIn = document.getElementById("in");
			<?php
			global $aname;
				$cmd = "SELECT `artwork` FROM `art` WHERE `uname` ='$aname'";
				$aa = getDatabaseResults($cmd);
				echo "artistArray = ".json_encode($aa).";";
			?>
			
				for(i=0; i< artistArray.length; i++)
				{
					artpiece = document.createElement("img");
					fileN = artistArray[i][0];
					dot = fileN.indexOf('.');
					endtag= fileN[dot] + fileN[dot+1] + fileN[dot+2] + fileN[dot+3];
					if(endtag == ".mp3")
					{
						artpiece.src = "uploads/play.jpg";
						var blah = "uploads/" + artistArray[i][0];
						//artpiece.setAttribute("location", "blah"); 
						artpiece.loca = blah;
						artpiece.className = "work";
						artpiece.setAttribute("onclick","playSound(this,this.loca);");
						artSpace.appendChild(artpiece);
					}
					else{
					artpiece.src = "uploads/" + artistArray[i][0];
					artpiece.className = "work";
					artpiece.setAttribute("onclick","show(this.src);");
					artSpace.appendChild(artpiece);
					}
				}
			
		}
		function playSound(el,soundfile) 
		{
              if (el.mp3) {
                  if(el.mp3.paused) el.mp3.play();
                  else el.mp3.pause();
              } else {
                  el.mp3 = new Audio(soundfile);
                  el.mp3.play();
              }
          }
		  function show(imgSrc)
		{
			bigIn.src = imgSrc;
			big.style.display = "block";
			big.setAttribute("onclick","hide(this)");
		}
		function hide(obj)
		{
			obj.style.display = "none";
		}
		</script>
	</head>
		
	<body onload = "initialize();">
		<h1 id = "top"><span> Artist: </span> <?php echo $_POST["artist"]; ?> </h1>
	<hr />
		
	<div id = "artspace">
	
	</div>
	<br/>
	<form id = "return" action="home.php" method="post">
		 <input type="hidden" name="name" value="<?php echo $_POST["prof"]; ?>">
		<input  id = "back" type = "submit" value = "return"/>
		 <input  type="hidden" name="first" value ="<?php echo $rndName; ?>" />
		</form>
	<div id ="disp" >
		<img id = "in" />
	</div>
	</body>
</html>