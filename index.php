<?php
  include("includes/header.php");
  $page = !empty($_GET["page"]) ? (int)$_GET["page"] : 1;
  $itemPerPage = 4;
  $itemsCount = Photo::countAll();
  $photos = Photo::findAll();

  $paginate = new Paginate($page, $itemPerPage, $itemsCount);
  $sql = "SELECT * FROM photos LIMIT {$itemPerPage} OFFSET {$paginate->offset()}";
  $photos = Photo::findThisQuery($sql);
?>

            <div class="row">

                <!-- Blog Entries Column -->
                <div class="col-md-12">
                  <div class="thumbnails row">
                    <?php foreach ($photos as $photo): ?>

                        <div class="col-xs-6 col-md-3">
                          <a class="thumbnail" href="photo.php?id=<?php echo $photo->id ?>"><img class="img-responsive homePhoto" src="admin/<?php echo $photo->picPath() ?>" alt="" /></a>
                        </div>

                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <ul class="pager">
                  <?php
                    if($paginate->pageTotal() > 1){
                      if($paginate->hasNext()){
                        echo '<li class="next"><a href="index.php?page='. $paginate->next() .'">Next</a></li>';
                      }

                      if($paginate->hasPrevious()){
                        echo '<li class="previous"><a href="index.php?page='. $paginate->previous() .'">Previous</a></li>';
                      }
                    }
                   ?>
                </ul>
              </div>
                <div class="row">
                  <ul class="pager">
                  <?php
                    for ($i=1; $i <= $paginate->pageTotal(); $i++) { ?>
                      <li class="active"><a class="text-center" href="index.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                   <?php } ?>
                </ul>
              </div>
        <!-- /.row -->
        <?php include("includes/footer.php"); ?>
