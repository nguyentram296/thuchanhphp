<?php // IDEA:
require_once ("config/db.class.php");

class Product
{
  public $productID;
  public $productName;
  public $cateID;
  public $price;
  public $quantity;
  public $description;
  public $picture;
//Hàm khởi tạo
public function __construct($pro_name,$cate_id,$price,$quantity,$desc,$picture){
          $this->productName = $pro_name;
          $this->cateID = $cate_id;
          $this->price = $price;
          $this->quantity = $quantity;
          $this->description = $desc;
          $this->picture = $picture;
        }
  //Lưu sản phẩm
  public function save(){
    // Xử lý hình ảnh
            $file_temp=$this->picture['tmp_name'];
            $user_file=$this->picture['name'];
            $timestamp=date("Y").date("m").date("d").date("h").date("i").date("s");
            $file_path="uploads/".$timestamp.$user_file;
            if(move_uploaded_file($file_temp,$file_path)==false){
              return false;
            }

            $db = new Db();
            //Thêm product vào CSDL
            $sql = "INSERT INTO Product (ProductName,CateID,Price,Quantity,Description,Picture) VALUES
            ('$this->productName','$this->cateID','$this->price','$this->quantity','$this->description','$file_path')";
            $result = $db->query_execute($sql);
            return $result;
        }
  //Hàm danh sách sản phẩm
  public static function list_product(){
    $db= new Db();
    $sql="SELECT * FROM product";
    $result = $db-> select_to_array($sql);
    return $result;
  }
  //Hàm lấy danh sách sản phẩm theo loại sản phẩm
  public static function list_product_by_cateid($cateid){
    $db= new Db();
    $sql="SELECT * FROM product WHERE CateID='$cateid'";
    $result = $db-> select_to_array($sql);
    return $result;
  }
  public static function get_product($id){
    $db= new Db();
    $sql="SELECT * FROM product WHERE productID = '$id'";
    $result = $db-> select_to_array($sql);
    return $result;
  }
  //Hàm lấy danh sách sản phẩm cùng loại
  public static function list_product_relate($cateid, $id){
    $db= new Db();
    $sql="SELECT * FROM product WHERE CateID ='$cateid' AND productID != '$id'";
    $result = $db-> select_to_array($sql);
    return $result;
  }
}
?>
