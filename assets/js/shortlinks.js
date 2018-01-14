'use strict';

$(function() {
  $('#generate_button').on('click', function() {
    let unique = window.location.protocol + '//' + window.location.hostname + '/' + uniqid();
    if (!$('#shortlinks-url').val()) {
      return false;
    }
    $('#shortlinks-short_url').val(unique);
    return false;
  });

  function uniqid() {
    var ts=String(new Date().getTime()), i = 0, out = '';
    for(i=0;i<ts.length;i+=2) {
      out+=Number(ts.substr(i, 2)).toString(36);
    }
    return ('d'+out);
  }

});