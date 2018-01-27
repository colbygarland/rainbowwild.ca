<?php
/**
*
* @since             1.0.0
* @package           IDP_Funktions
*
* @wordpress-plugin
* Plugin Name:       ! Image Design Funktions !
* Plugin URI:        http://imagedesignpros.com/
* Description:       Add some Funk with these pre-built custom funk-tions.
* Version:           1.2.0
* Author:            Marcus Vanstone
* Author URI:        http://imagedesignpros.com
* License:           GPL-2.0+
* License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
* Text Domain:       idp-functions
* Domain Path:       /languages

SETTING FORMAT

array(

	array( {fieldtype:text,textarea,truefalse,info}, {name/id}, {label}, {help/info}, {defaultvalue}, {help/info css styles} ) 

)

*/
/*require 'plugin-updates/plugin-update-checker.php';
$MyUpdateChecker = PucFactory::buildUpdateChecker('http://idmail.ca/wpplugins/info.json', __FILE__, 'idp-funktions');
if (!is_array($FNKOP))
    $FNKOP = array();*/
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
} //!defined('WPINC')
class idpFunktions
{
    private $options;
    public function __construct()
    {
        add_action('admin_menu', array(
            $this,
            'FunkMenu'
        ));
        add_action('admin_init', array(
            $this,
            'Register'
        ));
    }
    public function Register()
    {
        global $FNKOP;
        register_setting('idp-funktions-group', 'funktions');
    }
    public function FunkMenu()
    {
        add_options_page('Funk-tions', 'Funk-tions', 'manage_options', 'idp-funktions', array(
            $this,
            'FunkPage'
        ));
    }
    public function FunkPage()
    {
        if (!current_user_can('manage_options'))
            wp_die(__('You are not authorized to access this page.'));
        //FUNCTION INCLUDES
        $loc  = str_replace('idp-funktions.php', '', __FILE__);
        $path = str_replace(get_option('siteurl') . '/', ABSPATH, $loc) . 'functions/';
        echo '<div class="wrap">';
        echo '<h2>Image Design Funk-tions</h2>';
?>



        <form method="post" action="options.php">



        	<?php
        settings_fields('idp-funktions-group');
?>



		    <?php
        do_settings_sections('idp-funktions-group');
?>



            <?php
        $funkset = get_option('funktions'); // print_r($funkset);
?>



            <table class="form-table">

				<tr>

                	<th>Function Name</th><th style="width:auto">Options</th>

                </tr>
                    	<?php
        global $FNKOP;
        //print_r($FNKOP);
        $funkops = scandir($path);
        unset($funkops[0]);
        unset($funkops[1]);
        foreach ($funkops as $fop):
            if ($fop != 'index.php' && strpos($fop, '.php') == true) {
                $fp     = str_replace('.php', '', $fop);
                $funknm = ucwords(str_replace(array(
                    '-',
                    '.php'
                ), array(
                    ' ',
                    ''
                ), $fop));
                if (in_array($fop, $funkset)) {
                    $chk   = 'checked';
                    $style = 'font-weight:bold; color:#000;';
                } //in_array($fop, $funkset)
                else {
                    $chk   = false;
                    $style = 'font-weight:normal; color:#999;';
                }
                echo '<tr valign="top"><th scope="row"><label style="' . $style . '" for="' . $fp . '"><input name="funktions[]" type="checkbox" id="' . $fp . '" value="' . $fp . '.php" ' . $chk . '> ' . $funknm . '</label></th><td>' . $this->settings($fp) . '</td></tr>';
            } //$fop != 'index.php' && strpos($fop, '.php') == true
        endforeach;
?>



                    

                    



            



            </table>



            <?php
        submit_button();
?>



        </form>



        <?php
        echo '</div>';
    }
    /* array(
    
    array( {FNK[0]fieldtype:text,textarea,truefalse,info }, {FNK[1]name/id}, {FNK[2]label}, {FNK[3]help/info}, {FNK[4]defaultvalue}, {FNK[5]help/info css styles} ) 
    
    )*/
    function settings($fop)
    {
        global $FNKOP;
        $funkset = get_option('funktions');
		if( is_array($FNKOP[$fop]) ):
        foreach ($FNKOP[$fop] as $FNK):
            $val = ($funkset[$FNK[1]] ? $funkset[$FNK[1]] : $FNK[4]);
            switch ($FNK[0]) {
                case 'info':
                    $out[] = '<span style="' . $FNK[5] . '">' . $FNK[3] . '</span>';
                    break;
                case 'text':
                    $out[] = '<label>' . $FNK[2] . ' <input type="text" class="large-text code" name="funktions[' . $FNK[1] . ']" value="' . $val . '"></label>';
                    break;
                case 'textarea':
                    $out[] = '<label>' . $FNK[2] . '<br><textarea style="width:95%;min-height:100px" name="funktions[' . $FNK[1] . ']">' . $val . '</textarea></label>';
                    break;
                case 'truefalse':
                    $chk = false;
                    if ($val)
                        $chk = 'checked';
                    $out[] = '<label><input type="checkbox" name="funktions[' . $FNK[1] . ']" ' . $chk . '> ' . $FNK[2] . '</label>';
                    break;
            } //$FNK[0]
        endforeach;
		
		if( is_array($out) )
	        return implode('<br>', $out);
		endif;
    }
}
$loc  = str_replace('idp-funktions.php', '', __FILE__);
$path = str_replace(get_option('siteurl') . '/', ABSPATH, $loc) . 'functions/';
$funk = get_option('funktions');
if (is_array($funk)) {
    foreach ($funk as $fnk) {
        if (strpos($fnk, '.php') !== false)
            include_once($path . $fnk);
        //echo $path.$fnk.'.php<br>';
    } //$funk as $fnk
} //is_array($funk)
if (is_admin())
    $Funktion = new idpFunktions();

