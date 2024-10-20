"use strict";
((typeof self !== 'undefined' ? self : this)["webpackChunkedit_entity_in_layout"] = (typeof self !== 'undefined' ? self : this)["webpackChunkedit_entity_in_layout"] || []).push([[582],{

/***/ 8582:
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

// ESM COMPAT FLAG
__webpack_require__.r(__webpack_exports__);

// EXPORTS
__webpack_require__.d(__webpack_exports__, {
  "default": function() { return /* binding */ MultiSelectEntities; }
});

;// CONCATENATED MODULE: ./node_modules/babel-loader/lib/index.js??clonedRuleSet-40.use[1]!./node_modules/@vue/vue-loader-v15/lib/loaders/templateLoader.js??ruleSet[1].rules[3]!./node_modules/@vue/vue-loader-v15/lib/index.js??vue-loader-options!../components_bootstrapvuejs/src/components/Ressouces/MultiSelectEntities.vue?vue&type=template&id=096c5807
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
            "placeholder": "",
            "label": "text",
            "track-by": "text",
            "show-no-results": true,
            "taggable": _vm.auto_create,
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
// EXTERNAL MODULE: ../drupal-vuejs/src/App/jsonApi/itemsEntity.js
var itemsEntity = __webpack_require__(8010);
// EXTERNAL MODULE: ../components_bootstrapvuejs/src/components/fieldsDrupal/loadField.js + 138 modules
var loadField = __webpack_require__(7181);
;// CONCATENATED MODULE: ./node_modules/thread-loader/dist/cjs.js!./node_modules/babel-loader/lib/index.js??clonedRuleSet-40.use[1]!./node_modules/@vue/vue-loader-v15/lib/index.js??vue-loader-options!../components_bootstrapvuejs/src/components/Ressouces/MultiSelectEntities.vue?vue&type=script&lang=js





/* harmony default export */ var MultiSelectEntitiesvue_type_script_lang_js = ({
  name: "MultiSelectEntities",
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
    },
    /**
     * Pour effeutuer les requetes, certains champs initialise leur configuration, cela fontionne si l'application est interne au site.
     * Mais dans le cadre d'une applcation decouplé, il faut utiliser la config definie par l'applicationde base. (dans ce cas on met true)
     */
    overrideConfig: {
      type: Boolean,
      default: false
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
  //    * ( il ya un probleme avec le watch, des que la valeur change, il envoit les données,
  //    *  ce qui est faux, c'est unqiuement à la modification de l'utilisateur ).
  //    * @param {*} val
  //    */
  //   // value_select(val) {
  //   //   if (this.cardinality) {
  //   //     const vals = [];
  //   //     val.forEach((item) => {
  //   //       vals.push({ target_id: item.value });
  //   //     });
  //   //     this.setValue(vals);
  //   //   } else {
  //   //     const vals = [];
  //   //     vals.push({ target_id: val.value });
  //   //     this.setValue(vals);
  //   //   }
  //   // },
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
    getTermById(tid) {
      let entity_type_id = this.getFistVocab();
      if (entity_type_id && loadField/* default */.A.config) {
        const bundle = this.field.definition_settings.bundle_entity_type_id ? this.field.definition_settings.bundle_entity_type_id : entity_type_id;
        const terms = new itemsEntity/* default */.A(entity_type_id, bundle, loadField/* default */.A.config);
        if (this.overrideConfig) {
          terms.remplaceConfig();
          console.log("getTermById :::", this.overrideConfig);
        }
        this.isLoading = true;
        terms.getValueById(tid).then(() => {
          const options = terms.getOptions();
          if (options[0]) {
            this.options.push(options[0]);
            if (this.cardinality) {
              this.value_select.push(options[0]);
            } else if (options[0]) this.value_select = options[0];
          }
          this.isLoading = false;
        }).catch(() => {
          this.isLoading = false;
        });
      }
    },
    /**
     *
     */
    loadDefaults() {
      this.value_select = [];
      this.model[this.field.name].forEach(item => {
        this.getTermById(item.target_id);
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
     * @param {*} search
     */
    asyncFind(search, init = false) {
      if (search.length >= 2 || init) {
        let entity_type_id = this.getFistVocab();
        if (entity_type_id && loadField/* default */.A.config) {
          const bundle = this.field.definition_settings.bundle_entity_type_id ? this.field.definition_settings.bundle_entity_type_id : entity_type_id;
          const terms = new itemsEntity/* default */.A(entity_type_id, bundle, loadField/* default */.A.config);
          if (this.overrideConfig) {
            terms.remplaceConfig();
          }
          this.isLoading = true;
          terms.getSearch(search).then(() => {
            this.options = terms.getOptions();
            this.isLoading = false;
          }).catch(e => {
            this.isLoading = false;
            console.log(e);
          });
        }
      }
    },
    /**
     *
     * @param {string} newElement
     */
    createElement(newElement) {
      const entity = {
        value: {
          name: newElement
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
     * cette fonction est utiliser pour mettre à jour les données dans l'entité.
     * @deprecated
     * @param {*} input
     */
    // selectUser(input) {
    //   const vals = this.model[this.field.name];
    //   vals.push({ target_id: input.value });
    //   this.setValue(vals);
    // },

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
      //met à jour la valeur de value_computed
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
;// CONCATENATED MODULE: ../components_bootstrapvuejs/src/components/Ressouces/MultiSelectEntities.vue?vue&type=script&lang=js
 /* harmony default export */ var Ressouces_MultiSelectEntitiesvue_type_script_lang_js = (MultiSelectEntitiesvue_type_script_lang_js); 
// EXTERNAL MODULE: ./node_modules/@vue/vue-loader-v15/lib/runtime/componentNormalizer.js
var componentNormalizer = __webpack_require__(1656);
;// CONCATENATED MODULE: ../components_bootstrapvuejs/src/components/Ressouces/MultiSelectEntities.vue





/* normalize component */
;
var component = (0,componentNormalizer/* default */.A)(
  Ressouces_MultiSelectEntitiesvue_type_script_lang_js,
  render,
  staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* harmony default export */ var MultiSelectEntities = (component.exports);

/***/ }),

/***/ 8010:
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

/* harmony import */ var core_js_modules_es_array_push_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(4114);
/* harmony import */ var core_js_modules_es_array_push_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_push_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _utilities_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(7536);
/* harmony import */ var _Confs_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(9430);
/* harmony import */ var _buildFilter_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(9031);




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
//# sourceMappingURL=EditEntity.common.582.js.map