
<?php if ( $apply = get_the_job_application_method() ) :
	wp_enqueue_script( 'wp-job-manager-job-application' );
	?>
	<div class="job_application application">
		<?php do_action( 'job_application_start', $apply ); ?>
		
		<input type="button" class="application_button button" value="<?php _e( 'Apply for job', 'wp-job-manager' ); ?>" />
		
	
<?php //sletter cookien som settes når brukeren trykker submit form og deretter sender mail

if (isset($_COOKIE['BAAAAAAA5467AAA96789678AAAAAA67969AA123123123AMGGGA1231212AAAAM87231231311'])) {
    //unset($_COOKIE['BAAAAAAA5467AAA96789678AAAAAA67969AA123123123AMGGGA1231212AAAAM87231231311']);
    setcookie('BAAAAAAA5467AAA96789678AAAAAA67969AA123123123AMGGGA1231212AAAAM87231231311', '', time() - 3600, "/"); // empty value and old timestamp

    //echo'cookie finnes';
}else {
	//echo'cookie finnes ikke 3';
}


 ?>

		<div class="application_details">
			<?php
				/**
				 * job_manager_application_details_email or job_manager_application_details_url hook
				 */

				do_action( 'job_manager_application_details_' . $apply->type, $apply );




			?>
		</div>
		<?php do_action( 'job_application_end', $apply ); ?>
	</div>
<?php endif; ?>

<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>

	$(function () {
		function settEvents() {


			/*henter tlf fra bruker sin konto*/
			if($('#ninja_forms_field_66').length){
				var kundeTlf = $('#tlfFraBrukerSpan').text();
				$('#ninja_forms_field_66').val(kundeTlf);

			}

		}


		//#ninja_forms_field_66

		var init = function () {
			settEvents();
		}();

	});
</script>
