@extends('layouts.app')

@section("styleSection")
<style>
	.form-container {
		text-align: center;
		justify-content: center;
	}

	form {
		margin-top: 25px;
	}

	input {
		border: 1px solid #E0E2E3;
		border-radius: 4px;
		outline-offset: -2px;
		display: inline-block;
		font-size: 18px;
		font-family: "HelveticaNeue";
		padding: 15px;
		color: #373F4A;
	}

	/* 
	button {
		background: #0EB00E;
		box-shadow: 0 0 2px 0 rgba(0, 0, 0, 0.10), 0 2px 2px 0 rgba(0, 0, 0, 0.10);
		border-radius: 4px;
		cursor: pointer;
		font-size: 16px;
		color: #FFFFFF;
		letter-spacing: 0;
		text-align: center;
		padding: 15px;
		margin-top: 10px;
		outline: none;
		font-family: "HelveticaNeue-Bold", Helvetica, Arial, sans-serif;
	} */

	.sq-field-wrapper {
		display: flex;
		flex-flow: row nowrap;
		margin-bottom: 16px;
	}

	.sq-field {
		margin-bottom: 16px;
		width: 100%;
	}

	.sq-field:first-child {
		margin-left: 0;
	}

	.sq-field:last-child {
		margin-right: 0;
	}

	.sq-field--in-wrapper {
		flex-grow: 1;
		margin: 0 8px;
	}

	.sq-label {
		margin-bottom: 8px;
		text-transform: uppercase;
		font-size: 10px !important;
	}

	.sq-input {
		background-color: #fff;
		border-style: solid;
		border-width: 1px;
		overflow: hidden;
		transition: border-color 0.25s ease;
		width: 100%;
	}

	.sq-input {
		display: block;
		width: 100%;
		height: 34px;
		padding: 6px 12px;
		font-size: 14px;
		line-height: 1.428571429;
		color: #555;
		vertical-align: middle;
		background-color: #fff;
		background-image: none;
		border: 1px solid #ccc;
		border-radius: 4px;
		-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
		box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
		-webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
		transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s
	}

	.sq-input :focus {
		border-color: #66afe9;
		outline: 0;
		-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(102, 175, 233, 0.6);
		box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(102, 175, 233, 0.6)
	}

	.sq-input :-moz-placeholder {
		color: #999
	}

	.sq-input ::-moz-placeholder {
		color: #999;
		opacity: 1
	}

	.sq-input :-ms-input-placeholder {
		color: #999
	}

	.sq-input ::-webkit-input-placeholder {
		color: #999
	}

	.sq-input [disabled],
	.sq-input [readonly],
	fieldset[disabled] .sq-input {
		cursor: not-allowed;
		background-color: #eee
	}

	textarea.sq-input {
		height: auto
	}

	.sq-input--focus {
		background-color: #fbfdff;
	}

	.sq-input--error {
		background-color: #fbfdff;
	}

	.sq-button {
		color: #fff;
		padding: 16px;
		width: 100%;
	}

	.sq-button:active {
		color: #fff;
	}

	.sq-payment-form {
		max-width: 100%;
		padding: 20px 20px 5px;
		width: 380px;
		justify-content: center;
		margin: auto;
	}

	.sq-label {
		color: #000000;
		font-size: 14px;
		font-family: "Helvetica Neue", "Helvetica", sans-serif;
		font-weight: 500;
		letter-spacing: 0.5px;
	}

	.sq-input {
		border-color: #E0E2E3;
		border-radius: 4px;
	}

	.sq-input--focus {
		border-color: #4A90E2;
	}

	.sq-input--error {
		border-color: #e02e2f;
	}

	.sq-button {
		background: #4A90E2;
		border-radius: 4px;
		font-size: 16px;
		font-weight: 600;
		letter-spacing: 1px;
	}

	.sq-button:active {
		background: #4A90E2;
	}

	.sq-wallet-divider {
		margin: 24px 0;
		position: relative;
		text-align: center;
		width: 100%;
	}

	.sq-wallet-divider:after,
	.sq-wallet-divider::after,
	.sq-wallet-divider:before,
	.sq-wallet-divider::before {
		background: #bbb;
		content: '';
		display: block;
		height: 1px;
		left: 0;
		position: absolute;
		right: 0;
		top: 9px;
	}

	.sq-wallet-divider:after,
	.sq-wallet-divider::after {
		right: 65%;
	}

	.sq-wallet-divider:before,
	.sq-wallet-divider::before {
		left: 65%;
	}

	.sq-wallet-divider__text {
		color: #bbb;
		padding: 10px;
		text-transform: uppercase;
	}

	/* Indicates how Google Pay button will appear */
	.button-google-pay {
		width: 100%;
		min-height: 40px;
		padding: 11px 24px;
		margin-bottom: 18px;
		background-color: #000;
		background-image: url(data:image/svg+xml,%3Csvg%20width%3D%22103%22%20height%3D%2217%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cg%20fill%3D%22none%22%20fill-rule%3D%22evenodd%22%3E%3Cpath%20d%3D%22M.148%202.976h3.766c.532%200%201.024.117%201.477.35.453.233.814.555%201.085.966.27.41.406.863.406%201.358%200%20.495-.124.924-.371%201.288s-.572.64-.973.826v.084c.504.177.912.471%201.225.882.313.41.469.891.469%201.442a2.6%202.6%200%200%201-.427%201.47c-.285.43-.667.763-1.148%201.001A3.5%203.5%200%200%201%204.082%2013H.148V2.976zm3.696%204.2c.448%200%20.81-.14%201.085-.42.275-.28.413-.602.413-.966s-.133-.684-.399-.959c-.266-.275-.614-.413-1.043-.413H1.716v2.758h2.128zm.238%204.368c.476%200%20.856-.15%201.141-.448.285-.299.427-.644.427-1.036%200-.401-.147-.749-.441-1.043-.294-.294-.688-.441-1.183-.441h-2.31v2.968h2.366zm5.379.903c-.453-.518-.679-1.239-.679-2.163V5.86h1.54v4.214c0%20.579.138%201.013.413%201.302.275.29.637.434%201.085.434.364%200%20.686-.096.966-.287.28-.191.495-.446.644-.763a2.37%202.37%200%200%200%20.224-1.022V5.86h1.54V13h-1.456v-.924h-.084c-.196.336-.5.611-.91.826-.41.215-.845.322-1.302.322-.868%200-1.528-.259-1.981-.777zm9.859.161L16.352%205.86h1.722l2.016%204.858h.056l1.96-4.858H23.8l-4.41%2010.164h-1.624l1.554-3.416zm8.266-6.748h1.666l1.442%205.11h.056l1.61-5.11h1.582l1.596%205.11h.056l1.442-5.11h1.638L36.392%2013h-1.624L33.13%207.876h-.042L31.464%2013h-1.596l-2.282-7.14zm12.379-1.337a1%201%200%200%201-.301-.735%201%201%200%200%201%20.301-.735%201%201%200%200%201%20.735-.301%201%201%200%200%201%20.735.301%201%201%200%200%201%20.301.735%201%201%200%200%201-.301.735%201%201%200%200%201-.735.301%201%201%200%200%201-.735-.301zM39.93%205.86h1.54V13h-1.54V5.86zm5.568%207.098a1.967%201.967%200%200%201-.686-.406c-.401-.401-.602-.947-.602-1.638V7.218h-1.246V5.86h1.246V3.844h1.54V5.86h1.736v1.358H45.75v3.36c0%20.383.075.653.224.812.14.187.383.28.728.28.159%200%20.299-.021.42-.063.121-.042.252-.11.392-.203v1.498c-.308.14-.681.21-1.12.21-.317%200-.616-.051-.896-.154zm3.678-9.982h1.54v2.73l-.07%201.092h.07c.205-.336.511-.614.917-.833.406-.22.842-.329%201.309-.329.868%200%201.53.254%201.988.763.457.509.686%201.202.686%202.079V13h-1.54V8.688c0-.541-.142-.947-.427-1.218-.285-.27-.656-.406-1.113-.406-.345%200-.656.098-.931.294a2.042%202.042%200%200%200-.651.777%202.297%202.297%200%200%200-.238%201.029V13h-1.54V2.976zm32.35-.341v4.083h2.518c.6%200%201.096-.202%201.488-.605.403-.402.605-.882.605-1.437%200-.544-.202-1.018-.605-1.422-.392-.413-.888-.62-1.488-.62h-2.518zm0%205.52v4.736h-1.504V1.198h3.99c1.013%200%201.873.337%202.582%201.012.72.675%201.08%201.497%201.08%202.466%200%20.991-.36%201.819-1.08%202.482-.697.665-1.559.996-2.583.996h-2.485v.001zm7.668%202.287c0%20.392.166.718.499.98.332.26.722.391%201.168.391.633%200%201.196-.234%201.692-.701.497-.469.744-1.019.744-1.65-.469-.37-1.123-.555-1.962-.555-.61%200-1.12.148-1.528.442-.409.294-.613.657-.613%201.093m1.946-5.815c1.112%200%201.989.297%202.633.89.642.594.964%201.408.964%202.442v4.932h-1.439v-1.11h-.065c-.622.914-1.45%201.372-2.486%201.372-.882%200-1.621-.262-2.215-.784-.594-.523-.891-1.176-.891-1.96%200-.828.313-1.486.94-1.976s1.463-.735%202.51-.735c.892%200%201.629.163%202.206.49v-.344c0-.522-.207-.966-.621-1.33a2.132%202.132%200%200%200-1.455-.547c-.84%200-1.504.353-1.995%201.062l-1.324-.834c.73-1.045%201.81-1.568%203.238-1.568m11.853.262l-5.02%2011.53H96.42l1.864-4.034-3.302-7.496h1.635l2.387%205.749h.032l2.322-5.75z%22%20fill%3D%22%23FFF%22%2F%3E%3Cpath%20d%3D%22M75.448%207.134c0-.473-.04-.93-.116-1.366h-6.344v2.588h3.634a3.11%203.11%200%200%201-1.344%202.042v1.68h2.169c1.27-1.17%202.001-2.9%202.001-4.944%22%20fill%3D%22%234285F4%22%2F%3E%3Cpath%20d%3D%22M68.988%2013.7c1.816%200%203.344-.595%204.459-1.621l-2.169-1.681c-.603.406-1.38.643-2.29.643-1.754%200-3.244-1.182-3.776-2.774h-2.234v1.731a6.728%206.728%200%200%200%206.01%203.703%22%20fill%3D%22%2334A853%22%2F%3E%3Cpath%20d%3D%22M65.212%208.267a4.034%204.034%200%200%201%200-2.572V3.964h-2.234a6.678%206.678%200%200%200-.717%203.017c0%201.085.26%202.11.717%203.017l2.234-1.731z%22%20fill%3D%22%23FABB05%22%2F%3E%3Cpath%20d%3D%22M68.988%202.921c.992%200%201.88.34%202.58%201.008v.001l1.92-1.918c-1.165-1.084-2.685-1.75-4.5-1.75a6.728%206.728%200%200%200-6.01%203.702l2.234%201.731c.532-1.592%202.022-2.774%203.776-2.774%22%20fill%3D%22%23E94235%22%2F%3E%3C%2Fg%3E%3C%2Fsvg%3E);
		background-origin: content-box;
		background-position: center;
		background-repeat: no-repeat;
		background-size: contain;
		border: 0;
		border-radius: 4px;
		box-shadow: 0 1px 1px 0 rgba(60, 64, 67, 0.30), 0 1px 3px 1px rgba(60, 64, 67, 0.15);
		outline: 0;
		cursor: pointer;
		display: none;
	}


	.sq-apple-pay {
		-webkit-appearance: -apple-pay-button;
		border: none;
		height: 48px;
		margin-bottom: 12px;
		width: 100%;
		display: none;
	}

	.sq-masterpass {
		background-color: #000;
		background-image: url(https://masterpass.com/dyn/img/btn/global/mp_chk_btn_384x048px.svg);
		background-repeat: no-repeat;
		background-size: contain;
		background-position: center right;
		border-radius: 5px;
		height: 42px;
		margin-bottom: 16px;
		width: 100%;
		display: none;
	}

	.sq-button:hover {
		cursor: pointer;
		background-color: #4281CB;
	}

	#error {
		width: 100%;
		margin-top: 16px;
		font-size: 14px;
		color: red;
		font-weight: 500;
		text-align: center;
		opacity: 0.8;
	}
