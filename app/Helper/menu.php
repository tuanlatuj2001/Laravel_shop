<?php
function has_child($data, $parent_id)
{
    foreach ($data as $v) {
        if ($v['parent_id'] == $parent_id) {
            return true;
        }
    }
}
function render_menu($data, $parent_id = 0, $level = 0)
{
    if ($level == 0) {
        $result = "<ul class='list-item'>";
    } else {
        $result = "<ul class='sub-menu'>";
    }
    foreach ($data as $v) {
        if ($v['parent_id'] == $parent_id) {
            $result .= '<li>';
            $result .= "<a href='#'>{$v['catalog_name']}</a>";
            if (has_child($data, $v['catalog_id'])) {
                $result .= render_menu($data, $v['parent_id'], $level + 1);
            }
            $result .= '</li>';
        }
    }
    $result .= '</ul>';
    return $result;
}