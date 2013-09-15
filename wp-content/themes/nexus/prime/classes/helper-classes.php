<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Hiron
 * Date: 3/27/12
 * Time: 11:59 AM
 * To change this template use File | Settings | File Templates.
 */

class PrimeShortcodeHelper
{
    function PrimeShortcodeHelper()
    {
        $this->__construct();
    }

    function __construct()
    {

    }

    function print_data_attributes($args)
    {
        foreach ($args as $key => $value) {
            printf(' data-%s="%s" ', $key, $value);
        }
    }
}

class PrimePortfolioPost
{
    public $pid;
    public $portfolioType;
    public $permalink;

    function PrimePortfolio($pid)
    {
        $this->__construct($pid);
    }

    function __construct($pid)
    {
        $this->pid = $pid;
        $this->portfolioType = $this->get_portfolio_type();
        $this->permalink = $this->get_permalink();
    }


    function get_portfolio_type()
    {
        $portfolio_type = get_post_meta($this->pid, '_prime_portfolio_item_type', true);

        switch ($portfolio_type) {
            case 'Featured Image':
                return 'IMAGE';
                break;
            case 'Embedded Video':
                return 'EMBED';
                break;
            case 'Gallery':
                return 'GALLERY';
                break;
            default:
                return 'IMAGE';
        }
    }

    function get_permalink()
    {
        return get_permalink($this->pid);
    }

    function render_preview()
    {
        if ($this->portfolioType == 'IMAGE') {
            $previewType = get_post_meta($this->pid, '_prime_image_portfolio_display', true);
            switch ($previewType) {
                case 'Lightbox':
                    $this->render_preview_image_with_lightbox();
                    break;
                case 'Preview Image':
                default:
                    $this->render_preview_image_link_with_link();
                    break;
            }
        }
        else if ($this->portfolioType == 'EMBED') {
            $this->render_preview_lightbox_embed();
        }
        else if ($this->portfolioType == 'GALLERY') {
            $previewType = get_post_meta($this->pid, '_prime_gallery_portfolio_display', true);
            switch ($previewType) {
                case 'Preview Image':
                default:
                    $this->render_preview_image_link_with_link();
                    break;
            }
        }
    }

    /**
     * Private rendering methods for Portfolio Item Previews
     */

    function render_preview_image_link_with_link()
    {
        $link = get_post_meta($this->pid, '_prime_preview_image_href', true);
        $link = empty($link) ? 'javascript:void(0);' : $link;

        $icon_class = "icon-file";
        switch ($this->portfolioType) {
            case 'IMAGE':
                $icon_class = 'icon-picture';
                break;
            case 'EMBED':
                $icon_class = "icon-film";
                break;
            case 'GALLERY':
                $icon_class = "icon-picture";
                break;
            default:
                break;
        }
        ?>
    <a href="<?php echo $link ?>" class="image-link no-frame">
        <!--        <span class="image-overlay"></span>-->
        <!--        <span class="overlay-thumbnail"><i class="--><?php //echo $icon_class; ?><!--"></i></span>-->
        <?php
        $this->render_preview_image();
        ?>
    </a>
    <?php

    }

    function render_permalink_wrapped_image()
    {
        ?>
    <a href="<?php the_permalink(); ?>" class="image-link no-frame">
        <!--        <span class="image-overlay"></span>-->
        <!--        <span class="overlay-thumbnail"><i class="--><?php //echo $icon_class; ?><!--"></i></span>-->
        <?php
        $this->render_preview_image();
        ?>
    </a>
    <?php
    }

    private function render_preview_image()
    {
        prime_render_preview_image(array('class' => 'post-image', 'img_dimension_attrs' => true));
    }

    private function render_preview_image_with_lightbox()
    {
        $url = get_post_meta($this->pid, '_prime_lightbox_image', true);
        $url = empty($url) ? wp_get_attachment_url(get_post_thumbnail_id($this->pid)) : $url;

        ?>
    <a href="<?php echo $url; ?>" rel='prettyPhoto' class="image-link no-frame" title="<?php the_title(); ?>">

        <!--        <span class="overlay-thumbnail"><i class="icon-zoom-in"></i></span>-->
        <?php
        $this->render_preview_image();
        ?>
        <!--        <span class="image-overlay"></span>-->
    </a>
    <?php

    }

    private function render_preview_inline_embed()
    {
        $url = get_post_meta($this->pid, '_prime_video_embed_url', true);
        $url .= '?primePortfolio=true';
        $sc = sprintf('[embed width="%s" height="%s"]%s[/embed]', 640, 360, $url);

        $wp_embed = new WP_Embed();
        echo '<div class="portfolio-preview-video">';
        echo $wp_embed->shortcode(array('width' => 640, 'height' => 360, 'controls' => 0), $url);
        echo "</div>";
    }

    private function render_preview_lightbox_embed()
    {
        $url = get_post_meta($this->pid, '_prime_video_embed_url', true);
        ?>
    <a href="<?php echo $url; ?>" rel='prettyPhoto' class="image-link no-frame" title="<?php the_title(); ?>">
        <!--        <span class="image-overlay"></span>-->
        <!--        <span class="overlay-thumbnail"><i class="icon-zoom-in"></i></span>-->
        <?php
        $this->render_preview_image();
        ?>
    </a>
    <?php

    }

    private function render_preview_gallery_inline()
    {

        ?>
    <div class="flexslider galleryslider"             <?php
        $autoplay = get_post_meta($this->pid, '_prime_gallery_inline_autoplay', true) != 'false';
        $autoplay_speed = get_post_meta($this->pid, '_prime_gallery_inline_autoplay_speed', true);



        if ($autoplay) {
            echo 'data-slideshow="true" ';
            if ($autoplay_speed) printf('data-slideshow-speed="%s"', $autoplay_speed);
        }?>>
        <ul class="slides">
            <?php
            $args = array(
                'post_type' => 'attachment',
                'order' => 'ASC',
                'orderby' => 'menu_order ID',
                'numberposts' => -1,
                'post_status' => null,
                'post_parent' => $this->pid,
                'exclude' => get_post_thumbnail_id($this->pid)
            );

            $attachments = get_posts($args);
            $preview_image_url = get_post_meta($this->pid, '_prime_preview_image', true);
            $background = get_post_meta($this->pid, '_prime_background', true);
            if ($attachments) {
                foreach ($attachments as $attachment) {
                    $clean_src = wp_get_attachment_image_src($attachment->ID, 'full');

                    $src = prime_attachment_image_url(array(
                        'att_id' => $attachment->ID,
                        'width' => 218,
                        'height' => 201
                    ));
                    $img_title = $attachment->post_title;

                    if (!endsWith($preview_image_url, $clean_src[0]) &&
                        !endsWith($background['background-image'], $clean_src[0])
                    ) {
                        ?>
                        <li>
                            <a href="<?php echo $src ?>">
                                <img src="<?php echo $src; ?>"
                                     title="<?php echo $img_title; ?>"
                                     alt="<?php echo $img_title; ?>"/></a>
                        </li>
                        <?php

                    }
                }
            } ?>

        </ul>
    </div>
    <?php

    }
}