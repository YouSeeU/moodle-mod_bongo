define(['jquery'], function ($) {

  return {
    init: function () {
      var form = $('#mform1');
      var submitButton = $('#id_submitbutton');

      form.submit(function () {
        submitButton.prop('disabled', true);
      });
    }
  };
});