</style>
@endSection("styleSection")

@section('content')

<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="#">Home</a></li>
				<li class="active">Check out</li>
			</ol>
		</div>
		<!--/breadcrums-->

		<div class="shopper-informations">
			<!-- <form action="{{route('completeorder')}}" method="POST"> -->
			<div class="formChanged">
				<div class="row">
					<div class="col-sm-8 clearfix">
						@if (Session::has('errors'))
						<div class="alert alert-danger">All fields are required</div>
						@endif
						<div class="bill-to">
							<p>Shipment Information</p>
							<div class="form-one" style="width: 100%;">
								@csrf
								<input type="text" name="firstname" id="firstname" placeholder="First Name *">
								<input type="text" name="lastname" id="lastname" placeholder="Last Name *">
								<input type="text" name="address1" id="address1" placeholder="Address 1 *">
								<input type="text" name="address2" id="address2" placeholder="Address 2">
								<input type="text" name="zip" id="zip" placeholder="Zip / Postal Code *">
								<input type="text" name="state" id="state" placeholder="State *">
								<input type="text" name="city" id="city" placeholder="City *">
								<input type="text" name="mobile" id="mobile" placeholder="Mobile Phone">
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<order-message></order-message>
						<div class="w-100 text-center">
							<div id="form-container" class="sq-payment-form">
								<div class="sq-field">
									<label class="sq-label">Card Number</label>
									<div id="sq-card-number"></div>
								</div>
								<div class="sq-field-wrapper">
									<div class="sq-field sq-field--in-wrapper">
										<label class="sq-label">CVV</label>
										<div id="sq-cvv"></div>
									</div>
									<div class="sq-field sq-field--in-wrapper">
										<label class="sq-label">Expiration</label>
										<div id="sq-expiration-date"></div>
									</div>
									<div class="sq-field sq-field--in-wrapper">
										<label class="sq-label">Postal Code</label>
										<div id="sq-postal-code"></div>
									</div>
								</div>
								<button id="sq-creditcard" class="button-credit-card btn btn-default check_out" onclick="onGetCardNonce(event)">Complete Order</button>
								<div id="success">successfully paid</div>
							</div>
						</div>
						<div>

							<!-- <button class="btn btn-default check_out">Complete</button> -->
						</div>
					</div>
				</div>
			</div>
			<!-- </form> -->
		</div>

	</div>
