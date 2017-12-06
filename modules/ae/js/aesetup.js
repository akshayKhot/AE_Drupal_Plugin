(function ($, Drupal, drupalSettings) {

    Drupal.behaviors.mybehavior = {
        attach: function (context, settings) {

            console.log(drupalSettings.ae);

        }
    };

})(jQuery, Drupal, drupalSettings);

