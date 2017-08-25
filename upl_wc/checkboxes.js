function wcSelectAll(domainId, all, form) {

	for (var ind = 0; ind < form.elements.length; ind++) {

		var item = form.elements[ind];

		if (domainId.test(item.name)) {

			item.checked = all;

		}

	}

}