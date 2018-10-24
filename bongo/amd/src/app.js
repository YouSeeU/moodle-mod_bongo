define(['jquery'], function ($) {

  return {
    init: function () {
      var form = $('#mform1');
      var submitButton = $('#id_submitbutton');
      var cancelButton = $('#id_cancel');
      var submittingLoader = $('#bongo-submitting-loader');

      form.submit(function () {
        submitButton.prop('disabled', true);
        cancelButton.prop('disabled', true);
        submittingLoader.css('display', 'block');
      });
    }
  };
});