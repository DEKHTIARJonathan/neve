(window.webpackJsonp=window.webpackJsonp||[]).push([[4],{3603:function(module,exports,__webpack_require__){__webpack_require__(35)({target:"Object",stat:!0},{setPrototypeOf:__webpack_require__(2074)})},3604:function(module,exports,__webpack_require__){var $=__webpack_require__(35),fails=__webpack_require__(83),toObject=__webpack_require__(248),nativeGetPrototypeOf=__webpack_require__(1356),CORRECT_PROTOTYPE_GETTER=__webpack_require__(2073);$({target:"Object",stat:!0,forced:fails((function(){nativeGetPrototypeOf(1)})),sham:!CORRECT_PROTOTYPE_GETTER},{getPrototypeOf:function getPrototypeOf(it){return nativeGetPrototypeOf(toObject(it))}})},3605:function(module,exports,__webpack_require__){var $=__webpack_require__(35),getBuiltIn=__webpack_require__(392),aFunction=__webpack_require__(337),anObject=__webpack_require__(167),isObject=__webpack_require__(168),create=__webpack_require__(915),bind=__webpack_require__(2072),fails=__webpack_require__(83),nativeConstruct=getBuiltIn("Reflect","construct"),NEW_TARGET_BUG=fails((function(){function F(){}return!(nativeConstruct((function(){}),[],F)instanceof F)})),ARGS_BUG=!fails((function(){nativeConstruct((function(){}))})),FORCED=NEW_TARGET_BUG||ARGS_BUG;$({target:"Reflect",stat:!0,forced:FORCED,sham:FORCED},{construct:function construct(Target,args){aFunction(Target),anObject(args);var newTarget=arguments.length<3?Target:aFunction(arguments[2]);if(ARGS_BUG&&!NEW_TARGET_BUG)return nativeConstruct(Target,args,newTarget);if(Target==newTarget){switch(args.length){case 0:return new Target;case 1:return new Target(args[0]);case 2:return new Target(args[0],args[1]);case 3:return new Target(args[0],args[1],args[2]);case 4:return new Target(args[0],args[1],args[2],args[3])}var $args=[null];return $args.push.apply($args,args),new(bind.apply(Target,$args))}var proto=newTarget.prototype,instance=create(isObject(proto)?proto:Object.prototype),result=Function.apply.call(Target,instance,args);return isObject(result)?result:instance}})},3606:function(module,exports,__webpack_require__){__webpack_require__(35)({target:"Object",stat:!0,sham:!__webpack_require__(153)},{create:__webpack_require__(915)})},3611:function(module,__webpack_exports__,__webpack_require__){"use strict";__webpack_require__.r(__webpack_exports__),__webpack_require__.d(__webpack_exports__,"default",(function(){return ColorPickerFix}));__webpack_require__(36),__webpack_require__(638),__webpack_require__(3603),__webpack_require__(3604),__webpack_require__(3605),__webpack_require__(3606),__webpack_require__(18),__webpack_require__(19),__webpack_require__(21),__webpack_require__(25),__webpack_require__(24),__webpack_require__(20),__webpack_require__(22);var _wordpress_components__WEBPACK_IMPORTED_MODULE_13__=__webpack_require__(1353);function _typeof(obj){return(_typeof="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function _typeof(obj){return typeof obj}:function _typeof(obj){return obj&&"function"==typeof Symbol&&obj.constructor===Symbol&&obj!==Symbol.prototype?"symbol":typeof obj})(obj)}function _classCallCheck(instance,Constructor){if(!(instance instanceof Constructor))throw new TypeError("Cannot call a class as a function")}function _defineProperties(target,props){for(var i=0;i<props.length;i++){var descriptor=props[i];descriptor.enumerable=descriptor.enumerable||!1,descriptor.configurable=!0,"value"in descriptor&&(descriptor.writable=!0),Object.defineProperty(target,descriptor.key,descriptor)}}function _setPrototypeOf(o,p){return(_setPrototypeOf=Object.setPrototypeOf||function _setPrototypeOf(o,p){return o.__proto__=p,o})(o,p)}function _createSuper(Derived){var hasNativeReflectConstruct=function _isNativeReflectConstruct(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],(function(){}))),!0}catch(e){return!1}}();return function _createSuperInternal(){var result,Super=_getPrototypeOf(Derived);if(hasNativeReflectConstruct){var NewTarget=_getPrototypeOf(this).constructor;result=Reflect.construct(Super,arguments,NewTarget)}else result=Super.apply(this,arguments);return _possibleConstructorReturn(this,result)}}function _possibleConstructorReturn(self,call){return!call||"object"!==_typeof(call)&&"function"!=typeof call?function _assertThisInitialized(self){if(void 0===self)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return self}(self):call}function _getPrototypeOf(o){return(_getPrototypeOf=Object.setPrototypeOf?Object.getPrototypeOf:function _getPrototypeOf(o){return o.__proto__||Object.getPrototypeOf(o)})(o)}function _defineProperty(obj,key,value){return key in obj?Object.defineProperty(obj,key,{value:value,enumerable:!0,configurable:!0,writable:!0}):obj[key]=value,obj}var dataToColors=function dataToColors(oldColors,_ref){var source=_ref.source,valueKey=_ref.valueKey,value=_ref.value;return"hex"===source?_defineProperty({source:source},source,value):Object.assign({source:source},Object.assign({},oldColors[source],_defineProperty({},valueKey,value)))},ColorPickerFix=function(_ColorPicker){!function _inherits(subClass,superClass){if("function"!=typeof superClass&&null!==superClass)throw new TypeError("Super expression must either be null or a function");subClass.prototype=Object.create(superClass&&superClass.prototype,{constructor:{value:subClass,writable:!0,configurable:!0}}),superClass&&_setPrototypeOf(subClass,superClass)}(ColorPickerFix,_ColorPicker);var _super=_createSuper(ColorPickerFix);function ColorPickerFix(){return _classCallCheck(this,ColorPickerFix),_super.apply(this,arguments)}return function _createClass(Constructor,protoProps,staticProps){return protoProps&&_defineProperties(Constructor.prototype,protoProps),staticProps&&_defineProperties(Constructor,staticProps),Constructor}(ColorPickerFix,[{key:"handleInputChange",value:function handleInputChange(data){switch(data.state){case"reset":this.resetDraftValues();break;case"commit":var colors=dataToColors(this.state,data);(function isValueEmpty(data){return"hex"===data.source&&void 0===data.hex||("hsl"===data.source&&(void 0===data.h||void 0===data.s||void 0===data.l)||!("rgb"!==data.source||void 0!==data.r&&void 0!==data.g&&void 0!==data.b||void 0!==data.h&&void 0!==data.s&&void 0!==data.v&&void 0!==data.a||void 0!==data.h&&void 0!==data.s&&void 0!==data.l&&void 0!==data.a))})(colors)||this.commitValues(colors);break;case"draft":this.setDraftValues(dataToColors(this.state,data))}}}]),ColorPickerFix}(_wordpress_components__WEBPACK_IMPORTED_MODULE_13__.a)}}]);
//# sourceMappingURL=4.91eab32e0ec800f38902.bundle.js.map