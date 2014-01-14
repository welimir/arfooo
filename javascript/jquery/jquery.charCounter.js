/**
 *
 * Copyright (c) 2007 Tom Deater (http://www.tomdeater.com)
 * Licensed under the MIT License:
 * http://www.opensource.org/licenses/mit-license.php
 * 
 */
 
(function($) {
	/**
	 * attaches a character counter to each textarea element in the jQuery object
	 * usage: $("#myTextArea").charCounter(max, settings);
	 */

	$.fn.charCounter = function (max, settings) {
		settings = $.extend({
			container: "<span></span>",
			classname: "charcounter",
			format: "(%1 characters remaining)",
			pulse: true,
            min: 0,
			delay: 0,
            ignoreHtmlTags: false
		}, settings);
		var p, timeout;
		
		function count(el, container) {
			el = $(el);
            var text = el.val();
            if (settings.ignoreHtmlTags) {
                text = text.replace(/(<([^>]+)>)/ig, '').replace(/&[a-z]+;/ig, ' ');
            }

			if (max && text.length > max) {
			    el.val(text.substring(0, max));
			    if (settings.pulse && !p) {
			    	pulse(container, true);
			    };
			};
            
            if (settings.min) {
                if (text.length < settings.min) {
                    container.css("color", "red");
                } else {
                    container.css("color", "green");
                }
            }
            
			if (settings.delay > 0) {
				if (timeout) {
					window.clearTimeout(timeout);
				}
				timeout = window.setTimeout(function () {
					container.html(settings.format.replace(/%1/, (max - text.length)));
				}, settings.delay);
			} else {
				container.html(settings.format.replace(/%1/, Math.abs(max - text.length)));
			}
		};
		
		function pulse(el, again) {
			if (p) {
				window.clearTimeout(p);
				p = null;
			};
			el.animate({ opacity: 0.1 }, 100, function () {
				$(this).animate({ opacity: 1.0 }, 100);
			});
			if (again) {
				p = window.setTimeout(function () { pulse(el) }, 200);
			};
		};
		
		return this.each(function () {
			var container = (!settings.container.match(/^<.+>$/)) 
				? $(settings.container) 
				: $(settings.container)
					.insertAfter(this)
					.addClass(settings.classname);
			$(this)
				.bind("keydown", function () { count(this, container); })
				.bind("keypress", function () { count(this, container); })
				.bind("keyup", function () { count(this, container); })
				.bind("focus", function () { count(this, container); })
				.bind("mouseover", function () { count(this, container); })
				.bind("mouseout", function () { count(this, container); })
				.bind("paste", function () { 
					var me = this;
					setTimeout(function () { count(me, container); }, 10);
				});
			if (this.addEventListener) {
				this.addEventListener('input', function () { count(this, container); }, false);
			};
			count(this, container);
		});
	};

})(jQuery);