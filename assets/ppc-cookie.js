( function($, window) {
  $( function() {
    const pccPaidUrlCopy = document.getElementById('ppc-cookie-paid-url-copy');
      pccPaidUrlCopy.addEventListener('click', (event) => {
        event.preventDefault();
        var pccPaidUrlange = document.createRange();
        pccPaidUrlange.selectNode(document.getElementById('ppc-cookie-paid-url'));
        window.getSelection().removeAllRanges(); // clear current selection
        window.getSelection().addRange(pccPaidUrlange); // select URL text
        document.execCommand('copy');
        window.getSelection().removeAllRanges();
      });
  });

} )( jQuery, window );