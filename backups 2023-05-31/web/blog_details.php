<?php $blog = "active" ?>
<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>

<?php
extract($_POST);
if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == 'blogdetails' || $_SERVER['REQUEST_METHOD'] == "POST" && @$action == "comment" ) {

    //echo $blogid;
    $db = dbConn();
    $sql = "SELECT * FROM tbl_blog WHERE Id= '$blogid' ";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
    
   $blogidforcomment= $blogid;
}
?>


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




    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row g-5">

                <div class="col-lg-8">

                    <article class="blog-details">



                        <div class="post-img">
                            <img src="../system/assets/images/blog/<?= $row['Image'] ?>" alt="" class="img-fluid">
                        </div>

                        <h2 class="title"><?= $row['Title'] ?></h2>

                        <div class="meta-top">
                            <ul><?php
                                $authorid = $row['Author'];

                                $sqlauthour = "SELECT * FROM tbl_users WHERE UserId='$authorid'";
                                $resultauthours = $db->query($sqlauthour);
                                $rowauthour = $resultauthours->fetch_assoc();
                                ?>
                                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <?= $rowauthour['FirstName'] . " " . $rowauthour['LastName'] ?></a</li>
                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-details.html"><time datetime="2020-01-01"><?php echo substr($row['Date'], 0, 10) ?></time></a></li>
                                <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-details.html">12 Comments</a></li>
                            </ul>
                        </div><!-- End meta top -->

                        <div class="content">
                            <p>
                                <?= $row['Description'] ?> </p>


                            <!--                            <blockquote>
                                                            <p>
                                                                Et vero doloremque tempore voluptatem ratione vel aut. Deleniti sunt animi aut. Aut eos aliquam doloribus minus autem quos.
                                                            </p>
                                                        </blockquote>-->





                        </div><!-- End post content -->

                        <div class="meta-bottom">
                            <i class="bi bi-folder"></i>
                            <ul class="cats">
                                <li><a href="#">Business</a></li>
                            </ul>

                            <i class="bi bi-tags"></i>
                            <ul class="tags">
                                <li><a href="#">Creative</a></li>
                                <li><a href="#">Tips</a></li>
                                <li><a href="#">Marketing</a></li>
                            </ul>
                        </div><!-- End meta bottom -->

                    </article><!-- End blog post -->



                    <div class="comments">

                        <h4 class="comments-count">8 Comments</h4>

                        <div id="comment-1" class="comment">
                            <div class="d-flex">
                                <div class="comment-img"><img src="assets/img/blog/comments-1.jpg" alt=""></div>
                                <div>
                                    <h5><a href="">Georgia Reader</a> <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                                    <time datetime="2020-01-01">01 Jan,2022</time>
                                    <p>
                                        Et rerum totam nisi. Molestiae vel quam dolorum vel voluptatem et et. Est ad aut sapiente quis molestiae est qui cum soluta.
                                        Vero aut rerum vel. Rerum quos laboriosam placeat ex qui. Sint qui facilis et.
                                    </p>
                                </div>
                            </div>
                        </div><!-- End comment #1 -->



                        <div class="reply-form">

                            <?php
                            extract($_POST);
                            if ($_SERVER['REQUEST_METHOD'] == "POST" && @$action == "comment") {
                        echo $blogidforcomment;
                        print_r($blogid);
                                echo "data";
                                //seperate variables and values from the form
                                extract($_POST);

                                //data clean
                                $Name = cleanInput($name);
                                $Email = cleanInput($email);
                                $Comment = cleanInput($comment);

                                //create array variable store validation messages
                                $messages = array();

                                //validate required fields
                                if (empty($Name)) {
                                    $messages['error_Name'] = "The Name should not be empty..!";
                                }
                                if (empty($Email)) {
                                    $messages['error_Email'] = "The Email should not be empty..!";
                                }

                                if (empty($Comment)) {
                                    $messages['error_Comment'] = "The Comment should not be empty..!";
                                }

                                if (empty($messages)) {

                                   
                                    $cdate = date('Y-m-d');
                                    echo $sql = "INSERT INTO tbl_blog_comments(comment_post_id,comment_author,comment_email,comment_content,comment_date) VALUES ('$blogid','$Name','$Email','$Comment','$cdate')";

                                    $db = dbConn();
                                    $db->query($sql);

                                   echo  $sql2 = "UPDATE tbl_blog SET post_comment_count = post_comment_count + 1 WHERE Id = $blogid";
                                    $db = dbConn();
                                    $db->query($sql2);

                                    $Name = null;
                                    $Email = null;
                                    $Comment = null;

//                                    header("Location: blog.php");
                                }
                            }
                            ?>


                            <h4>Leave a Reply</h4>
                            <p>Your email address will not be published. Required fields are marked * </p>
                            <form  method="post"  action="blog_details.php">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <input name="name" type="text" class="form-control" value="<?= @$Name; ?>" placeholder="Your Name*">
                                        <div class="text-danger"> <?= @$messages['error_Name']; ?></div>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input name="email" type="text" class="form-control" value="<?= @$Email; ?>"  placeholder="Your Email*">
                                        <div class="text-danger"> <?= @$messages['error_Email']; ?></div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col form-group">
                                        <textarea name="comment" class="form-control" value="<?= @$Comment; ?>" placeholder="Your Comment*"></textarea>
                                        <div class="text-danger"> <?= @$messages['error_Comment']; ?></div>
                                    </div>
                                </div>
