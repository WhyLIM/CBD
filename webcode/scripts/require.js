(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
if ('undefined' === typeof define) {
	(function() {
		var defs = {},
			resolved = {};

		define = function(id, deps, factory) {
			if (defs[id]) {
				throw new Error('Duplicate definition for ' + id);
			}
			defs[id] = [deps, factory];
		}

		define.amd = {
			bundle: true, // this implementation works only with bundled amd modules
			dynamic: false, // does not support dynamic or async loading
		};

		require = function(id) {
			if (!resolved[id]) {
				if (!defs[id]) {
					throw new Error('No definition for ' + id);
				}
				var deps = defs[id][0];
				var factory = defs[id][1];
				var args = deps.map(require);
				resolved[id] = factory.apply(null, args);
				delete defs[id];
			}
			return resolved[id];
		}
	})();
}

},{}]},{},[1]);
