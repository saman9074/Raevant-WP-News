<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="wrap">
    <div class="testbox">
        <form action="" method="post">
            <div class="banner">
                <h1 class="RBAPP_title"><?php _e('Raevant Blog App - Settings','RBAPP') ?></h1>
            </div>
<!--            <p class="top-info">Want to become a member of our Gym? Then start by filling our form to complete registration. We will contact you shortly to notify you about your membership card.</p>-->
            <div class="item">
                <p><?php _e('Send new post notification','RBAPP') ?><span class="required">*</span></p>
                <div class="item">
                    <select name="RBAPP_npn">
                        <option value="enable" <?php if(RBAPP_SETTING_DATA_New['3'] == 'enable'){ echo ' selected="selected"'; } ?> ><?php _e('enable','CPW') ?></option>
                        <option value="disable" <?php if(RBAPP_SETTING_DATA_New['3'] == 'disable'){ echo ' selected="selected"'; } ?> ><?php _e('disable','CPW') ?></option>
                    </select>
            </div>


            <div class="item">
                <p><?php _e('Send update post notification','RBAPP') ?><span class="required">*</span></p>
                <div class="item">
                    <select name="RBAPP_upn">
                        <option value="enable" <?php if(RBAPP_SETTING_DATA_New['4'] == 'enable'){ echo ' selected="selected"'; } ?> ><?php _e('enable','CPW') ?></option>
                        <option value="disable" <?php if(RBAPP_SETTING_DATA_New['4'] == 'disable'){ echo ' selected="selected"'; } ?> ><?php _e('disable','CPW') ?></option>
                    </select>
            </div>


                <p><?php _e('API Provider','RBAPP') ?><span class="required">*</span></p>
                <div class="item">
                    <select name="api_provider">
                        <option value="coinmarketcap" <?php if(RBAPP_SETTING_DATA_New['1'] == 'najva'){ echo ' selected="selected"'; } ?> >najva</option>
                        <option value="cryptocompare" --><?php if(CPW_SETTING_DATA['1'] == 'push-pole'){ echo ' selected="selected"'; } ?>>push-pole</option>
                    </select>
                </div>

                <p><?php _e('API Key','RBAPP') ?><span class="required">*</span></p>
                <div class="item">
                    <input type="text" name="apikey" placeholder="<?php _e('eg: f235ca3b-c315-4960-a8f8-************','CPW') ?>" value='<?php echo isset(RBAPP_SETTING_DATA_New['2']) ? RBAPP_SETTING_DATA_New['2']:''; ?>' required/>
                </div>

                
                <!-- <div class="item">
                    <p><?php _e('Symbols of cryptocurrencies that you want to show.','CPW') ?><span class="required">*</span></p>
                    <input type="text" name="symbols" placeholder="<?php _e('eg: btc,eth,trx, and other','CPW') ?>" value='<?php echo isset(RBAPP_SETTING_DATA_New['3']) ? RBAPP_SETTING_DATA_New['3'] : ''; ?>' required/>
                </div>

                <p><?php _e('Currency','CPW') ?><span class="required">*</span> <?php _e('(only for redirect link)','CPW') ?></p>
                <div class="item">
                    <input type="text" name="Currency" placeholder="<?php _e('eg: usd or eur','CPW') ?>" value='<?php echo isset(RBAPP_SETTING_DATA_New['4']) ? RBAPP_SETTING_DATA_New['4']:''; ?>' required/>
                </div> -->


            </div>
            <div class="btn-block">
                <button type="submit" name="saveSettings"><?php _e('Save','RBAPP') ?></button>
            </div>
        </form>
    </div>
</div>
