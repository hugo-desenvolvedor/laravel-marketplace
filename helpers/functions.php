<?php

/**
 * Get items from specific store
 *
 * @param $items
 * @param $storeId
 * @return array|null
 */
function filterItemsByStoreId(array $items, $storeId): ?array
{
    if (!is_numeric($storeId)) {
        return null;
    }

    return array_filter(
        $items,
        function ($value) use ($storeId) {
            return $value['store_id'] == $storeId;
        }
    );
}
