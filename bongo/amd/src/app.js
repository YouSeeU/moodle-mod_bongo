define(['jquery'], function ($) {

  return {
    init: function () {
      $.keyframe.define([{
        name: 'bongo-load',
        '0%': {
          transform: 'translateX(-50%) translateY(-50%) rotate(0deg)'
        },
        '100%': {
          transform: 'translateX(-50%) translateY(-50%) rotate(360deg)'
        }
      }]);

      var form = $('#mform1');
      var submitButton = $('#id_submitbutton');
      var cancelButton = $('#id_cancel');
      var loadingDiv = $('#bongo-submitting-loader');
      var loadingIcon = $('#bongo-submitting-loader-icon');
      var loadingText = $('#bongo-submitting-loader-text');

      loadingDiv.css({ display: 'none', margin: '8px' });
      // loadingIcon.css({display: 'inline-block', width: '24px', height: '24px', backgroundColor: 'blue', marginRight: '8px'});
      loadingIcon.css({
        display: 'inline-block',
        marginRight: '8px',
        position: 'relative',
        top: '5em',
        left: '5em',
        // font-size: 4px,
        // text-indent: -9999em,
        borderTop: '1.1em solid #006fbf',
        borderRight: '1.1em solid #006fbf',
        borderBottom: '1.1em solid #006fbf',
        borderLeft: '1.1em solid #ffffff',
        transform: 'translateZ(0)',
        animation: 'bongo-load 1.1s infinite linear',
        borderRadius: '50%',
        width: '4em',
        height: '4em',

        '-webkit-transform': 'translateZ(0)',
        '-webkit-animation': 'bongo-load 1.1s infinite linear'
      });
      loadingText.css({ display: 'inline-block' });

      form.submit(function () {
        submitButton.prop('disabled', true);
        cancelButton.prop('disabled', true);
        loadingDiv.css('display', 'block');
      });

    }
  };
});