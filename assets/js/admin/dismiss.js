jQuery(function($){
  $(document).on('click', '.deensimc-dismiss-btn, #deensimc-feedback-notice .notice-dismiss', function(){
    $.post(DeensimcFB.ajax_url, {
      action: 'deensimc_notice_dismiss',
      nonce:  DeensimcFB.nonce
    }, function(){
      $('#deensimc-feedback-notice').fadeOut();
    });
  });

  $(document).on('click', '.deensimc-never-show', function(){
    $.post(DeensimcFB.ajax_url, {
      action: 'deensimc_never_show_notice',
      nonce:  DeensimcFB.nonce
    }, function(){
      $('#deensimc-feedback-notice').fadeOut();
    });
  });
});