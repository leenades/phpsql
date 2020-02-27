<?php
    require 'database/databbase.php';
?>
<html>
<head>
	<title>Sign Up Page</title>
	<style type="text/css">
	    body {
	    	background-image: url("large-foliage-tropical-leaf-with-dark-green-texture-abstract-nature-background_1484-1608.jpg");
	    	background-repeat: no-repeat;
	    	background-position: center;
            background-attachment: fixed;
            background-size: 1400px 650px;

	    }
		div.absolute {
			position: absolute;
			top: 10px;
			left: 15px;
	        right: 600px;
	        width: 200px;
	        height: 100px;
		}
		#size {
			width: 170px;
		}
		form.border {
			border: 4px solid white;
			position: absolute;
			top: 300px;
			left: 550px;
	        right: 600px;
	        width: 200px;
	        height: 100px;
	        border-radius: 10px;
		}
		input.b1{
			position: relative;
			right: 550px;
			top: -290px
		}
	</style>
</head>
<body>
	<form class="border" novalidate action="thirdpage.php" method="post">
		<div class="absolute">
			<input id="size" type="text" name="t1" placeholder="Email" required>
			<input id="size" type="password" name="password" placeholder="Password" required>
			<input id="size" type="text" name="username" placeholder="Username" required>

			<input name="submit"  type="submit"  value="Sign up" id="size">
		</div>
		<input class="b1" type="submit" name="back" value="Back" formaction="secondpage.php">
	</form>
	<?php
	  if(isset($_POST['submit']))
	{
	  	$email = $_POST['t1'];
	  	$password = $_POST['password'];
	  	$username = $_POST['username'];

           $sql= " SELECT * FROM register WHERE email='$email' or username='$username'";
	       $res=mysqli_query($con, $sql);
	        if (mysqli_num_rows($res)>0) 
	    {
            // output data of each row
            $row = mysqli_fetch_assoc($res);              	
            //checks if email and username exists in database
              if($email==$row['email'])
              {
                echo '<script type="text/javascript"> alert("Email already exists.. Try another email")</script>';
                exit();
              }
             else if ($username==$row['username'])
             {
               echo '<script type="text/javascript"> alert("Username already exists.. Try another username")</script>';
               exit();
             } 
        }
		 else 
		 //checks if form is filled or not
		 {   
		 	if(!empty($email) && !empty($password) && !empty($username))
		 	{
		 			$salt="Uef45f5e1f5f".$password;
		 			$hash=hash("sha512", $salt);
		 		$query= "insert into register values('$email', '$hash', '$username')";
		        $query_run= mysqli_query($con, $query);
		        //outputs this message if form is filled
		        echo '<script type="text/javascript"> alert("User Registered...Go to login page to login") </script>';
		   	    exit();
		    }
		    else if(empty($email) && empty($password) && empty($username))
		    {
		       //outputs this message if form is empty
		   	   echo '<script type="text/javascript"> alert("Error!..Please fill out form.") </script>';
               exit(); 
		    }
		 }
	}
	?>
</body>
</html>