<?php
/**
 * Copyright (C) 2019-2021 Paladin Business Solutions
 *
 */

/* ========= */
/* show_form */
/* ========= */
Function show_sms_form($message, $label = "", $color = "#008EC2") {	
	
	global $print_again, $wpdb; ?>    	
		
	<form action="" method="post" >
	<table class="TableOverride" >
		<tr class="TableOverride">
			<td colspan="2" align="center">
<?php	
	if ($print_again == true) {
		echo "<font color='$color'><strong>" . esc_html($message) . "</strong></font>";
	} else {
	    echo "<font color='$color'><strong>" . esc_html($message) . "</strong></font>";	    
	} ?>
	</td>
	</tr>	
		
	<tr class="TableOverride">
		<td class="left_col">
			<p style='display: inline; <?php if ($label == "mobile_number") echo "color:red"; ?>' >
			<?php _e('Mobile Number','ringcentral-sms'); ?>:</p>
			<p style='color: red; display: inline'>*</p>
		</td>
		<td class="right_col">
		  <input type="tel" name="mobile_number" 
		  value="<?php if ($print_again) { echo $_POST['mobile_number'] ; } ?>"
		  placeholder="1-999-999-9999" > 
        </td>
	</tr>	
	<tr class="TableOverride">
		<td class="left_col">
			<p style='display: inline; <?php if ($label == "mobile_message") echo "color:red"; ?>' >Message Content:</p>
			<p style='color: red; display: inline'>*</p>
		</td>
		<td class="right_col">
		  <textarea name="mobile_message" rows="10" cols="125"><?php if ($print_again) { echo $_POST['mobile_message'] ; } ?></textarea> 
        </td>
	</tr>	
	<tr class="TableOverride">
		<td colspan="2" align="center">			
			<br/>
			<?php 
			$btn_attributes = array( "style" => "background: #008ec2; border-color: #006799; color: #fff;" );
			submit_button("Send SMS","","submit","",$btn_attributes); ?>
			<br/><br/>
		</td>
	</tr>
	</table>
	</form>
<?php
}
/* ========== */
/* check_form */
/* ========== */
Function check_sms_form() {
	
	global $print_again, $wpdb;
	
	$label = "" ;
	$message = "" ;	  

 	/* data integrity checks */	

	if (strlen($_POST['mobile_number']) < 14) {
	    $print_again = true;
	    $label = "mobile_number";
	    $message = "Mobile number is short or blank, do you have the full compliment of digits?";
	}
	if ($_POST['mobile_message'] == "") {
	    $print_again = true;
	    $label = "mobile_message";
	    $message = "Mobile message cannot be blank, I have to send something!";
	}	
	
	// end data integrity checking

	if ($print_again == true) {		
	    show_sms_form($message, $label, "red");
	} else {	    
	           		
	    rc_send_sms($_POST['mobile_number'], $_POST['mobile_message']) ;        
	    
	    $message = "Message sent to provided number, send another one?";	   
	    show_sms_form($message, $label, "blue") ;	    
	}
}

/* ============= */
/*  --- MAIN --- */
/* ============= */
if(isset($_POST['submit'])) {
	check_sms_form();
} else {	
	$message = __('Provide the necessary data to send an SMS Message', 'ringcentral-sms');
	show_sms_form($message);
} 
?>