<?php
function userpicker_plus_get_group_member_objects($group_guid) {
	$entities = get_group_members($group_guid, 0);
	$results = array();
	foreach ($entities as $entity) {
		$value = $entity->guid;
		
		$output = elgg_view_list_item($entity, array(
			'use_hover' => false,
			'class' => 'elgg-autocomplete-item',
		));

		$icon = elgg_view_entity_icon($entity, 'tiny', array(
			'use_hover' => false,
		));

		$result = array(
			'type' => 'user',
			'name' => $entity->name,
			'desc' => $entity->username,
			'guid' => $entity->guid,
			'label' => $output,
			'value' => $value,
			'icon' => $icon,
			'url' => $entity->getURL(),
		);
		$results[$entity->name . rand(1, 100)] = $result;
	}
	return json_encode($results);
}