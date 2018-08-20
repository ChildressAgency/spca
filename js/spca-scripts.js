jQuery(document).ready(function($){
  // donation slider
  if(typeof $.fn.slider == 'function'){
    $('#donation').slider({
      id: 'sliderDonation',
      min: 5,
      max: 5000,
      scale: 'logarithmic',
      step: 5,
      value: 5,
      tooltip: 'hide',
      handle: 'custom'
    });
    $('#donation').on('slide', function(slideEvent){
      $('#donationval').text(slideEvent.value);
    });
    $('#donation').on('slideStop', function(slideEvent){
      $('#donationval').text(slideEvent.value);
    });
  }
  
  //pagination
  var page = 2;
  var loadmore = 'on';
  $('.has-spinner').on('click', function(e){
    e.preventDefault();
    if(loadmore == 'on'){
      loadmore = 'off';
      $(this).addClass('active');
      
      $('#posts').append($('<div class="page" id="p' + page + '">').load(window.location.href + '/?paged=' + page + ' .page > *', function(){
        page++;
        loadmore = 'on';
        $('.has-spinner.active').removeClass('active');
      }));
      
    }
  });
  $(document).ajaxComplete(function(event, xhr, options){
    if(xhr.responseText.indexOf('class="page"') == -1){
      loadmore = 'off';
      $('.has-spinner.active').removeClass('active');
    }
  //jQuery(document.body).trigger( 'post-load');
  });
});
