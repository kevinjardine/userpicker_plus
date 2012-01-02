<?php
$user = $vars['user'];
$groups = $user->getGroups('',0);
$options_values = array(0=>elgg_echo('userpicker_plus:add_everyone_from_a_group'));
if ($groups) {
	foreach ($groups as $group) {
		$n = $group->getMembers(0,0,TRUE);
		$group_string = elgg_echo('userpicker_plus:group_string',array($n,$group->name));
		$options_values[$group->guid] = $group_string;
	}
	$vars['options_values'] = $options_values;
	echo elgg_view('input/dropdown',$vars);
}
