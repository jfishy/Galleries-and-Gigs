<!DOCTYPE HTML>
<!-- Josh Fish-->
<html>
	<head>
		<title></title>
			
		<style>
		#top
		{
		position: fixed;

		height: 20%;
		width: 100%;
		left:0px;
		top:0px;
		}
		#icon
		{
			position:absolute;
			width: 10%;
			height: 80%;
			left: 5px;
			top: 5px;
		}
		#icon >img
		{
			position: absolute;
			border: thin solid;
			width: 95%;
			border-radius: 6px;
			padding: 1%;
		}
		#p
		{
			border-style: solid;
			border-left-color: white;
			border-right-color: white;
			width: 85%;
			height: 95%;
			padding-top: 2.5%;
			padding-bottom: 2.5%;
			
		}
		#bar 
		{
		position:absolute;
		width: 100%;
		height: 5%;
		top: 80%;
		}
		
		
		
		/* Dropdown Button */
	.dropbtn 
	{
    background-color: white;
	border: thin solid black;
	margin-left: 5%;
    color: blue;
	font-size: 18px;
    padding-bottom:5px;
	padding-left: 2px;
	padding-right:2px;
    cursor: pointer;
	}

/* Dropdown button on hover & focus */
.dropbtn:hover, .dropbtn:focus 
{
    background-color: #66CCFF;
}

