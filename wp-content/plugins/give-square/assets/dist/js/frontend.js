!function(e){function r(a){if(t[a])return t[a].exports;var i=t[a]={i:a,l:!1,exports:{}};return e[a].call(i.exports,i,i.exports,r),i.l=!0,i.exports}var t={};r.m=e,r.c=t,r.d=function(e,t,a){r.o(e,t)||Object.defineProperty(e,t,{configurable:!1,enumerable:!0,get:a})},r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,"a",t),t},r.o=function(e,r){return Object.prototype.hasOwnProperty.call(e,r)},r.p="",r(r.s=0)}([function(e,r,t){t(1),e.exports=t(2)},function(e,r,t){"use strict";function a(e,r){if(!(e instanceof r))throw new TypeError("Cannot call a class as a function")}var i=function(){function e(e,r){for(var t=0;t<r.length;t++){var a=r[t];a.enumerable=a.enumerable||!1,a.configurable=!0,"value"in a&&(a.writable=!0),Object.defineProperty(e,a.key,a)}}return function(r,t,a){return t&&e(r.prototype,t),a&&e(r,a),r}}();document.addEventListener("DOMContentLoaded",function(e){var r=document.querySelectorAll(".give-form-wrap"),t={};Array.prototype.forEach.call(r,function(r){var a=null,i=r.querySelector(".give-form");i.querySelector('input[name="give-form-id-prefix"]').value;null!==i.querySelector(".give-btn-modal")?a=i.querySelector(".give-btn-modal"):null!==i.querySelector(".give-btn-reveal")&&(a=i.querySelector(".give-btn-reveal")),t=new n(i,a,e),jQuery(document).on("give_gateway_loaded",function(e,r,a){"square"===i.querySelector(".give-gateway-option-selected .give-gateway").value&&(t.destroy(i),t.create_payment_form(i),t.build(i))}),null!==a&&a.addEventListener("click",function(){if("square"===i.querySelector(".give-gateway:checked").value){new Promise(function(e,r){setTimeout(function(){e(i.querySelector(".give-modal-open"))},300)}).then(function(e){t.destroy(i),t.create_payment_form(i),t.build(i),t.recalculate(i)})}})}),jQuery("body").on("submit",".give-form",function(e){var r=jQuery(this),a=r.find('input[name="give-form-id-prefix"]').val();"square"===r.find("input.give-gateway:checked").val()&&(t.paymentForm[a].requestCardNonce(),e.preventDefault())})});var n=function(){function e(r,t,i){a(this,e),this.defaultGateway="",this.paymentForm=[],this.event=i,this.formID=r.querySelector('input[name="give-form-id"]').value,this.submitButton=r.querySelector("#give-purchase-button"),null!==r.querySelector(".give-gateway-option-selected .give-gateway").value&&(this.defaultGateway=r.querySelector(".give-gateway-option-selected .give-gateway").value),"square"===this.defaultGateway&&null===t&&(this.create_payment_form(r),this.build(r))}return i(e,[{key:"create_payment_form",value:function(e){var r=this,t=e.querySelector('input[name="give-form-id-prefix"]').value;this.paymentForm[t]=new SqPaymentForm({applicationId:giveSquareLocaliseVars.applicationID,locationId:giveSquareLocaliseVars.locationID,inputClass:"give-square-cc-fields",autoBuild:!1,inputStyles:[giveSquareLocaliseVars.inputStyles],applePay:!1,masterpass:!1,cardNumber:{elementId:"give-card-number-field-"+t,placeholder:giveSquareLocaliseVars.cardNumberPlaceholder},cvv:{elementId:"give-card-cvc-field-"+t,placeholder:giveSquareLocaliseVars.cvcPlaceholder},expirationDate:{elementId:"give-card-expiration-field-"+t,placeholder:giveSquareLocaliseVars.cardExpiryPlaceholder},postalCode:{elementId:"give-square-card-zip-"+t,placeholder:giveSquareLocaliseVars.postalCodePlaceholder},callbacks:{inputEventReceived:function(r){switch(r.eventType){case"cardBrandChanged":var a=r.cardBrand.toLowerCase();"discoverdiners"===r.cardBrand.toLowerCase()?a="dinersclub":"americanexpress"===r.cardBrand.toLowerCase()&&(a="amex"),e.querySelector(".card-type").className="card-type "+a;break;case"postalCodeChanged":e.querySelector("#give-square-card-zip-hidden-"+t).value=r.postalCodeValue}},cardNonceResponseReceived:function(a,i,n){if(null!==a&&a.length>0){var o="";a.forEach(function(e){o+='<div class="give_errors"><p class="give_error">'+e.message+"</p></div>"}),e.querySelector("#give-square-payment-errors-"+t).innerHTML=o,give_global_vars.complete_purchase?r.submitButton.value=give_global_vars.complete_purchase:r.submitButton.value=r.submitButton.getAttribute("data-before-validation-label"),r.submitButton.removeAttribute("disabled"),e.querySelector(".give-submit-button-wrap").querySelector(".give-loading-animation").style.display="none"}else e.querySelector("#card-nonce-"+t).value=i,e.submit()},unsupportedBrowserDetected:function(){alert(giveSquareLocaliseVars.unsupportedBrowserText)}}})}},{key:"build",value:function(e){var r=e.querySelector('input[name="give-form-id-prefix"]').value;this.paymentForm[r].build()}},{key:"destroy",value:function(e){var r=e.querySelector('input[name="give-form-id-prefix"]').value;void 0!==this.paymentForm[r]&&this.paymentForm[r].destroy()}},{key:"recalculate",value:function(e){var r=e.querySelector('input[name="give-form-id-prefix"]').value;void 0!==this.paymentForm[r]&&this.paymentForm[r].recalculateSize()}}]),e}()},function(e,r){}]);
//# sourceMappingURL=frontend.js.map