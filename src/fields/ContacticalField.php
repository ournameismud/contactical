<?php
/**
 * Contactical plugin for Craft CMS 3.x
 *
 * Simple fieldtype for capturing contact details
 *
 * @link      http://ournameismud.co.uk/
 * @copyright Copyright (c) 2018 @cole007
 */

namespace ournameismud\contactical\fields;

use ournameismud\contactical\Contactical;
use ournameismud\contactical\assetbundles\contacticalfieldfield\ContacticalFieldFieldAsset;

use Craft;
use craft\base\ElementInterface;
use craft\base\Field;
use craft\helpers\Db;
use yii\db\Schema;
use craft\helpers\Json;

/**
 * @author    @cole007
 * @package   Contactical
 * @since     0.0.1
 */
class ContacticalField extends Field
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $contacticalAddress = 1,
        $contacticalWeb = 1,
        $contacticalEmail = 1,
        $contacticalFax = 1,
        $contacticalTelephone = 1,
        $contacticalLocation = 1;

    // Static Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('contactical', 'Contactical Field');
    }

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules = array_merge($rules, [
            ['contacticalAddress', 'boolean'],
            ['contacticalWeb', 'boolean'],
            ['contacticalEmail', 'boolean'],
            ['contacticalTelephone', 'boolean'],
            ['contacticalFax', 'boolean'],
            ['contacticalLocation', 'boolean'],
        ]);
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function getContentColumnType(): string
    {
        return Schema::TYPE_TEXT;
    }

    /**
     * @inheritdoc
     */
    public function normalizeValue($value, ElementInterface $element = null)
    {
        return $value;
    }

    /**
     * @inheritdoc
     */
    public function serializeValue($value, ElementInterface $element = null)
    {
        return parent::serializeValue($value, $element);
    }

    /**
     * @inheritdoc
     */
    public function getSettingsHtml()
    {
        // Render the settings template
        return Craft::$app->getView()->renderTemplate(
            'contactical/_components/fields/ContacticalField_settings',
            [
                'field' => $this,
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function getInputHtml($value, ElementInterface $element = null): string
    {
        // Register our asset bundle
        Craft::$app->getView()->registerAssetBundle(ContacticalFieldFieldAsset::class);

        // Get our id and namespace
        $id = Craft::$app->getView()->formatInputId($this->handle);
        $namespacedId = Craft::$app->getView()->namespaceInputId($id);

        // Variables to pass down to our field JavaScript to let it namespace properly
        $jsonVars = [
            'id' => $id,
            'name' => $this->handle,
            'namespace' => $namespacedId,
            'prefix' => Craft::$app->getView()->namespaceInputId(''),
            ];
        $jsonVars = Json::encode($jsonVars);
        Craft::$app->getView()->registerJs("$('#{$namespacedId}-field').ContacticalContacticalField(" . $jsonVars . ");");

        // Render the input template
        return Craft::$app->getView()->renderTemplate(
            'contactical/_components/fields/ContacticalField_input',
            [
                'name' => $this->handle,
                'value' => json_decode($value),
                'field' => $this,
                'id' => $id,
                'namespacedId' => $namespacedId,
            ]
        );
    }
}
