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

	const openMenu = function() {
		toggle.setAttribute( 'aria-expanded', 'true' );
		navigation.classList.add( 'is-open' );
		document.body.classList.add( 'menu-open' );
	};

	toggle.addEventListener( 'click', function() {
		const isExpanded = 'true' === toggle.getAttribute( 'aria-expanded' );
		if ( isExpanded ) {
			closeMenu();
			return;
		}

		openMenu();
	} );

	document.addEventListener( 'keydown', function( event ) {
		if ( 'Escape' === event.key ) {
			closeMenu();
			toggle.focus();
		}
	} );

	document.addEventListener( 'click', function( event ) {
		if ( ! navigation.contains( event.target ) && ! toggle.contains( event.target ) ) {
			closeMenu();
		}
	} );

	navigation.addEventListener( 'click', function( event ) {
		if ( event.target.closest( 'a' ) ) {
			closeMenu();
		}
	} );

	window.addEventListener( 'resize', function() {
		if ( window.innerWidth >= 768 ) {
			closeMenu();
		}
	} );
}() );
