/**
 * Accessible mobile navigation.
 */
( function() {
	const toggle = document.querySelector( '.minhaz-lms-menu-toggle' );
	const navigation = document.querySelector( '.minhaz-lms-primary-menu' );

	if ( ! toggle || ! navigation ) {
		return;
	}

	const closeMenu = function() {
		toggle.setAttribute( 'aria-expanded', 'false' );
		navigation.classList.remove( 'is-open' );
		document.body.classList.remove( 'menu-open' );
	};

	toggle.addEventListener( 'click', function() {
		const isExpanded = 'true' === toggle.getAttribute( 'aria-expanded' );
		if ( isExpanded ) {
			closeMenu();
			return;
		}

		toggle.setAttribute( 'aria-expanded', 'true' );
		navigation.classList.add( 'is-open' );
		document.body.classList.add( 'menu-open' );
	} );

	document.addEventListener( 'keydown', function( event ) {
		if ( 'Escape' === event.key ) {
			closeMenu();
			toggle.focus();
		}
	} );

	navigation.addEventListener( 'click', function( event ) {
		if ( event.target.closest( 'a' ) ) {
			closeMenu();
		}
	} );
}() );
