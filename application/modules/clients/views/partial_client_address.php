<?php $this->load->helper('country'); ?>

<span class="client-address-street-line">
    <?php echo($client->client_address_1 ? "<span class='bold'>Client address : </span>" .htmlsc($client->client_address_1) . '<br>' : ''); ?>
</span>
<span class="client-address-street-line">
    <?php echo($client->client_address_2 ?"<span class='bold'>Client address :</span> " . htmlsc($client->client_address_2) . '<br>' : ''); ?>
</span>
<span class="client-adress-town-line">
    <?php echo($client->client_city ?"<span class='bold'>Client City : </span>" . htmlsc($client->client_city) .  '<br> ' : ''); ?>
    
</span>
<span class="client-adress-town-line">
   
    <?php echo($client->client_state ? "<span class='bold'>Client State :</span> " .htmlsc($client->client_state) . ' ' : ''); ?>
  
</span>
<span class="client-adress-town-line">
    <?php echo($client->client_zip ? "<span class='bold'>Client Zip :</span> " .htmlsc($client->client_zip) : ''); ?>
</span>
<span class="client-adress-country-line">
    <?php echo($client->client_country ? '<br><span class="bold">Client Country :</span> ' . get_country_name(trans('cldr'), $client->client_country) : ''); ?>
</span>
