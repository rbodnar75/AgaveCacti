<?php
/*
 +-------------------------------------------------------------------------+
 | Copyright (C) 2004-2024 The Cacti Group                                 |
 +-------------------------------------------------------------------------+
 | AgaveCacti Modern Dashboard                                             |
 +-------------------------------------------------------------------------+
*/

// Get system statistics
$total_hosts = db_fetch_cell('SELECT COUNT(*) FROM host');
$total_graphs = db_fetch_cell('SELECT COUNT(*) FROM graph_templates_graph');
$total_data_sources = db_fetch_cell('SELECT COUNT(*) FROM data_template_data');
$poller_enabled = read_config_option('poller_enabled');
$last_poller_run = read_config_option('date');

// Get recent activity
$recent_logs = db_fetch_assoc('SELECT * FROM cacti_log ORDER BY logdate DESC LIMIT 5');

// Get device status
$devices_up = db_fetch_cell("SELECT COUNT(*) FROM host WHERE status = 3");
$devices_down = db_fetch_cell("SELECT COUNT(*) FROM host WHERE status = 1");
$devices_unknown = db_fetch_cell("SELECT COUNT(*) FROM host WHERE status = 0");

// Get poller stats
$poller_stats = db_fetch_row('SELECT * FROM poller_time ORDER BY id DESC LIMIT 1');
$poller_time = isset($poller_stats['end_time']) ? $poller_stats['end_time'] : 0;

?>

