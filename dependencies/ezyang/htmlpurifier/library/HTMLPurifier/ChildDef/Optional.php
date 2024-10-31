<?php

/**
 * Definition that allows a set of elements, and allows no children.
 * @note This is a hack to reuse code from BracketSpace_Notification_Dependencies_HTMLPurifier_ChildDef_Required,
 *       really, one shouldn't inherit from the other.  Only altered behavior
 *       is to overload a returned false with an array.  Thus, it will never
 *       return false.
 *
 * @license LGPL-2.1-or-later
 * Modified by bracketspace on 02-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */
class BracketSpace_Notification_Dependencies_HTMLPurifier_ChildDef_Optional extends BracketSpace_Notification_Dependencies_HTMLPurifier_ChildDef_Required
{
    /**
     * @type bool
     */
    public $allow_empty = true;

    /**
     * @type string
     */
    public $type = 'optional';

    /**
     * @param array $children
     * @param BracketSpace_Notification_Dependencies_HTMLPurifier_Config $config
     * @param BracketSpace_Notification_Dependencies_HTMLPurifier_Context $context
     * @return array
     */
    public function validateChildren($children, $config, $context)
    {
        $result = parent::validateChildren($children, $config, $context);
        // we assume that $children is not modified
        if ($result === false) {
            if (empty($children)) {
                return true;
            } elseif ($this->whitespace) {
                return $children;
            } else {
                return array();
            }
        }
        return $result;
    }
}

// vim: et sw=4 sts=4
