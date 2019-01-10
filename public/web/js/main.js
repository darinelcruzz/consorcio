/*
	Exponent by Pixelarity
	pixelarity.com | hello@pixelarity.com
	License: pixelarity.com/license
*/

(function($) {

	var	$window = $(window),
		$body = $('body');

	// Breakpoints.
		breakpoints({
			xlarge:   [ '1281px',  '1680px' ],
			large:    [ '981px',   '1280px' ],
			medium:   [ '737px',   '980px'  ],
			small:    [ '481px',   '736px'  ],
			xsmall:   [ null,      '480px'  ]
		});

	// Play initial animations on page load.
		$window.on('load', function() {
			window.setTimeout(function() {
				$body.removeClass('is-preload');
			}, 100);
		});

	// Touch?
		if (browser.mobile)
			$body.addClass('is-touch');

	// Scrolly.
		$('.scrolly').scrolly({
			speed: 1500,
			offset: 100
		});

	// Banner.
		var $banner = $('#banner');

		if ($banner.length > 0) {

			// Parallax background.
				if (browser.name != 'ie'
				&&	browser.name != 'edge'
				&&	!browser.mobile) {

					breakpoints.on('<=medium', function() {

						$window.off('scroll.px');
						$banner.css('background-position', '');

					});

					breakpoints.on('>medium', function() {

						$banner.css('background-position', 'center 0px');

						$window.on('scroll.px', function() {
							$banner.css('background-position', 'center ' + (parseInt($window.scrollTop()) * -0.5) + 'px');
						});

					});

				}

		}

	// Menu.
		$('#menu')
			.prepend('<h2>Menu</h2>')
			.append('<a href="#menu" class="closer"></a>')
			.appendTo($body)
			.panel({
				delay: 500,
				hideOnClick: true,
				hideOnSwipe: true,
				resetScroll: true,
				resetForms: true,
				side: 'right',
				target: $body,
				visibleClass: 'menu-visible'
			});

})(jQuery);