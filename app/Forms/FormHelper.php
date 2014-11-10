<?php

class Forms_FormHelper
{
    static public function insertFormId($form)
    {
        $form_html = html_entity_decode($form['form_html']);
        $form_hidden = "<input style='display:none;' class='hidden hide' name='entity' type='text' value='${form['id']}'>";
        $final_form = str_replace("{{form_id_replace}}", $form_hidden, $form_html);
        return $final_form;
    }
}