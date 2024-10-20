"use strict";
((typeof self !== 'undefined' ? self : this)["webpackChunkedit_entity_in_layout"] = (typeof self !== 'undefined' ? self : this)["webpackChunkedit_entity_in_layout"] || []).push([[132],{

/***/ 6132:
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

// ESM COMPAT FLAG
__webpack_require__.r(__webpack_exports__);

// EXPORTS
__webpack_require__.d(__webpack_exports__, {
  "default": function() { return /* binding */ OptionsTaxonomy; }
});

;// CONCATENATED MODULE: ./node_modules/babel-loader/lib/index.js??clonedRuleSet-40.use[1]!./node_modules/@vue/vue-loader-v15/lib/loaders/templateLoader.js??ruleSet[1].rules[3]!./node_modules/@vue/vue-loader-v15/lib/index.js??vue-loader-options!../components_bootstrapvuejs/src/components/Ressouces/OptionsTaxonomy.vue?vue&type=template&id=17034ab4
var render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return _c('div', [_c('b-form-group', {
    attrs: {
      "label": _vm.field.label
    }
  }, [_c('b-form-radio-group', {
    attrs: {
      "options": _vm.options,
      "name": _vm.field.name
    },
    on: {
      "change": _vm.input
    },
    model: {
      value: _vm.selected,
      callback: function ($$v) {
        _vm.selected = $$v;
      },
      expression: "selected"
    }
  })], 1)], 1);
};
var staticRenderFns = [];

// EXTERNAL MODULE: ../components_bootstrapvuejs/node_modules/core-js/modules/es.array.push.js
var es_array_push = __webpack_require__(3518);
// EXTERNAL MODULE: ../drupal-vuejs/src/App/jsonApi/termsTaxo.js
var termsTaxo = __webpack_require__(1036);
// EXTERNAL MODULE: ../components_bootstrapvuejs/src/components/fieldsDrupal/loadField.js + 138 modules
var loadField = __webpack_require__(7181);
;// CONCATENATED MODULE: ./node_modules/thread-loader/dist/cjs.js!./node_modules/babel-loader/lib/index.js??clonedRuleSet-40.use[1]!./node_modules/@vue/vue-loader-v15/lib/index.js??vue-loader-options!../components_bootstrapvuejs/src/components/Ressouces/OptionsTaxonomy.vue?vue&type=script&lang=js



/* harmony default export */ var OptionsTaxonomyvue_type_script_lang_js = ({
  name: "OptionsTaxonomy",
  components: {},
  props: {
    field: {
      type: Object,
      required: true
    },
    model: {
      type: [Object, Array],
      required: true
    },
    namespaceStore: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      options: [],
      selected: null
    };
  },
  mounted() {
    this.loadTerms();
    this.selected = this.getValue();
  },
  methods: {
    loadTerms() {
      let vocabulary = this.getFistVocab();
      if (vocabulary && loadField/* default */.A.config) {
        const terms = new termsTaxo/* default */.A(vocabulary, loadField/* default */.A.config);
        terms.get().then(() => {
          this.options = terms.getOptions();
        });
      }
    },
    getFistVocab() {
      if (this.field.definition_settings.handler_settings.target_bundles) {
        const keys = Object.keys(this.field.definition_settings.handler_settings.target_bundles);
        return this.field.definition_settings.handler_settings.target_bundles[keys[0]];
      } else return null;
    },
    getValue() {
      if (this.model[this.field.name] && this.model[this.field.name][0] && this.model[this.field.name][0].target_id) return this.model[this.field.name][0].target_id;
    },
    input(val) {
      const vals = [];
      vals.push({
        target_id: val
      });
      this.$emit("setValue", vals);
    }
  }
});
;// CONCATENATED MODULE: ../components_bootstrapvuejs/src/components/Ressouces/OptionsTaxonomy.vue?vue&type=script&lang=js
 /* harmony default export */ var Ressouces_OptionsTaxonomyvue_type_script_lang_js = (OptionsTaxonomyvue_type_script_lang_js); 
// EXTERNAL MODULE: ./node_modules/@vue/vue-loader-v15/lib/runtime/componentNormalizer.js
var componentNormalizer = __webpack_require__(1656);
;// CONCATENATED MODULE: ../components_bootstrapvuejs/src/components/Ressouces/OptionsTaxonomy.vue





/* normalize component */
;
var component = (0,componentNormalizer/* default */.A)(
  Ressouces_OptionsTaxonomyvue_type_script_lang_js,
  render,
  staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* harmony default export */ var OptionsTaxonomy = (component.exports);

/***/ })

}]);
//# sourceMappingURL=EditEntity.common.132.js.map