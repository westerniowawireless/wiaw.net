<?php

//  You can add PHP code to this file. The code below just writes a log statement.
add_action('wp_footer', 'example_function');
if (!function_exists('example_function')) {
    function example_function($args)
    {
		_log('This statement will write to the debug log.');
	}
}

?>