<?php
session_start();
if(!isset($_SESSION['uid'])){
	header('Location:login.php');
}

include_once 'header.php';
include_once 'nav.php';
?>
	<div class="container-fluid row">
		<div class="content">
			<ul class="divisions">
				<li data-attr="1"><img src="images/cherry.jpg" width=100 height=100 ></li>
				<li data-attr="2"><img src="images/donot.jpg" width=100 height=100 ></li>
				<li data-attr="3"><img src="images/seven.png" width=100 height=100 /></li>	
			</ul><br>
			<input type="button" class="play" id="play" data-attempt="" value="PLAY" data-id = <?php echo $_SESSION['uid']; ?>  />
			<div class="redeem_container col-md-12 hide">
				<div style="padding:20px;">
					<div>
						<span style="font-size:20px;">Use following points to redeem.</span><br>
						<div class="redeem_box">
							<div style="padding:20px">
								<img src="images/gozoop.png" style="width:100%;height:20%">
								<span>Point Required: 100</span>
								<button type="button" id="redeem_button" class="redeem_now" data-point="100">Redeem</button>
							</div>
						</div>
						<div class="redeem_box">
							<div style="padding:20px">
								<img src="images/gozoop.png" style="width:100%;height:20%">
								<span>Point Required: 200</span>
								<button type="button" id="redeem_button" class="redeem_now" data-point="200">Redeem</button>
							</div>
						</div>
						<div class="redeem_box">
							<div style="padding:20px">
								<img src="images/gozoop.png" style="width:100%;height:20%">
								<span>Point Required: 500</span>
								<button type="button" id="redeem_button" class="redeem_now" data-point="500">Redeem</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include_once 'footer.php' ?>	