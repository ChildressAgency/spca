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

  //pet search
  var searchUrl = 'https://ws.petango.com/webservices/adoptablesearch/wsAdoptableAnimals.aspx?';
  var searchQueryString = '&css=http://ws.petango.com/WebServices/adoptablesearch/css/styles.css&authkey=u4bl4npb2mnkueh85ho8spw5veybpsxa2ytshcoiuoynukq2ah&location=&site=&onhold=A&orderby=ID&recAmount=&detailsInPopup=No&featuredPet=Include&stageID=';
  var viewportWidth = $(window).width();
  console.log(viewportWidth);
  //var iframeWidth = document.getElementById('petSearchResults').clientWidth;
  var colNum = '&colnum=3';

  $('#searchPets').on('click', function(e){
    e.preventDefault();
    var searchVal = '';
    searchVal += 'species=' + $('#species').val();
    searchVal += '&agegroup=' + $('#ageGroup').val();
    searchVal += '&gender=' + $('#gender').val();

    if(viewportWidth <= 767){
      colNum = '&colnum=2';
    }

    searchVal += colNum;

    $('#petSearchResults').attr('src', searchUrl + searchVal + searchQueryString);
  });
});
