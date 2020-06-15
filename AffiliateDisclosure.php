<?php 
/** 
Plugin Name: Simple Affiliate Disclosure Plugin
Description: Use this plugin to add the FTC required affiliate disclosure to every post on your blog automatically. 
Plugin URI: http://www.CorrespondwithJohn.com/
Author: John Morgan
Version: 1.0
Author URI: http://www.CorrespondWithJohn.com/
**/
function disclose_submenu() {
    add_submenu_page('edit.php', 'Simple Affiliate Disclosure', 'Simple Affiliate Disclosure', 'manage_options', 'disclose_submenu', 'disclose_admin_page');
}

add_action('admin_menu', 'disclose_submenu');

function disclose_admin_page() {
    
    if(array_key_exists('submit_disclosure_update', $_POST)) {
        update_option('simple_disclosure_before', $_POST['disclose_before']);
        update_option('simple_disclosure_after', $_POST['disclose_after']);

        ?>
            <div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"><strong>Your Disclosures Have Been Updated!</strong></div>
        <?php
    }

    $disclose_before = get_option('simple_disclosure_before', 'none');
    $disclose_after = get_option('simple_disclosure_after', 'none');
    ?>
    <div class="wrap">
        <h2>Simple Affiliate Disclosure Plugin Settings</h2>

        <p>Thanks for using the Simple Affiliate Disclosure Plugin. Our plugin was developed to make it easy for you to add an affiliate disclosure as required by the FTC on to any post that is promoting a product/service where you receive a commission on the sale. To be on the safe side, this plugin will automatically add it to all of the blog posts you currently have published and also publish in the future. To learn more about Affiliate Disclosures you can check out my blog post <a href="http://correspondwithjohn.com/business/affiliate-marketing-disclosures" target="_blank">"Affiliate Marketing Disclosures: A Legal Requirement"</a></p>

        <p>For your convienence we have added the capability to choose if you want your disclosure to be added to the beginning or the end of your post (or both if you wanted to). You can also use one or both areas to place a string of text automatically to all of your posts. So for example, you can have it set to show a disclosure at the beginning of the post, and at the end of the post a generic Call to Action for readers to leave a comment, etc.</p>

        <p>If you run into any issues, check out our <a href="#" target="_blank">Documentation</a>. If you can't find an answer there, feel free to jump on the <a href="#" target="_blank">Support Area</a> and post your questions, issues, and/or feedback.</p>

        <p>Also as a final note, if you would like to <a href="#" target="_blank">Support the Plugin</a> you could make a small donation to help me out as I continue to create, update, and support more WordPress developments. If you're needing help with your WordPress Site or need some work done or have a need for a consultant (SEO, Inbound Marketing, Content Marketing, Email Marketing, etc.), <a href="http://www.CorrespondWithJohn.com/" target="_blank">head to my web site!</a></p>
    
        <form method="post" action="">
            <label for="disclose_before" class=""><strong>Add Disclosure Before Post Content</strong></label><br><br>
            <textarea name="disclose_before" class="large-text" rows="8"><?php print stripslashes($disclose_before); ?></textarea><br><br>
        
            <label for="disclose_after" class=""><strong>Add Disclosure After Post Content</strong></label><br><br>
            <textarea name="disclose_after" class="large-text" rows="8"><?php print stripslashes($disclose_after); ?></textarea><br><br>
        
            <input type="submit" name="submit_disclosure_update" class="button button-primary" value="Save Settings">
        </form>

        <p>An Example Affiliate Disclosure you can use before your blog post content:</p>

        <p>Disclosure: Some of the links in this post are compensated affiliate links. What this means is that if you click on the link and make a purchase I will make a commission on that sale. Keep in mind that I link these companies and their products because of their quality and not because of the commission I receive from your purchases. However, by making a purchase through these links you will be helping support my blog with no additional cost to you. Ultimately though, the decision is yours, and whether or not you decide to buy something is completely up to you.</p>

        <p>Need Help with Your WordPress Site? You can hire the developer of the Simple Affiliate Disclosure Plugin, John Morgan, to assist you. Head over to his site located at <a href="http://www.correspondwithjohn.com" target="_blank">http://www.CorrespondWithJohn.com/</a> to learn more!</p>
    </div>
    <?php
}

function disclosure_insertion($content) {
    if(is_single() && is_main_query()) {
        $disclose_before = get_option('simple_disclosure_before', 'none');
        $disclose_after = get_option('simple_disclosure_after', 'none');

        $content = $disclose_before . $content . $disclose_after;    
    } 

    return $content;
} 

add_filter( 'the_content', 'disclosure_insertion' );
?>