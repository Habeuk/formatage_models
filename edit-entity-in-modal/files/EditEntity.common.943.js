"use strict";
((typeof self !== 'undefined' ? self : this)["webpackChunkedit_entity_in_layout"] = (typeof self !== 'undefined' ? self : this)["webpackChunkedit_entity_in_layout"] || []).push([[943],{

/***/ 2943:
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

// ESM COMPAT FLAG
__webpack_require__.r(__webpack_exports__);

// EXPORTS
__webpack_require__.d(__webpack_exports__, {
  "default": function() { return /* binding */ EditEntity; }
});

;// CONCATENATED MODULE: ./node_modules/babel-loader/lib/index.js??clonedRuleSet-40.use[1]!./node_modules/@vue/vue-loader-v15/lib/loaders/templateLoader.js??ruleSet[1].rules[3]!./node_modules/@vue/vue-loader-v15/lib/index.js??vue-loader-options!./src/App/EditEntity.vue?vue&type=template&id=ee077134&
var render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return _c('div', [_c('modalForm', {
    attrs: {
      "title-modal": _vm.titleModal,
      "manage-modal": _vm.manageModal
    },
    on: {
      "closeModal": _vm.closeModal
    },
    scopedSlots: _vm._u([{
      key: "header",
      fn: function () {
        return [_c('HCardIcon', {
          attrs: {
            "with-mb": false
          },
          scopedSlots: _vm._u([{
            key: "titre",
            fn: function () {
              return [_c('span', [_vm._v(" Modifier le contenu ")])];
            },
            proxy: true
          }, {
            key: "default",
            fn: function () {
              return [_c('span', [_vm._v(" Veillez remplir les champs ci-dessous et enregistrer ")]), _c('br'), _c('span', [_vm._v(" En cas de probleme ou d'incomprehension , veillez nous "), _c('a', {
                attrs: {
                  "href": "#"
                }
              }, [_vm._v(" laisser un message ")])])];
            },
            proxy: true
          }])
        })];
      },
      proxy: true
    }])
  })], 1);
};
var staticRenderFns = [];

;// CONCATENATED MODULE: ./node_modules/babel-loader/lib/index.js??clonedRuleSet-40.use[1]!./node_modules/@vue/vue-loader-v15/lib/loaders/templateLoader.js??ruleSet[1].rules[3]!./node_modules/@vue/vue-loader-v15/lib/index.js??vue-loader-options!./src/App/ModalForm.vue?vue&type=template&id=67f0ea7e&
var ModalFormvue_type_template_id_67f0ea7e_render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return _c('b-modal', {
    attrs: {
      "id": "b-modal-manage-project",
      "title": "BootstrapVue",
      "size": "lg",
      "footer-bg-variant": "light",
      "header-bg-variant": "light",
      "body-class": "edit-entity-in-modal",
      "hide-footer": false,
      "no-close-on-backdrop": false
    },
    on: {
      "ok": _vm.handleOk
    },
    scopedSlots: _vm._u([{
      key: "modal-header",
      fn: function () {
        return [_vm._t("header")];
      },
      proxy: true
    }, {
      key: "default",
      fn: function () {
        return [_c('b-alert', {
          attrs: {
            "variant": "danger",
            "fade": "",
            "show": _vm.hasErrorOnprocess
          }
        }, [_c('error-message')], 1), _c('formEdit', {
          ref: "formEdit"
        })];
      },
      proxy: true
    }, {
      key: "modal-footer",
      fn: function ({
        cancel
      }) {
        return [_vm.run_entity.numbers ? _c('div', {
          staticClass: "run-entity"
        }, [_c('b-alert', {
          attrs: {
            "variant": _vm.hasErrorOnprocess ? 'danger' : 'info',
            "fade": "",
            "show": true
          }
        }, [_c('strong', [_vm._v(" " + _vm._s(_vm.run_entity.creates))]), _vm._v(" / " + _vm._s(_vm.run_entity.numbers) + " Contenus mise à jour. "), _vm.hasErrorOnprocess ? _c('div', [_c('error-message')], 1) : _vm._e()])], 1) : _vm._e(), _c('b-button', {
          class: _vm.waiting ? 'save-wait' : '',
          attrs: {
            "disabled": _vm.waiting,
            "size": "md",
            "variant": "info"
          },
          on: {
            "click": _vm.handleOk
          }
        }, [_c('b-icon', {
          attrs: {
            "icon": "save2",
            "variant": "white"
          }
        }), _c('span', [_vm._v(" Enregister ")]), _vm.waiting ? _c('svgWaiting') : _vm._e()], 1), _c('b-button', {
          attrs: {
            "disabled": _vm.waiting,
            "size": "md",
            "variant": "outline-secondary"
          },
          on: {
            "click": function ($event) {
              return cancel();
            }
          }
        }, [_vm._v(" Annuler ")])];
      }
    }], null, true),
    model: {
      value: _vm.openModel,
      callback: function ($$v) {
        _vm.openModel = $$v;
      },
      expression: "openModel"
    }
  });
};
var ModalFormvue_type_template_id_67f0ea7e_staticRenderFns = [];

;// CONCATENATED MODULE: ./node_modules/babel-loader/lib/index.js??clonedRuleSet-40.use[1]!./node_modules/@vue/vue-loader-v15/lib/loaders/templateLoader.js??ruleSet[1].rules[3]!./node_modules/@vue/vue-loader-v15/lib/index.js??vue-loader-options!./src/App/FormuLaire.vue?vue&type=template&id=538aaa22&
var FormuLairevue_type_template_id_538aaa22_render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return _c('div', [_c('div', [_c('b-alert', {
    staticClass: "building-fields d-flex align-items-center",
    attrs: {
      "variant": 'info',
      "fade": "",
      "show": _vm.building_fields
    }
  }, [_c('h3', {
    staticClass: "d-flex align-items-center mb-0 ml-0 mr-auto"
  }, [_vm._v(" Construction du formulaire encours ")]), _c('b-icon', {
    staticClass: "ml-5",
    attrs: {
      "icon": "three-dots",
      "animation": "cylon",
      "font-scale": "4"
    }
  })], 1), _c('b-alert', {
    staticClass: "building-fields d-flex align-items-center",
    attrs: {
      "variant": 'primary',
      "fade": "",
      "show": _vm.running
    }
  }, [_c('h3', {
    staticClass: "d-flex align-items-center mb-0 ml-0 mr-auto"
  }, [_vm._v(" Encours d'execution ")]), _c('b-icon', {
    staticClass: "ml-5",
    attrs: {
      "icon": "three-dots",
      "animation": "cylon",
      "font-scale": "4"
    }
  })], 1)], 1), _vm.show ? _c('b-form', {
    on: {
      "submit": function ($event) {
        $event.preventDefault();
        return _vm.onSubmit.apply(null, arguments);
      },
      "reset": _vm.onReset
    }
  }, _vm._l(_vm.fields, function (container, i) {
    return _c(container.template, {
      key: i,
      tag: "component",
      attrs: {
        "entity": container.entity,
        "class-entity": ['pt-1']
      }
    }, _vm._l(container.fields, function (render, k) {
      return _c(render.template, {
        key: k,
        tag: "component",
        attrs: {
          "field": render.field,
          "model": render.model,
          "entities": render.entities,
          "class-css": ['mb-5'],
          "parent-name": i + '.entity.',
          "parent-child-name": i + '.entities.',
          "namespace-store": ""
        },
        on: {
          "addNewValue": function ($event) {
            return _vm.addNewValue($event, render);
          },
          "removeField": function ($event) {
            return _vm.removeField($event, render);
          },
          "array_move": function ($event) {
            return _vm.array_move($event, render);
          }
        }
      });
    }), 1);
  }), 1) : _vm._e()], 1);
};
var FormuLairevue_type_template_id_538aaa22_staticRenderFns = [];

