<?php
/**
 * Comment API: Walker_Comment class
 *
 * @package    WordPress
 * @subpackage Comments
 * @since      4.4.0
 */

/**
 * Core walker class used to create an HTML list of comments.
 *
 * @since 2.7.0
 *
 * @see   Walker
 */
class PMW_Walker_Comment extends Walker
{

	/**
	 * What the class handles.
	 *
	 * @since  2.7.0
	 * @access public
	 * @var string
	 *
	 * @see    Walker::$tree_type
	 */
	public $tree_type = 'comment';

	/**
	 * Database fields to use.
	 *
	 * @since  2.7.0
	 * @access public
	 * @var array
	 *
	 * @see    Walker::$db_fields
	 * @todo   Decouple this
	 */
	public $db_fields = [ 'parent' => 'comment_parent', 'id' => 'comment_ID' ];

	/**
	 * Starts the list before the elements are added.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Optional. Depth of the current comment. Default 0.
	 * @param array  $args   Optional. Uses 'style' argument for type of HTML list. Default empty array.
	 *
	 * @since  2.7.0
	 * @access public
	 *
	 * @see    Walker::start_lvl()
	 * @global int   $comment_depth
	 *
	 */
	public function start_lvl( &$output, $depth = 0, $args = [] )
	{
		$GLOBALS[ 'comment_depth' ] = $depth + 1;

		switch ( $args[ 'style' ] ) {
			case 'div':
				break;
			case 'ol':
				$output .= '<ol class="children">' . "\n";
				break;
			case 'ul':
			default:
				$output .= '<ul class="children">' . "\n";
				break;
		}
	}

	/**
	 * Ends the list of items after the elements are added.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Optional. Depth of the current comment. Default 0.
	 * @param array  $args   Optional. Will only append content if style argument value is 'ol' or 'ul'.
	 *                       Default empty array.
	 *
	 * @since  2.7.0
	 * @access public
	 *
	 * @see    Walker::end_lvl()
	 * @global int   $comment_depth
	 *
	 */
	public function end_lvl( &$output, $depth = 0, $args = [] )
	{
		$GLOBALS[ 'comment_depth' ] = $depth + 1;

		switch ( $args[ 'style' ] ) {
			case 'div':
				break;
			case 'ol':
				$output .= "</ol><!-- .children -->\n";
				break;
			case 'ul':
			default:
				$output .= "</ul><!-- .children -->\n";
				break;
		}
	}

