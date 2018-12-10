<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 09.12.2018
 * Time: 21:36
 */

require_once (ROOT.'/application/views/components/header.php'); ?>

    <main class="main">
        <div class="container">
            <div class="row">
                <aside class="col-lg-3 col-sm-12">
                    сайд бар
                </aside>
                <div class="col-lg-9 col-sm-12">
                    <?php foreach ($categories as $category){?>
                        <div class="cat_cart clearfix">
                            <h3><a href="<?php echo '/i-market/'.$tag.$parent_tag.'/'.$category['tag']; ?>"><?php echo $category['name']; ?></a></h3>
                            <div>
                                <a class='cat_img' href="">
                                    <img src="<?php echo $category['image']; ?>" alt="<?php echo $category['name']; ?>">
                                </a>
                                <p><?php echo $category['description']; ?></p>
                            </div>
                        </div>
                        <div class="row">
                    <?php } ?>
                    <?php if(isset($products)){
                          foreach ($products as $product){?>
                              <div class="product_cart col-lg-4 col-sm-6 clearfix">
                                  <h3><a href="<?php echo '/i-market/'.$tag.$parent_tag.'/'.$child_tag.'/'.$product['tag']; ?>"><?php echo $product['name']; ?></a></h3>
                                  <div>
                                      <a class='cat_img' href="">
                                          <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                                      </a>
                                      <p><?php echo $product['description']; ?></p>
                                  </div>
                              </div>

                          <?php }
                    }?>
                        </div>

                </div>
            </div>
        </div>
    </main>




<?php require_once (ROOT.'/application/views/components/footer.php');