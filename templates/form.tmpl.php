<div class="form">
  <div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
      <!-- Select Office -->
      <div class="pse-office row">
        <label class="col-md-12 control-label" for="pse_select_office">Office</label>
        <div class="col-md-12">
          <select id="pse_select_office" name="pse_select_office" class="form-control"></select>
        </div>
      </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
      <!-- Input System Size-->
      <div class="form-group row">
        <label class="col-sm-5 col-md-54 col-lg-6 control-label" for="pse_input_system_size">System Size (kW)</label>
        <div class="col-sm-7 col-md-7 col-lg-6">
          <input id="pse_input_system_size" min="0" name="pse_input_system_size" step=".00" type="number" class="form-control input-md">
        </div>
      </div>

      <!-- Input Daytime Usage -->
      <div class="form-group row">
        <label class="col-sm-5 col-md-5 col-lg-6 control-label" for="pse_input_daytime_usage">Daytime Usage</label>
        <div class="col-sm-7 col-md-7 col-lg-6">
          <div class="input-group">
            <input id="pse_input_daytime_usage" min="0" name="pse_input_daytime_usage" class="form-control" type="text">
            <span class="input-group-addon">%</span>
          </div>
        </div>
      </div>

      <!-- Input Power Price -->
      <div class="form-group row">
        <label class="col-sm-5 col-md-5 col-lg-6 control-label" for="pse_input_power_price">Power Price (Kw)</label>
        <div class="col-sm-7 col-md-7 col-lg-6">
          <div class="input-group">
            <span class="input-group-addon">$</span>
            <input id="pse_input_power_price" min="0" name="pse_input_power_price" step=".01" class="form-control" type="number">
          </div>
        </div>
      </div>

      <!-- Input Feed In Tariff -->
      <div class="form-group row">
        <label class="col-sm-5 col-md-5 col-lg-6 control-label" for="pse_input_feed_in_tariff">Feed In Tariff</label>
        <div class="col-sm-7 col-md-7 col-lg-6">
          <div class="input-group">
            <span class="input-group-addon">$</span>
            <input id="pse_input_feed_in_tariff" min="0" name="pse_input_feed_in_tariff" step=".01" class="form-control" type="number">
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
      <!-- Input System Loss Factor -->
      <div class="form-group row">
        <label class="col-sm-5 col-md-5 col-lg-6 control-label" for="pse_input_system_loss_factor">System Loss Factor</label>
        <div class="col-sm-7 col-md-7 col-lg-6">
          <div class="input-group">
            <input id="pse_input_system_loss_factor" min="0" name="pse_input_system_loss_factor" class="form-control" type="number">
            <span class="input-group-addon">%</span>
          </div>
        </div>
      </div>

      <!-- Select Battery Offered -->
      <div class="form-group row">
        <label class="col-sm-5 col-md-5 col-lg-6 control-label" for="pse_select_battery_offered">Battery Offered</label>
        <div class="col-sm-7 col-md-7 col-lg-6">
          <select id="pse_select_battery_offered" name="pse_select_battery_offered" class="form-control"></select>
        </div>
      </div>

      <!-- Select Battery Model -->
      <div class="form-group row">
        <label class="col-sm-5 col-md-5 col-lg-6 control-label" for="pse_select_battery_model">Battery Model</label>
        <div class="col-sm-7 col-md-7 col-lg-6">
          <select id="pse_select_battery_model" name="pse_select_battery_model" class="form-control"></select>
        </div>
      </div>

      <!-- Input Smoothing Rate -->
      <div class="form-group row">
        <label class="col-sm-5 col-md-5 col-lg-6 control-label" for="pse_input_smoothing_rate">Smoothing Rate</label>
        <div class="col-sm-7 col-md-7 col-lg-6">
          <div class="input-group">
            <input id="pse_input_smoothing_rate" min="0" name="pse_input_smoothing_rate" class="form-control" type="number">
            <span class="input-group-addon">%</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
