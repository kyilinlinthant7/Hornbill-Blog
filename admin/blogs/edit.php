<?php
    $blogId = $_GET['blog_id'];

    # get blog
    $stmt = $conn->prepare("SELECT * FROM blogs WHERE id = $blogId");
    $stmt->execute();
    $blog = $stmt->fetchObject();
    
    # update blog
    $titleErr = "";
    $contentErr = "";
    $imageErr = ""; 

        if(isset($_POST['blogUpdateBtn'])) {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $userId = $_SESSION['user']->id;
            
            $imageName = $_FILES['image']['name'];
            $imageTmpName = $_FILES['image']['tmp_name'];
            $imageType = $_FILES['image']['type'];

            if($title == "") {
                $titleErr = "The title field is required!";
            } elseif($content == "") {
                $contentErr = "The content field is required!";
            } else {
                if($imageName == "") {
                    $stmt = $conn->prepare("UPDATE blogs SET title = '$title', content = '$content' WHERE id = $blogId");
                } else {
                    // delete old photo
                    unlink("../assets/blog-images/$blog->image");
                    if(in_array($imageType, ['image/png', 'image/jpg', 'image/jpeg'])) {
                        move_uploaded_file($imageTmpName, "../assets/blog-images/$imageName");            
                    }
                    $stmt = $conn->prepare("UPDATE blogs SET title = '$title', content = '$content', image = '$imageName' WHERE id = $blogId");
                }

                $result = $stmt->execute();
                if($result) {
                    echo "<script>sweetAlert('updated a blog', 'blogs')</script>";
                }
            }
        }
?>
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Blog Edit Form</h6>
                    <a href="index.php?page=blogs" class="btn btn-primary btn-sm">
                        <i class="fas fa-angle-double-left"></i> Back </a>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class=" mb-2">
                            <label for="">Title</label>
                            <input type="text" name="title" value="<?php echo $blog->title ?>" class="form-control">
                            <span class="text-danger">
                                <?php echo $titleErr ?>
                            </span>
                        </div>
                        <div class=" mb-2">
                            <label for="">Content</label>
                            <textarea name="content" id="" rows="10"
                                class="form-control"><?php echo $blog->content ?></textarea>
                            <span class=" text-danger">
                                <?php echo $contentErr ?>
                            </span>
                        </div>
                        <div class=" mb-2">
                            <label for="">Image</label>
                            <input type="file" name="image" class="form-control">
                            <img src="../assets/blog-images/<?php echo $blog->image ?>" class="my-2" alt=""
                                style="width: 100px;">
                            <span class=" text-danger">
                                <?php echo $imageErr ?>
                            </span>
                        </div>
                        <button name="blogUpdateBtn" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>