<!doctype html>
<html>
<head>
<style>
.error
{
	color:red;
}
body
{
	background-image: url('pic2.jpg');
	background-size: cover;
}
.sai
{
	border-radius: 10px;

	width:400px;
	height:300px;
	left:38%;
	background-color: lightgrey;
	top:100px;
	position: relative;
}
label
{
	position: relative;
	left:5%;
	color:black;
	font-size: 21px;
}
input
{
	position: relative;
	left:30px;
}
</style>
</head>
<body>
<?php
function a($data)
{
	$data=trim($data);
	$data=stripslashes($data);
	$data=htmlspecialchars($data);
	return $data;
}
$nameerr=$emailerr=$websiteerr=$gendererr=" ";
$name=$email=$website=$gender=" ";
if($_SERVER['REQUEST_METHOD']=="POST")
{
	if(empty($_POST['name']))
	{
		$nameerr="must required";
	} 
	else
	{
		$name=a($_POST['name']);
        if(!preg_match("/^[a-zA-Z ]*$/",$name))
        {
        	$nameerr="not in valid form";
        }
        else
        {
        	$name=$name;
        }
	}
	if(empty($_POST['email']))
	{
		$emailerr="must required";
	} 
	else
	{
		$email=a($_POST['email']);
        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
        	$emailerr="not in valid form";
        }
        else
        {
        	$email=$email;
        }
	}
	if(empty($_POST['website']))
	{
		$websiteerr="must required";
	} 
	else
	{
		$website=a($_POST['website']);
        if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website))
        {
        	$websiteerr="not in valid form";
        }
        else
        {
        	$website=$website;
        }
	}
	if(empty($_POST['gender']))
	{
		$gendererr=" ";
	}
	else
	{
		$gender=a($_POST['gender']);
		$gender=$gender;
	}
}
?>
<?php 
if($x=mysqli_connect("localhost","root","Amma@Nanna1"))
{
	//echo "sql connected";
}
else
{
	die("connection error".mysqli_connect_error());
}
/*
$y="CREATE DATABASE phpform";
$z=mysqli_query($x,$y);
if($z)
{
	echo "database created";
}
else
{
	die("error".mysqli_error($x));
}*/
if(mysqli_select_db($x,'phpform'))
{
	//echo "selected";
}
else
{
	echo "not selected";
}
$w="CREATE TABLE phpform(name varchar(30)primary key,email varchar(30)not null,website varchar(30)not null,gender varchar(20)not null)";
$e=mysqli_query($x,$w);
if($e)
{
	echo "table created";
}
else
{
	mysqli_error($x);
}
$r="INSERT INTO phpform"." (name,email,website,gender)"." values('$name','$email','$website','$gender')";
$t=mysqli_query($x,$r);
if($t)
{
	//echo "inserted";
}
else
{
	die("not inserted".mysqli_error($x));
}
?>

<span class="error">*</span>
<form class="sai" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
<label>Name:</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name="name"><span class="error">*<?php echo $nameerr ?></span><br><br><br>
<label>Email:</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name="email"><span class="error">*<?php echo $emailerr ?></span><br><br><br>
<label>Password:</label><input type="password" name="website"><span class="error">*<?php echo $websiteerr ?></span><br><br><br>
<label>Gender:</label><input type="radio" name="gender" value="Male"><span style="font-size: 20px;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspMale</span>
<input type="radio" name="gender" value="Female"><span style="font-size: 20px;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspFemale</span><br><br><br>
<input type="submit" name="submit" style="position: relative;left:20%;">
</form>
<!--
<h2>YOUR INPUT</h2><br>
name is:<?php echo $name."<br>" ?>
email is:<?php echo $email."<br>" ?>
website is :<?php echo $website."<br>" ?>
gender is :<?php echo $gender."<br>" ?>
<?php 
$p="SELECT * FROM phpform";
$u=mysqli_query($x,$p);
echo "<table border=2px>
      <tr>
      <th>name</th>
      <th>email</th>
      <th>website</th>
      <th>gender</th>
      </tr>";
      while($i=mysqli_fetch_array($u))
      {
      	echo"<tr>";
      	echo "<td>".$i['name']."</td>";
        echo"<td>".$i['email']."</td>";
        echo"<td>".$i['website']."</td>";
        echo"<td>".$i['gender']."</td>";
        echo"</tr>";
      }
echo  "</table>";
?>
<?php 
$o="DELETE FROM phpform where name IS NULL";
mysqli_query($x,$o);
?>-->
</body>
</html>