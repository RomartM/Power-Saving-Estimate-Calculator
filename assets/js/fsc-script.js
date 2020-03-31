(function($) {
  $(function() {
    // var init
    var select_el_array = jQuery(".fsc-calc select");
    var input_el_array = jQuery(".fsc-calc input");
    var _preset_data = fsc_json_vars["preset-data"];

    function loadPresetData() {
      select_el_array.each(function(index, element) {
        var values = _preset_data[element.id.slice(11)];
        if (values.length > 0) {
          values.forEach(function(item) {
            jQuery("#" + element.id).append(`<option value="${item[0]}" ${item[1]}>${item[0]}</option>`)
          })
        }
      });

      input_el_array.each(function(index, element) {
        var values = _preset_data[element.id.slice(10)];
        if (values !== undefined) {
          jQuery("#" + element.id).val(values["value"]);
        }
      })
    }

    loadPresetData();
  });
})(jQuery);
