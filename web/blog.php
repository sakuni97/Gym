<?php $blog = "active" ?>
<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Blog</h2>
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li>Blog</li>
                </ol>
            </div>

        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row g-5">

                <div class="col-lg-12">

                    <?php
                    $db = dbConn();
                    $sql = "SELECT * FROM tbl_blog";
                    $result = $db->query($sql);
                    ?>

                    <div class="row gy-4 posts-list">

                        <?php
                        if ($result->num_rows > 0) {
                            $i = 1;
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <!-- Start post list item -->
                                <div class="col-lg-4">
                                    <article class="d-flex flex-column">

                                        <div class="post-img">
                                            <img src="../system/assets/images/blog/<?= $row['Image'] ?>" alt="" class="img-fluid">
                                        </div>

                                        <h2 class="title">
                                            <form method="post" action="blog_details.php">
                                                <input type="hidden" name="blogid" value="<?= $row['Id']  ?>">
                                                <button type="submit" name="action" value="blogdetails" class="btn btn-primary btn-lg border-0"><?= $row['Title'] ?></button>

                                            </form>
<!--                                            <a href="blog-details.html"></a>-->
                                        </h2>

                                        <div class="meta-top">
                                            <?php
                                            $authorid = $row['Author'];

                                             $sqlauthour = "SELECT * FROM tbl_users WHERE UserId='$authorid'";
                                            $resultauthours = $db->query($sqlauthour);
                                            $rowauthour = $resultauthours->fetch_assoc();
                                            ?>
                                            <ul>
                                                <li class="d-flex align-items-center"><i class="bi bi-person"></i><?= $rowauthour['FirstName'] ." " . $rowauthour['LastName'] ?></li>
                                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <time datetime="2022-01-01"><?= $row['Date'] ?></time></li>
        <!--                                                <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-details.html">12 Comments</a></li>-->
                                            </ul>
                                        </div>

                                        <div class="content">
                                            <p>
                                                <?php echo substr($row['Description'], 0, 200) ?>
                                            </p>
                                        </div>

                                        <div class="read-more mt-auto align-self-end">
<!--                                            <a href="blog_details.php?Id=<?= $row['Id'] ?>">Read More</a>-->
                                            <form method="post" action="blog_details.php">
                                                <input type="hidden" name="blogid" value="<?= $row['Id']  ?>">
                                                <button type="submit" name="action" value="blogdetails"> Read More </button> 
                                            </form>
                                        </div>

                                    </article>
                                </div><!-- End post list item -->
                            <?php }
                        } ?>


                    </div><!-- End blog posts list -->

<!--                    <div class="blog-pagination">
                        <ul class="justify-content-center">
                            <li><a href="#">1</a></li>
                            <li class="active"><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                        </ul>
                    </div> End blog pagination -->

                </div>

                

            </div>

        </div>
    </section><!-- End Blog Section -->

</main><!-- End #main -->

<?php include 'footer.php'; ?>
  