<?php

elgg_register_event_handler('init', 'system', 'userpicker_plus_init');

/**
 * Init userpicker_plus plugin.
 */
function userpicker_plus_init() {

	elgg_register_library('elgg:userpicker_plus', elgg_get_plugins_path() . 'userpicker_plus/models/model.php');

	// register the plugin's JavaScript
	$userpicker_plus_js = elgg_get_simplecache_url('js', 'userpicker_plus/js');
	elgg_register_simplecache_view('js/userpicker_plus/js');
	elgg_register_js('elgg.userpicker_plus', $userpicker_plus_js);

	// routing of urls
	elgg_register_page_handler('userpicker_plus', 'userpicker_plus_page_handler');
}

/**
 * Dispatches userpicker_plus pages.
 *
 * @param array $page
 * @return bool
 */
function userpicker_plus_page_handler($page) {

	elgg_load_library('elgg:userpicker_plus');

	$page_type = $page[0];
	switch ($page_type) {
		case 'group':
			$group_guid = $page[1];
			echo userpicker_plus_get_group_member_objects($group_guid);
			break;
		case 'group_picker':
			echo elgg_view('input/groups_for_user',
				array(
					'name'=>'group_picker', 
					'id'=>'userpicker-plus-group-picker',
					'class'=>'userpicker-plus-group-picker-class', 
					'user'=>elgg_get_logged_in_user_entity(),
				)
			);
			break;
		default:
			return FALSE;
			break;
	}
	return TRUE;
}
