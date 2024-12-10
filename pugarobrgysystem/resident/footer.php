<?php
require_once '../includes/include.php';
?>


<!-- Footer -->
<footer
class="text-center mt-5 text-lg-start text-white"
style="background-color: #00214D"
>
<!-- Grid container -->
<div class="container p-4 pb-0">
	<!-- Section: Links -->
	<section class="">
		<!--Grid row-->
		<div class="row">
			<!-- Grid column -->
			<div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
				<h6 class="text-uppercase mb-4 font-weight-bold">
					Pugaro Barangay System
				</h6>
				<p>
					Here you can use rows and columns to organize your footer
					content. Lorem ipsum dolor sit amet, consectetur adipisicing
					elit.
				</p>
			</div>
			<!-- Grid column -->


			<hr class="w-100 clearfix d-md-none" />

			<!-- Grid column -->
			<div class="col-md-6 col-lg-6 col-xl-6 mx-auto mt-3">
				<h6 class="text-uppercase mb-4 font-weight-bold">
					Feedback And Suggestions
				</h6>
				<form action="../includes/functions.php" method="post">
					<label class="mb-2">Tell us about your experience</label>
					<input type="hidden" id="location" name="location">
					<textarea name="feedback" id="feedback" class="form-control p-3 fw-bold shadow" placeholder="Write your message here..." rows="4"></textarea>
					<button name="feedbackbtn" id="feedbackbtn" class="btn btn-outline-light p-2 mt-3 float-start fw-bold"><i class="fa-solid fa-paper-plane"></i> Send feedback </button>
				</form>
			</div>


			<!-- Grid column -->
		</div>
		<!--Grid row-->
	</section>
	<!-- Section: Links -->

	<hr class="my-3">

	<!-- Section: Copyright -->
	<section class="p-3 pt-0">
		<div class="row d-flex align-items-center">
			<!-- Grid column -->
			<div class="col-md-7 col-lg-8 text-center text-md-start">
				<!-- Copyright -->
				<div class="p-3">
					© 2024 Copyright: All Rights Reserved.
				</div>
				<!-- Copyright -->
			</div>
			<!-- Grid column -->

			<!-- Grid column -->
			<div class="col-md-5 col-lg-4 ml-lg-0 text-center text-md-end">
				<!-- Facebook -->
				<a
				class="btn btn-outline-light btn-floating m-1"
				class="text-white"
				role="button"
				><i class="fab fa-facebook-f"></i
				></a>


				<!-- Google -->
				<a
				class="btn btn-outline-light btn-floating m-1"
				class="text-white"
				role="button"
				><i class="fab fa-google"></i
				></a>
			</div>
			<!-- Grid column -->
		</div>
	</section>
	<!-- Section: Copyright -->
</div>
<!-- Grid container -->
</footer>
  <!-- Footer -->


  <script>
  var pathname = window.location.pathname;  // Get the full pathname
  var lastSegment = pathname.split('/').pop();  // Split by '/' and get the last part
  $("#location").val(lastSegment);  // Use .text() for non-input elements
</script>
