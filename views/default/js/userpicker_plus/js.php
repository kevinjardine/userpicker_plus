elgg.provide('elgg.userpicker_plus');

/**
 * Userpicker_plus initialization
 *
 * @return void
 */
elgg.userpicker_plus.init = function() {
	
	// binding group select action
	$('.userpicker-plus-group-picker-class').change(elgg.userpicker_plus.groupSelectResponse);
	$('.userpicker-plus-remove-all').click(elgg.userpicker_plus.removeAll);
	if (elgg.userpicker_plus.size(elgg.userpicker.userList)) {
		$(".userpicker-plus-remove-all-wrapper").show();
	} else {
		$(".userpicker-plus-remove-all-wrapper").hide();
	}	
};

/**
 * Adds a group's users to the user list
 *
 * elgg.userpicker.userList is defined in the input/userpicker view
 *
 * @param {Object} event
 * @return void
 */
elgg.userpicker_plus.groupSelectResponse = function(event) {
	
	var groupGuid = $(this).val();
	elgg.getJSON('userpicker_plus/group/'+groupGuid, {success: elgg.userpicker_plus.addGroup});
	$("#"+$(this).attr("id")+" option[value='"+groupGuid+"']").remove();
	
	//$(this).removeOption(groupGuid);
	//event.preventDefault();
};

elgg.userpicker_plus.addGroup = function(data) {
	$.each (data, function(i,info) {
		// do not allow users to be added multiple times
		if (!(info.guid in elgg.userpicker.userList)) {
			elgg.userpicker.userList[info.guid] = true;
			var users = $('.elgg-input-user-picker').siblings('.elgg-user-picker-list');
			var li = '<input type="hidden" name="members[]" value="' + info.guid + '" />';
			li += elgg.userpicker.viewUser(info);
			$('<li>').html(li).appendTo(users);
		}
	});
	if (elgg.userpicker_plus.size(elgg.userpicker.userList) > 0) {
		$(".userpicker-plus-remove-all-wrapper").show();
	} else {
		$(".userpicker-plus-remove-all-wrapper").hide();
	}	
}

elgg.userpicker_plus.removeAll = function() {
	$(".elgg-user-picker-list").children().remove();
	elgg.userpicker.userList = {};
	$(".userpicker-plus-remove-all-wrapper").hide();
}

elgg.userpicker_plus.size = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};


elgg.register_hook_handler('init', 'system', elgg.userpicker_plus.init);