	/**
	 * Traverses elements to create list from elements.
	 *
	 * This function is designed to enhance Walker::display_element() to
	 * display children of higher nesting levels than selected inline on
	 * the highest depth level displayed. This prevents them being orphaned
	 * at the end of the comment list.
	 *
	 * Example: max_depth = 2, with 5 levels of nested content.
	 *     1
	 *      1.1
	 *        1.1.1
	 *        1.1.1.1
	 *        1.1.1.1.1
	 *        1.1.2
	 *        1.1.2.1
	 *     2
	 *      2.2
	 *
	 * @param WP_Comment $element           Comment data object.
	 * @param array      $children_elements List of elements to continue traversing. Passed by reference.
	 * @param int        $max_depth         Max depth to traverse.
	 * @param int        $depth             Depth of the current element.
	 * @param array      $args              An array of arguments.
	 * @param string     $output            Used to append additional content. Passed by reference.
	 *
	 * @since  2.7.0
	 * @access public
	 *
	 * @see    Walker::display_element()
	 * @see    wp_list_comments()
	 *
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output )
	{
		if ( ! $element )
			return;

		$id_field = $this->db_fields[ 'id' ];
		$id       = $element->$id_field;

		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

		/*
		 * If at the max depth, and the current element still has children, loop over those
		 * and display them at this level. This is to prevent them being orphaned to the end
		 * of the list.
		 */
		if ( $max_depth <= $depth + 1 && isset( $children_elements[ $id ] ) ) {
			foreach ( $children_elements[ $id ] as $child )
				$this->display_element( $child, $children_elements, $max_depth, $depth, $args, $output );

			unset( $children_elements[ $id ] );
		}
	}

	/**
	 * Starts the element output.
	 *
	 * @param string      $output  Used to append additional content. Passed by reference.
	 * @param WP_Comment  $comment Comment data object.
	 * @param int         $depth   Optional. Depth of the current comment in reference to parents. Default 0.
	 * @param array       $args    Optional. An array of arguments. Default empty array.
	 * @param int         $id      Optional. ID of the current comment. Default 0 (unused).
	 *
	 * @since  2.7.0
	 * @access public
	 *
	 * @see    Walker::start_el()
	 * @see    wp_list_comments()
	 * @global int        $comment_depth
	 * @global WP_Comment $comment
	 *
	 */
	public function start_el( &$output, $comment, $depth = 0, $args = [], $id = 0 )
	{
		$depth++;
		$GLOBALS[ 'comment_depth' ] = $depth;
		$GLOBALS[ 'comment' ]       = $comment;

		if ( ! empty( $args[ 'callback' ] ) ) {
			ob_start();
			call_user_func( $args[ 'callback' ], $comment, $args, $depth );
			$output .= ob_get_clean();
			return;
		}

		if ( ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) && $args[ 'short_ping' ] ) {
			ob_start();
			$this->ping( $comment, $depth, $args );
			$output .= ob_get_clean();
		} else if ( 'html5' === $args[ 'format' ] ) {
//			$output .= '<div class="' . ( ( $depth > 1 ) ? 'cm-reply' : 'cm-box' ) . '" id="comment-' . get_comment_ID() . '">';
			$output .= '<a id="comment-' . get_comment_ID() . '"></a>';
			$output .= '<li class="comment even thread-even depth-' . $depth . ' parent">';
			ob_start();
			$this->html5_comment( $comment, $depth, $args );
			$output .= ob_get_clean();
		} else {
			ob_start();
			$this->comment( $comment, $depth, $args );
			$output .= ob_get_clean();
		}
	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @param string     $output  Used to append additional content. Passed by reference.
	 * @param WP_Comment $comment The current comment object. Default current comment.
	 * @param int        $depth   Optional. Depth of the current comment. Default 0.
	 * @param array      $args    Optional. An array of arguments. Default empty array.
	 *
	 * @see    Walker::end_el()
	 * @see    wp_list_comments()
	 *
	 * @since  2.7.0
	 * @access public
	 *
	 */
	public function end_el( &$output, $comment, $depth = 0, $args = [] )
	{
		if ( ! empty( $args[ 'end-callback' ] ) ) {
			ob_start();
			call_user_func( $args[ 'end-callback' ], $comment, $args, $depth );
			$output .= ob_get_clean();
			return;
		}
		if ( 'div' == $args[ 'style' ] )
			$output .= "</div><!-- #comment-## -->\n";
		else
			$output .= "</li><!-- #comment-## -->\n";
	}

	/**
	 * Outputs a pingback comment.
	 *
	 * @param WP_Comment $comment The comment object.
	 * @param int        $depth   Depth of the current comment.
	 * @param array      $args    An array of arguments.
	 *
	 * @see    wp_list_comments()
	 *
	 * @since  3.6.0
	 * @access protected
	 *
	 */
	protected function ping( $comment, $depth, $args )
	{
		$tag = ( 'div' == $args[ 'style' ] ) ? 'div' : 'li';
		?>
		<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( '', $comment ); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:' ); ?><?php comment_author_link( $comment ); ?><?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
		<?php
	}

	/**
	 * Outputs a single comment.
	 *
	 * @param WP_Comment $comment Comment to display.
	 * @param int        $depth   Depth of the current comment.
	 * @param array      $args    An array of arguments.
	 *
	 * @see    wp_list_comments()
	 *
	 * @since  3.6.0
	 * @access protected
	 *
	 */
	protected function comment( $comment, $depth, $args )
	{
		if ( 'div' == $args[ 'style' ] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}
		?>
		<<?php echo $tag; ?><?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?> id="comment-<?php comment_ID(); ?>">
		<?php if ( 'div' != $args[ 'style' ] ) : ?>
		<div id="div-comment-<?php comment_ID(); ?>" class="comment-body boxed-layout padding-2x azoom-small-box-shadow">
	<?php endif; ?>
		<div class="comment-author-image">
			<div class="comment-author">
				<?php if ( 0 != $args[ 'avatar_size' ] ) echo get_avatar( $comment, $args[ 'avatar_size' ] ); ?>
			</div>
		</div>
		<div class="comment-meta commentmetadata">
			<div class="comment-header row">
				<div class="comment-reply-container large-3 medium-4 small-3 columns">
					<div class="reply ltr">
						<?php
						comment_reply_link( array_merge( $args, [
							'add_below' => $add_below,
							'depth' => $depth,
							'max_depth' => $args[ 'max_depth' ],
							'before' => '',
							'after' => '',
						] ) );
						?>
					</div>
				</div>
				<div class="comment-author-date-container large-9 medium-9 small-9 columns">
					<div class="comment-author vcard">
						<?php echo sprintf( '<cite class="fn">%s</cite>', get_comment_author_link( $comment ) ); ?>
					</div>
					<div class="comment-date yekan">
						<?php echo get_comment_date( '', $comment ); ?>
					</div>
					<div class="comment-text">
						<?php comment_text( $comment, array_merge( $args, [ 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args[ 'max_depth' ] ] ) ); ?>
					</div>
				</div>
			</div>
		</div>
		<!--  -->
		<?php if ( '0' == $comment->comment_approved ) : ?>
		<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ) ?></em>
		<br/>
	<?php endif; ?>
		<!--  -->
		<?php if ( 'div' != $args[ 'style' ] ) : ?>
		</div>
	<?php endif; ?>
		<?php
	}

	/**
	 * Outputs a comment in the HTML5 format.
	 *
	 * @param WP_Comment $comment Comment to display.
	 * @param int        $depth   Depth of the current comment.
	 * @param array      $args    An array of arguments.
	 *
	 * @see    wp_list_comments()
	 *
	 * @since  3.6.0
	 * @access protected
	 *
	 */
	protected function html5_comment( $comment, $depth, $args )
	{
		$tag = ( 'div' === $args[ 'style' ] ) ? 'div' : 'li';
		?>
		<article class="comment-body media">
			<div class="media-left">
				<img class="media-object" alt="<?php echo get_comment_author(); ?>" src="<?php echo get_avatar_url( $comment, $args[ 'avatar_size' ] ); ?>">
			</div>
			<div class="media-body">
				<div class="comment-meta darklinks">
					<a class="author_url"><?php echo get_comment_author(); ?>
					</a>
					<span class="comment-date small-text highlight">
						<time datetime="<?= $comment->comment_date ?>" class="entry-date">
							<?= time_elapsed_string( $comment->comment_date ) ?>
						</time>
					</span>
				</div>
				<p>
					<?php comment_text(); ?>
					<?php
					comment_reply_link( array_merge( $args, [
						'add_below' => 'div-comment',
						'depth' => $depth,
						'max_depth' => $args[ 'max_depth' ],
						'before' => '',
						'after' => '',
					] ) );
					?>
					<?php if ( '0' == $comment->comment_approved ) : ?>
						<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ) ?></em>
						<br/>
					<?php endif; ?>
				</p>
			</div>
		</article>
		<?php
	}
}
