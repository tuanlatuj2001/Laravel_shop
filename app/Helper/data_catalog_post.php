<?php
function data_catalog_post($data, $parent_id = 0, $level = 0)
{
    $result = [];
    foreach ($data as $item) {
        if ($item['parent_id'] == $parent_id) {
            $item['level'] = $level;
            $result[] = $item;
            $child = data_tree($data, $item['catalog_post_id'], $level + 1);
            $result = array_merge($result, $child);
        }
    }
    return $result;
}