<?php

class Core_View_ViewDriver
{
    static public function renderLayoutContent($layout_string)
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
                return self::renderLayoutContent($layout_string);
            } else {
                return $layout_string;
            }
        }
        echo "Invalid display layout";
    }

    static public function insertBodyContent($admin_frame, $body_content)
    {
        return str_replace("{{body_content}}", $body_content, $admin_frame);
    }

    static public function insertScripts($page_html, $layout_html)
    {
        $found_match = preg_match_all('/(?:{{scripts}}([[:ascii:]]*){{\/scripts}})/im', $page_html, $matches);
        return str_replace("{{scripts_content}}", $matches[1][0], $layout_html);
    }

    static public function insertAny($layout_html, $page_html)
    {
        $found_match = preg_match_all('/(?:{{([^_]+)_content}})/im', $layout_html, $tag_names);
        if ($found_match) {
            for ($i = 0; $i < count($tag_names[1]); $i++) {
                $sub_found = preg_match_all('/(?:{{' . $tag_names[1][$i] . '}}([[:ascii:]]*){{\/' . $tag_names[1][$i] . '}})/im', $page_html, $rep_content);
                if ($sub_found) {
                    return str_replace($tag_names[0][$i], $rep_content[1][0], $layout_html);
                }
            }
        }
        return null;
    }
}