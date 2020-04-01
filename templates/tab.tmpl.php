<div class="panel with-nav-tabs panel-primary">
  <div class="panel-heading">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab_your_system" data-toggle="tab">Your System</a></li>
      <li><a href="#tab_if_all_power_used" data-toggle="tab">If sll power used</a></li>
      <li><a href="#tab_your_usage_breakdown" data-toggle="tab">Your Usage Breakdown</a></li>
    </ul>
  </div>
  <div class="panel-body">
    <div class="tab-content">
      <div class="tab-pane fade in active" id="tab_your_system"><?php include 'your-system.tmpl.php';?></div>
      <div class="tab-pane fade" id="tab_if_all_power_used"><?php include 'if-all-power-used.tmpl.php'; ?></div>
      <div class="tab-pane fade" id="tab_your_usage_breakdown"><?php include 'usage-breakdown.tmpl.php';?></div>
    </div>
  </div>
</div>
