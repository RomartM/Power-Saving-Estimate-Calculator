<?php
$template_defaults = array("Daytime Use", "KWH Daily", "Current KWH Rate", "Daily Saving", "Quarterly Saving", "Annual Savings");

$table = FSC_Table::create("name_id", array(
  "thead"=> $template_defaults,
  "tbody"=> array( // CSS Class based not value
    $template_defaults
  )
));

echo $table;
?>