</section>
<!--/#cart_items-->


@endsection
@section('scriptTag')

<script defer>
	$('#success').hide();
	const paymentForm = new SqPaymentForm({
		// Initialize the payment form elements
		//TODO: Replace with your sandbox application ID
		applicationId: "sandbox-sq0idb-ZXZZZ5sqf2yk-wdMl_enmQ",
		inputClass: 'sq-input',
		autoBuild: false,
		// Customize the CSS for SqPaymentForm iframe elements
		inputStyles: [{
			fontSize: '16px',
			lineHeight: '24px',
			padding: '16px',
			placeholderColor: '#a0a0a0',
			backgroundColor: 'transparent',
		}],
		// Initialize the credit card placeholders
		cardNumber: {
			elementId: 'sq-card-number',
			placeholder: 'Card Number'
		},
		cvv: {
			elementId: 'sq-cvv',
			placeholder: 'CVV'
		},
		expirationDate: {
			elementId: 'sq-expiration-date',
			placeholder: 'MM/YY'
		},
		postalCode: {
			elementId: 'sq-postal-code',
			placeholder: 'Postal'
		},
		// SqPaymentForm callback functions
		callbacks: {
			/*
			 * callback function: cardNonceResponseReceived
			 * Triggered when: SqPaymentForm completes a card nonce request
			 */
			cardNonceResponseReceived: function(errors, nonce, cardData) {
				if (errors) {
					// Log errors from nonce generation to the browser developer console.
					console.error('Encountered errors:');
					errors.forEach(function(error) {
						console.error('  ' + error.message);
					});
					alert('Encountered errors, check browser developer console for more details');
					return;
				}
				//TODO: Replace alert with code in step 2.1
				//  alert('here is your card token ' + nonce);
				$('#success').hide();
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url: "{{ route('add-card') }}",
					type: "POST",
					data: {
						nonce,
						firstname: $("#firstname").val(),
						lastname: $("#lastname").val(),
						address1: $("#address1").val(),
						address2: $("#address2").val(),
						zip: $("#zip").val(),
						state: $("#state").val(),
						city: $("#city").val(),
						mobile: $("#mobile").val(),
					},
					success: function(data) {
						$('#success').removeClass("alert")
						$('#success').removeClass("alert-danger")
						if (data == "field") {
							$('#success').show()
							$('#success').html("All fields are required")
							$('#success').addClass("alert")
							$('#success').addClass("alert-danger")
							return false;
						}
						if (data == false) {
							$('#success').addClass("alert")
							$('#success').addClass("alert-danger")
							$('#success').html("An error occur, while processing your request")
							console.log(data)
							return false;

						}
						window.location.assign("/order-complete")
					},
					error: function(xhr, status, error) {
						console.log('error', error)
					}
				});
			}
		}
	});
	paymentForm.build();
	// onGetCardNonce is triggered when the "Pay $1.00" button is clicked
	function onGetCardNonce(event) {
		// Don't submit the form until SqPaymentForm returns with a nonce
		event.preventDefault();
		// Request a nonce from the SqPaymentForm object
		paymentForm.requestCardNonce();
	}
</script>

@endsection