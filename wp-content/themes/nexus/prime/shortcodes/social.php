<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hiron
 * Date: 5/25/12
 * Time: 2:57 PM
 * To change this template use File | Settings | File Templates.
 */

function prime_shortcode_social($atts, $content = null)
{
    $defaults = array(
        'show_fb' => true,
        'show_google' => true,
        'show_twitter' => true,
        'show_linkedin' => true,
        'counter' => 'top'
    );
    extract(shortcode_atts($defaults, $atts));

    $bubble_top = $counter != 'right' ? true : false;
    $class = $bubble_top ? 'counter-top' : 'counter-right';

    ob_start();

    ?>
    <div class="social-shortcode <?php echo $class; ?>">
    <?php

    if ($bubble_top) {
        ?>

    <?php if ($show_fb !== 'false') { ?>
        <span class="fb-wrap">
    <!--    http://developers.facebook.com/docs/reference/plugins/like/ -->
        <div class="fb-like" data-send="false" data-layout="box_count" data-width="44" data-show-faces="false"></div>
    </span>
        <?php } ?>

    <?php if ($show_twitter !== 'false') { ?>
        <span class="twitter-wrap">
    <!--    https://dev.twitter.com/docs/tweet-button -->
        <a href="https://twitter.com/share" data-count="vertical" class="twitter-share-button" data-lang="en">Tweet</a>
    </span>
        <?php } ?>

    <?php if ($show_google !== 'false') { ?>
        <span class="g-wrap">
        <g:plusone size="tall"></g:plusone>
    </span>
        <?php } ?>

    <?php if ($show_linkedin !== 'false') { ?>
        <span class="in-wrap">
        <script type="IN/Share" data-counter="top"></script>
		<div class="clear"></div>
    </span>
        <?php } ?>

    <?php
    }
    else {
        ?>
    <?php if ($show_fb !== 'false') { ?>
        <span class="fb-wrap">
<!--    http://developers.facebook.com/docs/reference/plugins/like/ -->
    <div class="fb-like" data-send="false" data-layout="button_count" data-width="44" data-show-faces="false"></div>
</span>
        <?php } ?>

    <?php if ($show_twitter !== 'false') { ?>
        <span class="twitter-wrap">
<!--    https://dev.twitter.com/docs/tweet-button -->
    <a href="https://twitter.com/share" data-count="horizontal" class="twitter-share-button" data-lang="en">Tweet</a>
</span>
        <?php } ?>

    <?php if ($show_google !== 'false') { ?>
        <span class="g-wrap">
    <g:plusone size="medium"></g:plusone>
</span>
        <?php } ?>

    <?php if ($show_linkedin !== 'false') { ?>
        <span class="in-wrap">
    <script type="IN/Share" data-counter="right"></script>
</span>
        <?php } ?>
    <?php
    }

    ?>
    </div>
    <?php
    $ret_val = ob_get_contents();
    ob_end_clean();

    return $ret_val;
}