<!--                                <input type="text" name="Id" value="<?= $Id ?>">-->
                                <input type="text" name="blogid" value= "<?= $blogidforcomment ?>">
                                <button type="submit" name="action" value="comment" class="btn btn-primary">Post Comment</button>

                            </form>

                        </div>

                    </div><!-- End blog comments -->

                </div>

                <div class="col-lg-4">

                    <div class="sidebar">

                        <div class="sidebar-item search-form">
                            <h3 class="sidebar-title">Search</h3>
                            <form action="" class="mt-3">
                                <input type="text">
                                <button type="submit"><i class="bi bi-search"></i></button>
                            </form>
                        </div><!-- End sidebar search formn-->

                        <div class="sidebar-item categories">
                            <h3 class="sidebar-title">Categories</h3>
                            <ul class="mt-3">
                                <li><a href="#">General <span>(25)</span></a></li>
                                <li><a href="#">Lifestyle <span>(12)</span></a></li>
                                <li><a href="#">Travel <span>(5)</span></a></li>
                                <li><a href="#">Design <span>(22)</span></a></li>
                                <li><a href="#">Creative <span>(8)</span></a></li>
                                <li><a href="#">Educaion <span>(14)</span></a></li>
                            </ul>
                        </div><!-- End sidebar categories-->

                        <div class="sidebar-item recent-posts">
                            <h3 class="sidebar-title">Recent Posts</h3>

                            <div class="mt-3">

                                <div class="post-item mt-3">
                                    <img src="assets/img/blog/blog-recent-1.jpg" alt="" class="flex-shrink-0">
                                    <div>
                                        <h4><a href="blog-post.html">Nihil blanditiis at in nihil autem</a></h4>
                                        <time datetime="2020-01-01">Jan 1, 2020</time>
                                    </div>
                                </div><!-- End recent post item-->

                                <div class="post-item">
                                    <img src="assets/img/blog/blog-recent-2.jpg" alt="" class="flex-shrink-0">
                                    <div>
                                        <h4><a href="blog-post.html">Quidem autem et impedit</a></h4>
                                        <time datetime="2020-01-01">Jan 1, 2020</time>
                                    </div>
                                </div><!-- End recent post item-->

                                <div class="post-item">
                                    <img src="assets/img/blog/blog-recent-3.jpg" alt="" class="flex-shrink-0">
                                    <div>
                                        <h4><a href="blog-post.html">Id quia et et ut maxime similique occaecati ut</a></h4>
                                        <time datetime="2020-01-01">Jan 1, 2020</time>
                                    </div>
                                </div><!-- End recent post item-->

                                <div class="post-item">
                                    <img src="assets/img/blog/blog-recent-4.jpg" alt="" class="flex-shrink-0">
                                    <div>
                                        <h4><a href="blog-post.html">Laborum corporis quo dara net para</a></h4>
                                        <time datetime="2020-01-01">Jan 1, 2020</time>
                                    </div>
                                </div><!-- End recent post item-->

                                <div class="post-item">
                                    <img src="assets/img/blog/blog-recent-5.jpg" alt="" class="flex-shrink-0">
                                    <div>
                                        <h4><a href="blog-post.html">Et dolores corrupti quae illo quod dolor</a></h4>
                                        <time datetime="2020-01-01">Jan 1, 2020</time>
                                    </div>
                                </div><!-- End recent post item-->

                            </div>

                        </div><!-- End sidebar recent posts-->

                        <div class="sidebar-item tags">
                            <h3 class="sidebar-title">Tags</h3>
                            <ul class="mt-3">
                                <li><a href="#">App</a></li>
                                <li><a href="#">IT</a></li>
                                <li><a href="#">Business</a></li>
                                <li><a href="#">Mac</a></li>
                                <li><a href="#">Design</a></li>
                                <li><a href="#">Office</a></li>
                                <li><a href="#">Creative</a></li>
                                <li><a href="#">Studio</a></li>
                                <li><a href="#">Smart</a></li>
                                <li><a href="#">Tips</a></li>
                                <li><a href="#">Marketing</a></li>
                            </ul>
                        </div><!-- End sidebar tags-->

                    </div><!-- End Blog Sidebar -->

                </div>
            </div>

        </div>
    </section><!-- End Blog Details Section -->

</main><!-- End #main -->

<?php include 'footer.php'; ?>