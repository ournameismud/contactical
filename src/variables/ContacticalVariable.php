<?php
/**
 * Contactical plugin for Craft CMS 3.x
 *
 * Simple fieldtype for capturing contact details
 *
 * @link      http://ournameismud.co.uk/
 * @copyright Copyright (c) 2018 @cole007
 */

namespace ournameismud\contactical\variables;

use ournameismud\contactical\Contactical;

use Craft;

/**
 * @author    @cole007
 * @package   Contactical
 * @since     0.0.1
 */
class ContacticalVariable
{
    // Public Methods
    // =========================================================================

    /**
     * @param null $optional
     * @return string
     */
    public function exampleVariable($optional = null)
    {
        $result = "And away we go to the Twig template...";
        if ($optional) {
            $result = "I'm feeling optional today...";
        }
        return $result;
    }
}
