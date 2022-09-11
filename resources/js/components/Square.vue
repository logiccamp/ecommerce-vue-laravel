<template>
    <div class="container">
        <div id="sq-ccbox">
            <!--
            You should replace the action attribute of the form with the path of
            the URL you want to POST the nonce to (for example, "/process-card")
            -->
            <form id="nonce-form" novalidate action="path/to/payment/processing/page" method="post">
            <div class="errorbox">
                <div class="error" v-for="(error, index) in errors" :key="index">
                {{error}}
                </div>
            </div>
            <div id="card-tainer">
                <div class="cardfields card-number" :id="id+'-sq-card-number'">o</div>
                <div class="cardfields expiration-date" :id="id+'-sq-expiration-date'">e</div>
                <div class="cardfields cvv" :id="id+'-sq-cvv'">e</div>
                <div class="cardfields postal-code" :id="id+'-sq-postal-code'">e</div>
            </div>

            <input type="hidden" id="card-nonce" name="nonce">
            <div id="sq-walletbox">
                <button v-show=masterpass :id="id+'-sq-masterpass'" class="button-masterpass">Master Pay</button>
            </div>
            </form>
        </div>
        <button @click="requestCardNonce( $event)" class='productPurchase payButton'>Pay</button>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
            errors: [],
            masterpass: true,
            applePay: false
            };
        },
        watch: {
            showPaymentForm: function() {
            if (!this.showPaymentForm) {
                return 1;
            }
            this.paymentForm.build();
            }
        },
        props: {
            showPaymentForm: Boolean,
            id: Number
        },
        mounted: function() {
            let locationId = "L3AE3K3XYXTDE";
            let applicationId = "sandbox-sq0idb-ZXZZZ5sqf2yk-wdMl_enmQ";
            let that = this;
            this.paymentForm = new SqPaymentForm({
            autoBuild: false,
            applicationId: applicationId,
            locationId: locationId,
            inputClass: "sq-input",
            // Initialize the payment form elements

            // Customize the CSS for SqPaymentForm iframe elements
            inputStyles: [
                {
                fontSize: ".9em"
                }
            ],

            // Initialize Apple Pay placeholder ID
            applePay: {
                elementId: that.id + "-sq-apple-pay"
            },

            // Initialize Masterpass placeholder ID
            masterpass: {
                elementId: that.id + "-sq-masterpass"
            },

            // Initialize the credit card placeholders
            cardNumber: {
                elementId: that.id + "-sq-card-number",
                placeholder: "Card number"
            },
            cvv: {
                elementId: that.id + "-sq-cvv",
                placeholder: "CVV"
            },
            expirationDate: {
                elementId: that.id + "-sq-expiration-date",
                placeholder: "MM / YY"
            },
            postalCode: {
                elementId: that.id + "-sq-postal-code",
                placeholder: "Zip Code"
            },

            // SqPaymentForm callback functions
            callbacks: {
                /*
                * callback function: methodsSupported
                * Triggered when: the page is loaded.
                */
                methodsSupported: function(methods) {
                // Only show the button if Apple Pay for Web is enabled
                // Otherwise, display the wallet not enabled message.
                that.applePay = methods.applePay;
                that.masterpass = methods.masterpass;
                },

                /*
                * Digital Wallet related functions
                */
                createPaymentRequest: function() {
                var paymentRequestJson;
                /* ADD CODE TO SET/CREATE paymentRequestJson */
                return paymentRequestJson;
                },
                validateShippingContact: function(contact) {
                var validationErrorObj;
                /* ADD CODE TO SET validationErrorObj IF ERRORS ARE FOUND */
                return validationErrorObj;
                },

                /*
                * callback function: cardNonceResponseReceived
                * Triggered when: SqPaymentForm completes a card nonce request
                */
                cardNonceResponseReceived: function(errors, nonce, cardData) {
                if (errors) {
                    errors.forEach(function(error) {
                    that.errors.push(error.message);
                    });
                    return;
                }
                // Assign the nonce value to the hidden form field
                document.getElementById("card-nonce").value = nonce;

                // POST the nonce form to the payment processing page
                document.getElementById("nonce-form").submit();
                },
                /*
                * callback function: paymentFormLoaded
                * Triggered when: SqPaymentForm is fully loaded
                */
                paymentFormLoaded: function() {
                console.log("paymentFormLoaded");
                /* HANDLE AS DESIRED */
                }
            }
            });
        },
        methods: {
            requestCardNonce: function(event) {
            // Don't submit the form until SqPaymentForm returns with a nonce
            event.preventDefault();

            // Request a nonce from the SqPaymentForm object
            this.paymentForm.requestCardNonce();
            }
        }
    }
</script>
