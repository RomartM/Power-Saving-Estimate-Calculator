(function($) {
  $(function() {
    // Form Fields
    var select_el_array = jQuery(".pse-calc select");
    var input_el_array = jQuery(".pse-calc input");
    var field_listener = jQuery(select_el_array.selector).add(input_el_array.selector);

    // Form Field ID's
    var field_ids = {};

    // Output Tables
    var table_your_system = jQuery("#pse_your_system");
    var table_usage_breakdown = jQuery("#pse_usage_breakdown");
    var table_if_all_powered_used = jQuery("pse_if_all_power_used");

    // Preset Plugin Datas
    var _preset_data = pse_json_vars["preset-data"];
    var default_currency = _preset_data.currency["value"];

    function loadPresetData() {
      select_el_array.each(function(index, element) {
        var values = _preset_data[element.id.slice(11)];
        // Append to field_ids as jQuery
        field_ids[element.id.slice(11)] = jQuery("#" + element.id);

        if (values.length > 0) {
          values.forEach(function(item) {
            jQuery("#" + element.id).append(`<option value="${item[0]}" ${item[1]}>${item[0]}</option>`)
          })
        }
      });

      input_el_array.each(function(index, element) {
        var values = _preset_data[element.id.slice(10)];
        // Append to field_ids as jQuery
        field_ids[element.id.slice(10)] = jQuery("#" + element.id);

        if (values !== undefined) {
          jQuery("#" + element.id).val(values["value"]);
        }
      })
    }

    function fieldVal(field_name) {
      return field_ids[field_name].val();
    }

    // Class Implementation

    class yourSystemCalculation {

      constructor() {
        this.table = jQuery("#pse_your_system");
        this.table["setText"] = window.pse_utils.setText;
      }

      _get_system_size() {
        return fieldVal('system_size');
      }

      _get_production_average() {
        return _preset_data.peak_sun_hours.value;
      }

      _get_loss_factor() {
        return fieldVal('system_loss_factor');
      }

      _get_kwh_daily() {
        return window.pse_utils._round(this._get_system_size() * this._get_production_average(), 2);
      }

      _get_kwh_quarterly() {
        return this._get_kwh_daily() * 365 / 4;
      }

      _get_kwh_annualy() {
        return this._get_kwh_quarterly() * 4;
      }

      calculate() {
        this.table.setText(".system_size", this._get_system_size() + "kW");
        this.table.setText(".production_average", this._get_production_average());
        this.table.setText(".kwh_daily", this._get_kwh_daily().toFixed(2));
        this.table.setText(".kwh_quarterly", window.pse_utils._commas(window.pse_utils._round(this._get_kwh_quarterly(), 0)));
        this.table.setText(".kwh_annualy", window.pse_utils._commas(this._get_kwh_annualy()));
        this.table.setText(".loss_factor", String(this._get_loss_factor()).concat("%"));
      }
    }

    class ifAllPowerUsedCalculation {
      constructor(yourSystemInit) {
        this.table = jQuery("#pse_if_all_power_used");
        this.table["setText"] = window.pse_utils.setText;
        this.daytime_use = 100;
        this.yourSystem = yourSystemInit;
      }

      _get_kwh_daily() {
        return this.yourSystem._get_kwh_daily();
      }

      _get_power_price() {
        return fieldVal("power_price");
      }

      _get_daily_saving() {
        return this._get_kwh_daily() * this._get_power_price();
      }

      _get_quarterly_saving() {
        return this._get_daily_saving() * 92;
      }

      _get_annual_saving() {
        return this._get_quarterly_saving() * 4;
      }

      calculate() {
        this.table.setText(".daytime_use", String(this.daytime_use).concat("%"));
        this.table.setText(".kwh_daily", this._get_kwh_daily().toFixed(2));
        this.table.setText(".current_kwh_rate", this._get_power_price());
        this.table.setText(".daily_saving", window.pse_utils._round(this._get_daily_saving(), 2));
        this.table.setText(".quarterly_saving", window.pse_utils._commas(window.pse_utils._round(this._get_quarterly_saving(), 2)));
        this.table.setText(".annual_savings", window.pse_utils._commas(window.pse_utils._roundup(this._get_annual_saving(), 0)));
      }
    }

    class usageBreakDownCalculation {
      constructor(ifAllPowerUsedInit) {
        this.tr_usage_savings = jQuery(".usage_savings");
        this.tr_usage_savings["setText"] = window.pse_utils.setText;

        this.tr_storage_savings = jQuery(".storage_savings");
        this.tr_storage_savings["setText"] = window.pse_utils.setText;

        this.tr_export_savings_fit = jQuery(".export_savings_fit");
        this.tr_export_savings_fit["setText"] = window.pse_utils.setText;

        this.tr_total_savings = jQuery(".total_savings");
        this.tr_total_savings["setText"] = window.pse_utils.setText;

        this.table_daily_kwh_by_month = jQuery("#daily_kwh_by_month");
        this.table_daily_kwh_by_month["setText"] = window.pse_utils.setText;

        this.ifAllPowerUsed = ifAllPowerUsedInit;

        this.monthly_dataset = [
          ["January", 5.92450],
          ["February", 5.21900],
          ["March", 4.93850],
          ["April", 4.16500],
          ["May", 3.15350],
          ["June", 2.66050],
          ["July", 2.93250],
          ["August", 3.45100],
          ["September", 4.50500],
          ["October", 5.15100],
          ["November", 5.61000],
          ["December", 5.81400]
        ];
      }

      battery_usage_dataset() {
        var dataset = [
          ["LG Chem 6.4", 6.4],
          ["LG Chem 9.8", 9.8],
          ["Tesla PW2", 13.5]
        ];

        dataset.map(function(data) {
          return data.push(((1 + fieldVal("smoothing_rate") * data[1]) / 100));
        })

        return dataset;
      }

      _filer_daily_saving(value) {
        if (value < 1) {
          return "-";
        }
        return default_currency.concat(window.pse_utils._round(value, 2));
      }

      _filer_quarterly_saving(value) {
        if (value < 1) {
          return "-";
        }
        return default_currency.concat(window.pse_utils._commas(window.pse_utils._round(value, 0)));
      }

      _filer_annual_saving(value) {
        if (value < 1) {
          return "-";
        }
        return default_currency.concat(window.pse_utils._commas(window.pse_utils._round(value, 0)));
      }

      _get_battery_usable() {
        return window.pse_utils._vlookup(fieldVal("battery_model"), this.battery_usage_dataset(), 3);
      }

      _get_battery_offered() {
        return fieldVal("battery_offered");
      }

      _get_battery_capacity() {
        return window.pse_utils._if(this._get_battery_offered() == "Yes", this._get_battery_usable(), 0);
      }

      _get_total_generation() {
        return this.ifAllPowerUsed._get_kwh_daily();
      }

      _get_usage() {
        return ((fieldVal("daytime_usage") * this.ifAllPowerUsed._get_kwh_daily()) / 100);
      }

      _get_export_amount() {
        return ((_preset_data.solar_exported.value * this.ifAllPowerUsed._get_kwh_daily()) / 100);
      }

      _get_storage_kwh() {
        return window.pse_utils._if(this._get_export_amount() < this._get_battery_capacity(), this._get_export_amount(), this._get_battery_capacity());
      }

      _get_export_amount_1() {
        return this._get_export_amount() - this._get_storage_kwh();
      }

      _get_percentage(value) {
        return (((100 - fieldVal('system_loss_factor')) * value) / 100);
      };

      // Usage Saving Calculation

      _get_usage_saving_daily() {
        return this._get_usage() * fieldVal("power_price");
      }

      _get_usage_saving_quarterly() {
        return this._get_usage_saving_daily() * 92;
      }

      _get_usage_saving_annual() {
        return this._get_usage_saving_quarterly() * 4;
      }

      calculate_usage_saving() {
        this.tr_usage_savings.setText(".total", window.pse_utils._round(this._get_usage(), 2).toFixed(2));
        this.tr_usage_savings.setText(".current_kwh_rate", fieldVal("power_price"));
        this.tr_usage_savings.setText(".daily_saving", this._filer_daily_saving(this._get_usage_saving_daily()));
        this.tr_usage_savings.setText(".quarterly_saving", this._filer_quarterly_saving(this._get_usage_saving_quarterly()));
        this.tr_usage_savings.setText(".annual_saving", this._filer_annual_saving(this._get_usage_saving_annual()));
      }

      // Storage Saving Calculation

      _get_storage_saving_daily() {
        return this._get_storage_kwh() * fieldVal("power_price");
      }

      _get_storage_saving_quarterly() {
        return this._get_storage_saving_daily() * 92;
      }

      _get_storage_saving_annual() {
        return this._get_storage_saving_quarterly() * 4;
      }

      calculate_storage_saving() {
        this.tr_storage_savings.setText(".total", window.pse_utils._round(this._get_storage_kwh(), 2));
        this.tr_storage_savings.setText(".current_kwh_rate", fieldVal("power_price"));
        this.tr_storage_savings.setText(".daily_saving", this._filer_daily_saving(this._get_storage_saving_daily()));
        this.tr_storage_savings.setText(".quarterly_saving", this._filer_quarterly_saving(this._get_storage_saving_quarterly()));
        this.tr_storage_savings.setText(".annual_saving", this._filer_annual_saving(this._get_storage_saving_annual()));
      }

      // Export Savings Calculation

      _get_export_saving_daily() {
        return this._get_export_amount_1() * fieldVal("feed_in_tariff");
      }

      _get_export_saving_quarterly() {
        return this._get_export_saving_daily() * 92;
      }

      _get_export_saving_annual() {
        return this._get_export_saving_quarterly() * 4;
      }

      calculate_export_saving() {
        this.tr_export_savings_fit.setText(".total", window.pse_utils._round(this._get_export_amount_1(), 2));
        this.tr_export_savings_fit.setText(".current_kwh_rate", fieldVal("feed_in_tariff"));
        this.tr_export_savings_fit.setText(".daily_saving", this._filer_daily_saving(this._get_export_saving_daily()));
        this.tr_export_savings_fit.setText(".quarterly_saving", this._filer_quarterly_saving(this._get_export_saving_quarterly()));
        this.tr_export_savings_fit.setText(".annual_saving", this._filer_annual_saving(this._get_export_saving_annual()));
      }

      // KWH Day Calculation

      _get_daily_kwh_by_month(value) {
        return window.pse_utils._round(this._get_percentage(value * fieldVal("system_size")), 2);
      }

      _daily_kwh_by_month_calcualation() {
        this.monthly_dataset.forEach(function(data) {
          this.table_daily_kwh_by_month.setText("td." + data[0].toLowerCase(), this._get_daily_kwh_by_month(data[1]));
        }.bind(this))
      }

      calculate_sum() {
        this.tr_total_savings.setText(".quarterly_saving", this._filer_quarterly_saving(window.pse_utils._sum([
          this._get_usage_saving_quarterly(),
          this._get_storage_saving_quarterly(),
          this._get_export_saving_quarterly()
        ])));
        this.tr_total_savings.setText(".annual_saving", this._filer_annual_saving(window.pse_utils._sum([
          this._get_usage_saving_annual(),
          this._get_storage_saving_annual(),
          this._get_export_saving_annual()
        ])));
      }

      calculate() {
        this.calculate_usage_saving();
        this.calculate_storage_saving();
        this.calculate_export_saving();
        this.calculate_sum();
        this._daily_kwh_by_month_calcualation();
      }

    }

    // Class Initialization
    var yourSystem = new yourSystemCalculation();
    var ifAllPowerUsed = new ifAllPowerUsedCalculation(yourSystem);
    var usageBreakDown = new usageBreakDownCalculation(ifAllPowerUsed);

    // Calculate Initiator
    function calculate() {
      yourSystem.calculate();
      ifAllPowerUsed.calculate();
      usageBreakDown.calculate();
    }

    // Event Listner
    field_listener.on('change', function() {
      calculate();
    });

    loadPresetData();
    calculate();
  });
})(jQuery);
