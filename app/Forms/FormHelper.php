<?php

class Forms_FormHelper
{
    //ToDo: Json parsing Logic could go here, to avoid saving as HTML
    static public function insertFormId($form)
    {
        $form_html = html_entity_decode($form['form_html']);
        $form_hidden = "<input style='display:none;' class='hidden hide' name='form_id' type='text' value='${form['id']}'>";
        $final_form = str_replace("{{form_id_replace}}", $form_hidden, $form_html);
        return $final_form;
    }
    static public function preprocessHtml($html, $user_id)
    {
        $form_hidden = "<input style='display:none;' class='hidden hide' name='author_id' type='text' value='$user_id'>";
        $final_form = str_replace("{{form_hidden_author_input}}", $form_hidden, $html);
        return $final_form;
    }
}