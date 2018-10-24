define(['jquery', 'core/ajax'], function ($, ajax) {

  return {
    init: function () {
      const submitButton = $('#id_submitbutton');
      submitButton.click(function () {
        submitButton.prop('disabled', true);
      });
    }
  };
});