<?php declare(strict_types=1);

namespace Shopware\Framework\Writer\Resource;

use Shopware\Context\Struct\TranslationContext;
use Shopware\Framework\Event\PluginRecommendationsWrittenEvent;
use Shopware\Framework\Write\Field\IntField;
use Shopware\Framework\Write\Flag\Required;
use Shopware\Framework\Write\WriteResource;

class PluginRecommendationsWriteResource extends WriteResource
{
    protected const CATEGORYID_FIELD = 'categoryID';
    protected const BANNER_ACTIVE_FIELD = 'bannerActive';
    protected const NEW_ACTIVE_FIELD = 'newActive';
    protected const BOUGHT_ACTIVE_FIELD = 'boughtActive';
    protected const SUPPLIER_ACTIVE_FIELD = 'supplierActive';

    public function __construct()
    {
        parent::__construct('s_plugin_recommendations');

        $this->fields[self::CATEGORYID_FIELD] = (new IntField('categoryID'))->setFlags(new Required());
        $this->fields[self::BANNER_ACTIVE_FIELD] = (new IntField('banner_active'))->setFlags(new Required());
        $this->fields[self::NEW_ACTIVE_FIELD] = (new IntField('new_active'))->setFlags(new Required());
        $this->fields[self::BOUGHT_ACTIVE_FIELD] = (new IntField('bought_active'))->setFlags(new Required());
        $this->fields[self::SUPPLIER_ACTIVE_FIELD] = (new IntField('supplier_active'))->setFlags(new Required());
    }

    public function getWriteOrder(): array
    {
        return [
            self::class,
        ];
    }

    public static function createWrittenEvent(array $updates, TranslationContext $context, array $rawData = [], array $errors = []): PluginRecommendationsWrittenEvent
    {
        $event = new PluginRecommendationsWrittenEvent($updates[self::class] ?? [], $context, $rawData, $errors);

        unset($updates[self::class]);

        if (!empty($updates[self::class])) {
            $event->addEvent(self::createWrittenEvent($updates, $context));
        }

        return $event;
    }
}