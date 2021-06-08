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

/***/ "./resources/metronic/js/pages/features/miscellaneous/sticky-panels.js":
/*!*****************************************************************************!*\
  !*** ./resources/metronic/js/pages/features/miscellaneous/sticky-panels.js ***!
  \*****************************************************************************/
/***/ (() => {

eval(" // Class definition\n// Based on:  https://github.com/rgalus/sticky-js\n\nvar KTStickyPanelsDemo = function () {\n  // Private functions\n  // Basic demo\n  var demo1 = function demo1() {\n    if (KTLayoutAsideToggle && KTLayoutAsideToggle.onToggle) {\n      var sticky = new Sticky('.sticky');\n      KTLayoutAsideToggle.onToggle(function () {\n        setTimeout(function () {\n          sticky.update(); // update sticky positions on aside toggle\n        }, 500);\n      });\n    }\n  };\n\n  return {\n    // public functions\n    init: function init() {\n      demo1();\n    }\n  };\n}();\n\njQuery(document).ready(function () {\n  KTStickyPanelsDemo.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvbWV0cm9uaWMvanMvcGFnZXMvZmVhdHVyZXMvbWlzY2VsbGFuZW91cy9zdGlja3ktcGFuZWxzLmpzPzI0ZmMiXSwibmFtZXMiOlsiS1RTdGlja3lQYW5lbHNEZW1vIiwiZGVtbzEiLCJLVExheW91dEFzaWRlVG9nZ2xlIiwib25Ub2dnbGUiLCJzdGlja3kiLCJTdGlja3kiLCJzZXRUaW1lb3V0IiwidXBkYXRlIiwiaW5pdCIsImpRdWVyeSIsImRvY3VtZW50IiwicmVhZHkiXSwibWFwcGluZ3MiOiJDQUNBO0FBQ0E7O0FBRUEsSUFBSUEsa0JBQWtCLEdBQUcsWUFBWTtBQUVqQztBQUVBO0FBQ0EsTUFBSUMsS0FBSyxHQUFHLFNBQVJBLEtBQVEsR0FBWTtBQUNwQixRQUFJQyxtQkFBbUIsSUFBSUEsbUJBQW1CLENBQUNDLFFBQS9DLEVBQXlEO0FBQ3JELFVBQUlDLE1BQU0sR0FBRyxJQUFJQyxNQUFKLENBQVcsU0FBWCxDQUFiO0FBRUFILHlCQUFtQixDQUFDQyxRQUFwQixDQUE2QixZQUFXO0FBQ3BDRyxrQkFBVSxDQUFDLFlBQVc7QUFDbEJGLGdCQUFNLENBQUNHLE1BQVAsR0FEa0IsQ0FDRDtBQUNwQixTQUZTLEVBRVAsR0FGTyxDQUFWO0FBR0gsT0FKRDtBQUtIO0FBQ0osR0FWRDs7QUFZQSxTQUFPO0FBQ0g7QUFDQUMsUUFBSSxFQUFFLGdCQUFXO0FBQ2JQLFdBQUs7QUFDUjtBQUpFLEdBQVA7QUFNSCxDQXZCd0IsRUFBekI7O0FBeUJBUSxNQUFNLENBQUNDLFFBQUQsQ0FBTixDQUFpQkMsS0FBakIsQ0FBdUIsWUFBVztBQUM5Qlgsb0JBQWtCLENBQUNRLElBQW5CO0FBQ0gsQ0FGRCIsImZpbGUiOiIuL3Jlc291cmNlcy9tZXRyb25pYy9qcy9wYWdlcy9mZWF0dXJlcy9taXNjZWxsYW5lb3VzL3N0aWNreS1wYW5lbHMuanMuanMiLCJzb3VyY2VzQ29udGVudCI6WyJcInVzZSBzdHJpY3RcIjtcclxuLy8gQ2xhc3MgZGVmaW5pdGlvblxyXG4vLyBCYXNlZCBvbjogIGh0dHBzOi8vZ2l0aHViLmNvbS9yZ2FsdXMvc3RpY2t5LWpzXHJcblxyXG52YXIgS1RTdGlja3lQYW5lbHNEZW1vID0gZnVuY3Rpb24gKCkge1xyXG5cclxuICAgIC8vIFByaXZhdGUgZnVuY3Rpb25zXHJcblxyXG4gICAgLy8gQmFzaWMgZGVtb1xyXG4gICAgdmFyIGRlbW8xID0gZnVuY3Rpb24gKCkge1xyXG4gICAgICAgIGlmIChLVExheW91dEFzaWRlVG9nZ2xlICYmIEtUTGF5b3V0QXNpZGVUb2dnbGUub25Ub2dnbGUpIHtcclxuICAgICAgICAgICAgdmFyIHN0aWNreSA9IG5ldyBTdGlja3koJy5zdGlja3knKTtcclxuXHJcbiAgICAgICAgICAgIEtUTGF5b3V0QXNpZGVUb2dnbGUub25Ub2dnbGUoZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgICAgICBzZXRUaW1lb3V0KGZ1bmN0aW9uKCkge1xyXG4gICAgICAgICAgICAgICAgICAgIHN0aWNreS51cGRhdGUoKTsgLy8gdXBkYXRlIHN0aWNreSBwb3NpdGlvbnMgb24gYXNpZGUgdG9nZ2xlXHJcbiAgICAgICAgICAgICAgICB9LCA1MDApO1xyXG4gICAgICAgICAgICB9KTtcclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgcmV0dXJuIHtcclxuICAgICAgICAvLyBwdWJsaWMgZnVuY3Rpb25zXHJcbiAgICAgICAgaW5pdDogZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgIGRlbW8xKCk7XHJcbiAgICAgICAgfVxyXG4gICAgfTtcclxufSgpO1xyXG5cclxualF1ZXJ5KGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbigpIHtcclxuICAgIEtUU3RpY2t5UGFuZWxzRGVtby5pbml0KCk7XHJcbn0pO1xyXG4iXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/metronic/js/pages/features/miscellaneous/sticky-panels.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/metronic/js/pages/features/miscellaneous/sticky-panels.js"]();
/******/ 	
/******/ })()
;