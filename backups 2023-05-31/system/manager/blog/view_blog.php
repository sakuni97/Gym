<?php $blog="active" ?>
<?php include '../../header.php'; ?>
<?php include '../../menu.php'; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Blog Posts</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>/manager/blog/add_blog.php" class="btn btn-sm btn-outline-secondary">New Blog Post</a>
                <button type="button" class="btn btn-sm btn-outline-secondary">Search Post</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                Update Blog Post
            </button>
        </div>
    </div>

    <h5><span class="badge bg-primary">

            <?php
            $sql = "SELECT count(*) FROM tbl_blog";
            $db = dbConn();
            $result = $db->query($sql);

            // Display data on web page
            while ($row = mysqli_fetch_array($result)) {
                echo $row['count(*)'];
            }
            ?>
        </span> Posts</h5>
    <div class="table-responsive">
        <?php
        $sql = "SELECT * FROM tbl_blog ";
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
                    <th scope="col">Author</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Images</th>
                    <th scope="col">Status</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Date</th>

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
                            
                            <?php
                                $db = dbConn();
                                $creator = $row['Id'];
                               
                                
                                $sqlj = "SELECT * FROM tbl_blog INNER JOIN tbl_users ON tbl_blog.Author = tbl_users.UserId WHERE Id='$creator' ";

                                $results = $db->query($sqlj);
                                ?>
                                <?php
                                $rowx = $results->fetch_assoc();
                                ?>
                            <td><?= $rowx['FirstName'] ?> </td>
                            
                            
                            <td><?= $row['Title'] ?> </td>
                            <td><?php echo substr($row['Description'],0, 200)  ?></td>
                            
                            <td><img class="img-fluid" width="75" src="../../assets/images/blog/<?= $row['Image'] ?>"></td>
                            <td><?= $row['Status'] ?></td>
                            <td><?= $row['Tags'] ?></td>
                            <td><?= $row['Date'] ?></td>



                            

                           

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
