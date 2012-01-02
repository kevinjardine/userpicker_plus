<?php
elgg_load_js('elgg.userpicker_plus');
echo elgg_view('input/userpicker',array('value'=>$vars['value']));
if (elgg_is_logged_in()) {
	echo elgg_view('input/groups_for_user',
		array(
			'name'=>'group_picker', 
			'id'=>'userpicker-plus-group-picker',
			'class'=>'userpicker-plus-group-picker-class', 
			'user'=>elgg_get_logged_in_user_entity(),
		)
	);
}
?>
<div class="userpicker-plus-remove-all-wrapper">
<a href="javascript:void(0);" class="userpicker-plus-remove-all"><?php echo elgg_echo('userpicker_plus:remove_all'); ?></a>
</div>