<?php
$response = new TwimlResponse;

function modwrap($num, $mod) {
    return ($mod + ($num % $mod)) % $mod;
}

$now = date_create('now');
$today = modwrap(date_format($now, 'w') - 1, 7);

$response->redirect(AppletInstance::getDropZoneUrl(
  ($from = AppletInstance::getValue("range_{$today}_from"))
  && ($to = AppletInstance::getValue("range_{$today}_to"))
  && date_create($from) <= $now && $now < date_create($to)
  ? 'open'
  : 'closed'
));

$response->respond();
