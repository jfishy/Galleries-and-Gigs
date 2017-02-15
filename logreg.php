<!DOCTYPE HTML>
<!-- Ivan Turner -->
<html>
	<head>
	<style>
	#b
	{
		position:fixed;
		left:0px;
		top:0px;
		width:100%;
		height:100%;
		z-index:-1;
	}
	#c
	{
		background-color:blue;
		color:white;
		width: 100%;
		font-size: 30px;
		font-family: palatino;
	}
	form
	{
		width: 25%;
		height: 50%;
		margin:auto;
		margin-top: 10%;
	}
	#outbox
	{
		font-size: 50px;
		text-align:center;
		background-color:white;
		margin-top:8%;
	}
	h2{
		width: 20%;
		margin:auto;
	}
	a
	{
			width:100%;
			font-size: 25px;
			border: thin solid;
			background-color:white;
			text-decoration:none;
			padding: 10px;
			color:blue;
	}
	body{font-family: monospace;}
	</style>
		<?php
			/*
				Global variables
				
				Copying the variables from the $_POST array into individual global variables CAN make them easier to work with DEPENDING on the situation.  In this case, I will be embedding the information into strings and having them in individual variables will save me from having to concatenate.
				
				As these variables are global, they need to be "seen" by the server before they are used.  Therefore, any global variables should appear in your code above functions that use them.
			*/
			$uname = $_POST['uname'];
			$pword = $_POST['pword'];
			$logreg = $_POST['logreg'];
			$conn = new PDO("mysql:hostname=localhost;dbname=josh fish", "root", "");
			
			/*
				SQL can do much of the work that you would normally do in code.  Instead of having to search a large amount of data for your user, let SQL do it by specifying the "WHERE" clause in your statement.  With this command, SQL will only return rows where the username is the one that was typed in by the user.
				
				Because of the program's design, there should never be more than 1 row returned by this statement.
			*/
			$cmd = "SELECT * FROM `simpleusers` WHERE `uname` = '$uname'";
			$result = $conn->prepare($cmd);
			$result->execute();
			//create a list of the users
			$cmd2 = "SELECT `uname` FROM `art`";
			$result2= $conn->prepare($cmd2);
			$result2->execute();
			$list =$result2->fetchAll(PDO::FETCH_BOTH);
			$rand = mt_rand(0,count($list)-1);
			$names = $list[$rand][0];
			
			/*
				checkLogin
				
				Checks to make sure that the user information is correct for a login and returns an appropriate message.
				
				Parameters:
					$userCount - the number of users in the database that have that username.  There should be either 1 or 0.
					
				Returns:
					A message that indicates whether or not the login was succesful.
			*/
			function checkLogin($userCount)
			{
				/*
					PHP does not automatically recognize global variables.  In order to use a global variable inside a funtion, you must first declare that you are using the global version of that variable.
				*/
				global $uname, $pword, $conn, $result;
				
				//If there are no users with this name then the login is incorrect.
				if ($userCount == 0)
					return "You have entered an incorrect username or password";

				/*
					There should only be 1 row of data because the registration prevents duplicate usernames.  I fetch the row here so that I can commpare the password in the database with the password the user entered.
				*/
				$data = $result->fetch();
				if($data['pword'] != $pword)
					return "You have entered an incorrect username or password";
				
				return "Welcome back, $uname.";
			}
			
			/*
				checkRegister
				
				Checks to make sure the user is not already registered and registers him/her if not.
				
				Parameters:
					$userCount - the number of users in the database that have the same name.  This number should be 0 or 1.
					
				Returns:
					A message that indicates whether or not registration was successful.
			*/
			function checkRegister($userCount)
			{
				global $uname, $pword, $conn;
				
				/*
					If a user with that name already exists, deny registration.
				*/
				if ($userCount > 0)
					return "A user with that name already exists.";
				
				/*
					Insert the user into the database.
					
					Because $result is not defined as global at the beginning of the function, the $result variable used in the statements below is a different variable entirely.
					
					Because SQL is inserting data into the table, there is no need to fetch information.
				*/
				$cmd = ("INSERT INTO `simpleusers` VALUES ('$uname', '$pword')");
				$result = $conn->prepare($cmd);
				$result->execute();
				
				return "Congratulations, $uname!  You have now registered for the site.  Please return to the  log in page.";
			}
		
			/*
				Based on the value passed in by the radio button, the program will either call the function to log a user in or call a function to register the user.
				
				Each of these functions requires information.  They want to know the number of users that have the username entered.  The $result was generated and populated at the top of the program.  By calling it inside the parentheses, its return value (the number of rows in the result) will become the value passed into the parameter.
			*/
			if ($logreg == "login")
				$msg = checkLogin($result->rowCount());
			else
				$msg = checkRegister($result->rowCount());
		?>
		<title></title>
		<style>
		
		</style>
		<script>
			function initialize()
			{
				outputBox = document.getElementById("outbox");
				var rnd = parseInt(Math.random() * 4) + 1;
				document.getElementById("b").src = "images/back" + rnd +".jpg";
				/*
					In order to output the information generated by the server side script, the code that defines that information has to be above this code.  Note that Javascript notation has to be maintained, ie the string echoed by PHP is in quotes from the Javascript.
					
					Remember that echo writes code.  Here we are echoing out a string to put into an innerHTML.  The quotes are there to tell Javascript that what it sees is a string.
				*/
				outputBox.innerHTML = "<?php echo $msg; ?>";
				if(outputBox.innerHTML == "Welcome back, <?php echo $uname; ?>." )
						document.getElementById("back").style.display = "none";
				if(outputBox.innerHTML == "You have entered an incorrect username or password" ||outputBox.innerHTML == "Congratulations, <?php echo $uname; ?>!  You have now registered for the site.  Please return to the  log in page." || outputBox.innerHTML == "A user with that name already exists.")
						document.getElementById("c").style.display = "none";
			}
		</script>
	</head>
		
	<body onload = "initialize();">
	<img id = "b"  />
		<div id = "outbox"></div>
		<hr />
		<form action="home.php" method="post">
		 <input type="hidden" name="name" value="<?php echo $uname; ?>" />
		 <input type="hidden" name="first" value="<?php echo $names; ?>" />
		<input  id = "c" type = "submit" value = "continue to site"/>
		</form>

		<h2><a id = "back" href = "index.html">Return to Log In</a></h2>
		
	</body>
</html>