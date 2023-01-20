(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[31],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/Settings.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/Settings.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _opt_lampp_htdocs_matar_admin_node_modules_babel_runtime_helpers_esm_asyncToGenerator_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./node_modules/@babel/runtime/helpers/esm/asyncToGenerator.js */ "./node_modules/@babel/runtime/helpers/esm/asyncToGenerator.js");
/* harmony import */ var core_js_modules_es_function_name_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.function.name.js */ "./node_modules/core-js/modules/es.function.name.js");
/* harmony import */ var core_js_modules_es_function_name_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_function_name_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_json_stringify_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.json.stringify.js */ "./node_modules/core-js/modules/es.json.stringify.js");
/* harmony import */ var core_js_modules_es_json_stringify_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_json_stringify_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var bootstrap_vue__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! bootstrap-vue */ "./node_modules/bootstrap-vue/esm/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_5__);




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
  components: {
    BBadge: bootstrap_vue__WEBPACK_IMPORTED_MODULE_4__["BBadge"],
    BFormGroup: bootstrap_vue__WEBPACK_IMPORTED_MODULE_4__["BFormGroup"],
    BFormInput: bootstrap_vue__WEBPACK_IMPORTED_MODULE_4__["BFormInput"],
    BFormSelect: bootstrap_vue__WEBPACK_IMPORTED_MODULE_4__["BFormSelect"],
    BTabs: bootstrap_vue__WEBPACK_IMPORTED_MODULE_4__["BTabs"],
    BTab: bootstrap_vue__WEBPACK_IMPORTED_MODULE_4__["BTab"],
    BCardText: bootstrap_vue__WEBPACK_IMPORTED_MODULE_4__["BCardText"],
    BForm: bootstrap_vue__WEBPACK_IMPORTED_MODULE_4__["BForm"],
    BFormFile: bootstrap_vue__WEBPACK_IMPORTED_MODULE_4__["BFormFile"],
    BButton: bootstrap_vue__WEBPACK_IMPORTED_MODULE_4__["BButton"],
    BListGroup: bootstrap_vue__WEBPACK_IMPORTED_MODULE_4__["BListGroup"],
    BListGroupItem: bootstrap_vue__WEBPACK_IMPORTED_MODULE_4__["BListGroupItem"],
    BImg: bootstrap_vue__WEBPACK_IMPORTED_MODULE_4__["BImg"]
  },
  data: function data() {
    return {
      countries: [],
      sattelite_link: "",
      affiliate_mode: null,
      country: {
        name: "",
        media: ""
      }
    };
  },
  mounted: function mounted() {
    var _this = this;

    return Object(_opt_lampp_htdocs_matar_admin_node_modules_babel_runtime_helpers_esm_asyncToGenerator_js__WEBPACK_IMPORTED_MODULE_0__["default"])( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_3___default.a.mark(function _callee() {
      var countries;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_3___default.a.wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              _context.prev = 0;
              _context.next = 3;
              return axios__WEBPACK_IMPORTED_MODULE_5___default.a.get("/api/countries");

            case 3:
              countries = _context.sent;
              _this.countries = countries.data;
              _context.next = 10;
              break;

            case 7:
              _context.prev = 7;
              _context.t0 = _context["catch"](0);
              alert("حدث خطأ ما");

            case 10:
            case "end":
              return _context.stop();
          }
        }
      }, _callee, null, [[0, 7]]);
    }))();
  },
  methods: {
    addCountry: function addCountry() {
      var data = new FormData();
      data.append("media", this.country.media, this.country.media.name);
      var details = JSON.stringify({
        name: this.country.name
      });
      data.append("data", details);
      var config = {
        headers: {
          "content-type": "multipart/form-data",
          token: JSON.parse(localStorage.getItem("MatarAdmin")).token
        }
      };
      axios__WEBPACK_IMPORTED_MODULE_5___default.a.post("/api/admin/add-countries", data, config).then(function (result) {
        alert("تم اضافة الدولة"), location.reload();
      })["catch"](function (err) {
        alert("حدث خطأ ما");
      });
    },
    deleteCountry: function deleteCountry(id) {
      var confirm = window.confirm("هل انت متأكد من اجراء هذه العملية ؟");

      if (confirm) {
        axios__WEBPACK_IMPORTED_MODULE_5___default.a.post("/api/admin/delete-countries", {
          id: id
        }, {
          headers: {
            token: JSON.parse(localStorage.getItem("MatarAdmin")).token
          }
        }).then(function (result) {
          alert("تم حذف الدولة"), location.reload();
        })["catch"](function (err) {
          alert("حدث خطأ ما");
        });
      }
    },
    updateSattelite: function updateSattelite() {
      var confirm = window.confirm("هل انت متأكد من اجراء هذه العملية ؟");

      if (confirm) {
        axios__WEBPACK_IMPORTED_MODULE_5___default.a.post("/api/admin/system-settings/satellite", {
          satellite_link: this.sattelite_link
        }, {
          headers: {
            token: JSON.parse(localStorage.getItem("MatarAdmin")).token
          }
        }).then(function (result) {
          alert("تم تعديل صور الاقمار الصناعية");
        })["catch"](function (err) {
          alert("حدث خطأ ما");
        });
      }
    },
    updateAffiliate: function updateAffiliate() {
      var confirm = window.confirm("هل انت متأكد من اجراء هذه العملية ؟");

      if (confirm) {
        axios__WEBPACK_IMPORTED_MODULE_5___default.a.post("/api/admin/system-settings/affiliate", {
          affiliate_mode: this.affiliate_mode
        }, {
          headers: {
            token: JSON.parse(localStorage.getItem("MatarAdmin")).token
          }
        }).then(function (result) {
          alert("تم تعديل وضع نظام التسويق"), location.reload();
        })["catch"](function (err) {
          alert("حدث خطأ ما");
        });
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/Settings.vue?vue&type=template&id=3663d5cd&":
/*!**********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/Settings.vue?vue&type=template&id=3663d5cd& ***!
  \**********************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function () {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c(
        "b-tabs",
        { attrs: { "content-class": "pt-1", fill: "" } },
        [
          _c(
            "b-tab",
            { attrs: { title: "الدول" } },
            [
              _c(
                "b-card-text",
                [
                  _c(
                    "b-form",
                    {
                      on: {
                        submit: function ($event) {
                          $event.preventDefault()
                          return _vm.addCountry.apply(null, arguments)
                        },
                      },
                    },
                    [
                      _c(
                        "b-form-group",
                        { attrs: { label: "الدولة", "label-for": "country" } },
                        [
                          _c("b-form-input", {
                            attrs: { id: "country" },
                            model: {
                              value: _vm.country.name,
                              callback: function ($$v) {
                                _vm.$set(_vm.country, "name", $$v)
                              },
                              expression: "country.name",
                            },
                          }),
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "b-form-group",
                        { attrs: { label: "علم الدولة", "label-for": "icon" } },
                        [
                          _c("b-form-file", {
                            attrs: { id: "icon", accept: "image/png" },
                            model: {
                              value: _vm.country.media,
                              callback: function ($$v) {
                                _vm.$set(_vm.country, "media", $$v)
                              },
                              expression: "country.media",
                            },
                          }),
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "b-button",
                        { attrs: { type: "submit", variant: "success" } },
                        [_vm._v("اضافة")]
                      ),
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c("hr"),
                  _vm._v(" "),
                  _c("br"),
                  _vm._v(" "),
                  _c("h4", [_vm._v("الدول المضافة")]),
                  _vm._v(" "),
                  _c("br"),
                  _vm._v(" "),
                  _c(
                    "b-list-group",
                    _vm._l(_vm.countries, function (country) {
                      return _c(
                        "b-list-group-item",
                        {
                          key: country.id,
                          staticStyle: {
                            display: "flex",
                            "align-items": "center",
                          },
                        },
                        [
                          _c("b-img", {
                            staticStyle: {
                              "max-width": "25px",
                              "object-fit": "contain",
                            },
                            attrs: {
                              src: "/storage/countries/" + country.icon,
                            },
                          }),
                          _vm._v(" "),
                          _c("span", [_vm._v(_vm._s(country.country))]),
                          _vm._v(" "),
                          _c(
                            "b-button",
                            {
                              staticClass: "btn-icon rounded-circle",
                              staticStyle: {
                                "margin-right": "auto",
                                display: "block",
                              },
                              attrs: { variant: "flat-danger", size: "sm" },
                              on: {
                                click: function ($event) {
                                  return _vm.deleteCountry(country.id)
                                },
                              },
                            },
                            [
                              _c("feather-icon", {
                                attrs: { icon: "XIcon", size: "12" },
                              }),
                            ],
                            1
                          ),
                        ],
                        1
                      )
                    }),
                    1
                  ),
                ],
                1
              ),
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "b-tab",
            { attrs: { title: "صور الاقمار الصناعية" } },
            [
              _c(
                "b-card-text",
                [
                  _c(
                    "b-form",
                    {
                      on: {
                        submit: function ($event) {
                          $event.preventDefault()
                          return _vm.updateSattelite.apply(null, arguments)
                        },
                      },
                    },
                    [
                      _c(
                        "b-form-group",
                        {
                          attrs: {
                            label: "رابط الموقع",
                            "label-for": "website",
                          },
                        },
                        [
                          _c("b-form-input", {
                            attrs: {
                              id: "website",
                              placeholder: "رابط الموقع المطلوب عرضه",
                            },
                            model: {
                              value: _vm.sattelite_link,
                              callback: function ($$v) {
                                _vm.sattelite_link = $$v
                              },
                              expression: "sattelite_link",
                            },
                          }),
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "b-button",
                        {
                          staticClass: "w-100",
                          attrs: { type: "submit", variant: "success" },
                        },
                        [
                          _vm._v(
                            "\n                        تعديل\n                    "
                          ),
                        ]
                      ),
                    ],
                    1
                  ),
                ],
                1
              ),
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "b-tab",
            { attrs: { title: "نظام التسويق" } },
            [
              _c(
                "b-card-text",
                [
                  _c(
                    "b-form",
                    {
                      on: {
                        submit: function ($event) {
                          $event.preventDefault()
                          return _vm.updateAffiliate.apply(null, arguments)
                        },
                      },
                    },
                    [
                      _c(
                        "b-form-group",
                        {
                          attrs: {
                            label: "نظام التسويق",
                            "label-for": "affiliate",
                          },
                        },
                        [
                          _c(
                            "b-form-select",
                            {
                              attrs: { id: "affiliate" },
                              model: {
                                value: _vm.affiliate_mode,
                                callback: function ($$v) {
                                  _vm.affiliate_mode = $$v
                                },
                                expression: "affiliate_mode",
                              },
                            },
                            [
                              _c("option", { attrs: { value: "1" } }, [
                                _vm._v("مُفعل"),
                              ]),
                              _vm._v(" "),
                              _c("option", { attrs: { value: "0" } }, [
                                _vm._v("مُعطل"),
                              ]),
                            ]
                          ),
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "b-button",
                        {
                          staticClass: "w-100",
                          attrs: { type: "submit", variant: "success" },
                        },
                        [
                          _vm._v(
                            "\n                        تعديل\n                    "
                          ),
                        ]
                      ),
                    ],
                    1
                  ),
                ],
                1
              ),
            ],
            1
          ),
        ],
        1
      ),
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/src/views/Settings.vue":
/*!*********************************************!*\
  !*** ./resources/js/src/views/Settings.vue ***!
  \*********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Settings_vue_vue_type_template_id_3663d5cd___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Settings.vue?vue&type=template&id=3663d5cd& */ "./resources/js/src/views/Settings.vue?vue&type=template&id=3663d5cd&");
/* harmony import */ var _Settings_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Settings.vue?vue&type=script&lang=js& */ "./resources/js/src/views/Settings.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Settings_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Settings_vue_vue_type_template_id_3663d5cd___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Settings_vue_vue_type_template_id_3663d5cd___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/src/views/Settings.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/src/views/Settings.vue?vue&type=script&lang=js&":
/*!**********************************************************************!*\
  !*** ./resources/js/src/views/Settings.vue?vue&type=script&lang=js& ***!
  \**********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Settings_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./Settings.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/Settings.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Settings_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/src/views/Settings.vue?vue&type=template&id=3663d5cd&":
/*!****************************************************************************!*\
  !*** ./resources/js/src/views/Settings.vue?vue&type=template&id=3663d5cd& ***!
  \****************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Settings_vue_vue_type_template_id_3663d5cd___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./Settings.vue?vue&type=template&id=3663d5cd& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/Settings.vue?vue&type=template&id=3663d5cd&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Settings_vue_vue_type_template_id_3663d5cd___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Settings_vue_vue_type_template_id_3663d5cd___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);