<?php 
include 'header.php';
if(isset($_POST['submit'])){
	$first_name = $_POST['name'];
	echo "<script>alert('Message sent. Thank you {$first_name}, we will contact you shortly.');</script>";
}
?>
<h2><b>CONTACT US</b></h2>
<form method="post">
	<div class="row pt">
		<div class="col-md-8">
		<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4"><?php echo @$err;?></div>
	</div><br>
	<div class="pd">
	<div class="row">
		<div class="col-sm-4">Name:</div>
		<div class="col-sm-5">
		<input type="name" name="name" class="form-control" placeholder="Name" required maxlength="40" required></div>
	</div><br>

	<div class="row pd">
		<div class="col-sm-4">E-mail:</div>
		<div class="col-sm-5">
		<input type="email" name="mail" placeholder="E-mail" required class="form-control" maxlength="40" required></div>
	</div><br>
	
	<div class="row pd">
		<div class="col-sm-4">Subject:</div>
		<div class="col-sm-5">
		<input type="text" name="subject" placeholder="Subject" required class="form-control" maxlength="40" required></div>
	</div><br>
	
	<div class="row pd">
		<div class="col-sm-4" >Enter Your Message:</div>
		<div class="col-sm-5">
	<textarea name="msg" rows="5" cols="50" placeholder="Your message" required maxlength="400" required></textarea></div>
	</div><br>

	<div class="row" style="margin-top:10px;float:center;">
		<div class="col-sm-2"></div>
		<div class="col-sm-5">
		<center><input type="submit" value="Submit"name="submit" class="btn btn-success"/></center>
		</div>
	</div>
</div></form>
		</div>
		<div class="col-md-4">
		<h2>Contact us</h2>
		Name:  Admin<br/>
		Mobile:   1746797795<br/>
		Email: admin@example.com<br/>
		Website: <a href="index.php">My Fitness Friend</a>
		</div>
	</div>
<?php
include 'footer.php';
?>
