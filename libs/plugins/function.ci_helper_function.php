<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty {ci_helper_function} function plugin
 *
 * Type:     function<br>
 * Name:     ci_url_title<br>
 * Purpose:  bridge to code igniter helper's function
 * @author Zachie du Bruyn
 * @param array Format:
 * <pre>
 * array(
 *   'name' => required name of the function
 *   'helper' => required name of the ci helper
 *   'params' => optional comma seprated params values for function
 *   'assign' => optional smarty variable name to assign to
 * )
 * </pre>
 * @param Smarty
 */
function smarty_function_ci_helper_function($params, &$smarty)
{
        if ($smarty->debugging) {
            $_params = array();
            require_once(SMARTY_CORE_DIR . 'core.get_microtime.php');
            $_debug_start_time = smarty_core_get_microtime($_params, $smarty);
        }

        $_name = isset($params['name']) ? $params['name'] : '';
        $_helper = isset($params['helper']) ? $params['helper'] : '';
        $_params = isset($params['params']) ? explode(',',$params['params']) : '';
        $_assign = isset($params['assign']) ? $params['assign'] : '';

        if ($_name != '' && $_helper != '')
        {
		    // get a Code Igniter instance
		    $CI = &get_instance();
            $CI->load->helper($_helper);
		    $value = '';


            if (is_callable($_name))
            {
                if ($_params == '' || count($_params) == 0)
                {
                    $value = $_name();
                }
                else
                {
                    $value = call_user_func_array($_name, $_params);
                }
            }

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
