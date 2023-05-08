<?php
require_once ("./../db/__init__.php") or die("couldn't load db configuration file");
class Product extends DBConnection
{
    private $product_name;
    private $product_description;
    private $product_price;
    private $product_image;


    public function __construct()
    {
        parent::__construct();
    }

    public function response($code = 200, $message = null, $data = [])
    {
        $data = [
            "code" => $code,
            "message" => $message,
            "product" => $data
        ];

        return json_encode($data);
    }

    public function custom_input_sanitizer($input)
    {
        $input = $input;
        $input = trim($input);
        $input = stripcslashes($input);
        $input = htmlspecialchars($input);

        return mysqli_escape_string($this->conn, $input);
    }


    public function create($product_name, $product_description, $product_price, $product_image)
    {
        if (!isset($product_name) || !isset($product_desc) || !isset($product_price)) {
            die("Provide complete arguments");
        }

        $this->product_name = $this->custom_input_sanitizer($product_name);
        $this->product_description = $this->custom_input_sanitizer($product_description);
        $this->product_price = $this->custom_input_sanitizer($product_price);
        $this->product_image = $this->custom_input_sanitizer($product_image);

        $query = mysqli_prepare($this->conn, "INSERT INTO product_table (product_name, product_description, product_price, product_image) VALUES (?, ?, ?, ?)");

        $query->bind_param("ssss", $this->product_name, $this->product_description, $this->product_price, $this->product_image);

        if (!$query) {
            return $this->response(500, "Product creation failed!");
        }

        //handle the file upload
        $file_upload_status = $this->handle_file($this->product_image);

        if (!$file_upload_status) {
            return $this->response(500, $file_upload_status);
        } else {
            $file_upload_permanent_status = $this->upload_file_permanent();
            if (!$file_upload_permanent_status) {
                return $this->response(500, "could not upload file");
            }
        }

        $query->execute();
        return $this->response(200, "Product created successfully");
        $query->close();
        $this->conn->close();
    }

    public function delete($id)
    {
        if (!$id) {
            die("Provide product id");
        }

        $query = mysqli_prepare($this->conn, "DELETE FROM  product_table WHERE id = ?");
        $query->bind_param("i", $id);

        if (!$query) {
            return $this->response(500, "could not delete product");
        }

        $query->execute();

        return $this->response(200, "product deleted successfully");
        $query->close();
        $this->conn->close();
    }

    public function get()
    {
        $query = mysqli_prepare($this->conn, "SELECT * FROM products_table");

        if (!$query) {
            return $this->response(500, "could not get products");
        }

        $query->execute();
        $query->bind_result($id, $product_name, $product_description, $product_price, $product_image);

        while ($query->fetch()) {
            return $this->response(200, "products gotten successfully", [
                "id" => $id,
                "name" => $product_name,
                "description" => $product_description,
                "price" => $product_price,
                "image_url" => $product_image
            ]);
        }

        $query->close();
        $this->conn->close();
    }
}
