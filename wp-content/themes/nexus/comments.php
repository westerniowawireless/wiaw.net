<?php if (get_comments_number() > 0) { ?>
<!--<div class="divider"></div>-->
<?php } ?>

<?php
global $FRONTEND_STRINGS;
global $prime_frontend;

// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ($FRONTEND_STRINGS['not_directly']);

if (post_password_required()) {
    $prime_frontend->render_comments_password_required();
    return;
}
// You can start editing here. 

if (have_comments()) {
    $prime_frontend->render_comments();
}
else {
} // this is displayed if there are no comments so far

if (!comments_open()) {
    $prime_frontend->render_comments_closed();
}
?>

<?php if (comments_open()) : ?>

<div class="divider shortcode-divider"></div>

<div id="respond" class="comment-form-wrapper <?php if (is_user_logged_in()) echo 'is-logged-in' ?>">
    
    <h3><?php comment_form_title($FRONTEND_STRINGS['share_thoughts'], $FRONTEND_STRINGS['leave_reply']); ?></h3>
    <?php $prime_frontend->render_comment_form($user_identity, $req, $comment_author, $comment_author_email, $comment_author_url); ?>
    <p class="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></p>
    <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
    <p><?php printf($FRONTEND_STRINGS['must_login'], wp_login_url(get_permalink())); ?></p>
    <?php else : ?>

    <?php endif; // If registration required and not logged in ?>
</div>
<?php endif; // if you delete this the sky will fall on your head ?>
