<?php
require_once("../config/index.php");

print($_GET["id"]);
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    $sql = "SELECT * FROM models WHERE id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        $param_id = trim($_GET["id"]);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $file_name = $row["file_name"];
                $scale = $row["scale"];
                $active = $row["active"];
            } else {
                header("location: error.php");
                exit();
            }
        } else {
            echo "Please try again later.";
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else {
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Model</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Model</h1>
                    <div class="form-group">
                        <h5>File Name</h5>
                        <p><b><?php echo $row["file_name"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <h5>Scale</h5>
                        <p><b><?php echo $row["scale"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <h5>Active</h5>
                        <p>
                            <b>
                                <?php $active = $row["active"] ? "True" : "False";
                                echo $active;
                                ?>
                            </b>
                        </p>
                    </div>
                    <p><a href="../index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>