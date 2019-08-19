<?php

class scf_Content {



	/**
	 * The content for the final email
	 * @var String
	 */
	public $emailContent;



	/**
	 * The content for the page
	 * @var String
	 */
	private $pageContent;



	/**
	 * Check if the success message is ready to be displayed
	 * @var Boolean
	 */
	private $successMessageReady;



	/**
	 * The ID for the form
	 * @var String
	 */
	private $form_id;



	/**
	 * Constructor functions
	 */
	public function __construct() {

		// Do anything first
		$this->successMessageReady = false;

		// Set the form ID
		$this->form_id = rand(0,10000);

	}



	/**
	 * Set the required scripts and styles
	 * @param Array $options The options used for this plugin
	 */
	public function setVendors($options) {

		// Does it need bootstrap
		if( $options['include_bootstrap'] ) {

			// Include Bootstrap styles
			wp_enqueue_style('scf_bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css');

			// Include Bootstrap scripts
			wp_enqueue_script('scf_bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js');

		}

		// Does it need FontAwesome?
		if( $options['include_fontawesome'] ) {

			// Include FontAwesome styles
			wp_enqueue_style('scf_fontawesome-css', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');

		}

		// Does it need reCAPTCHA?
		if( $options['include_recaptcha'] ) {

			// Include reCAPTCHA styles
			wp_enqueue_script('scf_recaptcha-js', 'https://www.google.com/recaptcha/api.js#asyncload#deferload');

		}

	}



	/**
	 * Add the form to the page ocntnet
	 * @param array   $options       The options set and passed
	 * @param array   $fields        All the required fields for the form
	 * @param array   $errors        Any errors that need to be shown
	 * @param boolean $isresp        Has the form passed the reCAPTCHA test
	 * @param boolean $formcompleted Is the form completed yet
	 */
	public function addForm($options = array(), $fields = array(), $errors = array(), $isresp = false, $formcompleted = false) {

		// Return false if the success message has already been created - we don't need the form!
		if( $this->successMessageReady ) return false;

		// Check if there are any problems
		$any_problems = (!empty($errors) || $isresp) && $formcompleted;

		// Open the wrapping divs - .in SHOWS the content
	    $content = '<div id="form_'.$this->form_id.'" class="scf_form bs-component ' . ($options['form_collapsed'] && $options['button'] && !$any_problems ? 'collapse' : 'collapse in' ) . '">';

		    // Open the row
		    $content .= '<div class="row">';

		        // Set the styling div around the form
		        $content .= '<div class="'.( $options['form_styling'] != "full-width" ? "col-sm-6 col-sm-offset-3" : "col-xs-12" ).'">';

		        	// Set the form title
		        	$content .= '<h2 class="text-center">'.$options['form_title'].'</h2><br>';

			    	// Print out the errors if there are any
			        foreach($errors as $error) {

			        	// Add the error to the content
			        	$content .= '<div class="alert alert-danger" role="alert">'.$error.'</div>';

			        }

		        	// Add the validation error to the content and hide it
		        	$content .= '<div class="alert alert-danger error-notice" role="alert">' . $options['valid_fail_text'] . '</div>';

		        	// Open the actual form
		            $content .= '<form class="form-horizontal row" name="simple_contact_form" method="post" action="" id="form-holder" onsubmit="return validateForm(\'form_'.$this->form_id.'\')" >';

		            	// Start outputting each field
		                foreach($fields as $item) {

		                	// Continue the loop if 'exclude' is selected
		                	if($item['exclude']) continue;

		                	// Start each field off with a default wrapper and check if it's required
		                    $content .= '<div class="'.($item['required'] ? 'validation' : '').' '.$item['slug'].' '.$options['column_class'].'">';

	                    		// Open the form group
	                    		$content .= '<div class="form-group">';

	                    			// Check if the field is a checkbox and if it uses labels
				                    if($options['labels'] && $item['type'] != 'checkbox') {

				                    	// Set the label
				                        $content .= '<label class="row-item col-md-3" for="'.$item['slug'].'"><span>'.$item['title'].($item['required'] ? ' *' : '').'</span></label>';

				                        // Set the next classes and offsets
				                        $nextclass = 'col-md-9';
				                        $offset = 'col-md-offset-3';

				                    } elseif(!$options['labels']) {

				                    	// Check if the field is a selectbox
				                        if($item['type'] == 'select') {

				                        	// Open the label
				                            $content .= '<label class="row-item col-md-12" for="'.$item['slug'].'"><span>'.$item['title'].($item['required'] ? ' *' : '').'</span></label>';

				                        } else {

				                        	// Set the next class
				                            $nextclass = 'col-md-12';

				                        }

				                    };

				                    // Are we using placeholders, precious?
				                    $placeholder = ($options['placeholders'] ? ' placeholder="'.$item['title'].($item['required'] ? ' *' : '').'"' : '');

				                    // Is the type a checkbox? Set it's field with a label
				                    if($item['type'] == 'checkbox') {

				                        $content .= '<div class="row-item">';

				                        	$content .= '<label class="row-item '.$nextclass.' '.$offset.' checkbox" for="'.$item['slug'].'">';

				                        		$content .= '<input name="'.$item['slug'].'" id="'.$item['slug'].'" type="checkbox" value="Yes" checked="'.$item['value'].'">';

			                        			$content .= '<span>'.$item['title'].($item['required'] ? ' *' : '').'</span>';

		                        			$content .= '</label>';

	                        			$content .= '</div>';

				                    };

				                    // Open the row item
				                    $content .= '<div class="row-item '.$nextclass.'">';

				                    	// Check what type this is and output the field
			                            if($item['type'] == 'text' || $item['type'] == 'email' || $item['type'] == 'name') {

			                            	// Set this as a text box
			                                $content .= '<input name="'.$item['slug'].'" id="'.$item['slug'].'" class="form-control" type="text" value="'.$item['value'].'"'.$placeholder.'>';

			                            } else if($item['type'] == 'textarea') {

			                            	// Set this as a textarea
			                                $content .= '<textarea name="'.$item['slug'].'" id="'.$item['slug'].'" class="form-control" '.$placeholder.'>'.$item['value'].'</textarea>';

			                            } else if($item['type'] == 'select') {

			                            	// Set this as a select box
			                                $content .= '<select name="'.$item['slug'].'" id="'.$item['slug'].'" class="form-control">';

			                                	// Cycle through each option for the select box
			                                    foreach($item['options'] as $opt) {

			                                		// Add the option to the select box
			                                        $content .= '<option value="'.sanitize_title($opt).'">'.$opt.'</option>';

			                                    }

		                                    // Close the select box
			                                $content .= '</select>';

			                            };

		                            // Close the row item
			                        $content .= '</div>';

			                        // Clear any floats
			                        $content .= '<div class="clearfix"></div>';

		                        // Close the form group
			                    $content .= '</div>';

		                        // Clear any floats
		                        $content .= '<div class="clearfix"></div>';

		                    // Close the field wrapper
		                    $content .= '</div>';

		                };

		                // Check if we need recaptcha. Maths is already added as a field if it's selected.
		                if($options['validation'] === 'recaptcha' && $options['public_key'] && $options['private_key']) {

		                	// Open the validation wrapper
		                    $content .= '<div class="' . $options['column_class'] . '">';

		                    	// Open the row item
		                    	$content .= '<div id="row-item" class="form-group">';

		                    		// Open the row
		                    		$content .= '<div class="'.$nextclass.' '.$offset.'">';

		                    			// Add the content
		                    			$content .= '<div id="recaptcha_form_'.$this->form_id.'" class="g-recaptcha" data-sitekey="'.$options['public_key'].'"></div>';

	                    			// Close the row
	                    			$content .= '</div>';

	            				// Close the row item
	                			$content .= '</div>';

	        				// Close the validation wrapper
	            			$content .= '</div>';
		                
		                };

		                // Clear the floating for the form so far
		                $content .= '<div class="clearfix"></div>';

		                // Open the column
		                $content .= '<div class="'.$options['column_class'].'">';

			                // Add the hidden items and submit page. Opening the form group
			                $content .= '<div class="form-group">';

			                	// Opening the column
			                    $content .= '<div class="col-md-6 col-md-offset-3">';

			                		// Set the previous page hidden input
			                        $content .= '<input type="hidden" name="prevpage" value="'.get_permalink().'">';

			                		// Set the email subject hidden input
			                        $content .= '<input type="hidden" name="email_subject" value="'.$options['email_subject'].'">';

			                		// Set the form title hidden input
			                        $content .= '<input type="hidden" name="form_title" value="'.htmlentities($options['form_title']).'">';

			                		// Set the form ID hidden input
			                        $content .= '<input type="hidden" name="form_id" value="form_'.$this->form_id.'">';

			                		// Set the submit button
			                        $content .= '<button type="submit" class="btn btn-block ' . $options['submit_class'] . '">' . $options['submit_text'] . '</button>';

		                        // Close the column
			                	$content .= '</div>';

			                	// Clear the floats
			                	$content .= '<div class="clearfix"></div>';

			            	// Close the form group
			            	$content .= '</div>';

		            	// Close the col
		            	$content .= '</div>';

	            	// Close the form
		            $content .= '</form>';

	            // Close the form wrapper
		        $content .= '</div>';

		        // Clear the floats
		        $content .= '<div class="clearfix"></div>';

	        // Close the row
		    $content .= '</div>';

	    // Close the wrapping div
	    $content .= '</div>';

		// Send this content to the page content to be executed
    	$this->addToPageContent($content);
		
	}



	/**
	 * Add a button to the page contnet
	 * @param array $options The options set and passed
	 */
	public function addButton($options = array()) {

		// Return false if the success message has already been created
		if( $this->successMessageReady ) return false;

	    // Check if it needs a url to link to or if it collapses
	    if($options['form']) {
	    	$actions = 'data-toggle="collapse" data-target="#form_'.$this->form_id.'" href="javascript:void(0);"';
	    } else {
	    	$actions = 'href="'.$options['send_to_url'].'"';
	    }

	    // Open the main form wrapper
	    $content = '<div id="button_'.$this->form_id.'" class="scf_button">';

	    	// Open the row
	    	$content .= '<div class="row">';

		    	// Open the wrapper
		    	$content .= '<div class="'.$options['btn_wrapper'].'">';

				    // Open the button
			    	$content .= '<a class="btn btn-block ' . $options['btn_class'] . '" '. $actions . '>';

					    // Set the button contents
					    $content .= $options['btn_text'];

					    // Check if the button has a side icon. Set the side and icon if so.
					    if($options['btn_icon_side'] != "none") {
					    	$content .= '<i class="fa '.$options['btn_icon_type'].' pull-'.$options['btn_icon_side'].'" style="font-size: 14pt;"></i>';
					    }

				    // Close the button
				    $content .= '</a>';

			    // Close the inner wrapper
			    $content .= '</div>';	

		    // Close the row
		    $content .= '</div>';	

	    // Close the main form wrapper
	    $content .= '</div>';	

		// Send this content to the page content to be executed
	    $this->addToPageContent($content);


	}



	/**
	 * Create the validation script for required items
	 * @param array $fields Each of the fields to be checked for required values
	 */
	public function addValidationScript($fields) {

		global $multiple_forms;

		// Return if it's already been defined
		if( isset($multiple_forms) && $multiple_forms === true ) return false;

	    $script = '<script>
	        function validateForm(form_id) {

	            var submit = true,
	            	$ = jQuery,
	            	form = "#" + form_id;

                $(form + " .error-notice").removeClass( "show" );

            	';

	            foreach($fields as $field) {

	                if( !isset($field['required']) || !$field['required'] || !isset($field['slug']) ) continue;

                    $script .= '

                    var input_el = $(form + " #'.$field['slug'].'[name=\''.$field['slug'].'\']");
                    var valid_el = $(form + " .'.$field['slug'].'");
                    var is_checkbox = input_el.is(":checkbox");

                    valid_el.removeClass( "has-error" );

                    if( input_el.val() == "" || (is_checkbox && !input_el.prop( "checked")) ) {
                        valid_el.addClass( "has-error" );
                        submit = false;
                    }';

	            };

	            $script .= '

                if(!submit) $(form + " .error-notice").addClass( "show" );

	            return submit;
	        };
	    </script>
	    ';

	    $this->addToPageContent($script);
	}



	/**
	 * Add the success message to the content
	 * @param array $options The set and passed plugin options
	 */
	public function addSuccessMessage($options) {

		// Let the other bits know the form is successful
		$this->successMessageReady = true;

		// Add the success message to the content
		$this->addToPageContent($options['success_msg']);

	}



	/**
	 * Add passed content to the page body variable
	 * @param String $content the contnet to be added
	 */
	public function addToPageContent($content) {

		// Add the new content to the overall page content
		$this->pageContent .= $content;

	}



	/**
	 * Final function to get the page content
	 * @return String Final content to be returned
	 */
	public function getPageContent() {

		$content = '<div class="scf_wrapper">' . $this->pageContent . '</div>';

		return $content;

	}
	


} 

?>
