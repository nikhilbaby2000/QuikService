<?php

namespace App\QuikService\Libraries\QueryFilter;

interface FilterContract
{
    /**
     * The available filters.
     *
     * @return array
     */
    public function filters();
}
