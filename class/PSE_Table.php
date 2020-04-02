<?php

class PSE_Table {

  private function create_tag($name, $content = "tmpl", $class="", $title=""){
    $tmpl_class = ( ( $class !== "" ) ? "class=\"{$class}\"":"");
    $data_table = ( ( $name == "td" ) ? "data-title=\"{$title}\"": "");
    $tmpl = "<ttg {$tmpl_class} {$data_table}>{$content}</ttg>";
    $tmpl = str_replace( "ttg", $name, $tmpl );
    return $tmpl;
  }

  private function create_header( $header_values ){
    $tmpl = "";
    for ( $val_iterator = 0; $val_iterator < count( $header_values ); $val_iterator++ ) {
      $tmpl .= self::create_tag("th", $header_values[$val_iterator]);
    }
    return $tmpl;
  }

  private function create_data( $data_values ){
    $tmpl = "";
    for ( $val_iterator = 0; $val_iterator < count( $data_values ); $val_iterator++ ) {
      $filter = "";
      $txt = "";
      if(substr($data_values[$val_iterator], 0, 4) == "txt_"){
        $txt = substr($data_values[$val_iterator], 4);
      }else{
        $filter = strtolower(str_replace(" ", "_", $data_values[$val_iterator]));
      }
      $tmpl .= self::create_tag("td", $txt, $filter, $data_values[$val_iterator]);
    }

    return $tmpl;
  }

  private function create_row( $row_values, $method ){
    $tmpl = "";
    if ($method == 'create_data') {
      for ($val_iterator=0; $val_iterator < count($row_values); $val_iterator++) {
        $filter = "";
        if(substr($row_values[$val_iterator][0], 0, 4) == "txt_"){
          $filter = substr(strtolower(str_replace("(", "", str_replace(")", "", str_replace(" ", "_", $row_values[$val_iterator][0])))), 4);
        }
        $tmpl .= self::create_tag( "tr", self::create_data($row_values[$val_iterator]), $filter);
      }
    }else{
        $tmpl .= self::create_tag( "tr", self::create_header($row_values) );
    }
    return $tmpl;
  }


  public function create( $identifier, $object_data, $class_name=""){
    $table = "<table id=\"{$identifier}\" class=\"table table-bordered table-sm {$class_name}\">tmpl</table>";

    $thead = self::create_tag( "thead", self::create_row( $object_data["thead"],'create_header') );
    $tbody = self::create_tag( "tbody", self::create_row( $object_data["tbody"], 'create_data') );

    $table = str_replace( "tmpl", ($thead . $tbody), $table );

    return $table;
  }

}

?>
