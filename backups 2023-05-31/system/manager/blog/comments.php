<?php $comments="active" ?>
<?php include '../../header.php'; ?>
<?php include '../../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Blog Comments</h1>
<!--        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>/manager/blog/add_blog.php" class="btn btn-sm btn-outline-secondary">New Blog Post</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Search Post</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                Update Blog Post
            </button>
        </div>-->
    </div>

    <h5><span class="badge bg-primary">

            <?php
//            $sql = "SELECT count(*) FROM tbl_blog";
//            $db = dbConn();
//            $result = $db->query($sql);
//
//            // Display data on web page
//            while ($row = mysqli_fetch_array($result)) {
//                echo $row['count(*)'];
//            }
            ?>
        </span> Comments</h5>
    <div class="table-responsive">
        <?php
        $sql = "SELECT * FROM tbl_blog_comments ";
        $db = dbConn();
        $result = $db->query($sql);
//        if($result){
//            while($row= mysqli_fetch_assoc($result))
//        }
        ?>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Comment Author</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
                    <th scope="col">In Response to</th>
                    <th scope="col">Post Author</th>
                    <th scope="col">Date</th>
                    <th scope="col">Approve</th>
                    <th scope="col">Unapprove</th>
                    <th scope="col">Delete</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $i=1;
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?= $i ?> </td>
                            <td> <?= $row['comment_author'] ?> </td>
                            <td> <?= $row['comment_content'] ?> </td>
                            <td> <?= $row['comment_email'] ?> </td>
                            <td>

                                <span style=" width: 100px;" class="badge <?php echo $row['comment_status'] ? 'bg-success' : 'bg-danger' ?>"><?php echo $row['comment_status'] == 1 ? 'Approved' : 'Declined' ?></span>

                            </td>
                            
                            
                            <td>
                                <?php
                                $db = dbConn();
                                $post_id = $row['comment_post_id'];
                               
                                
                                $sqlj = "SELECT * FROM tbl_blog INNER JOIN tbl_blog_comments ON tbl_blog.Id = tbl_blog_comments.comment_post_id WHERE Id='$post_id' ";

                                $results = $db->query($sqlj);
                                ?>
                                <?php
                                $rowx = $results->fetch_assoc();
                                 $post_author = $rowx['Author'];
                                ?>
                                
                                <?= $rowx['Title'] ?> </td>
                           
                            
                            <?php
                                $db = dbConn();
                                //$creator = $row['comment_post_id'];
                               
                                
                                $sqlj = "SELECT * FROM tbl_users WHERE UserId='$post_author' ";

                                $results = $db->query($sqlj);
                                ?>
                                <?php
                                $roww = $results->fetch_assoc();
                                ?>
                            <td><?= $roww['FirstName'] ?> </td>
                        
                            <td><?= $row['comment_date'] ?></td>
                            <td></td>
                            <td></td>



                            

                           

<!--                            <td>       
                                <form method="post" action="trainer_profile.php?UserId=<?= $row['UserId'] ?>">
                                    <input type="hidden" name="UserId" value="<?= $row['UserId'] ?>" >
                                    <button type="submit" name="action" value="edit">View</button>

                                </form>
                            </td>-->

                        </tr>
                        <?php
                        $i++;
                    }
                    
                }
                ?>

            </tbody>
        </table>
    </div>
</main>

<?php include '../../footer.php'; ?>   
