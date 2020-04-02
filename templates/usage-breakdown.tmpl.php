<?php
$template_defaults = array("Usage Breakdown", "Total", "Current KWH Rate", "Daily Saving", "Quarterly Saving", "Annual Saving");

function alterFirstValue($horizontal_header_name, $template){
  $template['0'] = $horizontal_header_name;
  return $template;
}

$table = PSE_Table::create("pse_usage_breakdown", array(
"thead"=> $template_defaults,
  "tbody"=> array( // CSS Class based not value
    alterFirstValue("txt_Usage Savings", $template_defaults),
    alterFirstValue("txt_Storage Savings", $template_defaults),
    alterFirstValue("txt_Export Savings (FIT)", $template_defaults)
  )
));

$table1 = PSE_Table::create("pse_usage_breakdown_total", array(
  "thead"=> array("", "Quarterly Saving", "Annual Saving"),
  "tbody"=> array( // CSS Class based not value
    array("txt_Total Savings", "Quarterly Saving", "Annual Saving")
  )
));

$table2 = PSE_Table::create("daily_kwh_by_month", array(
  "thead"=> array("KWH Day", "Daily KWH by Month"),
  "tbody"=> array( // CSS Class based not value
    array("txt_Jan", "January"),
    array("txt_Feb", "February"),
    array("txt_Mar", "March"),
    array("txt_Apr", "April"),
    array("txt_May", "May"),
    array("txt_Jun", "June"),
    array("txt_Jul", "July"),
    array("txt_Aug", "August"),
    array("txt_Sep", "September"),
    array("txt_Oct", "October"),
    array("txt_Nov", "November"),
    array("txt_Dec", "December"),
  )
));

echo $table;
echo $table1;
echo $table2;

?>
