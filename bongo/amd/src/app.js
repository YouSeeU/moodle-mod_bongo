define(['jquery'], function ($) {

  return {
    init: function () {
      var submitButton = $('#id_submitbutton');
      submitButton.click(function () {
        $('#mform1').submit();
        submitButton.prop('disabled', true);
      });
    }
  };
});