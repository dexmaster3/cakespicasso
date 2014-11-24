<?php

class Display_Controller_Display extends Core_Controller_BaseController
{
    public function index($query)
    {
        $layout_model = new Layouts_Model_Layout();
        $layout = $layout_model->findAllByColumnValue('layout_name', $query['layout']);
        $layout_string = html_entity_decode($layout[0]['layout_content']);
        $return_layout = Core_View_ViewDriver::renderLayoutContent($layout_string);
        return $this->render($return_layout);
    }

    public function content($query = null)
    {
        Analytics_AnalyticsHelper::saveClientInformation();
        $content_model = new Pages_Model_Page();
        $content = $content_model->findById($query);
        $rendering_model = new Renderings_Model_Rendering();
        $rendering = $rendering_model->findById($content['rendering_id']);
        $form_model = new Forms_Model_Form();
        $form = $form_model->findById($content['form_id']);
        $rendering_string = html_entity_decode($rendering['html_string']);
        $rendering_string = str_replace("{{content_content}}", html_entity_decode($content['page_html']), $rendering_string);
        if ($form) {
            $new_form_html = Forms_FormHelper::insertFormId($form);
            $rendering_string = str_replace("{{form_content}}", $new_form_html, $rendering_string);
        } else {
            $rendering_string = str_replace("{{form_content}}", "", $rendering_string);
        }
        //Add in click script -- using static class in Analytics module better?
        $rendering_string .= "<link href='/assets/css/admin.css' type='text/css' rel='stylesheet'><script src='https://code.jquery.com/jquery-1.11.1.min.js'></script><script src='/assets/js/clicks.js'></script>";
        if ($_REQUEST['click'] && Users_UserHelper::isObjectOwner($content['author_id'])) {
            $rendering_string .= "<script>$(document).on('ready', function(){clickHandler.displayClickAnyPage();});</script>";
        }
        return $this->renderString($rendering_string);
    }

    public function layout($query)
    {
        $layout_model = new Layouts_Model_Layout();
        $layout = $layout_model->findById($query['id']);
        $layout_string = html_entity_decode($layout['layout_content']);
        $return_layout = Core_View_ViewDriver::renderLayoutContent($layout_string);
        return $this->renderString($return_layout);
    }

    public function rendering($query)
    {
        $rendering_model = new Renderings_Model_Rendering();
        $rendering = $rendering_model->findById($query['id']);
        return $this->renderString($rendering['html_string']);
    }

    public function create($query)
    {
        return $this->render();
    }

    public function blank($query)
    {
        return $this->render();
    }
}