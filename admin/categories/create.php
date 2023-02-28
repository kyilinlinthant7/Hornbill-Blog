<?php
$nameErr = "";
    if(isset($_POST['categoryCreateBtn'])) {
        $name = $_POST['name'];
        if($name === "" || ctype_space($name)) {
            $nameErr = "The name field is required!";
        }
        else {
            $stmt = $conn->prepare("INSERT INTO categories (name) VALUES ('$name')");
            $stmt->execute();
            echo "<script>sweetAlert('created a category', 'categories')</script>";
}
}
?>
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Category Create Form</h6>
                    <a href="index.php?page=categories" class="btn btn-primary btn-sm">
                        <i class="fas fa-angle-double-left"></i> Back </a>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class=" mb-2">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control">
                            <span class="text-danger">
                                <?php echo $nameErr ?>
                            </span>
                        </div>
                        <button name="categoryCreateBtn" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>