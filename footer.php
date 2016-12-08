<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jasny-bootstrap.js"></script>
	<script src="js/jquery.easing.1.3.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/jquery.jSlots.min.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript" src="js/script_end.js"></script>
	<script type="text/javascript" src="js/sweetalert.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){

		var image1 = 0;image2 = 0;image3 = 0;

		function ajax_check(points) {
			$.ajax({
				url : 'http://localhost/gozoop/check_play.php',
				type : 'POST',
				data : {id:'<?php echo $_SESSION['uid'] ?>',play_points: points},
				success : function(output){
					var response_data = $.parseJSON(output);
					$('#nav_score').text(response_data.points);
					unBindEvent(response_data.no_of_attemps);
				}
			});
		}

		var jSlots = $('.divisions').jSlots({
			spinner : '.play',
			spinEvent : 'click',
			easing : 'easeOutSine',
			time : 7000,
			loops : 6,
			onStart : function(){
				$('.redeem_container').addClass('hide');
				image1 = 0;image2 = 0;image3 = 0;
			},
			onEnd : function(finalnumbers){
				$.each(finalnumbers,function(index,value){
					if (value == 1) {
						image1++;
					};
					if (value == 2) {
						image2++;
					};
					if (value == 3) {
						image3++;
					};
				});

				var spin_message = "";

				if (image1 <= 1 && image2 <= 1 && image3 <= 1) {
					ajax_check(0);
					spin_message = "Ohh!! You lost. Please try again";
				}

				if (image1 == 2 || image2 == 2 || image3 == 2) {
					ajax_check(200);
					$('.redeem_container').removeClass('hide');
					spin_message = "You Scored 200 points";
				}

				if (image1 == 3 || image2 == 3 || image3 == 3) {
					ajax_check(500);
					$('.redeem_container').removeClass('hide');
					spin_message = "You Scored 500 points";
				}

				swal("Spin Result", spin_message);
			}
		});

$.ajax({
	url : 'http://localhost/gozoop/onloadajax.php',
	type : 'POST',
	data : {id:'<?php echo $_SESSION['uid'] ?>'},
	success : function(output){
		var response = $.parseJSON(output);
		$('#nav_score').text(response.points);
		unBindEvent(response.no_of_attemps);
	}
});

function unBindEvent(output){
	var finalCount = parseInt(output) + 1;
	$('#play').attr('data-attempt',finalCount);

	if (finalCount > 3) {
		$('.play').unbind().removeData();
		$('#play').removeClass('play');
		$('#play').addClass('stop');    
	}
}

$(document).on('click','.stop', function(e){
	$.ajax({
		url : 'http://localhost/gozoop/replay.php',
		type : 'POST',
		data : {id:'<?php echo $_SESSION['uid'] ?>'},
		success : function(output){
			if (output == 0) {
				swal({
					title: "Ooops!!",
					text: "Wait for 30 minutes to play next round.",
					type: "warning",
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Ok",
					closeOnConfirm: true
				});
			}else{
				$('#play').removeClass('stop');
				$('#play').addClass('play');
			}
		}
	});
});

$('.redeem_now').on('click', function(e){
	e.preventDefault();
	$this = $(this);

	var points = $this.attr('data-point');

	swal({
		title: "Are you sure?",
		text: "You want to redeem this product.",
		type: "info",
		showCancelButton: true,
		closeOnConfirm: false,
		showLoaderOnConfirm: true,
	},
	function(){
		$.ajax({
			url : 'http://localhost/gozoop/redeem.php',
			type : 'POST',
			data : {id:'<?php echo $_SESSION['uid'] ?>',redeem_points: points},
			success : function(output){
				var data = $.parseJSON(output);
				console.log(data.status);
				if (data.status == 'success') {
					$('#nav_score').text(data.remaining_points);
					reponse_points = data.remaining_points;
					var message = "";
					if (reponse_points > 0) {
						message = "You have only "+ reponse_points+" remaining redeem points.";
					}else{
						message = "You do not have any points remaining!";
					}
					swal("Points Redeemed!!",message,"success");
				}else{
					swal({
						title: "Ooops!!",
						text: "You do not have enough reward points to redeem this product!",
						type: "warning",
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "Ok",
						closeOnConfirm: true
					});
				}
			}
		});

	});
});
});   
</script>
</body>
</html>