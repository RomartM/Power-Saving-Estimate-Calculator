<?php
$template_defaults = array("Daytime Use", "KWH Daily", "Current KWH Rate", "Daily Saving", "Quarterly Saving", "Annual Savings");

$table = PSE_Table::create("pse_if_all_power_used", array(
  "thead"=> $template_defaults,
  "tbody"=> array( // CSS Class based not value
    $template_defaults
  )
), "pse-vertical-table-layout");

echo $table;
?>
