






if (typeof usi_commons === 'undefined') {
	usi_commons = {
		log:function(msg) {
			
		},
		log_error: function(msg) {
			
		},
		log_success: function(msg) {
			
		},
		dir:function(obj) {
			
		},
		log_styles: {
			error: 'color: red; font-weight: bold;',
			success: 'color: green; font-weight: bold;'
		},
		domain: "//www.upsellit.com",
		is_mobile: (/iphone|ipod|ipad|android|blackberry|mobi/i).test(navigator.userAgent.toLowerCase()),
		gup:function(name) {
			name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
			var regexS = "[\\?&]" + name + "=([^&#]*)";
			var regex = new RegExp(regexS);
			var results = regex.exec(window.location.href);
			if (results == null) return "";
			else return results[1];
		},
		load_script:function(source) {
			var docHead = document.getElementsByTagName("head")[0];
			if (top.location != location) docHead = parent.document.getElementsByTagName("head")[0];
			var newScript = document.createElement('script');
			newScript.type = 'text/javascript';
			newScript.src = source;
			docHead.appendChild(newScript);
		},
		load_display:function(usiQS, usiSiteID, usiKey) {
			usiKey = usiKey || "";
			this.load_script(this.domain + "/launch.jsp?qs=" + usiQS + "&siteID=" + usiSiteID + "&keys=" + usiKey);
		},
		load_facebook:function(usiQS, usiSiteID, usiKey) {
			usiKey = usiKey || "";
			this.load_script(this.domain + "/hound/facebook.jsp?qs=" + usiQS + "&siteID=" + usiSiteID + "&keys=" + usiKey);
		},
		load_view:function(usiHash, usiSiteID, usiKey) {
			if (location.href.indexOf("usi_force") != -1 || (usi_cookies.get("usi_launched") == null && usi_cookies.get("usi_launched"+usiSiteID) == null)) {
				usiKey = usiKey || "";
				var date = "";
				if (this.gup("usi_date") != "") date = "&usi_date=" + this.gup("usi_date");
				this.load_script(this.domain + "/view.jsp?hash=" + usiHash + "&siteID=" + usiSiteID + "&keys=" + usiKey + date);
			}
		},
		load_precapture:function(usiQS, usiSiteID) {
			this.load_script(this.domain + "/hound/monitor.jsp?qs=" + usiQS + "&siteID=" + usiSiteID + "&domain=" + encodeURIComponent(this.domain));
		},
		send_prod_rec:function(siteID, info, real_time) {
			try {
				if (!!siteID && !!info.name && !!info.link && !!info.pid && !!info.price && !!info.image) {
					var queryString = siteID + "|" + info.name + "|" + info.link + "|" + info.pid + "|" + info.price + "|" + info.image;
					if (info.extra) queryString += "|" + info.extra;
					var filetype = real_time ? "jsp" : "js";
					this.load_script(this.domain + "/active/pv2." + filetype + "?" + encodeURIComponent(queryString));
				}
			} catch (e) {}
		}
	};
}


