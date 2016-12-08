<?php
session_start();
if(!isset($_SESSION['uid'])){
	header('Location:login.php');
}
include_once 'db_connect.php';
include_once 'header.php';
include_once 'nav.php';
?>
<div class="container-fluid">
	<?php
	if (isset($_POST['submit']) && isset($_FILES['profile_picture'])) {
		$errors= array();
		$file_name = $_FILES['profile_picture']['name'];
		$file_size =$_FILES['profile_picture']['size'];
		$file_tmp =$_FILES['profile_picture']['tmp_name'];
		$file_type=$_FILES['profile_picture']['type'];
		$file_ext=strtolower(end(explode('.',$_FILES['profile_picture']['name'])));

		$extensions= array("jpeg","jpg","png");

		if(in_array($file_ext,$extensions)=== false){
			$errors[]="extension not allowed, please choose a JPEG or PNG file.";
		}

		if($file_size > 2097152){
			$errors[]='File size must be excately 2 MB';
		}

		if(empty($errors)==true){
			if (move_uploaded_file($file_tmp,"images/profile_pictures/".$file_name)) {
				$update_profile = "UPDATE users SET image='".$file_name."' WHERE id=".$_SESSION['uid'];
				mysqli_query($con,$update_profile)
				or die("update play attempts not execued");
			}
			?>
			<div class="alert alert-success">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Success!</strong> Profile picture uploaded successfully.
			</div>
			<?php
		}else{
			?>
			<div class="alert alert-danger">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Failed! Choose image.</strong>
			</div>
			<?php
		}	
	}
	?>

	<?php
		$profile_image = "";
		$query = "SELECT image FROM users WHERE id=".$_SESSION['uid'];

		$execute = mysqli_query($con,$query)
		or die('play attempt query not executed');

		$row = mysqli_fetch_array($execute);

		$profile_image = $row['image'];
	?>
	<div class="col-md-6 col-md-offset-3" style="padding-top: 20px;min-height: 600px">
		<div class="panel panel-default">
			<h1 class="update_header">Update Information</h1><hr>
			<div class="panel-body">

				<form method="POST" action="" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">

				<?php 
				if (!empty($profile_image)) {
					?>
						<div class="fileinput fileinput-exists" data-provides="fileinput" style="padding-left:35%">
						<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
							<img src="images/profile_pictures/<?php echo $profile_image; ?>" alt="profile_picture" />
						</div>
					<?php
				}else{
					?>
						<div class="fileinput fileinput-new" data-provides="fileinput" style="padding-left:35%">
						<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
						<img src="images/no_image.png" alt="..." />
						</div>
						<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
						</div>
					<?php
				}
				  ?>
						<div>
							<span class="btn btn-default btn-file">
								<span class="fileinput-new">Select image</span>
								<span class="fileinput-exists">Change</span>
								<input type="file" name="profile_picture"></span>
								<!-- <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> -->
							</div>
							<br>
							<input type="hidden" value="<?php echo $_SESSION['uid']; ?>">
							<button type="submit" class="btn btn-primary" name="submit">Save</button>
						</div>
					</form>

				</div><!--panel body-->

			</div><!-- panel -->

		</div>
	</div>
	<?php include_once 'footer.php' ?>

