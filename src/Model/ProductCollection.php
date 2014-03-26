<?php namespace Zenwalker\CommerceML\Model;

use Zenwalker\CommerceML\ORM\Collection;

class ProductCollection extends Collection
{
    /**
     * Translate price types id to string.
     *
     * @param PriceTypeCollection $priceTypeCollection
     * @return void
     */
    public function attachPriceTypeCollection($priceTypeCollection)
    {
        foreach ($this->fetch() as $product) {
            foreach ($product->price as $id => &$price) {
                $type = $priceTypeCollection->getType($id);
                if ($type) $price['type'] = $type;
            }
        }
    }
}