// EXTERNAL MODULE: ./node_modules/core-js/modules/es.array.push.js
var es_array_push = __webpack_require__(7658);
// EXTERNAL MODULE: ./src/request.js
var request = __webpack_require__(1564);
// EXTERNAL MODULE: ./node_modules/vuex/dist/vuex.esm.js
var vuex_esm = __webpack_require__(408);
;// CONCATENATED MODULE: ./node_modules/thread-loader/dist/cjs.js!./node_modules/babel-loader/lib/index.js??clonedRuleSet-40.use[1]!./node_modules/@vue/vue-loader-v15/lib/index.js??vue-loader-options!./src/App/FormuLaire.vue?vue&type=script&lang=js&



/* harmony default export */ var FormuLairevue_type_script_lang_js_ = ({
  name: "FormuLaire",
  props: {
    showSubmit: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      show: true
    };
  },
  computed: {
    ...(0,vuex_esm/* mapState */.rn)({
      fields: state => state.fields,
      building_fields: state => state.building_fields,
      running: state => state.running
    }),
    idEntity() {
      if (this.form.label !== "") {
        var id = request/* default.generateIdEntityType */.Z.generateIdEntityType(this.form.label);
        this.setId(id);
        return id;
      } else return "";
    }
  },
  methods: {
    /**
     * @private
     * @param {*} event
     */
    onSubmit() {
      this.submit();
    },
    /**
     * @public
     */
    submit() {
      return this.$store.dispatch("saveEntities");
    },
    onReset(event) {
      event.preventDefault();
      // Reset our form values
      // ...
      // Trick to reset/clear native browser form validation state
      this.show = false;
      this.$nextTick(() => {
        this.show = true;
      });
    },
    setId(id) {
      // Si l'uuid n'existe pas, alors c'est une creation de type, on peut generer l'id.
      if (!this.form.uuid) this.form.id = id;
    },
    addNewValue(value, render) {
      this.model[render.field.name].push(value);
    },
    removeField(index, render) {
      this.model[render.field.name].splice(index, 1);
    },
    array_move(evt, render) {
      const moveItem = (arr, fromIndex, toIndex) => {
        let itemRemoved = arr.splice(fromIndex, 1); // assign the removed item as an array
        arr.splice(toIndex, 0, itemRemoved[0]); // insert itemRemoved into the target index
        return arr;
      };
      const vals = moveItem(this.model[render.field.name], evt.oldIndex, evt.newIndex);
      this.$store.dispatch("setValue", {
        value: vals,
        fieldName: render.field.name
      });
    }
  }
});
;// CONCATENATED MODULE: ./src/App/FormuLaire.vue?vue&type=script&lang=js&
 /* harmony default export */ var App_FormuLairevue_type_script_lang_js_ = (FormuLairevue_type_script_lang_js_); 
