<?php
/**
 * Contactical plugin for Craft CMS 3.x
 *
 * Simple fieldtype for capturing contact details
 *
 * @link      http://ournameismud.co.uk/
 * @copyright Copyright (c) 2018 @cole007
 */

namespace ournameismud\contactical\assetbundles\contacticalfieldfield;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    @cole007
 * @package   Contactical
 * @since     0.0.1
 */
class ContacticalFieldFieldAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@ournameismud/contactical/assetbundles/contacticalfieldfield/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/ContacticalField.js',
        ];

        $this->css = [
            'css/ContacticalField.css',
        ];

        parent::init();
    }
}
