/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/metronic/js/pages/features/miscellaneous/session-timeout.js":
/*!*******************************************************************************!*\
  !*** ./resources/metronic/js/pages/features/miscellaneous/session-timeout.js ***!
  \*******************************************************************************/
/***/ (() => {

eval("\n\nvar KTSessionTimeoutDemo = function () {\n  var initDemo = function initDemo() {\n    $.sessionTimeout({\n      title: 'Session Timeout Notification',\n      message: 'Your session is about to expire.',\n      keepAliveUrl: HOST_URL + '/api//session-timeout/keepalive.php',\n      redirUrl: '?p=page_user_lock_1',\n      logoutUrl: '?p=page_user_login_1',\n      warnAfter: 5000,\n      //warn after 5 seconds\n      redirAfter: 15000,\n      //redirect after 15 secons,\n      ignoreUserActivity: true,\n      countdownMessage: 'Redirecting in {timer} seconds.',\n      countdownBar: true\n    });\n  };\n\n  return {\n    //main function to initiate the module\n    init: function init() {\n      initDemo();\n    }\n  };\n}();\n\njQuery(document).ready(function () {\n  KTSessionTimeoutDemo.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvbWV0cm9uaWMvanMvcGFnZXMvZmVhdHVyZXMvbWlzY2VsbGFuZW91cy9zZXNzaW9uLXRpbWVvdXQuanM/NjU5YiJdLCJuYW1lcyI6WyJLVFNlc3Npb25UaW1lb3V0RGVtbyIsImluaXREZW1vIiwiJCIsInNlc3Npb25UaW1lb3V0IiwidGl0bGUiLCJtZXNzYWdlIiwia2VlcEFsaXZlVXJsIiwiSE9TVF9VUkwiLCJyZWRpclVybCIsImxvZ291dFVybCIsIndhcm5BZnRlciIsInJlZGlyQWZ0ZXIiLCJpZ25vcmVVc2VyQWN0aXZpdHkiLCJjb3VudGRvd25NZXNzYWdlIiwiY291bnRkb3duQmFyIiwiaW5pdCIsImpRdWVyeSIsImRvY3VtZW50IiwicmVhZHkiXSwibWFwcGluZ3MiOiJBQUFhOztBQUViLElBQUlBLG9CQUFvQixHQUFHLFlBQVk7QUFDbkMsTUFBSUMsUUFBUSxHQUFHLFNBQVhBLFFBQVcsR0FBWTtBQUN2QkMsS0FBQyxDQUFDQyxjQUFGLENBQWlCO0FBQ2JDLFdBQUssRUFBRSw4QkFETTtBQUViQyxhQUFPLEVBQUUsa0NBRkk7QUFHYkMsa0JBQVksRUFBRUMsUUFBUSxHQUFHLHFDQUhaO0FBSWJDLGNBQVEsRUFBRSxxQkFKRztBQUtiQyxlQUFTLEVBQUUsc0JBTEU7QUFNYkMsZUFBUyxFQUFFLElBTkU7QUFNSTtBQUNqQkMsZ0JBQVUsRUFBRSxLQVBDO0FBT007QUFDbkJDLHdCQUFrQixFQUFFLElBUlA7QUFTYkMsc0JBQWdCLEVBQUUsaUNBVEw7QUFVYkMsa0JBQVksRUFBRTtBQVZELEtBQWpCO0FBWUgsR0FiRDs7QUFlQSxTQUFPO0FBQ0g7QUFDQUMsUUFBSSxFQUFFLGdCQUFZO0FBQ2RkLGNBQVE7QUFDWDtBQUpFLEdBQVA7QUFNSCxDQXRCMEIsRUFBM0I7O0FBd0JBZSxNQUFNLENBQUNDLFFBQUQsQ0FBTixDQUFpQkMsS0FBakIsQ0FBdUIsWUFBVztBQUM5QmxCLHNCQUFvQixDQUFDZSxJQUFyQjtBQUNILENBRkQiLCJmaWxlIjoiLi9yZXNvdXJjZXMvbWV0cm9uaWMvanMvcGFnZXMvZmVhdHVyZXMvbWlzY2VsbGFuZW91cy9zZXNzaW9uLXRpbWVvdXQuanMuanMiLCJzb3VyY2VzQ29udGVudCI6WyJcInVzZSBzdHJpY3RcIjtcclxuXHJcbnZhciBLVFNlc3Npb25UaW1lb3V0RGVtbyA9IGZ1bmN0aW9uICgpIHtcclxuICAgIHZhciBpbml0RGVtbyA9IGZ1bmN0aW9uICgpIHtcclxuICAgICAgICAkLnNlc3Npb25UaW1lb3V0KHtcclxuICAgICAgICAgICAgdGl0bGU6ICdTZXNzaW9uIFRpbWVvdXQgTm90aWZpY2F0aW9uJyxcclxuICAgICAgICAgICAgbWVzc2FnZTogJ1lvdXIgc2Vzc2lvbiBpcyBhYm91dCB0byBleHBpcmUuJyxcclxuICAgICAgICAgICAga2VlcEFsaXZlVXJsOiBIT1NUX1VSTCArICcvYXBpLy9zZXNzaW9uLXRpbWVvdXQva2VlcGFsaXZlLnBocCcsXHJcbiAgICAgICAgICAgIHJlZGlyVXJsOiAnP3A9cGFnZV91c2VyX2xvY2tfMScsXHJcbiAgICAgICAgICAgIGxvZ291dFVybDogJz9wPXBhZ2VfdXNlcl9sb2dpbl8xJyxcclxuICAgICAgICAgICAgd2FybkFmdGVyOiA1MDAwLCAvL3dhcm4gYWZ0ZXIgNSBzZWNvbmRzXHJcbiAgICAgICAgICAgIHJlZGlyQWZ0ZXI6IDE1MDAwLCAvL3JlZGlyZWN0IGFmdGVyIDE1IHNlY29ucyxcclxuICAgICAgICAgICAgaWdub3JlVXNlckFjdGl2aXR5OiB0cnVlLFxyXG4gICAgICAgICAgICBjb3VudGRvd25NZXNzYWdlOiAnUmVkaXJlY3RpbmcgaW4ge3RpbWVyfSBzZWNvbmRzLicsXHJcbiAgICAgICAgICAgIGNvdW50ZG93bkJhcjogdHJ1ZVxyXG4gICAgICAgIH0pO1xyXG4gICAgfVxyXG5cclxuICAgIHJldHVybiB7XHJcbiAgICAgICAgLy9tYWluIGZ1bmN0aW9uIHRvIGluaXRpYXRlIHRoZSBtb2R1bGVcclxuICAgICAgICBpbml0OiBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgICAgIGluaXREZW1vKCk7XHJcbiAgICAgICAgfVxyXG4gICAgfTtcclxufSgpO1xyXG5cclxualF1ZXJ5KGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbigpIHtcclxuICAgIEtUU2Vzc2lvblRpbWVvdXREZW1vLmluaXQoKTtcclxufSk7XHJcbiJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/metronic/js/pages/features/miscellaneous/session-timeout.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/metronic/js/pages/features/miscellaneous/session-timeout.js"]();
/******/ 	
/******/ })()
;