define(['jquery'], function ($) {

  return {
    init: function () {
      $('<style type=\'text/css\'>@keyframes load { 0% { transform: translateX(-50%) translateY(-50%) rotate(0deg); }' +
        '100% { transform: translateX(-50%) translateY(-50%) rotate(360deg); } } </style>').appendTo('head');

      var form = $('#mform1');
      var submitButton = $('#id_submitbutton');
      var cancelButton = $('#id_cancel');
      var loadingDiv = $('#bongo-submitting-loader');
      var loadingIcon = $('#bongo-submitting-loader-icon');
      var loadingText = $('#bongo-submitting-loader-text');

      loadingDiv.css({ display: 'none', margin: '8px' });
      loadingIcon.css({
        display: 'inline-block',
        marginRight: '12px',
        position: 'relative',
        top: '3em',
        left: '3em',
        fontSize: '4px',
        textIndent: '-9999em',
        borderWidth: '2px',
        borderStyle: 'solid',
        borderColor: 'rgb(0, 111, 191) rgb(0, 111, 191) rgb(0, 111, 191) rgb(255, 255, 255)',
        transform: 'translateZ(0)',
        '-webkit-transform': 'translateZ(0)',
        animation: 'bongo-load 1.1s infinite linear',
        '-webkit-animation': 'bongo-load 1.1s infinite linear',
        borderRadius: '50%',
        width: '4em',
        height: '4em'
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