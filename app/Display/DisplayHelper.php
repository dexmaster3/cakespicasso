<?php

class Display_DisplayHelper
{
    function renderLayoutContent($layout_string)
    {
        if (!empty($layout_string)) {
            $page = new Layouts_Model_Layout();
            $found_matches = preg_match_all('/(?:{{layout_id=([\d]{1,})}})/im', $layout_string, $layout_matches);
            if ($found_matches) {
                for ($i = 0; $i < count($layout_matches[1]); $i++) {
                    $found_page = $page->findById($layout_matches[1][$i]);
                    $found_content = html_entity_decode($found_page['layout_content']);
                    if (!empty($found_content)) {
                        $layout_string = str_replace($layout_matches[0][$i], $found_content, $layout_string);
                    } else {
                        $layout_string = str_replace($layout_matches[0][$i], "Layout Not Found", $layout_string);
                    }
                }
            }
            if (preg_match('/(?:{{layout_id=([\d]{1,})}})/im', $layout_string)) {
                return $this->renderLayoutContent($layout_string);
            } else {
                return $layout_string;
            }
        }
        echo "Invalid display layout";
    }
}