if (typeof usi_cookies === 'undefined') {
	usi_cookies = {
		expire_time: {
			minute: 60,
			hour: 60 * 60,
			day: 60 * 60 * 24,
			week: 60 * 60 * 24 * 7,
			two_weeks: 60 * 60 * 24 * 14,
			month: 60 * 60 * 24 * 30,
			year: 60 * 60 * 24 * 365,
			never: 60 * 60 * 24 * 365 * 10
		},
		update_window_name: function (name, value, exp_seconds) {
			try {
				var usi_exp_timestamp = -1;
				if (exp_seconds != -1) {
					var date = new Date();
					date.setTime(date.getTime() + (exp_seconds * 1000));
					usi_exp_timestamp = date.getTime();
				}
				var usi_win = window.top || window;
				var usi_found = 0;
				if (value != null && value.indexOf("=") != -1) value = value.replace(new RegExp('=', 'g'), 'USIEQLS');
				var usi_allValues = usi_win.name.split(";");
				var usi_newValues = "";
				for (var i = 0; i < usi_allValues.length; i++) {
					var usi_theValue = usi_allValues[i].split("=");
					if (usi_theValue.length == 3) {
						if (usi_theValue[0] == name) {
							usi_theValue[1] = value;
							usi_theValue[2] = usi_exp_timestamp;
							usi_found = 1;
						}
						if (usi_theValue[1] != null && usi_theValue[1] != "null") {
							usi_newValues += usi_theValue[0] + "=" + usi_theValue[1] + "=" + usi_theValue[2] + ";";
						}
					} else if (usi_allValues[i] != "") {
						//Not ours, disregard
						usi_newValues += usi_allValues[i] + ";";
					}
				}
				if (usi_found == 0) {
					//Add to the end
					usi_newValues += name + "=" + value + "=" + usi_exp_timestamp + ";";
				}
				usi_win.name = usi_newValues;
			} catch (e) {
			}
		},
		flush_window_name: function (usi_prefix) {
			try {
				var usi_win = window.top || window;
				var usi_allValues = usi_win.name.split(";");
				var usi_newValues = "";
				for (var i = 0; i < usi_allValues.length; i++) {
					var usi_theValue = usi_allValues[i].split("=");
					if (usi_theValue.length == 3) {
						if (usi_theValue[0].indexOf(usi_prefix) == 0) {
							//Ours, so delete
						} else {
							//Not ours, disregard
							usi_newValues += usi_allValues[i] + ";";
						}
					}
				}
				usi_win.name = usi_newValues;
			} catch (e) {
			}
		},
		get_from_window_name: function (name) {
			try {
				var usi_win = window.top || window;
				var usi_allValues = usi_win.name.split(";");
				for (var i = 0; i < usi_allValues.length; i++) {
					var usi_theValue = usi_allValues[i].split("=");
					if (usi_theValue.length == 3) {
						if (usi_theValue[0] == name) {
							var usi_value = usi_theValue[1];
							if (usi_value.indexOf("USIEQLS") != -1) usi_value = usi_value.replace(new RegExp('USIEQLS', 'g'), '=');
							if (usi_theValue[2] != "-1" && this.datediff(usi_theValue[2]) < 0) {
								//This expired, boo
							} else {
								if (typeof(usi_cookieless) === "undefined") this.create_cookie(usi_theValue[0], usi_value, this.datediff(usi_theValue[2]) / 1000);
								usi_results = [usi_value, usi_theValue[2]];
								return usi_results;
							}
						}
					} else if (usi_theValue.length == 2) {
						if (usi_theValue[0] == name) {
							var usi_value = usi_theValue[1];
							if (usi_value.indexOf("USIEQLS") != -1) usi_value = usi_value.replace(new RegExp('USIEQLS', 'g'), '=');
							usi_results = [usi_value, (new Date()).getTime() + (7 * 24 * 60 * 60 * 1000)];
							return usi_results;
						}
					}
				}
			} catch (e) {
			}
			return null;
		},
		datediff: function (timestamp) {
			return (timestamp - (new Date()).getTime());
		},
		create_cookie: function (name, value, exp_seconds) {
			if (exp_seconds != -1) {
				var date = new Date();
				date.setTime(date.getTime() + (exp_seconds * 1000));
				var expires = "; expires=" + date.toGMTString();
			}
			if (typeof(usi_parent_domain) != "undefined" && document.domain.indexOf(usi_parent_domain) != -1) {
				document.cookie = name + "=" + encodeURIComponent(value) + expires + "; path=/;domain=" + usi_parent_domain + ";";
			} else {
				document.cookie = name + "=" + encodeURIComponent(value) + expires + "; path=/;domain=" + document.domain + ";";
			}
		},
		read_cookie: function (name) {
			var nameEQ = name + "=";
			var ca = document.cookie.split(';');
			for (var i = 0; i < ca.length; i++) {
				var c = ca[i];
				while (c.charAt(0) == ' ') c = c.substring(1, c.length);
				if (c.indexOf(nameEQ) == 0) return decodeURIComponent(c.substring(nameEQ.length, c.length));
			}
			return null;
		},
		del: function (name) {
			this.set(name, null, -100);
		},
		get: function (name) {
			var usi_results = null;
			var usi_value = this.read_cookie(name);
			if (usi_value == null) {
				usi_results = this.get_from_window_name(name);
				if (usi_results != null && usi_results.length > 1) {
					usi_value = decodeURIComponent(usi_results[0]);
				}
			}
			if (usi_value == null) return null;
			return usi_value;
		},
		get_json: function(name) {
			var value = null;
			var cookieValue = usi_cookies.get(name);
			
			if (cookieValue == null) {
				return null;
			}
			try {
				value = JSON.parse(cookieValue);
			}
			catch (err) {
				cookieValue = cookieValue.replace(/\\"/g, '"');
				try {
					value = JSON.parse(JSON.parse(cookieValue));
				}
				catch (err) {
					try {
						value = JSON.parse(cookieValue);
					}
					catch (err2) {
					
					}
				}
			}
			
			return value;
		},
		set: function (name, value, exp_seconds, force_cookie) {
			try {
				value = value.replace(/(\r\n|\n|\r)/gm, "");
			} catch (e) {
			}
			if (typeof(usi_cookieless) === "undefined" || !!force_cookie) this.create_cookie(name, value, exp_seconds);
			if (typeof(usi_windownameless) === "undefined") this.update_window_name(name + "", value + "", exp_seconds);
		},
		set_json: function (name, obj, exp_seconds) {
			var value = JSON.stringify(obj).replace(/^"/, '').replace(/"$/, '');
			usi_cookies.set(name, value, exp_seconds);
		},
		flush: function (usi_prefix) {
			usi_prefix = usi_prefix || "usi_";
			var allCookies = document.cookie.split(";"), i, usiCookie, ourCookie;
			for (i = 0; i < allCookies.length; i++) {
				usiCookie = allCookies[i];
				if (usiCookie.toLowerCase().indexOf(usi_prefix) == 1) {
					ourCookie = usiCookie.split("=")[0];
					this.del(ourCookie);
				}
			}
			this.flush_window_name(usi_prefix);
		},
		print: function () {
			var allCookies = document.cookie.split(";");
			for (var i = 0; i < allCookies.length; i++) {
				var usiCookie = allCookies[i];
				if (usiCookie.trim().toLowerCase().indexOf("usi_") == 0) {
					console.log(usiCookie)
				}
			}
		},
		value_exists: function () {
			var i, usiCookie;
			for (i = 0; i < arguments.length; i++) {
				usiCookie = this.get(arguments[i]);
				if (usiCookie === "" || usiCookie === null) {
					return false;
				}
			}
			return true;
		}
	};
}
if (window.usi_app === undefined) {
	usi_app = {};
	usi_app.main = function () {
		usi_app.url = location.href.toLowerCase();
		usi_app.checkout_page = usi_app.url.indexOf("/ccrz__checkoutnew") != -1;
		usi_app.receipt_page = usi_app.url.indexOf("orderconfirmation") != -1;
		usi_app.device = usi_commons.is_mobile ? "mobile" : "desktop";
		
		
		if (usi_commons.gup("cartID") != "") {
			usi_cookies.set("usi_cart_id", usi_commons.gup("cartID"), 24*60*60);
		}

		if (usi_app.url.indexOf("usi_enable") != -1) {
			usi_cookies.set("usi_enable", "1", usi_cookies.expire_time.day);
		}

		if (usi_app.receipt_page) {
			setTimeout(usi_app.set_pixel, 2000);
			return;
		}

		usi_app.load();
	};
	usi_app.load = function(){
		if (usi_cookies.get("usi_enable") != null) {
			if (usi_cookies.get("usi_cart_id") != null) {
				// Precise Promotion
				usi_commons.load_view("Y40kNRMIoNKMzJ54rlnqOCY", "20394", usi_app.device);
			}
			if (usi_app.checkout_page) {
				usi_commons.load_precapture("bsDVjJOCA41KjROlHT2lLKH", "20356");
			}
		}
	};
	usi_app.set_pixel = function() {
		try {
			USI_orderID = document.getElementsByClassName("order-id")[0].innerHTML;
			USI_orderAmt = document.getElementsByClassName("subtotal")[0].innerHTML.replace(/[^0-9.]+/g,"");
		} catch(e) {}
		if (USI_orderAmt != "") {
			usi_commons.load_script("//www.upsellit.com/active/avid_pixel.jsp")
		} else {
			setTimeout(usi_app.set_pixel, 2000);
		}
	};
	usi_app.ready = function(func){
		if (typeof(document.readyState) != "undefined" && document.readyState === "complete") {
			func();
		} else if (window.addEventListener){
			window.addEventListener('load', func, true);
		} else if (window.attachEvent) {
			window.attachEvent('onload', func);
		} else {
			setTimeout(func, 5000);
		}
	};
	usi_app.ready(function(){
		setTimeout(usi_app.main, 5000);
	});
}

