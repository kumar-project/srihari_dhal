<?php

class scf_Email {


    /**
     * The final email content to be returned
     * @var String
     */
	private $emailcontent;



	/* 
	 * Constructor functions
	 */
	public function __construct() {

		// Do anything first

	}



	/* 
	 * Add content to the email contents
	 */
	public function addToEmailContents($field) {

        // Set the value to use
        if( $field['type'] == 'checkbox' ) {

            $value = $field['value'] ? 'Yes' : 'No';

        } else {

            $value = isset($field['value']) ? $field['value'] : '';

        }

        // Set email contents from the value
        $this->emailcontent .= $field['title'].': '.$value.'<br />';

	}



	/* 
	 * Send the email
	 */
	public function sendEmail($fields, $options) {

		// Set the subject line
		$subject = $options['email_subject'];

		// Set senders
        $email_recipients = explode(",", trim($options['email_recipients']));
        foreach( $email_recipients as $email ) {
        	$senders[] = array(
        		'email' => $email
    		);
    	};

        // Set the headers
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Determine the from details. Check for name field, then email field
        foreach($fields as $field) {

        	if( $field['type'] == 'name' && isset($field['value']) && !isset($sender_name)) $sender_name = $field['value'];

            if( $field['type'] == 'email' && isset($field['value']) && !isset($sender_email) ) $sender_email = $field['value'];
        }

        // Default to 'Enquirer' if there's nothing there
        if( !isset($sender_name) ) $sender_name = 'Enquirer';
        if( !isset($sender_email) ) $sender_email = empty($senders) ? 'enquiry@biglemoncreative.co.uk' : $senders[0]['email'];

        // Set the from details
        $headers .= "From: $sender_name <$sender_email>\r\n";

        // Set the name checker
        $nameIsAbandon = false;

        // Cycle through the fields
        foreach($fields as $field) {

            // Set the field content
        	if( $field['slug']!=='maths' && !$field['exclude'] ) $this->addToEmailContents($field);

            // Skip this if the name field contains the words "ABANDON" only
            if( $field['type']=='name' && $field['value'] == "ABANDON" ) $nameIsAbandon = true;

        }

        // See if we need to abandon
        if( $nameIsAbandon === true ) {

            // Dump the contents for analysis
            var_dump(
                $senders,
                $subject, 
                $this->emailcontent,
                $headers
            );

        } else {

            foreach($senders as $sendingemail) {
                $final_senders[] = $sendingemail['email']; 
            };

            if(empty($final_senders)) return false;

            // Send the email for each sender
            wp_mail(
                $final_senders, 
                $subject, 
                $this->emailcontent, 
                $headers
            );

        }

        // Write the data to the database
        $scf_db = new SCF_Data_Management();

        // Insert the data
        $scf_db->insertRow($this->emailcontent, 0);

	}



} 

?>