<?php
/**
 * The template for displaying comments.

 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}

if (post_password_required()): ?>
    <p class="nopassword"><?php esc_html_e('This post is password protected. Enter the password to view any comments.', 'eidmart');?></p>

<?php
return;
endif;

// Comment Form
$commenter = wp_get_current_commenter();
$req = get_option('require_name_email');
$aria_req = ($req ? " aria-required='true'" : '');

$args = array(

    'id_submit'            => 'submit-comment',
    'class_form'           => '',
    'title_reply'          => esc_html__('Post a Comment', 'eidmart'),
    'title_reply_to'       => esc_html__('Post a Reply to %s', 'eidmart'),
    'cancel_reply_link'    => esc_html__('Cancel Reply', 'eidmart'),
    'label_submit'         => esc_html__('Post Comment', 'eidmart'),
    'class_submit'         => 'btn-small',
    'comment_field'        => '
	<div class="">
		<textarea id="comment" class="form-control" placeholder="' . esc_attr__('Write your comment here...', 'eidmart') . '" name="comment" cols="30" rows="8" aria-required="true"></textarea>
	</div>',
    'comment_notes_before' => '',
    'comment_notes_after'  => '',

    'fields'               => apply_filters('comment_form_default_fields', array(

        'author' => '
		<div class="row">
			<div class="col-sm-6">
				<input id="author" class="form-control" name="author" placeholder="' . esc_attr__('Name', 'eidmart') . '" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' />
			</div>',

        'email'  =>
        '<div class="col-sm-6">
				<input id="email" name="email" class="form-control" placeholder="' . esc_attr__('Email', 'eidmart') . '" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' />
			</div>',
        '</div>',

    )),
);

?>

<div class="comment-form">
	<?php comment_form($args);?>
</div>


<?php if (have_comments()): ?>


	<div class="comment-section">
		<h3 class="comment-reply-title"><?php comments_number('', '1' . esc_html__(' Comment ', 'eidmart'), '% ' . esc_html__(' Comments ', 'eidmart'));?></h3>
		<ul class="eidmart-comment-depth">
			<?php wp_list_comments(array(
				'callback'    => 'eidmart_pietergoosen_comments',
				'style'       => 'li',
				'short_ping'  => true,
				'avatar_size' => 34,
			));
			?>
		</ul>
	</div>


	<?php // End Comments ?>

 	<?php else: // this is displayed if there are no comments so far

    if (!comments_open()):
    ?>
		<!-- If comments are open, but there are no comments. -->
		<!-- If comments are closed. -->

	<?php else:

    if (comments_open()):
    ?>

			<h3><?php comments_number('', '1' . esc_html__(' Comment ', 'eidmart'), '% ' . esc_html__(' Comments ', 'eidmart'));?></h3>

		<?php endif;?>
	<?php endif;?>
<?php endif;?>


<div class="comment_pager">
	<p><?php paginate_comments_links();?></p>
</div>


<?php
// Comment list style
function eidmart_pietergoosen_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    switch ($comment->comment_type):
	case 'pingback':
	case 'trackback':
		if ('div' == $args['style']) {
			$tag = 'div';
			$add_below = '';
		} else {
			$tag = 'li';
			$add_below = '';
		}
		?>
		<li <?php comment_class();?> id="comment-<?php comment_ID();?>">
			<p><?php esc_html_e('Pingback:', 'eidmart');?> <?php comment_author_link();?> <?php edit_comment_link(esc_html__('(Edit)', 'eidmart'), '<span class="edit-link">', '</span>');?></p>
		<?php
	break;
	default:
    global $post;
    ?>

    <li <?php comment_class();?> id="li-comment-<?php comment_ID();?>">

        <article id="div-comment-<?php comment_ID();?>" class="eidmart-comment-body comment-section">

			<div class="media" data-toggle="tooltip" data-placement="top" title="<?php echo get_comment_date('d F - Y'); ?> <?php esc_html_e('at', 'eidmart');?> <?php comment_time('h:i A');?>">
		        <?php if (0 != $args['avatar_size']) {
					echo get_avatar($comment, $args['avatar_size']);
				}
				?>
		      	<div class="author-name">
			      	<?php printf('%s ', sprintf('<b class="fn">%s</b>', get_comment_author_link()));?>
				</div>
				<div class="media-body">
					<?php comment_text();?>
					<h5 class="author-meta"> <span><?php comment_reply_link(array_merge($args, array('reply_text' => esc_html__('Reply', 'eidmart') . '<i class="fa fa-reply"></i>', 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'])));?></span></h5>
				</div>
		    </div>

        </article><!-- .comment-body -->

    <?php
	break;
    endswitch;
}
