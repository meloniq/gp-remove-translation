/* global $gprts_editor_options, $gp, wp */
/* eslint camelcase: "off" */
var $gprts = $gprts || {};
$gprts.editor = (
	function ($) {
		return {
			table: null,
			init: function (table) {
				$gprts.editor.table = table;
				$gprts.editor.install_hooks();
			},
			install_hooks: function () {
				$($gprts.editor.table).on('click', 'button.remove', $gprts.editor.hooks.remove_translation);
			},
			remove_translation: function (button) {
				var data;

				button.prop('disabled', true);
				$gp.notices.notice(wp.i18n.__('Removing translation...', 'glotpress'));

				data = {
					action: 'gprts_remove_translation',
					translation_id: button.data('id'),
					original_id: button.data('original_id'),
					nonce: button.data('nonce'),
				};

				$.ajax({
					type: 'POST',
					url: $gprts_editor_options.ajax_url,
					data: data,
					success: function (response) {
						$gp.notices.success(response.data.message);
						// remove editor and preview rows
						$('#preview-' + button.data('original_id') + '-' + button.data('id')).remove();
						$('#editor-' + button.data('original_id') + '-' + button.data('id')).remove();
					},
					error: function (xhr, msg) {
						/* translators: %s: Error message. */
						msg = xhr.responseText ? wp.i18n.sprintf(wp.i18n.__('Error: %s', 'glotpress'), xhr.responseText) : wp.i18n.__('Error removing translation!', 'glotpress');
						$gp.notices.error(msg);
					},
				});
			},
			hooks: {
				remove_translation: function () {
					$gprts.editor.remove_translation($(this));
					return false;
				},
			},
		};
	}(jQuery)
);

jQuery(function ($) {
	$gprts.editor.init($('#translations'));
});