<div class="agave-dashboard">
	<!-- Welcome Section -->
	<div class="agave-card agave-slide-in">
		<div class="agave-card-header">
			<h2 class="agave-card-title">Welcome to AgaveCacti</h2>
		</div>
		<div class="agave-card-body">
			<p style="color: var(--gray-600); font-size: 1rem; margin: 0;">
				Modern network monitoring and graphing solution. Monitor your infrastructure with style.
			</p>
		</div>
	</div>

	<!-- Stats Grid -->
	<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: var(--spacing-lg); margin-bottom: var(--spacing-lg);">
		
		<!-- System Overview Card -->
		<div class="agave-card agave-slide-in">
			<div class="agave-card-header">
				<h3 class="agave-card-title">System Overview</h3>
			</div>
			<div class="agave-card-body">
				<div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--spacing-md);">
					<div>
						<div style="font-size: 2rem; font-weight: 600; color: var(--primary-color);"><?php echo number_format($total_hosts); ?></div>
						<div style="color: var(--gray-600); font-size: 0.875rem;">Devices</div>
					</div>
					<div>
						<div style="font-size: 2rem; font-weight: 600; color: var(--secondary-color);"><?php echo number_format($total_graphs); ?></div>
						<div style="color: var(--gray-600); font-size: 0.875rem;">Graphs</div>
					</div>
					<div>
						<div style="font-size: 2rem; font-weight: 600; color: var(--accent-color);"><?php echo number_format($total_data_sources); ?></div>
						<div style="color: var(--gray-600); font-size: 0.875rem;">Data Sources</div>
					</div>
					<div>
						<div style="font-size: 1.25rem; font-weight: 600; color: <?php echo $poller_enabled == 'on' ? 'var(--success-color)' : 'var(--error-color)'; ?>;">
							<?php echo $poller_enabled == 'on' ? 'Active' : 'Inactive'; ?>
						</div>
						<div style="color: var(--gray-600); font-size: 0.875rem;">Poller Status</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Device Status Card -->
		<div class="agave-card agave-slide-in">
			<div class="agave-card-header">
				<h3 class="agave-card-title">Device Status</h3>
			</div>
			<div class="agave-card-body">
				<div style="display: flex; flex-direction: column; gap: var(--spacing-sm);">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div style="display: flex; align-items: center; gap: var(--spacing-sm);">
							<div style="width: 12px; height: 12px; background: var(--success-color); border-radius: 50%;"></div>
							<span>Up</span>
						</div>
						<span style="font-weight: 600;"><?php echo number_format($devices_up); ?></span>
					</div>
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div style="display: flex; align-items: center; gap: var(--spacing-sm);">
							<div style="width: 12px; height: 12px; background: var(--error-color); border-radius: 50%;"></div>
							<span>Down</span>
						</div>
						<span style="font-weight: 600;"><?php echo number_format($devices_down); ?></span>
					</div>
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div style="display: flex; align-items: center; gap: var(--spacing-sm);">
							<div style="width: 12px; height: 12px; background: var(--gray-400); border-radius: 50%;"></div>
							<span>Unknown</span>
						</div>
						<span style="font-weight: 600;"><?php echo number_format($devices_unknown); ?></span>
					</div>
				</div>
				
				<!-- Status Progress Bar -->
				<div style="margin-top: var(--spacing-md);">
					<?php 
					$total_devices = $devices_up + $devices_down + $devices_unknown;
					if ($total_devices > 0) {
						$up_percent = ($devices_up / $total_devices) * 100;
						$down_percent = ($devices_down / $total_devices) * 100;
						$unknown_percent = ($devices_unknown / $total_devices) * 100;
					?>
					<div style="height: 8px; background: var(--gray-200); border-radius: 4px; overflow: hidden; display: flex;">
						<div style="background: var(--success-color); width: <?php echo $up_percent; ?>%;"></div>
						<div style="background: var(--error-color); width: <?php echo $down_percent; ?>%;"></div>
						<div style="background: var(--gray-400); width: <?php echo $unknown_percent; ?>%;"></div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>

		<!-- Performance Card -->
		<div class="agave-card agave-slide-in">
			<div class="agave-card-header">
				<h3 class="agave-card-title">Performance</h3>
			</div>
			<div class="agave-card-body">
				<div style="display: flex; flex-direction: column; gap: var(--spacing-md);">
					<div>
						<div style="display: flex; justify-content: space-between; margin-bottom: var(--spacing-xs);">
							<span style="font-size: 0.875rem; color: var(--gray-600);">Last Poller Run</span>
							<span style="font-size: 0.875rem; font-weight: 500;"><?php echo $poller_time > 0 ? number_format($poller_time, 2) . 's' : 'N/A'; ?></span>
						</div>
					</div>
					<div>
						<div style="display: flex; justify-content: space-between; margin-bottom: var(--spacing-xs);">
							<span style="font-size: 0.875rem; color: var(--gray-600);">Last Update</span>
							<span style="font-size: 0.875rem; font-weight: 500;"><?php echo $last_poller_run ? date('M j, H:i', $last_poller_run) : 'Never'; ?></span>
						</div>
					</div>
					<div>
						<span class="agave-status <?php echo $poller_enabled == 'on' ? 'agave-status-success' : 'agave-status-error'; ?>">
							<?php echo $poller_enabled == 'on' ? 'System Healthy' : 'System Issues'; ?>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Recent Activity -->
	<div class="agave-card agave-slide-in">
		<div class="agave-card-header">
			<h3 class="agave-card-title">Recent Activity</h3>
		</div>
		<div class="agave-card-body">
			<?php if (cacti_sizeof($recent_logs)) { ?>
			<div style="display: flex; flex-direction: column; gap: var(--spacing-sm);">
				<?php foreach ($recent_logs as $log) { 
					$log_type = strtolower($log['facility']);
					$status_class = 'agave-status-info';
					if (stripos($log['message'], 'error') !== false) {
						$status_class = 'agave-status-error';
					} elseif (stripos($log['message'], 'warning') !== false) {
						$status_class = 'agave-status-warning';
					} elseif (stripos($log['message'], 'success') !== false) {
						$status_class = 'agave-status-success';
					}
				?>
				<div style="display: flex; align-items: flex-start; gap: var(--spacing-md); padding: var(--spacing-sm); border-radius: var(--border-radius-md); background: var(--gray-50);">
					<span class="agave-status <?php echo $status_class; ?>"><?php echo strtoupper(substr($log['facility'], 0, 3)); ?></span>
					<div style="flex: 1; min-width: 0;">
						<div style="font-size: 0.875rem; line-height: 1.4; margin-bottom: var(--spacing-xs);">
							<?php echo html_escape(substr($log['message'], 0, 120)) . (strlen($log['message']) > 120 ? '...' : ''); ?>
						</div>
						<div style="font-size: 0.75rem; color: var(--gray-500);">
							<?php echo date('M j, Y H:i:s', strtotime($log['logdate'])); ?>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
			<?php } else { ?>
			<div style="text-align: center; color: var(--gray-500); padding: var(--spacing-lg);">
				<div style="font-size: 3rem; margin-bottom: var(--spacing-md);">📊</div>
				<div>No recent activity to display</div>
			</div>
			<?php } ?>
		</div>
	</div>

	<!-- Quick Actions -->
	<div class="agave-card agave-slide-in">
		<div class="agave-card-header">
			<h3 class="agave-card-title">Quick Actions</h3>
		</div>
		<div class="agave-card-body">
			<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: var(--spacing-md);">
				<a href="host.php" class="agave-btn agave-btn-primary" style="text-decoration: none; justify-content: center;">
					<span>📱</span> Manage Devices
				</a>
				<a href="graphs.php" class="agave-btn agave-btn-secondary" style="text-decoration: none; justify-content: center;">
					<span>📈</span> View Graphs
				</a>
				<a href="data_sources.php" class="agave-btn agave-btn-secondary" style="text-decoration: none; justify-content: center;">
					<span>💾</span> Data Sources
				</a>
				<a href="settings.php" class="agave-btn agave-btn-secondary" style="text-decoration: none; justify-content: center;">
					<span>⚙️</span> Settings
				</a>
			</div>
		</div>
	</div>

	<!-- Getting Started Guide (for new installations) -->
	<div class="agave-card agave-slide-in">
		<div class="agave-card-header">
			<h3 class="agave-card-title">Getting Started</h3>
		</div>
		<div class="agave-card-body">
			<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: var(--spacing-lg);">
				<div>
					<h4 style="margin: 0 0 var(--spacing-sm) 0; color: var(--gray-700);">1. Add Devices</h4>
					<p style="margin: 0; color: var(--gray-600); font-size: 0.875rem; line-height: 1.5;">
						Start by adding network devices to monitor. AgaveCacti supports SNMP monitoring for switches, routers, and servers.
					</p>
				</div>
				<div>
					<h4 style="margin: 0 0 var(--spacing-sm) 0; color: var(--gray-700);">2. Create Graphs</h4>
					<p style="margin: 0; color: var(--gray-600); font-size: 0.875rem; line-height: 1.5;">
						Generate beautiful graphs to visualize your network performance, bandwidth usage, and system metrics.
					</p>
				</div>
				<div>
					<h4 style="margin: 0 0 var(--spacing-sm) 0; color: var(--gray-700);">3. Set Up Monitoring</h4>
					<p style="margin: 0; color: var(--gray-600); font-size: 0.875rem; line-height: 1.5;">
						Configure data collection intervals and set up automated polling to keep your data up-to-date.
					</p>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
/* Dashboard specific animations */
.agave-dashboard .agave-slide-in {
	animation: slideInDashboard 0.6s ease-out forwards;
	opacity: 0;
	transform: translateY(20px);
}

.agave-dashboard .agave-slide-in:nth-child(1) { animation-delay: 0.1s; }
.agave-dashboard .agave-slide-in:nth-child(2) { animation-delay: 0.2s; }
.agave-dashboard .agave-slide-in:nth-child(3) { animation-delay: 0.3s; }
.agave-dashboard .agave-slide-in:nth-child(4) { animation-delay: 0.4s; }
.agave-dashboard .agave-slide-in:nth-child(5) { animation-delay: 0.5s; }

@keyframes slideInDashboard {
	to {
		opacity: 1;
		transform: translateY(0);
	}
}

/* Responsive adjustments for dashboard */
@media (max-width: 768px) {
	.agave-dashboard .agave-card-body > div[style*="grid-template-columns"] {
		grid-template-columns: 1fr !important;
	}
}
</style>