// EXTERNAL MODULE: ./node_modules/@vue/vue-loader-v15/lib/runtime/componentNormalizer.js
var componentNormalizer = __webpack_require__(1001);
;// CONCATENATED MODULE: ./src/App/FormuLaire.vue





/* normalize component */
;
var component = (0,componentNormalizer/* default */.Z)(
  App_FormuLairevue_type_script_lang_js_,
  FormuLairevue_type_template_id_538aaa22_render,
  FormuLairevue_type_template_id_538aaa22_staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* harmony default export */ var FormuLaire = (component.exports);
;// CONCATENATED MODULE: ./node_modules/thread-loader/dist/cjs.js!./node_modules/babel-loader/lib/index.js??clonedRuleSet-40.use[1]!./node_modules/@vue/vue-loader-v15/lib/index.js??vue-loader-options!./src/App/ModalForm.vue?vue&type=script&lang=js&


/* harmony default export */ var ModalFormvue_type_script_lang_js_ = ({
  components: {
    formEdit: FormuLaire,
    svgWaiting: () => __webpack_require__.e(/* import() */ 337).then(__webpack_require__.bind(__webpack_require__, 3337)),
    "error-message": {
      props: [],
      template: `<div> Une <strong> erreur s'est produite </strong> , nos administrateurs sont  deja notifiées, ils vous contacterons des que c'est corrigé.<br /> Nous nous excusons pour ce désagrément ... </div>`,
      mounted() {
        //
      }
    }
  },
  props: {
    manageModal: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      waiting: false,
      hasErrorOnprocess: false
    };
  },
  computed: {
    ...(0,vuex_esm/* mapState */.rn)({
      run_entity: state => state.run_entity
    }),
    openModel: {
      get() {
        if (this.manageModal) return true;
        return false;
      },
      set(value) {
        this.$emit("closeModal", value);
      }
    }
  },
  methods: {
    handleOk(event) {
      event.preventDefault();
      // On demarre si et seulement, si on a pas deja demarré.
      if (!this.waiting) {
        this.waiting = true;
        this.hasErrorOnprocess = false;
        this.$refs.formEdit.submit().then(() => {
          this.waiting = false;
          this.$bvModal.hide("b-modal-manage-project");
          window.location.assign(window.location.pathname);
        }).catch(er => {
          // On doit afficher sur le modal.
          console.log("error : ", er);
          this.waiting = false;
          this.hasErrorOnprocess = true;
        });
      }
    }
  }
});
;// CONCATENATED MODULE: ./src/App/ModalForm.vue?vue&type=script&lang=js&
 /* harmony default export */ var App_ModalFormvue_type_script_lang_js_ = (ModalFormvue_type_script_lang_js_); 
