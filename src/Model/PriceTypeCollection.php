<?php namespace Zenwalker\CommerceML\Model;

use Zenwalker\CommerceML\ORM\Collection;

class PriceTypeCollection extends Collection
{
    /**
     * Get price type by id.
     *
     * @param $type
     * @return string
     */
    public function getType($type)
    {
        return $this->get($type)->type;
    }
}
