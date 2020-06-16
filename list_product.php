<?php
    require_once("Entities\product.class.php");
    require_once("Entities\category.class.php");
?>
<?php
    include_once("header.php");
    if(!isset($_GET["cateid"])){
      $prods = product::list_product();
    }
    else {
      $cateid=$_GET["cateid"];
      $prods = product::list_product_by_cateid($cateid);
    }
    $cates=Category::list_category();
?>
<div class="container text-center">
    <div class="col-sm-3">
      <h3>Danh mục</h3>
          <ul class="list-group">
              <?php
                  foreach ($cates as $item) {
                    echo "<li class='list-group-item'><a
                    href=/Lab5/list_product.php?cateid=".$item["CateID"].">".$item["CategoryName"]."</a></li>";
                  }?></ul>
    </div>
<div class="col-sm-9">
      <h3>Thông tin sản phẩm của cửa hàng</h3>
      <div class="row">
      <?php foreach ($prods as $item) {?>
          <div class="col-sm-4">
              <a href="/Lab5/product_detail.php?id=<?php echo $item["ProductID"]; ?>">
                <img  src="<?php echo"/Lab5/".$item["Picture"];?>" class="img-responsive" style="width:100%" alt="Image">
              </a>
              <p class="text-danger"><?php echo $item["ProductName"];?></p>
              <p class="text-info"><?php echo $item["Price"];?></p>
              <p> <button type="button" class="btn btn-primary">Mua hàng</button></p>
        </div>
        <?php } ?>
</div>
</div>
</div>
<?php  include_once("footer.php"); ?>
