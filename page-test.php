<?php get_header(); ?>
  <?php
    $url = 'http://www.petango.com/webservices/adoptablesearch/wsAdoptableAnimals.aspx?species=Dog&sex=A&agegroup=All&onhold=A&orderby=ID&colnum=3&AuthKey=u4bl4npb2mnkueh85ho8spw5veybpsxa2ytshcoiuoynukq2ah&css=http://petango.com/WebServices/adoptablesearch/css/styles.css';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $output = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    
    //echo $output;
    $pets = $output->getElementsByTagName('tr');
    foreach($pets as $pet){
      
    }
  ?>
<?php get_footer(); ?>