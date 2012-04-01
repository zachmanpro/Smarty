<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty {ci_url_title} function plugin
 *
 * Type:     function<br>
 * Name:     ci_url_title<br>
 * Purpose:  bridge to code igniter url_title function
 * @author Zachie du Bruyn
 * @param array Format:
 * <pre>
 * array(
 *   'value' => required value of the url_title
 *   'assign' => optional smarty variable name to assign to
 * )
 * </pre>
 * @param Smarty
 */
function smarty_function_ci_url_title($params, &$smarty)
{
        if ($smarty->debugging) {
            $_params = array();
            require_once(SMARTY_CORE_DIR . 'core.get_microtime.php');
            $_debug_start_time = smarty_core_get_microtime($_params, $smarty);
        }

        $_value = isset($params['value']) ? $params['value'] : '';
        $_assign = isset($params['assign']) ? $params['assign'] : '';

        if ($_value != '')
        {
		    // get a Code Igniter instance
		  //  $CI = &get_instance();
		    $value = '';

            $value = url_title($_value);
            if (!empty($_assign))
            {
                $smarty->assign( $_assign, $value );
            }
            else
            {
                return $value;
            }

		}

        if ($smarty->debugging) {
            $_params = array();
            require_once(SMARTY_CORE_DIR . 'core.get_microtime.php');
            $smarty->_smarty_debug_info[] = array('type'      => 'config',
                                                'filename'  => $_file.' ['.$_section.'] '.$_scope,
                                                'depth'     => $smarty->_inclusion_depth,
                                                'exec_time' => smarty_core_get_microtime($_params, $smarty) - $_debug_start_time);
        }

}

/* vim: set expandtab: */

?>
