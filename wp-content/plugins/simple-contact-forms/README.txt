=== Simple Contact Forms ===
Contributors: owenr88
Tags: contact forms, enquiry forms, contact, forms
Requires at least: 3.8
Tested up to: 4.6.1
Stable tag: 1.6.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin is designed to strip all the hassle so you can insert contact forms where you want and how you want. 

== Description ==

Simple Contact Forms is designed to strip all the hassle so you can insert contact forms where you want and how you want. It's incredibly simple to set up and use so you can spend more time working on the harder parts of your site.

Dropping Simple Contact Forms into your site allows users to complete your forms and interact with your site. A successful completion will trigger an email notification to you and create a record in the database, which is viewable in the WordPress Admin area (can also be exported by CSV).

Build your own contact forms with a number of configurable drag and drop fields. Fields can also be required for successful submission or excluded completely to be saved for later. The fields include:

* Plain text - Normal, Name and Email Address specific
* Textarea
* Checkboxe - Single or Multiple
* Dropdowns - Multiple Options

The plugin also has a number of options configurable in the WordPress admin area. These include:

* Form Titles
* Form Styling (Bootstrap only for now)
* Form Validation (reCAPTCHA and Maths test)
* Form Collapsable by a button
* Submit Button Text
* Button Text & Icon
* Button Styling
* Destination Pages
* Email Address for Notification
* Email Subject for Notification
* Error Message Content
* Success Message Content

Simple Contact Forms was created and is managed by [Big Lemon Creative](http://www.biglemoncreative.co.uk).

== Installation ==

Install the plugin by following these steps:

1. Upload the `simple-contact-forms` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Check out the settings page to create some fields and see how to include it in your theme

The plugin can also be searched for and installed directly in the WordPress Plugin manager.

== Frequently Asked Questions ==

= Can I ask you a question? =

Yes. Head over to the [GitHub](https://github.com/owenr88/Simple-Contact-Forms) page with any questions or feature requests. You might also find your answer in the support tab. Feel free to [contact us](http://www.biglemoncreative.co.uk) if you can't find an answer or reach us on [Twitter](https://twitter.com/biglemontweets).

== Screenshots ==

1. Form generation options
2. Form completion options
3. Field settings
4. Form output

== Changelog ==

= 1.6.4 =
* Change tiny bug to catch if there are any senders

= 1.6.3 =
* New way of calling reCaptcha with data-sitekey instead of in a jQuery onLoad

= 1.6.2 =
* Fixed bug where emails weren't sending because of empty email address fields

= 1.6.1 =
* Fixed error with stripping slashes

= 1.6.0 =
* Text box to change message when form values are wrong - Thanks to @jp-io
* Text box to change submit button text - Thanks to @jp-io

= 1.5.0 =
* Added button to export completions to a CSV file
* Fixed slash escaping on form titles
* Fixed headers error on redirecting
* Testing for WP 4.6.1

= 1.4.2 =
* Form now stays open if there's an error to show (regardless of the button and form collapse options)

= 1.4.1 =
* Composer package name renamed

= 1.4.0 =
* Added wrapper classes for the button
* Changed contributors
* New function to call the page content
* New classes to wrap the button, the form and the whole thing
* Better documentation
* Added composer compatability

= 1.3.4 =
* Created fallback for table array turning into a string

= 1.3.3 =
* Moved function called to fix form not returning
* Removed duplicate form title options in the sidebar and added some bits
* New descriptions
* Added logo and banner images 
* Changed contributors to Big Lemon Creative

= 1.3.2 =
* Readme files (...sigh)

= 1.3.1 =
* Changed label wording on the reCaptcha question
* Added a global variable to declare if there are multiple forms

= 1.3.0 =
* Added reCAPTCHA option for forms
* Added splitter script to load multiple recaptcha
* Added the option to include the recaptcha js script
* Added php function to add async and defer to js scripts
* Slightly repositioned the error messages to make more sense
* Included the ability to use multiple forms per page
* Fixed form validation messages not showing up
* Fixed some small styling issues with submit button alignment
* Gave it a little TLC

= 1.2.7 =
* Table wasn't allowing dropdowns to be clicked and fixed feedback of values going in the email header

= 1.2.6 =
* Fixed a few bugs on deleting tables

= 1.2.5 =
* Fixed bug on installing the plugin

= 1.2.4 =
* Fixed bug on deleting the plugin

= 1.2.3 =
* Added a delete button to completions

= 1.2.2 =
* Fixed form fields creation bug

= 1.2.1 =
* Fixed deleting plugin bug

= 1.2.0 =
* Tabbed view in the admin area

= 1.1.1 =
* Fixed the destination page to send the form to

= 1.1.0 =
* Submissions are tracked and logged on the settings page

= 1.0.6 =
* Bug Fixes on shortcodes

= 1.0.5 =
* Bug Fixes on checkbox items

= 1.0.4 =
* Bug fixes on the send to URL in the settings

= 1.0.3 =
* Allow additional classes for buttons
* Set default fields when installing
* Fixing a few small bugs

= 1.0.2 =
* Bug fix with form title
* Fixed form issues for iPad

= 1.0.1 =
* Add checkbox support
* Added the ability to not send an email for test purposes. Use the text "ABANDON" in a name field.

= 1.0.0 =
* The very first version! Includes widget, functional and shortcode support.

== Upgrade Notice ==

Only the first version!