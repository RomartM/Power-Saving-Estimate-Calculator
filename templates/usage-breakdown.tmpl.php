<?php
$template_defaults = array("Usage Breakdown", "Total	Current", "KWH Rate", "Daily Saving", "Quarterly Saving", "Annual Saving");

$table = FSC_Table::create("name_id", array(
  "thead"=> $template_defaults,
  "tbody"=> array( // CSS Class based not value
    $template_defaults
  )
));

$table2 = FSC_Table::create("name_id", array(
  "thead"=> array("KWH Day", "Daily KWH by Month"),
  "tbody"=> array( // CSS Class based not value
    array("txt_January", "January"),
    array("txt_February", "February"),
    array("txt_March", "March"),
    array("txt_April", "April"),
    array("txt_May", "May"),
    array("txt_June", "June"),
    array("txt_July", "July"),
    array("txt_August", "August"),
    array("txt_September", "September"),
    array("txt_October", "October"),
    array("txt_November", "November"),
    array("txt_December", "December"),
  )
));

echo $table;
echo $table2;


?>
