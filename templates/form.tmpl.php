<!-- External Assets -->
<div class="fsc-calc fsc-shortcode">
  <form class="form-horizontal">
    <fieldset>

      <!-- Select Office -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="fsc_select_office">Office</label>
        <div class="col-md-4">
          <select id="fsc_select_office" name="fsc_select_office" class="form-control"></select>
        </div>
      </div>

      <!-- Input System Size-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="fsc_input_system_size">System Size (kW)</label>
        <div class="col-md-4">
          <input id="fsc_input_system_size" min="0" name="fsc_input_system_size" step=".00" type="number"  class="form-control input-md">
        </div>
      </div>

      <!-- Input Daytime Usage -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="fsc_input_daytime_usage">Daytime Usage</label>
        <div class="col-md-4">
          <div class="input-group">
            <input id="fsc_input_daytime_usage" min="0" name="fsc_input_daytime_usage" class="form-control"  type="text">
            <span class="input-group-addon">%</span>
          </div>
        </div>
      </div>

      <!-- Input Power Price -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="fsc_input_power_price">Power Price (Kw)</label>
        <div class="col-md-4">
          <div class="input-group">
            <span class="input-group-addon">$</span>
            <input id="fsc_input_power_price" min="0" name="fsc_input_power_price" step=".01" class="form-control"  type="number">
          </div>
        </div>
      </div>

      <!-- Input Feed In Tariff -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="fsc_input_feed_in_tariff">Feed In Tariff</label>
        <div class="col-md-4">
          <div class="input-group">
            <span class="input-group-addon">$</span>
            <input id="fsc_input_feed_in_tariff" min="0" name="fsc_input_feed_in_tariff" step=".01" class="form-control"  type="number">
          </div>
        </div>
      </div>

      <!-- Input System Loss Factor -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="fsc_input_system_loss_factor">System Loss Factor</label>
        <div class="col-md-4">
          <div class="input-group">
            <input id="fsc_input_system_loss_factor" min="0" name="fsc_input_system_loss_factor" class="form-control"  type="number">
            <span class="input-group-addon">%</span>
          </div>
        </div>
      </div>

      <!-- Select Battery Offered -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="fsc_select_battery_offered">Battery Offered</label>
        <div class="col-md-4">
          <select id="fsc_select_battery_offered" name="fsc_select_battery_offered" class="form-control"></select>
        </div>
      </div>

      <!-- Select Battery Model -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="fsc_select_battery_model">Battery Model</label>
        <div class="col-md-4">
          <select id="fsc_select_battery_model" name="fsc_select_battery_model" class="form-control"></select>
        </div>
      </div>

      <!-- Input Smoothing Rate -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="fsc_input_smoothing_rate">Smoothing Rate</label>
        <div class="col-md-4">
          <div class="input-group">
            <input id="fsc_input_smoothing_rate" min="0" name="fsc_input_smoothing_rate" class="form-control"  type="number">
            <span class="input-group-addon">%</span>
          </div>
        </div>
      </div>

    </fieldset>
  </form>

</div>
