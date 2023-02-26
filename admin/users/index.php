<?php     
    # read users
    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_OBJ);

    #delete users
    if(isset($_POST['userDeleteBtn'])) {
        $userId = $_POST['user_id'];
        $stmt = $conn->prepare("DELETE FROM users WHERE id = $userId");
        $stmt->execute();
        echo "<script>location.href='index.php?page=users'</script>";
    }
?>
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class=" card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Users</h6>
                    <a href="index.php?page=users-create" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add New </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach($users as $user):
                                ?>
                                <tr>
                                    <td><?php echo $user->id ?></td>
                                    <td><?php echo $user->name ?></td>
                                    <td><?php echo $user->email ?></td>
                                    <td><?php echo $user->role ?></td>
                                    <td>
                                        <form method="POST">
                                            <input type="hidden" name="user_id" value="<?php echo $user->id ?>" />
                                            <a href="index.php?page=users-edit&user_id=<?php echo $user->id ?>"
                                                class="btn btn-success btn-sm"><i class="far fa-edit"></i> Edit</a>
                                            <button name="userDeleteBtn" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure to delete?');"><i class="far fa-trash-alt"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                                    endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>