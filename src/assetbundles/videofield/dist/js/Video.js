/**
 * Video Embedder plugin for Craft CMS 3.x
 *
 * Craft plugin to generate an embed URL from a YouTube or Vimeo URL.
 *
 * @link      http://github.com/mikestecker
 * @copyright Copyright (c) 2017 Mike Stecker
 */
(function($, Craft, window, document, undefined) {
	var pluginName = 'VideoEmbedder',
		defaults = {};

	// Plugin constructor
	function Plugin(element, options) {
		this.$element = $(element);
		this.options = $.extend({}, defaults, options);
		this._defaults = defaults;
		this._name = pluginName;
		this.init();
	}

	Plugin.prototype = {
		init: function(id) {
			this.id = id;
			this.$url = this.$element.find('.video-embedder-url');
			this.$preview = this.$element.find('.video-embedder-previewContainer');
			//this.$embedDataInput = this.$element.find('.video-embedder-embedDataInput');
			this.$url.on('change', $.proxy(this.fetchPreview, this));
			this.$url.on('keydown', $.proxy(this.handleKeydown, this));
			this.$spinner = $('<div class="spinner hidden"/>').insertAfter(this.$url.parent());
		},

		fetchPreview: function(event) {
			var self = this;
			var jxhr;

			event.preventDefault();

			this.$preview.addClass('is-loading');
			//this.$embedDataInput.val(null);
			this.$spinner.removeClass('hidden');

			jxhr = $.get(this.options.endpointUrl, {
				url: this.$url.val(),
				name: this.options.name
			});

			jxhr.done(function(data, textStatus, jqXHR) {
				//console.log(data);
				self.$preview.html(data);
			});

			jxhr.fail(function(jqXHR, textStatus, errorThrown) {
				console.log(errorThrown);
			});

			jxhr.always(function() {
				Craft.initUiElements(self.$preview);
				self.$preview.removeClass('is-loading');
				self.$spinner.addClass('hidden');
			});
		},

		handleKeydown: function(event) {
			if (event.keyCode === 13) {
				event.preventDefault();
				this.fetchPreview(event);
			}
		}
	};

	// A really lightweight plugin wrapper around the constructor,
	// preventing against multiple instantiations
	$.fn[pluginName] = function(options) {
		return this.each(function() {
			if (!$.data(this, 'plugin_' + pluginName)) {
				$.data(this, 'plugin_' + pluginName, new Plugin(this, options));
			}
		});
	};
})(jQuery, Craft, window, document);
