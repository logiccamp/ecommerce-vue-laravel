cardNonceResponseReceived: function(errors, nonce, cardData) {
if (errors) {
// Log errors from nonce generation to the browser developer console.
console.error('Encountered errors:');
errors.forEach(function(error) {
console.error(' ' + error.message);
});
alert('Encountered errors, check browser developer console for more details');
return;
}
//TODO: Replace alert with code in step 2.1
// alert('here is your card token ' + nonce);
$('#success').hide();
$.ajax({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},
url: "{{ route('add-card') }}",
type: "POST",
data: {
nonce
},
success: function(data) {
$('#success').show();
console.log('data', data);
},
error: function(xhr, status, error) {
console.log('error', error)
}
});
}