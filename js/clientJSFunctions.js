function userAbortedAjaxRequest(xhr) {
	return !xhr.getAllResponseHeaders();
}

$.extend({
	wm: function (obj) {
		var s;
		var e;
		if (typeof (obj.success) == 'function') {
			s = obj.success;
		} else {
			s = function () { };
		}
		if (typeof (obj.error) == 'function') {
			e = obj.error;
		}
		if (obj.data === undefined)
			obj.data = JSON.stringify(obj.jsData);
		var xhr = $.ajax({
			type: "POST",
			url: obj.url,
			dataType: "json",
			data: obj.data,
			contentType: "application/json; charset=utf-8",

			success: function (response) {
				if (response.d.hasOwnProperty('Session') && response.d.Session == false) {
					alert("Your session has expired.  Please refresh the page and try again");
				}
				else {
					if (response.d.hasOwnProperty('Success') && response.d.Success == true) {
						s(response.d);  // actually run the requested function if we've been given the go ahead
					}
					else {
						if (response.d.hasOwnProperty('ErrorMessage')) {
							alert(response.d.ErrorMessage);
							if (e !== undefined) {
								e();
							}
						}

						else {
							if (e !== undefined) {
								e();
							}
							else {
								alert('A problem occurred with your request, please contact your system administrator.');
							}
						}
					}
				}
			},

			error: function (error, userContext, methodName) {
				if (userAbortedAjaxRequest(xhr)) {
					return false;
				}

				if (error !== null && error.status != 0) {
					alert('A problem occurred with your request, please contact your system administrator. [' + error.status + ']');
				}
				return false;
			}
		});
		
		return xhr;
	}
});