<?php
$template_defaults = array("System Size", "Production Average", "KWH Daily", "KWH Quarterly", "KWH Annualy", "Loss factor");

$table = PSE_Table::create("pse_your_system", array(
  "thead"=> $template_defaults,
  "tbody"=> array( // CSS Class based not value
    $template_defaults
  )
));

echo $table;
?>
