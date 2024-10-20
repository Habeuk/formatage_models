"use strict";
((typeof self !== 'undefined' ? self : this)["webpackChunkEditEntity"] = (typeof self !== 'undefined' ? self : this)["webpackChunkEditEntity"] || []).push([[670],{

/***/ 6670:
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

// ESM COMPAT FLAG
__webpack_require__.r(__webpack_exports__);

// EXPORTS
__webpack_require__.d(__webpack_exports__, {
  "default": function() { return /* binding */ OptionsEntities; }
});

;// CONCATENATED MODULE: ./node_modules/babel-loader/lib/index.js??clonedRuleSet-82.use[1]!./node_modules/@vue/vue-loader-v15/lib/loaders/templateLoader.js??ruleSet[1].rules[3]!./node_modules/@vue/vue-loader-v15/lib/index.js??vue-loader-options!../components_bootstrapvuejs/src/components/Ressouces/OptionsEntities.vue?vue&type=template&id=f0ea76c0
var render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return _c('div', [_c('b-form-group', {
    attrs: {
      "label": _vm.field.label
    }
  }, [_vm.field.type == 'options_select' ? _c('b-form-select', {
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
  }) : _c('b-form-radio-group', {
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
// EXTERNAL MODULE: ../drupal-vuejs/src/App/jsonApi/itemsEntity.js
var itemsEntity = __webpack_require__(9808);
// EXTERNAL MODULE: ../components_bootstrapvuejs/src/components/fieldsDrupal/loadField.js + 138 modules
var loadField = __webpack_require__(439);
;// CONCATENATED MODULE: ./node_modules/thread-loader/dist/cjs.js!./node_modules/babel-loader/lib/index.js??clonedRuleSet-82.use[1]!./node_modules/@vue/vue-loader-v15/lib/index.js??vue-loader-options!../components_bootstrapvuejs/src/components/Ressouces/OptionsEntities.vue?vue&type=script&lang=js



/* harmony default export */ var OptionsEntitiesvue_type_script_lang_js = ({
  name: "OptionsEntities",
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
      let entity_type_id = this.getFistVocab();
      if (entity_type_id && loadField/* default */.A.config) {
        const terms = new itemsEntity/* default */.A(entity_type_id, entity_type_id, loadField/* default */.A.config);
        terms.get().then(() => {
          this.options = terms.getOptions();
        });
      }
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
     * @param {*} val
     */
    input(val) {
      const vals = [];
      vals.push({
        target_id: val
      });
      this.$emit("setValue", vals);
    },
    /**
     * --
     */
    getValue() {
      if (this.model[this.field.name] && this.model[this.field.name][0]) {
        if (this.model[this.field.name][0].value) return this.model[this.field.name][0].value;else return this.model[this.field.name][0].target_id;
      } else return null;
    }
  }
});
;// CONCATENATED MODULE: ../components_bootstrapvuejs/src/components/Ressouces/OptionsEntities.vue?vue&type=script&lang=js
 /* harmony default export */ var Ressouces_OptionsEntitiesvue_type_script_lang_js = (OptionsEntitiesvue_type_script_lang_js); 
// EXTERNAL MODULE: ./node_modules/@vue/vue-loader-v15/lib/runtime/componentNormalizer.js
var componentNormalizer = __webpack_require__(1656);
;// CONCATENATED MODULE: ../components_bootstrapvuejs/src/components/Ressouces/OptionsEntities.vue





/* normalize component */
;
var component = (0,componentNormalizer/* default */.A)(
  Ressouces_OptionsEntitiesvue_type_script_lang_js,
  render,
  staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* harmony default export */ var OptionsEntities = (component.exports);

/***/ }),

/***/ 9808:
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

/* harmony import */ var core_js_modules_es_array_push_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(4114);
/* harmony import */ var core_js_modules_es_array_push_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_push_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _utilities_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(218);
/* harmony import */ var _Confs_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(4832);
/* harmony import */ var _buildFilter_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(6505);




class itemsEntity {
  constructor(entity_type_id, bundle = null, config = null) {
    this.entity_type_id = entity_type_id;
    this.bundle = bundle;
    if (!bundle) {
      this.bundle = entity_type_id;
    }
    this.url = _Confs_js__WEBPACK_IMPORTED_MODULE_2__/* ["default"] */ .A.baseURl + "/" + this.entity_type_id + "/" + bundle;
    this.items = [];
    this.newConfig = config;
    // En function de l'environement on doit ajouter les paramettres de bases.( notament baseUrl, TestDomain, les methodes surchargées ).
    if (config) {
      // à ce state la surcharge total pose probleme, donc on doit surcharger par necessite.
      // utilities = {
      //   ...utilities,
      //   ...config,
      // };
      if (config.TestDomain) _utilities_js__WEBPACK_IMPORTED_MODULE_1__/* ["default"] */ .A.TestDomain = config.TestDomain;
    }
    /**
     * Permet de joindre les multiples filtres.
     */
    this.filterQuery = "";
    /**
     * Liste de champs à afficher dans le flux, si vide tous les champs seront affichés.
     */
    this.fields = [];
  }
  /**
   * Recupere les items en passant par le token.
   */
  get() {
    return new Promise((resolv, reject) => {
      if (this.filterQuery) {
        this.filterQuery = this.url.includes("?") ? "&" + this.filterQuery : "?" + this.filterQuery;
      }
      _utilities_js__WEBPACK_IMPORTED_MODULE_1__/* ["default"] */ .A.dGet(this.url + this.filterQuery + this.addFieldsToQuery(), _Confs_js__WEBPACK_IMPORTED_MODULE_2__/* ["default"] */ .A.headers).then(resp => {
        this.items = resp.data;
        resolv(resp.data);
      }).catch(er => {
        reject(er);
      });
    });
  }
  getColumnName() {
    switch (this.entity_type_id) {
      case "webform":
        return "title";
      default:
        return "name";
    }
  }
  /**
   * Recupere les items
   * ( on doit pouvoir faire un search avec d'autres filtre )
   */
  getSearch(search) {
    const filter = new _buildFilter_js__WEBPACK_IMPORTED_MODULE_3__/* ["default"] */ .A();
    filter.addFilter(this.getColumnName(), "CONTAINS", search);
    return new Promise((resolv, reject) => {
      _utilities_js__WEBPACK_IMPORTED_MODULE_1__/* ["default"] */ .A.dGet(this.url + "?" + filter.query, _Confs_js__WEBPACK_IMPORTED_MODULE_2__/* ["default"] */ .A.headers).then(resp => {
        this.items = resp.data;
        resolv(resp.data);
      }).catch(er => {
        reject(er);
      });
    });
  }
  /**
   *
   * @returns *
   */
  getValue(term) {
    const filter = new _buildFilter_js__WEBPACK_IMPORTED_MODULE_3__/* ["default"] */ .A();
    filter.addFilter(this.getColumnName(), "=", term);
    return new Promise((resolv, reject) => {
      _utilities_js__WEBPACK_IMPORTED_MODULE_1__/* ["default"] */ .A.dGet(this.url + "?" + filter.query, _Confs_js__WEBPACK_IMPORTED_MODULE_2__/* ["default"] */ .A.headers).then(resp => {
        this.items = resp.data;
        resolv(resp.data);
      }).catch(er => {
        reject(er);
      });
    });
  }
  /**
   *
   * @returns *
   */
  getValueByTid(id) {
    const filter = new _buildFilter_js__WEBPACK_IMPORTED_MODULE_3__/* ["default"] */ .A();
    filter.addFilter("tid", "=", id);
    return new Promise((resolv, reject) => {
      _utilities_js__WEBPACK_IMPORTED_MODULE_1__/* ["default"] */ .A.dGet(this.url + "?" + filter.query, _Confs_js__WEBPACK_IMPORTED_MODULE_2__/* ["default"] */ .A.headers).then(resp => {
        this.items = resp.data;
        resolv(resp.data);
      }).catch(er => {
        reject(er);
      });
    });
  }

  /**
   *
   * @returns *
   */
  getValueById(id) {
    const filter = new _buildFilter_js__WEBPACK_IMPORTED_MODULE_3__/* ["default"] */ .A();
    let fieldId = "drupal_internal__id";
    switch (this.entity_type_id) {
      case "user":
        fieldId = "uid";
        break;
      // case "domain":
      //   fieldId = "drupal_internal__id";
      //   break;
      case "node":
        fieldId = "drupal_internal__nid";
        break;
      case "taxonomy_term":
        fieldId = "tid";
        break;
    }
    filter.addFilter(fieldId, "=", id);
    return new Promise(resolv => {
      _utilities_js__WEBPACK_IMPORTED_MODULE_1__/* ["default"] */ .A.dGet(this.url + "?" + filter.query, _Confs_js__WEBPACK_IMPORTED_MODULE_2__/* ["default"] */ .A.headers).then(resp => {
        this.items = resp.data;
        resolv(resp.data);
      });
    });
  }

  /**
   * @see https://www.drupal.org/docs/core-modules-and-themes/core-modules/jsonapi-module/filtering
   * @param {*} field_name
   * @param {*} operator
   * @param {*} value
   */
  filter(field_name, operator, value) {
    const filter = new _buildFilter_js__WEBPACK_IMPORTED_MODULE_3__/* ["default"] */ .A();
    filter.addFilter(field_name, operator, value);
    if (filter.query) {
      if (!this.filterQuery) this.filterQuery += filter.query;else {
        this.filterQuery += "&" + filter.query;
      }
    }
  }
  /**
   * Les entities à joindre dans la requete.
   * @param {Array} entities
   */
  addIncludesEntities(entities = []) {
    //IE.url += "?include=executants,project_manager";
  }
  /**
   * Retourne les termes sous formes de liste d'otpions.
   * NB: Pour recuperer certaines données l'utilisateur doit envoyer ses entites l'utilisateur doit s'authentifier.
   */
  getOptions() {
    const options = [];
    for (const i in this.items.data) {
      const term = this.items.data[i];
      if (this.entity_type_id == "user") {
        console.log("termUser : ", term);
        if (term.attributes.drupal_internal__uid) options.push({
          text: term.attributes.name ? term.attributes.name : term.attributes.display_name,
          value: term.attributes.drupal_internal__uid
        });
      } else if (term.attributes.title) {
        options.push({
          text: term.attributes.title,
          value: term.attributes.drupal_internal__id
        });
      } else if (term.attributes.name) {
        options.push({
          text: term.attributes.name,
          value: term.attributes.drupal_internal__id
        });
      } else if (term.attributes.label) {
        options.push({
          text: term.attributes.label,
          value: term.attributes.drupal_internal__id
        });
      }
    }
    return options;
  }
  /**
   * -- https://www.drupal.org/node/2806623#s-get-article-media-entity-reference-field-image-url-uri-by-including-references
   */
  addFieldsToQuery() {
    var string = "";
    if (this.fields.length > 0) {
      string += "&fields[" + this.entity_type_id + "--" + this.bundle + "]";
      string += "=" + this.fields.toString();
    }
    return string;
  }
  /**
   * Permet d'ajouter uniquement les champs necessaires.
   */
  setFields(fields) {
    this.fields = fields;
  }
  /**
   * On a deux cas interne et externe au domaine, et en function de l'environnement
   * on doit utiliser token ou basic authentification.
   * ## approche 1
   * ( On ajoute cette variable en attendant la validation des autres modules de plus
   * il faudra que dans "config" la methode dGet existe, ce qui n'est pas le cas pour certains environnement.
   * gestion-projet-v2 => OK (--mode=dev), error (--mode=prod --> /projets/3248)
   * edit-entity => ??
   * Creation-cv => ??
   * Creation de site web => ??
   * ).
   * ## approche 2
   * faire une boucle.
   */
  remplaceConfig() {
    // On vide l'objet afin d'eviter le bug : https://projets-old.habeuk.com/#/projets/3248
    // utilities = {};
    // console.log("utilities : ", utilities);
    // console.log("newConfig : ", this.newConfig);
    // utilities = this.newConfig;
    for (const i in this.newConfig) {
      _utilities_js__WEBPACK_IMPORTED_MODULE_1__/* ["default"] */ .A[i] = this.newConfig[i];
    }
  }
}
/* harmony default export */ __webpack_exports__.A = (itemsEntity);

/***/ })

}]);
//# sourceMappingURL=EditEntity.umd.670.js.map