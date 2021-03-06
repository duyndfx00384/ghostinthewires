<?php
/**
 * The interface all Views should implement.
 *
 * @package Tribe\Events\Views\V2
 * @since   4.9.2
 */

namespace Tribe\Events\Views\V2;

use Tribe\Events\Views\V2\Interfaces\Repository_User_Interface;
use Tribe\Events\Views\V2\Interfaces\View_Url_Provider_Interface;
use Tribe__Context as Context;

/**
 * Interface View_Interface
 *
 * @package Tribe\Events\Views\V2
 * @since   4.9.2
 */
interface View_Interface  extends View_Url_Provider_Interface, Repository_User_Interface {

	/**
	 * Returns a View HTML code.
	 *
	 * @since 4.9.2
	 *
	 * @return string
	 */
	public function get_html(  );

	/**
	 * Returns the view slug.
	 *
	 * The slug should be the one that will allow the view to be built by the View class by slug.
	 *
	 * @since 4.9.2
	 *
	 * @return string The view slug.
	 */
	public function registration_slug(  );

	/**
	 * Returns the context instance the view will render from.
	 *
	 * Views that have not been explicitly assigned a Context will use, and return here,
	 * the global one.
	 *
	 * @since 4.9.2
	 *
	 * @return Context The View current Context instance or the global context if the view
	 *                 has not been assigned a context.
	 */
	public function get_context();

	/**
	 * Sets, or unset, the View context.
	 *
	 * @since 4.9.2
	 *
	 * @param \Tribe__Context|null $context Either a context instance or null to make the View use the global one.
	 */
	public function set_context( Context $context = null );

	/**
	 * Sets the View slug, usually the one it was registered with in the `tribe_events_views` filter.
	 *
	 * @since 4.9.2
	 *
	 * @param string $slug The slug to set for the View instance.
	 */
	public function set_slug( $slug  );

	/**
	 * Returns a View slug, usually the one it was registered with in the `tribe_events_views` filter.
	 *
	 * @since 4.9.2
	 *
	 * @return string The view slug, usually the one it was registered with in the `tribe_events_views` filter.
	 */
	public function get_slug( );

	/**
	 * Returns a View template class.
	 *
	 * @since 4.9.2
	 *
	 * @return Template The template instance used by the View.
	 */
	public function get_template();

	/**
	 * Sets a view Template.
	 *
	 * @since 4.9.2
	 *
	 * @param Template $template The template instance the View should use.
	 */
	public function set_template( Template $template );

	/**
	 * Sets up, by replacing the global query, the loop variables.
	 *
	 * The variables can be restored by using the `replace_the_loop` method.
	 *
	 * @since 4.9.3
	 *
	 * @param  array|null  $args An array of associative arguments used to setup the repository for the View.
	 *
	 */
	public function setup_the_loop( array $args = [] );

	/**
	 * Sets a View URL object either from some arguments or from the current URL.
	 *
	 * @since 4.9.3
	 *
	 * @param  array|null  $args An associative array of arguments that will be mapped to the corresponding query
	 *                           arguments by the View, or `null` to use the current URL.
	 */
	public function set_url( array $args = null, $merge = false );
}