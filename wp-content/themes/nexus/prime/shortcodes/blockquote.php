<?php

function prime_shortcode_blockquote($atts, $content = null)
{
    ob_start();
    ?>
<blockquote><?php echo wpautop(prime_remove_autop(do_shortcode($content))); ?></blockquote>

<?php
    $ret_val = ob_get_contents();
    ob_end_clean();

    return $ret_val;
}