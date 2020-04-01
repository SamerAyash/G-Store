(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[0],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/requestsTable.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/requestsTable.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  name: "requestsTable",
  data: function data() {
    return {
      requests: [],
      pagination: [],
      request2: {}
    };
  },
  created: function created() {
    this.fetchRequests();
  },
  methods: {
    fetchRequests: function fetchRequests(page_url) {
      var _this = this;

      page_url = page_url || '/api/admin/requests';
      axios.get(page_url).then(function (res) {
        _this.requests = res.data;

        _this.makePagination(res);
      })["catch"](function (err) {
        return console.log(err);
      });
    },
    makePagination: function makePagination(res) {
      var pagination = {
        current_page: res.current_page,
        last_page: res.last_page,
        total: res.total,
        next_page_url: res.next_page_url,
        prev_page_url: res.prev_page_url
      };
      this.pagination = pagination;
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/requestsTable.vue?vue&type=template&id=cf5085a2&scoped=true&":
/*!****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/requestsTable.vue?vue&type=template&id=cf5085a2&scoped=true& ***!
  \****************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("table", { staticClass: "table table-responsive" }, [
    _vm._m(0),
    _vm._v(" "),
    _c(
      "tbody",
      _vm._l(_vm.requests, function(request) {
        return _c("tr", { key: _vm.requests.id }, [
          _c("td"),
          _vm._v(" "),
          _c("td", [_vm._v(_vm._s(request.email))]),
          _vm._v(" "),
          _c("td", [_vm._v(_vm._s(request.description))]),
          _vm._v(" "),
          _c("td", [
            _c(
              "div",
              {
                staticClass: "btn-group mr-2",
                attrs: { role: "group", "aria-label": "First group" }
              },
              [
                _c(
                  "button",
                  {
                    staticClass: "btn btn-primary btn-sm",
                    staticStyle: { width: "67px" }
                  },
                  [_c("b-icon-pencil"), _vm._v("Edit")],
                  1
                ),
                _vm._v(" "),
                _c(
                  "button",
                  {
                    staticClass: "btn btn-danger btn-sm",
                    staticStyle: { width: "80px" },
                    attrs: {
                      "data-toggle": "modal",
                      "data-target": "#deleteModal"
                    },
                    on: {
                      click: function($event) {
                        _vm.request2 = request
                      }
                    }
                  },
                  [_c("b-icon-trash"), _vm._v("Delete")],
                  1
                )
              ]
            )
          ]),
          _vm._v(" "),
          _c("td", [_vm._v(_vm._s(request.created_at))]),
          _vm._v(" "),
          _c("td", [_vm._v(_vm._s(request.updated_at))])
        ])
      }),
      0
    )
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", [
      _c("tr", [
        _c("th", { attrs: { scope: "col" } }, [_vm._v("#")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Email")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Description")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Action")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Created at")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Updated at")])
      ])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/requestsTable.vue":
/*!***************************************************!*\
  !*** ./resources/js/components/requestsTable.vue ***!
  \***************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _requestsTable_vue_vue_type_template_id_cf5085a2_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./requestsTable.vue?vue&type=template&id=cf5085a2&scoped=true& */ "./resources/js/components/requestsTable.vue?vue&type=template&id=cf5085a2&scoped=true&");
/* harmony import */ var _requestsTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./requestsTable.vue?vue&type=script&lang=js& */ "./resources/js/components/requestsTable.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _requestsTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _requestsTable_vue_vue_type_template_id_cf5085a2_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _requestsTable_vue_vue_type_template_id_cf5085a2_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "cf5085a2",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/requestsTable.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/requestsTable.vue?vue&type=script&lang=js&":
/*!****************************************************************************!*\
  !*** ./resources/js/components/requestsTable.vue?vue&type=script&lang=js& ***!
  \****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_requestsTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./requestsTable.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/requestsTable.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_requestsTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/requestsTable.vue?vue&type=template&id=cf5085a2&scoped=true&":
/*!**********************************************************************************************!*\
  !*** ./resources/js/components/requestsTable.vue?vue&type=template&id=cf5085a2&scoped=true& ***!
  \**********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_requestsTable_vue_vue_type_template_id_cf5085a2_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./requestsTable.vue?vue&type=template&id=cf5085a2&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/requestsTable.vue?vue&type=template&id=cf5085a2&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_requestsTable_vue_vue_type_template_id_cf5085a2_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_requestsTable_vue_vue_type_template_id_cf5085a2_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);