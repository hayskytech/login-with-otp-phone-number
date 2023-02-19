<script src="https://www.gstatic.com/firebasejs/8.3.3/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.3/firebase-auth.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<style type="text/css">
  #verificationCode,#verifyBtn{
    display: none !important;
  }
  #myForm{
    max-width: 400px;
    border: 2px solid black;
    border-radius: 30px;
    padding: 50px;
    text-align: center;
  }
  label{
    margin: 10px;
    display: block;
    font-size: 20px;
  }
  #myForm input[type=text]{
    font-size: 20px;
    margin: 10px;
    text-align: center;
  }
</style>
<form id="myForm">
  <label>Phone Number: (10 digits)</label>
  <input type="text" id="phoneNumber" maxlength="10">
  <div id="recaptcha-container"></div>
  <input type="text" id="verificationCode" placeholder="Enter OTP" maxlength="6">
  <!-- <input type="text" id="password" placeholder="Enter your Password"> -->
  <button type="button" onclick="sendOTP()" id="sendBtn">Send OTP</button>
  <!-- <button type="button" onclick="enterPassword()" id="enterPassword">Enter Password</button> -->
  <button type="button" onclick="verifyOTP()" id="verifyBtn">Verify OTP</button>
</form>

<script type="text/javascript">
// Initialize Firebase
<?php
echo wp_unslash(get_option("firebase_config"));
?>

firebase.initializeApp(firebaseConfig);

 var verifier = null;
  window.onload = function() {
    verifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
  };

  // Define the sendOTP and verifyOTP functions
  function sendOTP() {
    var phoneNumber = "+91"+document.getElementById('phoneNumber').value;
    firebase.auth().signInWithPhoneNumber(phoneNumber, verifier)
      .then(function (confirmationResult) {
        window.confirmationResult = confirmationResult;
        document.getElementById('verificationCode').style.display = 'block';
        document.getElementById('verifyBtn').style.display = 'inline-block';
        document.getElementById('sendBtn').style.display = 'none';
        document.getElementById('recaptcha-container').style.display = 'none';
        document.getElementById('phoneNumber').setAttribute('readonly','');
      }).catch(function (error) {
        console.log(error);
      });
  }

  function verifyOTP() {
  var verificationCode = document.getElementById('verificationCode').value;
  confirmationResult.confirm(verificationCode)
    .then(function (result) {
      // Get the user's phone number from the verification result
      var phoneNumber = result.user.phoneNumber;
var ajaxurl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
    pNumber = phoneNumber.substring(1);
    console.log(pNumber);
      // Use the phone number to look up the user in WordPress
      var data = {
        action: 'login_with_otp',
        phone: pNumber
      };
      jQuery.post(ajaxurl, data, function (response) {
        if (response.success) {
            window.location.href = '<?php echo get_permalink(); ?>';
        } else {
          console.log(response.data);
        }
      });
    }).catch(function (error) {
      console.log(error);
    });
}
</script>