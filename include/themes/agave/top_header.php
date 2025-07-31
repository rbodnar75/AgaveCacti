<?php
/*
 +-------------------------------------------------------------------------+
 | Copyright (C) 2004-2024 The Cacti Group                                 |
 +-------------------------------------------------------------------------+
 | AgaveCacti Modern Theme - Top Header                                    |
 +-------------------------------------------------------------------------+
*/

global $config, $menu;

$page_title = api_plugin_hook_function('page_title', draw_navigation_text('title'));
$using_guest_account = false;

if (!isset_request_var('headercontent')) {?>
<!DOCTYPE html>
<html lang='<?php print CACTI_LOCALE;?>' class='agave-theme'>
<head>
	<?php html_common_header($page_title);?>
	<link href='<?php print $config['url_path'];?>include/themes/agave/main.css' type='text/css' rel='stylesheet'>
	<script src='<?php print $config['url_path'];?>include/themes/agave/agave.js' type='text/javascript'></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="theme-color" content="#2563eb">
</head>
<body>
	<div class="agave-layout">
		<!-- Header -->
		<header class="agave-header">
			<div class="agave-header-brand">
				<button class="agave-mobile-menu-toggle" aria-label="Toggle navigation">
					<span>☰</span>
				</button>
				<h1>
					<div class="agave-logo">🌵</div>
					AgaveCacti
				</h1>
			</div>
			<div class="agave-header-actions">
				<?php if (read_config_option('auth_method') != 0) {?>
				<div class="agave-user-menu">
					<span><?php echo $_SESSION['sess_user_id'];?></span>
					<a href="<?php print $config['url_path'];?>logout.php" class="agave-btn agave-btn-secondary">Logout</a>
				</div>
				<?php }?>
			</div>
		</header>

		<!-- Sidebar Navigation -->
		<nav class="agave-sidebar" id="navigation">
			<div class="agave-nav">
				<?php 
				// Generate comprehensive Agave navigation menu
				$realm_allowed = array();
				
				// Main sections
				$realm_allowed[8]  = is_realm_allowed(8);   // Console Access
				$realm_allowed[7]  = is_realm_allowed(7);   // View Graphs
				$realm_allowed[25] = is_realm_allowed(25);  // Realtime Graphs
				$realm_allowed[3]  = is_realm_allowed(3);   // Sites/Devices/Data
				$realm_allowed[5]  = is_realm_allowed(5);   // Graphs
				$realm_allowed[4]  = is_realm_allowed(4);   // Trees
				$realm_allowed[2]  = is_realm_allowed(2);   // Data Input Methods
				$realm_allowed[13] = is_realm_allowed(13);  // Data Queries
				$realm_allowed[10] = is_realm_allowed(10);  // Graph Templates
				$realm_allowed[11] = is_realm_allowed(11);  // Data Templates
				$realm_allowed[12] = is_realm_allowed(12);  // Device Templates
				$realm_allowed[23] = is_realm_allowed(23);  // Automation
				$realm_allowed[15] = is_realm_allowed(15);  // Settings/Utilities
				$realm_allowed[1]  = is_realm_allowed(1);   // Users/Groups
				$realm_allowed[18] = is_realm_allowed(18);  // Log Administration
				$realm_allowed[19] = is_realm_allowed(19);  // Log Viewing
				$realm_allowed[21] = is_realm_allowed(21);  // Reports Administration
				$realm_allowed[22] = is_realm_allowed(22);  // Reports Creation
				$realm_allowed[16] = is_realm_allowed(16);  // Export Templates
				$realm_allowed[17] = is_realm_allowed(17);  // Import Templates
				
				// Console/Dashboard
				if ($realm_allowed[8]) {
					print '<div class="agave-nav-section">';
					print '<div class="agave-nav-header">Dashboard</div>';
					print '<a class="agave-nav-item" href="' . $config['url_path'] . 'index.php">';
					print '<span class="agave-nav-icon">🏠</span>';
					print __('Console') . '</a>';
					print '</div>';
				}

				// Graphs Section
				if ($realm_allowed[7] || $realm_allowed[25]) {
					print '<div class="agave-nav-section">';
					print '<div class="agave-nav-header">Graphs</div>';
					
					if ($realm_allowed[7]) {
						print '<a class="agave-nav-item" href="' . $config['url_path'] . 'graph_view.php">';
						print '<span class="agave-nav-icon">📊</span>';
						print __('View Graphs') . '</a>';
					}
					
					if ($realm_allowed[25]) {
						print '<a class="agave-nav-item" href="' . $config['url_path'] . 'graph_realtime.php">';
						print '<span class="agave-nav-icon">⚡</span>';
						print __('Realtime') . '</a>';
					}
					print '</div>';
				}

				// Management Section
				if ($realm_allowed[3] || $realm_allowed[5] || $realm_allowed[4]) {
					print '<div class="agave-nav-section">';
					print '<div class="agave-nav-header">Management</div>';
					
					if ($realm_allowed[3]) {
						print '<a class="agave-nav-item" href="' . $config['url_path'] . 'host.php">';
						print '<span class="agave-nav-icon">🖥️</span>';
						print __('Devices') . '</a>';
						
						print '<a class="agave-nav-item" href="' . $config['url_path'] . 'sites.php">';
						print '<span class="agave-nav-icon">🏢</span>';
						print __('Sites') . '</a>';
						
						print '<a class="agave-nav-item" href="' . $config['url_path'] . 'data_sources.php">';
						print '<span class="agave-nav-icon">📈</span>';
						print __('Data Sources') . '</a>';
					}
					
					if ($realm_allowed[5]) {
						print '<a class="agave-nav-item" href="' . $config['url_path'] . 'graphs.php">';
						print '<span class="agave-nav-icon">📊</span>';
						print __('Graphs') . '</a>';
					}
					
					if ($realm_allowed[4]) {
						print '<a class="agave-nav-item" href="' . $config['url_path'] . 'tree.php">';
						print '<span class="agave-nav-icon">🌳</span>';
						print __('Trees') . '</a>';
					}
					print '</div>';
				}

				// Templates Section
				if ($realm_allowed[10] || $realm_allowed[11] || $realm_allowed[12]) {
					print '<div class="agave-nav-section">';
					print '<div class="agave-nav-header">Templates</div>';
					
					if ($realm_allowed[12]) {
						print '<a class="agave-nav-item" href="' . $config['url_path'] . 'host_templates.php">';
						print '<span class="agave-nav-icon">🖥️</span>';
						print __('Device') . '</a>';
					}
					
					if ($realm_allowed[10]) {
						print '<a class="agave-nav-item" href="' . $config['url_path'] . 'graph_templates.php">';
						print '<span class="agave-nav-icon">📊</span>';
						print __('Graph') . '</a>';
					}
					
					if ($realm_allowed[11]) {
						print '<a class="agave-nav-item" href="' . $config['url_path'] . 'data_templates.php">';
						print '<span class="agave-nav-icon">📋</span>';
						print __('Data Source') . '</a>';
					}
					print '</div>';
				}

				// Data Collection Section
				if ($realm_allowed[2] || $realm_allowed[13]) {
					print '<div class="agave-nav-section">';
					print '<div class="agave-nav-header">Data Collection</div>';
					
					if ($realm_allowed[2]) {
						print '<a class="agave-nav-item" href="' . $config['url_path'] . 'data_input.php">';
						print '<span class="agave-nav-icon">⬇️</span>';
						print __('Data Input') . '</a>';
					}
					
					if ($realm_allowed[13]) {
						print '<a class="agave-nav-item" href="' . $config['url_path'] . 'data_queries.php">';
						print '<span class="agave-nav-icon">❓</span>';
						print __('Data Queries') . '</a>';
					}
					print '</div>';
				}

				// Automation Section
				if ($realm_allowed[23]) {
					print '<div class="agave-nav-section">';
					print '<div class="agave-nav-header">Automation</div>';
					print '<a class="agave-nav-item" href="' . $config['url_path'] . 'automation_networks.php">';
					print '<span class="agave-nav-icon">🌐</span>';
					print __('Networks') . '</a>';
					
					print '<a class="agave-nav-item" href="' . $config['url_path'] . 'automation_devices.php">';
					print '<span class="agave-nav-icon">🔍</span>';
					print __('Discovery') . '</a>';
					print '</div>';
				}

				// Import/Export Section
				if ($realm_allowed[16] || $realm_allowed[17]) {
					print '<div class="agave-nav-section">';
					print '<div class="agave-nav-header">Import/Export</div>';
					
					if ($realm_allowed[17]) {
						print '<a class="agave-nav-item" href="' . $config['url_path'] . 'templates_import.php">';
						print '<span class="agave-nav-icon">�</span>';
						print __('Import') . '</a>';
					}
					
					if ($realm_allowed[16]) {
						print '<a class="agave-nav-item" href="' . $config['url_path'] . 'templates_export.php">';
						print '<span class="agave-nav-icon">📤</span>';
						print __('Export') . '</a>';
					}
					print '</div>';
				}

				// Administration Section
				if ($realm_allowed[15] || $realm_allowed[1] || $realm_allowed[18] || $realm_allowed[19]) {
					print '<div class="agave-nav-section">';
					print '<div class="agave-nav-header">Administration</div>';
					
					if ($realm_allowed[15]) {
						print '<a class="agave-nav-item" href="' . $config['url_path'] . 'settings.php">';
						print '<span class="agave-nav-icon">⚙️</span>';
						print __('Settings') . '</a>';
						
						print '<a class="agave-nav-item" href="' . $config['url_path'] . 'utilities.php">';
						print '<span class="agave-nav-icon">🔧</span>';
						print __('Utilities') . '</a>';
					}
					
					if ($realm_allowed[1]) {
						print '<a class="agave-nav-item" href="' . $config['url_path'] . 'user_admin.php">';
						print '<span class="agave-nav-icon">👥</span>';
						print __('Users') . '</a>';
					}
					
					if ($realm_allowed[18] || $realm_allowed[19]) {
						print '<a class="agave-nav-item" href="' . $config['url_path'] . 'clog.php">';
						print '<span class="agave-nav-icon">📝</span>';
						print __('Logs') . '</a>';
					}
					print '</div>';
				}

				// Reports Section
				if ($realm_allowed[21] || $realm_allowed[22]) {
					print '<div class="agave-nav-section">';
					print '<div class="agave-nav-header">Reports</div>';
					print '<a class="agave-nav-item" href="' . $config['url_path'] . 'reports_admin.php">';
					print '<span class="agave-nav-icon">📋</span>';
					print __('Reports') . '</a>';
					print '</div>';
				}
				?>
			</div>
			
			<!-- Agave Logo at bottom -->
			<div style="margin-top: auto; padding-top: 2rem; text-align: center;">
				<div class="agave-logo" style="margin: 0 auto; background: var(--primary-color); color: white;">🌵</div>
				<div style="font-size: 0.75rem; color: var(--gray-500); margin-top: 0.5rem;">AgaveCacti v1.0</div>
			</div>
		</nav>

		<!-- Mobile Overlay -->
		<div class="agave-overlay"></div>

		<!-- Main Content -->
		<main class="agave-main" id="main">
			<!-- Breadcrumb -->
			<nav class="agave-breadcrumb">
				<?php echo draw_navigation_text();?>
			</nav>
			
			<!-- Content Area -->
			<div class="agave-content" id="cactiContent">
			
			<?php } else {?>
			<div class="agave-breadcrumb">
				<?php echo draw_navigation_text();?>
			</div>
			<div class="agave-content" id="cactiContent">
			<?php } ?>