;// CONCATENATED MODULE: ./node_modules/mini-css-extract-plugin/dist/loader.js??clonedRuleSet-22.use[0]!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-22.use[1]!./node_modules/@vue/vue-loader-v15/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-22.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-22.use[3]!./node_modules/@vue/vue-loader-v15/lib/index.js??vue-loader-options!./src/App/ModalForm.vue?vue&type=style&index=0&id=67f0ea7e&prod&lang=scss&
// extracted by mini-css-extract-plugin

;// CONCATENATED MODULE: ./src/App/ModalForm.vue?vue&type=style&index=0&id=67f0ea7e&prod&lang=scss&

;// CONCATENATED MODULE: ./src/App/ModalForm.vue



;


/* normalize component */

var ModalForm_component = (0,componentNormalizer/* default */.Z)(
  App_ModalFormvue_type_script_lang_js_,
  ModalFormvue_type_template_id_67f0ea7e_render,
  ModalFormvue_type_template_id_67f0ea7e_staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* harmony default export */ var ModalForm = (ModalForm_component.exports);
;// CONCATENATED MODULE: ./node_modules/thread-loader/dist/cjs.js!./node_modules/babel-loader/lib/index.js??clonedRuleSet-40.use[1]!./node_modules/@vue/vue-loader-v15/lib/index.js??vue-loader-options!./src/App/EditEntity.vue?vue&type=script&lang=js&


/* harmony default export */ var EditEntityvue_type_script_lang_js_ = ({
  name: "EditEntity",
  components: {
    modalForm: ModalForm
  },
  data() {
    return {
      titleModal: "",
      manageModal: false
    };
  },
  computed: {
    ...(0,vuex_esm/* mapState */.rn)({
      currentEntityInfo: state => state.currentEntityInfo
    })
  },
  mounted() {
    this.check_edit_entity();
  },
  methods: {
    check_edit_entity() {
      document.addEventListener("formatage_models_data_quick_edit_vuejs", even => {
        if (even.detail && even.detail.id) {
          // On verifie s'il faut netoyer les données.
          if (this.currentEntityInfo.id && even.detail.id != this.currentEntityInfo.id) {
            console.log(" check_edit_entity Nettoyage ");
            this.$store.dispatch("cleanDatas").then(() => {
              this.initEdit(even);
            });
          } else {
            console.log(" check_edit_entity faux ");
            this.initEdit(even);
          }
        }
      }, false);
    },
    initEdit(even) {
      console.log("initEdit : ", even.detail);
      this.openModal();
      this.$store.dispatch("set_currentEntityForm", even.detail).then(() => {
        this.$store.dispatch("loadForm");
      });
    },
    openModal() {
      if (this.manageModal) this.manageModal = false;else this.manageModal = true;
    },
    closeModal() {
      this.manageModal = false;
    }
  }
});
;// CONCATENATED MODULE: ./src/App/EditEntity.vue?vue&type=script&lang=js&
 /* harmony default export */ var App_EditEntityvue_type_script_lang_js_ = (EditEntityvue_type_script_lang_js_); 
;// CONCATENATED MODULE: ./src/App/EditEntity.vue





/* normalize component */
;
var EditEntity_component = (0,componentNormalizer/* default */.Z)(
  App_EditEntityvue_type_script_lang_js_,
  render,
  staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* harmony default export */ var EditEntity = (EditEntity_component.exports);

/***/ })

}]);
//# sourceMappingURL=EditEntity.common.943.js.map