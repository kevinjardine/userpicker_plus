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
 * URLs take the form of
 *  All blogs:       blog/all
 *  User's blogs:    blog/owner/<username>
 *  Friends' blog:   blog/friends/<username>
 *  User's archives: blog/archives/<username>/<time_start>/<time_stop>
 *  Blog post:       blog/view/<guid>/<title>
 *  New post:        blog/add/<guid>
 *  Edit post:       blog/edit/<guid>/<revision>
 *  Preview post:    blog/preview/<guid>
 *  Group blog:      blog/group/<guid>/all
 *
 * Title is ignored
 *
 * @todo no archives for all blogs or friends
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
		default:
			return FALSE;
			break;
	}
	return TRUE;
}
