define(['jquery'], function ($) {

  return {
    init: function () {
            // $('<style type=\'text/css\'>
      // .lds-spinner {
      //   color: official;
      //   display: inline-block;
      //   position: relative;
      //   width: 64px;
      //   height: 64px;
      // }
      // .lds-spinner div {
      //   transform-origin: 32px 32px;
      //   animation: lds-spinner 1.2s linear infinite;
      // }
      // .lds-spinner div:after {
      //   content: " ";
      //   display: block;
      //   position: absolute;
      //   top: 3px;
      //   left: 29px;
      //   width: 5px;
      //   height: 14px;
      //   border-radius: 20%;
      //   background: #cef;
      // }
      // .lds-spinner div:nth-child(1) {
      //   transform: rotate(0deg);
      //   animation-delay: -1.1s;
      // }
      // .lds-spinner div:nth-child(2) {
      //   transform: rotate(30deg);
      //   animation-delay: -1s;
      // }
      // .lds-spinner div:nth-child(3) {
      //   transform: rotate(60deg);
      //   animation-delay: -0.9s;
      // }
      // .lds-spinner div:nth-child(4) {
      //   transform: rotate(90deg);
      //   animation-delay: -0.8s;
      // }
      // .lds-spinner div:nth-child(5) {
      //   transform: rotate(120deg);
      //   animation-delay: -0.7s;
      // }
      // .lds-spinner div:nth-child(6) {
      //   transform: rotate(150deg);
      //   animation-delay: -0.6s;
      // }
      // .lds-spinner div:nth-child(7) {
      //   transform: rotate(180deg);
      //   animation-delay: -0.5s;
      // }
      // .lds-spinner div:nth-child(8) {
      //   transform: rotate(210deg);
      //   animation-delay: -0.4s;
      // }
      // .lds-spinner div:nth-child(9) {
      //   transform: rotate(240deg);
      //   animation-delay: -0.3s;
      // }
      // .lds-spinner div:nth-child(10) {
      //   transform: rotate(270deg);
      //   animation-delay: -0.2s;
      // }
      // .lds-spinner div:nth-child(11) {
      //   transform: rotate(300deg);
      //   animation-delay: -0.1s;
      // }
      // .lds-spinner div:nth-child(12) {
      //   transform: rotate(330deg);
      //   animation-delay: 0s;
      // }
      // @keyframes lds-spinner {
      //   0% {
      //     opacity: 1;
      //   }
      //   100% {
      //     opacity: 0;
      //   }
      // }
      // </style>').appendTo('head');

      $('<style type=\'text/css\'>@keyframes load { 0% { transform: translateX(-50%) translateY(-50%) rotate(0deg); } 100% { transform: translateX(-50%) translateY(-50%) rotate(360deg); } } </style>').appendTo('head');

      // $.keyframe.define([{
      //   name: 'bongo-load',
      //   '0%': {
      //     transform: 'translateX(-50%) translateY(-50%) rotate(0deg)'
      //   },
      //   '100%': {
      //     transform: 'translateX(-50%) translateY(-50%) rotate(360deg)'
      //   }
      // }]);

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