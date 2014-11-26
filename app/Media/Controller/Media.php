<?php

class Media_Controller_Media extends Users_Controller_BaseAuth
{
    protected function index()
    {
        $media_model = new Media_Model_Media();
        $this->data->media = $media_model->findAllByColumnValue('author_id', $_SESSION['user']['id']);
        $this->data->media = array_reverse($this->data->media);
        return $this->render();
    }
    protected function create()
    {
        return $this->render();
    }
    protected function delete($query = null)
    {
        $media_model = new Media_Model_Media();
        $return_data = new stdClass();
        $media = $media_model->findById($query['id']);
        if (Users_UserHelper::isObjectOwner($media['author_id'])) {
            $media_model->deleteById($query['id']);

            $return_data->success = true;
            $return_data->type = "success";
            $return_data->message = "Media deleted";
            return $this->returnJson($return_data);
        } else {
            $return_data->success = false;
            $return_data->type = "error";
            $return_data->message = "Permission denied";
            return $this->returnJson($return_data);
        }
    }
    protected function upload()
    {
        $media_model = new Media_Model_Media();
        if (isset($_FILES)) {
            $relative_path = "/assets/upload";
            $server_path = ROOT . $relative_path;
            $uploadfile_name = time() . "_" . basename($_FILES['file']['name']);
            if (move_uploaded_file($_FILES['file']['tmp_name'], "$server_path/$uploadfile_name")) {
                $media['original_name'] = $_FILES['file']['name'];
                $media['file_name'] = $uploadfile_name;
                $media['full_path'] = "$relative_path/$uploadfile_name";
                $media['server_full_path'] = "$server_path/$uploadfile_name";
                $media['author_id'] = $_SESSION['user']['id'];
                $added = $media_model->addRow($media);
                if ($added) {
                    $activity_model = new Analytics_Model_ActivityLog();
                    $activity = array(
                        "name" => "Media Uploaded",
                        "type" => "fa fa-fw fa-file-image-o",
                        "description" => $_SESSION['user']['username'] . " uploaded media",
                        "author_id" => $_SESSION['user']['id'],
                        "note" => "Media ID: ".$added
                    );
                    $activity_model->addRow($activity);
                    return $this->returnJson(array(
                        "type" => "success",
                        "success" => true,
                        "message" => "File uploaded"
                    ));
                } else {
                    return $this->returnJson(array(
                        "type" => "error",
                        "success" => false,
                        "error" => "SQL add error"
                    ));
                }
            } else {
                return $this->returnJson(array(
                    "type" => "error",
                    "success" => false,
                    "error" => "File save error"
                ));
            }
        } else {
            return $this->returnJson(array(
                "type" => "error",
                "success" => false,
                "error" => "File transfer fail"
            ));
        }
    }
}