"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_Shared_Utility_Form_Select_Regular_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Shared/Utility/Form/Select/Regular.vue?vue&type=script&lang=js":
/*!*****************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Shared/Utility/Form/Select/Regular.vue?vue&type=script&lang=js ***!
  \*****************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! axios */ "./node_modules/axios/lib/axios.js");
/* harmony import */ var _Store_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../Store.js */ "./resources/js/Shared/Utility/Form/Store.js");


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: "RegularSelect",
  emits: ["update:modelValue"],
  props: {
    modelValue: {
      type: String,
      "default": ""
    },
    options: Array,
    validations: Array | Object,
    name: String,
    id: String,
    label: String,
    source: String,
    mount: Boolean,
    watching: {
      type: String,
      "default": null
    }
  },
  computed: {
    watchParentChange: function watchParentChange() {
      if (this.watching) {
        return this.store.toWatchList[this.watching];
      }
    }
  },
  methods: {
    saveToStore: function saveToStore(event) {
      var value = event.target.value;
      this.store.setToWatchList(this.name, value);
      this.$emit("update:modelValue", value);
    }
  },
  watch: {
    watchParentChange: function watchParentChange(newValue) {
      var _this = this;
      this.$emit("update:modelValue", null);
      if (this.source) {
        var targetUrl = "".concat(this.source, "/").concat(newValue);
        axios__WEBPACK_IMPORTED_MODULE_1__["default"].get(targetUrl).then(function (response) {
          if (response.data.data.length == 0) {
            _this.$emit("update:modelValue", null);
          }
          _this.selectOptions = response.data.data;
        })["catch"](function (error) {
          return console.log(error.message);
        });
      }
    }
  },
  data: function data() {
    return {
      selectOptions: this.options,
      store: _Store_js__WEBPACK_IMPORTED_MODULE_0__.store
    };
  },
  mounted: function mounted() {
    var _this2 = this;
    var targetWatchUrl = this.source;
    if (this.watching) {
      var watcherFieldValue, watcherFieldName;
      for (var key in this.$page.props.fields) {
        watcherFieldName = this.$page.props.fields[key].name;
        if (watcherFieldName == this.watching) {
          watcherFieldValue = this.$page.props.fields[key].value;
        }
      }
      targetWatchUrl = "".concat(this.source, "/").concat(watcherFieldValue);
    }
    if (this.mount && this.source) {
      axios__WEBPACK_IMPORTED_MODULE_1__["default"].get(targetWatchUrl).then(function (response) {
        _this2.selectOptions = response.data.data;
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Shared/Utility/Form/Select/Regular.vue?vue&type=template&id=5daff1c5":
/*!*********************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Shared/Utility/Form/Select/Regular.vue?vue&type=template&id=5daff1c5 ***!
  \*********************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = ["for"];
var _hoisted_2 = {
  key: 0,
  "class": "required-asterisk"
};
var _hoisted_3 = ["id", "value"];
var _hoisted_4 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: "",
  disabled: ""
}, "Select", -1 /* HOISTED */);
var _hoisted_5 = ["value", "selected"];
var _hoisted_6 = ["textContent"];
function render(_ctx, _cache, $props, $setup, $data, $options) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": $props.id,
    "class": "form-label"
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($props.label) + " ", 1 /* TEXT */), $props.validations.required ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_2, "*")) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 8 /* PROPS */, _hoisted_1), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", (0,vue__WEBPACK_IMPORTED_MODULE_0__.mergeProps)({
    "class": ["form-select", _ctx.$page.props.errors[$props.name] ? 'is-invalid' : 'valid'],
    id: $props.name,
    value: $props.modelValue
  }, _ctx.$page.props, {
    onInput: _cache[0] || (_cache[0] = function ($event) {
      return $options.saveToStore($event);
    })
  }), [_hoisted_4, ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.selectOptions, function (option) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: option['value'],
      key: $props.name + option['value'],
      selected: option['value'] == $props.modelValue
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(option["label"]), 9 /* TEXT, PROPS */, _hoisted_5);
  }), 128 /* KEYED_FRAGMENT */))], 16 /* FULL_PROPS */, _hoisted_3), _ctx.$page.props.errors[$props.name] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", {
    key: 0,
    "class": "invalid-feedback",
    textContent: (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.$page.props.errors[$props.name])
  }, null, 8 /* PROPS */, _hoisted_6)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)]);
}

/***/ }),

/***/ "./resources/js/Shared/Utility/Form/Store.js":
/*!***************************************************!*\
  !*** ./resources/js/Shared/Utility/Form/Store.js ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "store": () => (/* binding */ store)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var store = (0,vue__WEBPACK_IMPORTED_MODULE_0__.reactive)({
  toWatchList: [],
  setToWatchList: function setToWatchList(key, value) {
    this.toWatchList[key] = value;
  }
});

/***/ }),

/***/ "./resources/js/Shared/Utility/Form/Select/Regular.vue":
/*!*************************************************************!*\
  !*** ./resources/js/Shared/Utility/Form/Select/Regular.vue ***!
  \*************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Regular_vue_vue_type_template_id_5daff1c5__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Regular.vue?vue&type=template&id=5daff1c5 */ "./resources/js/Shared/Utility/Form/Select/Regular.vue?vue&type=template&id=5daff1c5");
/* harmony import */ var _Regular_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Regular.vue?vue&type=script&lang=js */ "./resources/js/Shared/Utility/Form/Select/Regular.vue?vue&type=script&lang=js");
/* harmony import */ var _var_www_html_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_var_www_html_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_Regular_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_Regular_vue_vue_type_template_id_5daff1c5__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/Shared/Utility/Form/Select/Regular.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/Shared/Utility/Form/Select/Regular.vue?vue&type=script&lang=js":
/*!*************************************************************************************!*\
  !*** ./resources/js/Shared/Utility/Form/Select/Regular.vue?vue&type=script&lang=js ***!
  \*************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Regular_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Regular_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Regular.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Shared/Utility/Form/Select/Regular.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/Shared/Utility/Form/Select/Regular.vue?vue&type=template&id=5daff1c5":
/*!*******************************************************************************************!*\
  !*** ./resources/js/Shared/Utility/Form/Select/Regular.vue?vue&type=template&id=5daff1c5 ***!
  \*******************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Regular_vue_vue_type_template_id_5daff1c5__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Regular_vue_vue_type_template_id_5daff1c5__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Regular.vue?vue&type=template&id=5daff1c5 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/Shared/Utility/Form/Select/Regular.vue?vue&type=template&id=5daff1c5");


/***/ })

}]);