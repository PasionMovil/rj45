<?php

function at_options_page() {

    $twt_ck = $_POST['twt_ck'] ? $_POST['twt_ck'] : get_option('twt_ck');
    $twt_cs = $_POST['twt_cs'] ? $_POST['twt_cs'] : get_option('twt_cs');
    $twt_ut = $_POST['twt_ut'] ? $_POST['twt_ut'] : get_option('twt_ut');
    $twt_us = $_POST['twt_us'] ? $_POST['twt_us'] : get_option('twt_us');

    if ($twt_ck)
        update_option('twt_ck', $twt_ck);

    if ($twt_cs)
        update_option('twt_cs', $twt_cs);

    if ($twt_ut)
        update_option('twt_ut', $twt_ut);

    if ($twt_us)
        update_option('twt_us', $twt_us);


    ob_start();
?>
    <div class="wrap">
        <h1>Awesome Twitter Widget</h1>
        
        <form method="post" action="options-general.php?page=at-options.php">
            <div class="input-wrapper">
                <label for="twt_ck">Consumer Key</label>
                <input type="text" id="twt_ck" name="twt_ck" value="<?php echo $twt_ck; ?>" placeholder="Consumer Key" />
            </div>
            <div class="input-wrapper">
                <label for="twt_ck">Consumer Secret</label>
                <input type="text" id="twt_cs" name="twt_cs" value="<?php echo $twt_cs; ?>" placeholder="Consumer Secret" />
            </div>
            <div class="input-wrapper">
                <label for="twt_ck">Access Token</label>
                <input type="text" id="twt_ut" name="twt_ut" value="<?php echo $twt_ut; ?>" placeholder="Access Token" />
            </div>
            <div class="input-wrapper">
                <label for="twt_ck">Access Token Secret</label>
                <input type="text" id="twt_us" name="twt_us" value="<?php echo $twt_us; ?>" placeholder="Access Token Secret" />
            </div>
                <!-- <input type="submit" value="Save" /> -->
                <?php submit_button(); ?>
            <div class="input-wrapper">
            </div>
        </form>

    </div>

<?php
    echo ob_get_clean();
}

function at_add_options_link() {
    global $at_settings_page;

    $at_settings_page = add_options_page('Awesome Twitter', 'Awesome Twitter', 'manage_options', 'at-options.php', 'at_options_page');

    // add_action('admin_print_styles-' . $at_settings_page, 'at_load_scripts');
}

add_action('admin_menu', 'at_add_options_link');