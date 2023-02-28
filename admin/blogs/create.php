<?php
    $titleErr = "";
    $contentErr = "";
    $imageErr = "";
    
        if(isset($_POST['blogCreateBtn'])) {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $userId = $_SESSION['user']->id;
            $created_at = date('Y-m-d H:i:s');
            
            $imageName = $_FILES['image']['name'];
            $imageTmpName = $_FILES['image']['tmp_name'];
            $imageType = $_FILES['image']['type'];

            if($title == "") {
                $titleErr = "The title field is required!";
            } elseif($content == "") {
                $contentErr = "The content field is required!";
            } elseif($imageName == "") {
                $imageErr = "The image field is required!";
            } else {
                // setting image name unique for duplicating images condition
                $imageName = uniqid() . '_' . $imageName;
                if(in_array($imageType, ['image/png', 'image/jpg', 'image/jpeg'])) {
                    move_uploaded_file($imageTmpName, "../assets/blog-images/$imageName");            
                }
                
                $stmt = $conn->prepare("INSERT INTO blogs(title, content, image, user_id, created_at) VALUES ('$title','$content','$imageName', $userId, '$created_at')");
                $result = $stmt->execute();
                if($result) {
                    echo "<script>sweetAlert('created a blog', 'blogs')</script>";
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
                    <h6 class="m-0 font-weight-bold text-primary">Blog Create Form</h6>
                    <a href="index.php?page=blogs" class="btn btn-primary btn-sm">
                        <i class="fas fa-angle-double-left"></i> Back </a>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class=" mb-2">
                            <label for="">Title</label>
                            <input type="text" name="title" class="form-control">
                            <span class="text-danger">
                                <?php echo $titleErr ?>
                            </span>
                        </div>
                        <div class=" mb-2">
                            <label for="">Content</label>
                            <textarea name="content" id="" rows="10" class="form-control"></textarea>
                            <span class=" text-danger">
                                <?php echo $contentErr ?>
                            </span>
                        </div>
                        <div class=" mb-2">
                            <label for="">Image</label>
                            <input type="file" name="image" class="form-control">
                            <span class=" text-danger">
                                <?php echo $imageErr ?>
                            </span>
                        </div>
                        <button name="blogCreateBtn" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>