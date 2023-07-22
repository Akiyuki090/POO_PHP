<?php
class Product {
    private $baseDados;

    public function __construct(){
        $this->baseDados = array(); 
    }

    public function addProduct($id, $name, $price) {
        $product = array(
            'id' => $id,
            'name' => $name,
            'price' => $price
        );
        array_push($this->baseDados, $product);
    }

    public function getAllProducts() {
        return $this->baseDados;
    }

    public function getProductById($id) {
        foreach($this->baseDados as $produto){
            if ($produto['id'] == $id){
                return $produto;
            }
        }
        return null;
    }

    public function removeProduct($id) {
        foreach($this->baseDados as $key => $produto){
            if ($produto['id'] == $id){
                unset($this->baseDados[$key]);
            }
        }
    }
}
?>