"use strict";
((typeof self !== 'undefined' ? self : this)["webpackChunkedit_entity_in_layout"] = (typeof self !== 'undefined' ? self : this)["webpackChunkedit_entity_in_layout"] || []).push([[272],{

/***/ 9272:
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

// ESM COMPAT FLAG
__webpack_require__.r(__webpack_exports__);

// EXPORTS
__webpack_require__.d(__webpack_exports__, {
  "default": function() { return /* binding */ MultiSelectTaxo; }
});

;// CONCATENATED MODULE: ./node_modules/babel-loader/lib/index.js??clonedRuleSet-40.use[1]!./node_modules/@vue/vue-loader-v15/lib/loaders/templateLoader.js??ruleSet[1].rules[3]!./node_modules/@vue/vue-loader-v15/lib/index.js??vue-loader-options!../components_bootstrapvuejs/src/components/Ressouces/MultiSelectTaxo.vue?vue&type=template&id=0e3615ce
var render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return _c('ValidationProvider', {
    attrs: {
      "name": _vm.fullname,
      "rules": _vm.getRules()
    },
    scopedSlots: _vm._u([{
      key: "default",
      fn: function (v) {
        return [_c('b-form-group', {
          attrs: {
            "label": _vm.field.label,
            "description": _vm.field.description
          }
        }, [_c('div', {
          staticClass: "autocomplete"
        }, [_c('multiselect', {
          attrs: {
            "options": _vm.options,
            "custom-label": _vm.nameWithLang,
            "taggable": _vm.auto_create,
            "placeholder": "",
            "label": "text",
            "track-by": "text",
            "show-no-results": true,
            "show-labels": false,
            "loading": _vm.isLoading,
            "multiple": _vm.cardinality,
            "allow-empty": true
          },
          on: {
            "search-change": _vm.asyncFind,
            "tag": _vm.createElement
          },
          model: {
            value: _vm.value_computed,
            callback: function ($$v) {
              _vm.value_computed = $$v;
            },
            expression: "value_computed"
          }
        }, [_c('template', {
          slot: "noResult"
        }, [_c('span', {
          staticClass: "option__title"
        }, [_vm._v(" Aucun contenu ne correspond à votre recherche ")])]), _c('template', {
          slot: "placeholder"
        }, [_c('span', {
          staticClass: "option__title"
        }, [_vm._v(" Aucun contenu ... ")])]), _c('template', {
          slot: "noOptions"
        }, [_c('span', {
          staticClass: "option__title"
        }, [_vm._v(" Saisir un ou plusieurs caractères ... ")])])], 2), _c('div', {
          staticClass: "text-danger"
        }, _vm._l(v.errors, function (error, ii) {
          return _c('small', {
            key: ii,
            staticClass: "d-block"
          }, [_vm._v(" " + _vm._s(error) + " ")]);
        }), 0)], 1)])];
      }
    }])
  });
};
var staticRenderFns = [];

// EXTERNAL MODULE: ../components_bootstrapvuejs/node_modules/core-js/modules/es.array.push.js
var es_array_push = __webpack_require__(3518);
// EXTERNAL MODULE: ./node_modules/vee-validate/dist/vee-validate.esm.js
var vee_validate_esm = __webpack_require__(3178);
// EXTERNAL MODULE: ../components_bootstrapvuejs/node_modules/vue-multiselect/dist/vue-multiselect.min.js
var vue_multiselect_min = __webpack_require__(9759);
var vue_multiselect_min_default = /*#__PURE__*/__webpack_require__.n(vue_multiselect_min);
// EXTERNAL MODULE: ../drupal-vuejs/src/App/jsonApi/termsTaxo.js
var termsTaxo = __webpack_require__(1036);
// EXTERNAL MODULE: ../components_bootstrapvuejs/src/components/fieldsDrupal/loadField.js + 138 modules
var loadField = __webpack_require__(7181);
;// CONCATENATED MODULE: ./node_modules/thread-loader/dist/cjs.js!./node_modules/babel-loader/lib/index.js??clonedRuleSet-40.use[1]!./node_modules/@vue/vue-loader-v15/lib/index.js??vue-loader-options!../components_bootstrapvuejs/src/components/Ressouces/MultiSelectTaxo.vue?vue&type=script&lang=js





/* harmony default export */ var MultiSelectTaxovue_type_script_lang_js = ({
  name: "MultiSelectTaxo",
  components: {
    ValidationProvider: vee_validate_esm/* ValidationProvider */.LW,
    Multiselect: (vue_multiselect_min_default())
  },
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
    },
    parentName: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      isLoading: false,
      options: [],
      value_select: null
    };
  },
  computed: {
    fullname() {
      return this.parentName + this.field.name;
    },
    cardinality() {
      if (this.field.cardinality === -1) {
        return true;
      } else {
        return false;
      }
    },
    auto_create() {
      return this.field.definition_settings.handler_settings.auto_create;
    },
    /**
     * @see https://skirtles-code.github.io/vue-examples/patterns/computed-v-model.html
     */
    value_computed: {
      get() {
        return this.value_select;
      },
      set(val) {
        this.updateValue(val);
      }
    }
  },
  // watch: {
  //   /**
  //    * L'objectif est que cette valeur soit un reflet de la valeur contenu dans l'entité.
  //    * @param {*} val
  //    */
  //   value_select(val) {
  //     if (this.cardinality) {
  //       const vals = [];
  //       val.forEach((item) => {
  //         vals.push({ target_id: item.value });
  //       });
  //       this.setValue(vals);
  //     } else {
  //       const vals = [];
  //       if (val) vals.push({ target_id: val.value });
  //       this.setValue(vals);
  //     }
  //   },
  // },
  mounted() {
    this.loadDefaults();
    this.asyncFind("", true);
  },
  methods: {
    /**
     *
     * @param {*} tid
     */
    getTermByTid(tid) {
      this.isLoading = true;
      // Doit etre dynamique.
      let vocabulary = this.getFistVocab();
      const terms = new termsTaxo/* default */.A(vocabulary);
      terms.getValueByTid(tid).then(() => {
        const options = terms.getOptions();
        this.options = options;
        if (this.cardinality) {
          this.value_select = options;
        } else if (options[0]) this.value_select = options[0];
        this.isLoading = false;
      }).catch(() => {
        this.isLoading = false;
      });
    },
    /**
     *
     */
    loadDefaults() {
      this.model[this.field.name].forEach(item => {
        this.getTermByTid(item.target_id);
      });
    },
    /**
     * --
     */
    getFistVocab() {
      if (this.field.definition_settings.handler_settings.target_bundles) {
        const keys = Object.keys(this.field.definition_settings.handler_settings.target_bundles);
        return this.field.definition_settings.handler_settings.target_bundles[keys[0]];
      } else if (this.field.definition_settings.target_type) {
        return this.field.definition_settings.target_type;
      } else return null;
    },
    /**
     *
     * @param {string} newElement
     */
    createElement(newElement) {
      const entity = {
        value: {
          name: newElement,
          vid: this.field.definition_settings.bundle_entity_type_id
        },
        entity_type_id: this.field.definition_settings.target_type
      };
      const action = this.namespaceStore ? this.namespaceStore + "/saveEntity" : "saveEntity";
      this.$store.dispatch(action, entity).then(response => {
        this.value_select.push({
          text: newElement,
          value: response.data.id
        });
        this.updateValue(this.value_select);
      }).catch(e => console.log("error: ", e));
    },
    /**
     *
     * @param {*} search
     */
    asyncFind(search, init = false) {
      if (search.length >= 2 || init) {
        // Doit etre dynamique.
        let vocabulary = this.getFistVocab();
        const terms = new termsTaxo/* default */.A(vocabulary);
        this.isLoading = true;
        terms.getSearch(search).then(() => {
          this.options = terms.getOptions();
          this.isLoading = false;
        });
      }
    },
    nameWithLang({
      text
    }) {
      return `${text}`;
    },
    /**
     *
     * @param {*} vals
     */
    setValue(vals) {
      if (this.namespaceStore) {
        this.$store.dispatch(this.namespaceStore + "/setValue", {
          value: vals,
          fieldName: this.fullname
        });
      } else this.$store.dispatch("setValue", {
        value: vals,
        fieldName: this.fullname
      });
    },
    /**
     *
     */
    getRules() {
      return loadField/* default */.A.getRules(this.field);
    },
    updateValue(val) {
      this.value_select = val;
      if (this.cardinality) {
        const vals = [];
        if (val && val.length) val.forEach(item => {
          vals.push({
            target_id: item.value
          });
        });
        this.setValue(vals);
      } else {
        const vals = [];
        if (val && val.value) vals.push({
          target_id: val.value
        });
        this.setValue(vals);
      }
    }
  }
});
;// CONCATENATED MODULE: ../components_bootstrapvuejs/src/components/Ressouces/MultiSelectTaxo.vue?vue&type=script&lang=js
 /* harmony default export */ var Ressouces_MultiSelectTaxovue_type_script_lang_js = (MultiSelectTaxovue_type_script_lang_js); 
// EXTERNAL MODULE: ./node_modules/@vue/vue-loader-v15/lib/runtime/componentNormalizer.js
var componentNormalizer = __webpack_require__(1656);
;// CONCATENATED MODULE: ../components_bootstrapvuejs/src/components/Ressouces/MultiSelectTaxo.vue





/* normalize component */
;
var component = (0,componentNormalizer/* default */.A)(
  Ressouces_MultiSelectTaxovue_type_script_lang_js,
  render,
  staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* harmony default export */ var MultiSelectTaxo = (component.exports);

/***/ })

}]);
//# sourceMappingURL=EditEntity.common.272.js.map