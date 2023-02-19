<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.js"></script>
<?php
global $wpdb;
$user_id = get_current_user_id();
if(isset($_POST["submit"])){
    $data["firebase_config"] = $_POST["firebase_config"];
    foreach ($data as $key => $value) {
        update_option($key, $value);
    }
}
?>
<h1>Firebase Config</h1>
<form method="post" enctype="multipart/form-data">
<textarea name="firebase_config" cols="70" rows="15"><?php echo wp_unslash(get_option("firebase_config")); ?></textarea>
<br>
<input type="submit" name="submit" value="Save" class="ui blue mini button"></td>
</form>

<hr>

<h2>Use this shortcode <pre style="display:inline;">[login_otp_phone_number]</pre> to display login form</h2>