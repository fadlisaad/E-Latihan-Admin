<?php
    /**
	 * Copyright 2009-2011 MARDI
	 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
	 * This file is part of MARDILMS.
	 * The latest code can be found at http://elearn.mardi.gov.my/
	 * 
	 * Description : upload multiple files form.
	 */
    // Contact subject
    $subject ="$subject";
    
	// Details
    $message="$detail";
    
    // Mail of sender
    $mail_from="$customer_mail";
    
	// From
    $header="from: $name <$mail_from>";
    
    // Enter your email address
    $to ='someone@somewhere.com';
    
    $send_contact=mail($to,$subject,$message,$header);
    
    // Check, if message sent to your email
    // display message "We've recived your information"
    if($send_contact){
    echo "We've recived your contact information";
    }
    else {
    echo "ERROR";
    }
?>