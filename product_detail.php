<?php
    require_once("Entities\product.class.php");
    require_once("Entities\category.class.php");
?>
<?php include_once ("header.php");
  if(!isset($_GET["id"])){
    //Đường dẫn xem chi tiết sản phẩm không đúng
    //dẫn đến trang not found
    header('Location:not_found.php');
  }
  else {
    $id = $_GET["id"];
    $prod = reset(Product::get_product($id));
    $prods_relate = Product::list_product_relate($prod["CateID"],$id);
  }
  $cates=Category::list_category();
?>
<div class="container text-center">
  <div class="col-sm-3 panel panel-danger">
    <h3 class="panel-heading">Danh mục</h3>
        <ul class="list-group">
            <?php
                foreach ($cates as $item) {
                  echo "<li class='list-group-item'><a
                  href=/Lab5/list_product.php?cateid=".$item["CateID"].">".$item["CategoryName"]."</a></li>";
                }?></ul>
  </div>
  <div class="col-sm-9 panel panel-info">
    <h3 class="panel-heading">Chi tiết sản phẩm</h3>
    <div class="row">
      <div class="col-sm-6">
        <img src="<?php echo "/Lab5/".$prod["Picture"];?>" class="img-responsive" style="width:100%" alt="Image">
      </div>
      <div class="col-sm-6">
        <!-- in thông tin chi tiết sản phẩm -->
        <div style="padding-left:10px">
          <h3 class="text-info"> <?php echo $prod["ProductName"]; ?> </h3>
          <p> Giá: <?php echo $prod["Price"];?></p>
          <p> Mô tả: <?php echo $prod["Description"];?></p>
          <p> <button type="button" class="btn btn-danger">Mua hàng</button></p>
      </div>
    </div>
  </div>
  <h3 class="panel-heading">Sản phẩm liên quan</h3>
  <div class="row">
    <?php
    foreach ($prods_relate as $item) {?>
      <div class="col-sm-4">
        <a href="/Lab5/product_detail.php?id=<?php echo $item["ProductID"]; ?>">
            <img src="<?php echo "/Lab5/".$item["Picture"];?>" class="img-responsive" style="width:100%" alt="Image">
        </a>
        <p class="text-danger"> <?php echo $item["ProductName"]; ?> </p>
        <p class="text-info"><?php echo $item["Price"];?></p>
        <p> <button type="button" class="btn btn-primary">Mua hàng</button></p>
      </div>
    <?php } ?>
  </div>
  </div>
</div>
<?php include_once ("footer.php");?>