/* The container  - needed to position the dropdown content */
.dropdown 
{
    position: relative;
    display: inline-block;
	left: 65%;
	margin-left: 2%;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content 
{
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}

/* Links inside the dropdown */
.dropdown-content a 
{
    color: black;
	font-size: 17px;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
	border: thin solid;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #f1f1f1}

/* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
.show {display:block;}

.aname
{
	color:blue;
}


#content
{
	position:fixed;
	width: 90%;
	height: 70%;
	top: 20%;
	left: 5%;
}
#no
{
	position:absolute;
	width: 15%;
	height: 13%;
	display:inline-block;
	border-color:red;
	border-style: solid;
	top: 42%;
	left: 8%;

}
#art
{
position:absolute;	
display:inline-block;
width: 50%;
height: 50%;
text-align:center;
left: 25%;
top: 12%;
font-size: 30px;
}
#yes
{
	position:absolute;
	width: 15%;
	height: 13%;
	border-color:green;
	display:inline-block;
	border-style: solid;
	text-align:center;
	left: 77%;
	top: 42%;
	font-size:23px;
}
 a
{
	font-size: 25px;
	color: black;
	text-decoration: none;
	
}
#more
{
	position: absolute;
	width: 25%;
	top: 85%;
	left: 37.5%;
	text-align:center;
	border: thin solid;
	font-size:23px;
	
}
#pro
{
	width: 20%;
	height:18%:
	border: solid;
}
#uname
{
	padding-bottom: 2px;
}
#you
{
font-size: 30px;
position:absolute;
width: 15%;
left:85%;
top:5px;
}
#logout
{
	font-size: 12px;
	color:blue;
}
#n
{
	width:100%;
	height:100%;
	background-color:white;
	font-size:20px;
	display:inline-block;
	word-wrap: break-word;
}
#y,#m
{
	color:blue;
	border:thin solid blue;
	background-color:white;
	font-size:25px;
	border-radius:3px;
}
		</style>
		<?php
		$theName = $_POST['name'];
		$nameArt = $_POST['first'];
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
		
		?>
		<script>
		function initialize()
		{
		
			 pic = "";
			nameSpot = document.getElementById("aname");
			<?php
				$cmd2 = "SELECT `artwork` FROM `art` WHERE `pagepic` ='show' && `uname` ='$nameArt' ";//change the name
				$pagepic = getDatabaseResults($cmd2)[0][0];
				if($pagepic != '')
				{
					if(strrchr( $pagepic, "." ) == ".mp3")
					{
						echo "music = '$pagepic';"; 
					}	
					else
					echo "pic = '$pagepic';"; 
				}
				else
				{
					$cmd3 = "SELECT `artwork` FROM `art` WHERE `uname` ='$nameArt' ";
					$pagepic = getDatabaseResults($cmd3)[0][0];
					if(strrchr( $pagepic, "." ) == ".mp3")
					{
						echo "music = '$pagepic';"; 
					}	
					else
					echo "pic = '$pagepic';";  
				}
				$cmd = "SELECT `uname` FROM `art` WHERE `pagepic` ='show'";
				$names = getDatabaseResults($cmd);
				echo "namesArray = ".json_encode($names).";";
				
			?>
			for(i=0;i<namesArray.length;i++)
			{
				if(namesArray[i][0] == '<?php echo $nameArt ;?>')
					num = i+1;
			}
			if(num == namesArray.length)
				num = 0;
			artistname =  namesArray[num][0];
			document.getElementById("idk").value= artistname;
			document.getElementById("m").value = '<?php echo $nameArt ;?>';
			document.getElementById("y").value = '<?php echo $nameArt ;?>';
			nameSpot.innerHTML = '<?php echo $nameArt ;?>';
			if(pic != "")
			document.getElementById("p").src = "uploads/" + pic;
			else
			{
				document.getElementById("p").src = "uploads/play.jpg";
				document.getElementById("p").setAttribute("onclick","playSound(this,'uploads/' + music);");
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
		function myFunction(num) 
		{
		var name = "myDropdown" + num;
		document.getElementById(name).classList.toggle("show");
		}

			// Close the dropdown menu if the user clicks outside of it
			window.onclick = function(event) 
		{
		if (!event.target.matches('.dropbtn')) 
		{
		var dropdowns = document.getElementsByClassName("dropdown-content");
		
		for (i = 0; i < dropdowns.length; i++) 
		{
		var openDropdown = dropdowns[i];
		if (openDropdown.classList.contains('show')) 
		{
        openDropdown.classList.remove('show');
		}
		}
  }
  
}


		</script>
	</head>
		
	<body onload = "initialize();">
	<div id = "top">
	<div id = "icon"><img  src = "images/gg.png" /></div>
	<div id = "you">
	<form method = "post" action = "profile.php" >
	<input type="hidden" name="check" value="" />
	<img id = "pro" src = "images/pro.png" /> <input type = "submit" id = "uname" value = "<?php echo $theName; ?>" name = "prof"/> 
	<a href = "index.html" id= "logout" > log out</a>
	</form>
	</div>
	<div id = "bar">
	<span class = "dropdown"> 
	<a class="dropbtn" href="events.html">Events</a>
  </span> 
  <span class = "dropdown"> 
  <button onclick="myFunction(2)" class="dropbtn">Notifications(1)</button>
		  <div id="myDropdown2" class="dropdown-content">
			<a href="#">You are a top 10 upvoted artist in your location!</a>
		  </div>
  </span> 
  
  <span class = "dropdown">
  <form method = "post" action = "message.php" >
			<input type = 'hidden' name ="inp" value = "n"/>
			<input type="hidden" name="prof" value="<?php echo $theName ; ?>" />
			<input type="hidden" name="artist" value="<?php echo $nameArt ; ?>" />
			<input type="hidden" name="open" value="not" />
			<input class="dropbtn" type = "submit" value = "messages" />
		</form>
  </span><hr/>
	</div>
	</div>
	<div id = "content">

	<form id = "no" action = "home.php" method = "post" >
	<input type="hidden" name="name" value="<?php echo $theName; ?>" />
	<input id = "idk" type="hidden" name="first"  />
	<input id = "n" type ="submit" value = "Not Interested" />
	</form>

	<span id = "art" >
	Artist: <span id = "aname">  </span><br /><img id = "p"  />
	</span>

	<form id = "yes"method = "post" action = "message.php" >
	<input type="hidden" name="inp" value="first" />
	<input type="hidden" name="prof" value="<?php echo $theName ; ?>" />
	<input type="hidden" name="open" value="direct" />
	I'm interested let <input type = "submit" id = "y"  name = "artist"/> know
	</form>

	<div id = "more">
<form method = "post" action = "more.php" >
<input type="hidden" name="prof" value="<?php echo $theName ; ?>" />
	see more of <input type = "submit" id = "m"  name = "artist"/>'s work
	</form>
 </div>
	</div>


	
	</body>
</html>