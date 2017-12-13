<?php declare(strict_types=1);

namespace Shopware\Order\Event\OrderDelivery;

use Shopware\Api\Entity\Write\WrittenEvent;
use Shopware\Order\Definition\OrderDeliveryDefinition;

class OrderDeliveryWrittenEvent extends WrittenEvent
{
    const NAME = 'order_delivery.written';

    public function getName(): string
    {
        return self::NAME;
    }

    public function getDefinition(): string
    {
        return OrderDeliveryDefinition::class;
    }
}
