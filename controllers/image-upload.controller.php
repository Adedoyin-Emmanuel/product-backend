<?php

class FileUploadHandler
{

    private $file_match_success = false;
    private $upload_tmp_name = "";
    private $target_file_dir = "";

    #create a method to handle the file
    public function handle_file($product_image)
    {
        $upload_file_name = $product_image["name"];
        $upload_dir = "../images/";
        #this is 1mb, the max amount of file size we can accept
        $max_file_size = 1000000;
        $striped_file = explode('.', $upload_file_name);
        $legit_file_extension = array("png", "jpeg", "jpg", "gif");
        $legit_upload_file_ext = strtolower(end($striped_file));
        $this->upload_tmp_name = $product_image["tmp_name"];
        $upload_file_error = $product_image["error"];
        $upload_file_size = $product_image["size"];


        $randomNumber = rand(0, 10000000);
        $randomTime = time();
        $processed_file_name = $randomNumber . $randomTime . '.' . $legit_upload_file_ext;
        $this->target_file_dir = $upload_dir . $processed_file_name;
        if ($upload_file_error != 0) {
            return 'an error occured while processing file';
        } else {

            if ($upload_file_size > $max_file_size) {
                return 'file size too large';
            } else {

                #check if the uploaded file matches the legit file extension
                if (in_array($legit_upload_file_ext, $legit_file_extension)) {
                    #the file matches all the required properties
                    $this->file_match_success = true;
                } else {
                    $this->file_match_success = false;

                    return 'invalid file extension, use (png, jpg, gif, jpeg)';
                }
            }
        }

        return $this->file_match_success;
    }

    public function upload_file_permanent()
    {
        if ($this->file_match_success === true) {
            #check if there was an error
            if (move_uploaded_file($this->upload_tmp_name, $this->target_file_dir)) {
                return true;
            } else {
                return false;
            }
        }
    }
}
