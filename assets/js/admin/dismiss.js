jQuery(function($){
  $(document).on('click', '.deensimc-dismiss-btn', function(){
    console.log('Dismiss button clicked');
    $.post(DeensimcFB.ajax_url, {
      action: 'deensimc_notice_dismiss',
      nonce:  DeensimcFB.nonce
    }, function(){
      $('#deensimc-feedback-notice').fadeOut();
    });
  });
});
