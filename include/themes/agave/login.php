<?php
/*
 +-------------------------------------------------------------------------+
 | Copyright (C) 2004-2024 The Cacti Group                                 |
 +-------------------------------------------------------------------------+
 | AgaveCacti Modern Login Page                                            |
 +-------------------------------------------------------------------------+
*/

// Modern login page for Agave theme
?>
<!DOCTYPE html>
<html lang="<?php print CACTI_LOCALE; ?>" class="agave-login-theme">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php print __('Login - AgaveCacti'); ?></title>
	<link href="<?php print $config['url_path']; ?>include/themes/agave/main.css" type="text/css" rel="stylesheet">
	<meta name="theme-color" content="#2563eb">
	<style>
		/* Modern login page styles */
		.agave-login-theme {
			height: 100vh;
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			display: flex;
			align-items: center;
			justify-content: center;
			font-family: var(--font-family-sans);
		}

		.agave-login-container {
			background: white;
			padding: 2rem;
			border-radius: 1rem;
			box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
			width: 100%;
			max-width: 400px;
			margin: 1rem;
		}

		.agave-login-header {
			text-align: center;
			margin-bottom: 2rem;
		}

		.agave-login-logo {
			font-size: 4rem;
			margin-bottom: 1rem;
		}

		.agave-login-title {
			font-size: 1.875rem;
			font-weight: 700;
			color: var(--gray-900);
			margin: 0 0 0.5rem 0;
		}

		.agave-login-subtitle {
			color: var(--gray-600);
			margin: 0;
		}

		.agave-login-form {
			display: flex;
			flex-direction: column;
			gap: 1.5rem;
		}

		.agave-login-field {
			display: flex;
			flex-direction: column;
			gap: 0.5rem;
		}

		.agave-login-label {
			font-weight: 600;
			color: var(--gray-700);
			font-size: 0.875rem;
		}

		.agave-login-input {
			padding: 0.75rem 1rem;
			border: 2px solid var(--gray-200);
			border-radius: 0.5rem;
			font-size: 1rem;
			transition: border-color 0.2s, box-shadow 0.2s;
		}

		.agave-login-input:focus {
			outline: none;
			border-color: var(--primary-color);
			box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
		}

		.agave-login-button {
			background: var(--primary-color);
			color: white;
			padding: 0.75rem 1rem;
			border: none;
			border-radius: 0.5rem;
			font-size: 1rem;
			font-weight: 600;
			cursor: pointer;
			transition: background-color 0.2s;
		}

		.agave-login-button:hover {
			background: var(--primary-dark);
		}

		.agave-login-error {
			background: rgba(220, 38, 38, 0.1);
			color: var(--error-color);
			padding: 1rem;
			border-radius: 0.5rem;
			border: 1px solid rgba(220, 38, 38, 0.2);
			margin-bottom: 1rem;
			font-size: 0.875rem;
		}

		.agave-login-checkbox {
			display: flex;
			align-items: center;
			gap: 0.5rem;
		}

		.agave-login-checkbox input {
			margin: 0;
		}

		.agave-login-footer {
			text-align: center;
			margin-top: 2rem;
			padding-top: 1.5rem;
			border-top: 1px solid var(--gray-200);
			color: var(--gray-500);
			font-size: 0.875rem;
		}

		/* Responsive */
		@media (max-width: 480px) {
			.agave-login-container {
				margin: 0.5rem;
				padding: 1.5rem;
			}
		}

		/* Animation */
		.agave-login-container {
			animation: slideIn 0.3s ease-out;
		}

		@keyframes slideIn {
			from {
				opacity: 0;
				transform: translateY(-20px);
			}
			to {
				opacity: 1;
				transform: translateY(0);
			}
		}
	</style>
</head>
<body>
	<div class="agave-login-container">
		<div class="agave-login-header">
			<div class="agave-login-logo">🌵</div>
			<h1 class="agave-login-title">AgaveCacti</h1>
			<p class="agave-login-subtitle">Network Monitoring Redefined</p>
		</div>

		<?php if ($error) { ?>
		<div class="agave-login-error">
			<?php print $error_msg; ?>
		</div>
		<?php } ?>

		<form class="agave-login-form" id="login" name="login" method="post" action="<?php print get_current_page(); ?>">
			<input type="hidden" name="action" value="login">
			
			<?php api_plugin_hook_function('login_before', array(
				'error'        => $error,
				'error_msg'    => $error_msg,
				'username'     => $username,
				'user_enabled' => $user_enabled,
				'action'       => get_nfilter_request_var('action')
			)); ?>

			<div class="agave-login-field">
				<label for="login_username" class="agave-login-label">Username</label>
				<input type="text" 
					   class="agave-login-input" 
					   id="login_username" 
					   name="login_username" 
					   value="<?php print html_escape($username); ?>" 
					   placeholder="Enter your username"
					   required>
			</div>

			<div class="agave-login-field">
				<label for="login_password" class="agave-login-label">Password</label>
				<input type="password" 
					   class="agave-login-input" 
					   id="login_password" 
					   name="login_password" 
					   placeholder="Enter your password"
					   autocomplete="current-password"
					   required>
			</div>

			<?php if (read_config_option('auth_method') == '3' || read_config_option('auth_method') == '4') {
				if (read_config_option('auth_method') == '3') {
					$realms = api_plugin_hook_function('login_realms', array(
						'1' => array('name' => __('Local'), 'selected' => false),
						'2' => array('name' => __('LDAP'), 'selected' => true)
					));
				} else {
					$realms = get_auth_realms(true);
				}

				if ($frv_realm && array_key_exists($frv_realm, $realms)) {
					foreach ($realms as $key => $realm) {
						$realms[$key]['selected'] = ($frv_realm == $key);
					}
				}
			?>
			<div class="agave-login-field">
				<label for="realm" class="agave-login-label">Authentication Realm</label>
				<select id="realm" name="realm" class="agave-login-input">
					<?php if (cacti_sizeof($realms)) {
						foreach($realms as $index => $realm) {
							print '<option value="' . $index . '"' . ($realm['selected'] ? ' selected="selected"':'') . '>' . html_escape($realm['name']) . "</option>\n";
						}
					} ?>
				</select>
			</div>
			<?php } ?>

			<?php if (read_config_option('auth_cache_enabled') == 'on') { ?>
			<div class="agave-login-checkbox">
				<input type="checkbox" 
					   id="remember_me" 
					   name="remember_me" 
					   <?php print (isset($_COOKIE['cacti_remembers']) || !isempty_request_var('remember_me') ? 'checked':''); ?>>
				<label for="remember_me" class="agave-login-label" style="margin: 0;">Keep me signed in</label>
			</div>
			<?php } ?>

			<button type="submit" class="agave-login-button">
				Sign In
			</button>

			<?php api_plugin_hook('login_after'); ?>
		</form>

		<div class="agave-login-footer">
			<div>AgaveCacti v<?php print $version; ?></div>
			<div>Modern Network Monitoring</div>
		</div>
	</div>

	<script>
		// Auto-focus first empty field
		document.addEventListener('DOMContentLoaded', function() {
			const username = document.getElementById('login_username');
			const password = document.getElementById('login_password');
			
			if (!username.value) {
				username.focus();
			} else {
				password.focus();
			}
			
			// Form validation
			const form = document.getElementById('login');
			form.addEventListener('submit', function(e) {
				const user = username.value.trim();
				const pass = password.value;
				
				if (!user || !pass) {
					e.preventDefault();
					alert('Please enter both username and password');
				}
			});
		});
	</script>
</body>
</html>
