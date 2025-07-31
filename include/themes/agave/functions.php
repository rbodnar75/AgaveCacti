<?php
/*
 +-------------------------------------------------------------------------+
 | Copyright (C) 2004-2024 The Cacti Group                                 |
 +-------------------------------------------------------------------------+
 | AgaveCacti Modern Graph Wrapper Functions                              |
 +-------------------------------------------------------------------------+
*/

/**
 * Modern HTML wrapper for form elements
 */
function agave_form_start($action = '', $method = 'post') {
	return '<form class="agave-form" action="' . $action . '" method="' . $method . '">';
}

function agave_form_end() {
	return '</form>';
}

function agave_input($name, $value = '', $placeholder = '', $type = 'text', $required = false) {
	$req = $required ? 'required' : '';
	return '<div class="agave-form-group">
		<input type="' . $type . '" name="' . $name . '" value="' . html_escape($value) . '" 
			placeholder="' . html_escape($placeholder) . '" class="agave-input" ' . $req . '>
	</div>';
}

function agave_select($name, $options = array(), $selected = '', $placeholder = '') {
	$html = '<div class="agave-form-group">
		<select name="' . $name . '" class="agave-select">';
	
	if ($placeholder) {
		$html .= '<option value="">' . html_escape($placeholder) . '</option>';
	}
	
	foreach ($options as $value => $text) {
		$sel = ($value == $selected) ? 'selected' : '';
		$html .= '<option value="' . html_escape($value) . '" ' . $sel . '>' . html_escape($text) . '</option>';
	}
	
	$html .= '</select></div>';
	return $html;
}

function agave_button($text, $type = 'button', $class = 'primary') {
	return '<button type="' . $type . '" class="agave-btn agave-btn-' . $class . '">' . html_escape($text) . '</button>';
}

/**
 * Modern card wrapper
 */
function agave_card_start($title = '', $class = '') {
	$html = '<div class="agave-card ' . $class . '">';
	if ($title) {
		$html .= '<div class="agave-card-header">
			<h3 class="agave-card-title">' . html_escape($title) . '</h3>
		</div>';
	}
	$html .= '<div class="agave-card-body">';
	return $html;
}

function agave_card_end() {
	return '</div></div>';
}

/**
 * Modern table wrapper
 */
function agave_table_start($headers = array()) {
	$html = '<div class="agave-table-wrapper">
		<table class="agave-table">
			<thead><tr>';
	
	foreach ($headers as $header) {
		$html .= '<th>' . html_escape($header) . '</th>';
	}
	
	$html .= '</tr></thead><tbody>';
	return $html;
}

function agave_table_end() {
	return '</tbody></table></div>';
}

function agave_table_row($cells = array()) {
	$html = '<tr>';
	foreach ($cells as $cell) {
		$html .= '<td>' . $cell . '</td>';
	}
	$html .= '</tr>';
	return $html;
}

/**
 * Status indicators
 */
function agave_status($text, $type = 'info') {
	return '<span class="agave-status agave-status-' . $type . '">' . html_escape($text) . '</span>';
}

/**
 * Modern graph container
 */
function agave_graph_container($graph_html, $title = '') {
	$html = '<div class="agave-graph-container">';
	if ($title) {
		$html .= '<div class="agave-graph-title">' . html_escape($title) . '</div>';
	}
	$html .= $graph_html;
	$html .= '</div>';
	return $html;
}

/**
 * Grid layout helper  
 */
function agave_grid_start($columns = 'repeat(auto-fit, minmax(300px, 1fr))') {
	return '<div style="display: grid; grid-template-columns: ' . $columns . '; gap: var(--spacing-lg);">';
}

function agave_grid_end() {
	return '</div>';
}

/**
 * Responsive navigation breadcrumb
 */
function agave_breadcrumb($items = array()) {
	if (empty($items)) return '';
	
	$html = '<nav class="agave-breadcrumb">';
	$last_key = array_key_last($items);
	
	foreach ($items as $key => $item) {
		if (is_array($item)) {
			$html .= '<a href="' . $item['url'] . '">' . html_escape($item['text']) . '</a>';
		} else {
			$html .= '<span>' . html_escape($item) . '</span>';
		}
		
		if ($key !== $last_key) {
			$html .= ' <span style="color: var(--gray-400);">></span> ';
		}
	}
	
	$html .= '</nav>';
	return $html;
}
