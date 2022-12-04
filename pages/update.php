<?php
require_once "../config/index.php";

$file_name = "";
$scale = 0;
$active = true;

if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];
    $scale = $_POST["scale"];
    $active = ($_POST["active"] == "true" ? 1 : 0);
    print($active);

    $sql = "UPDATE models SET scale=?, active=? WHERE id=?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "iii", $param_scale, $param_active, $param_id);

        $param_scale = $scale;
        $param_active = $active;
        $param_id = $id;

        if (mysqli_stmt_execute($stmt)) {
            header("location: ../index.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else {
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        $id =  trim($_GET["id"]);

        $sql = "SELECT * FROM models WHERE id = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            $param_id = $id;
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
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($link);
    } else {
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Model</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Model</h2>
                    <p>Please edit the input values and submit to update the model.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <h5>File Name</h5>
                            <label><?php echo $file_name; ?></label>
                        </div>
                        <div class="form-group">
                            <h5>Scale</h5>
                            <input type="range" name="scale" class="form-control" min="0" max="10000000" id="scale" value="<?php echo $scale; ?>" onchange="handleScale()"><?php echo $scale; ?>
                        </div>
                        <div class="form-group">
                            <h5>Active</h5>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="active" <?php echo ($active ? "checked" : "") ?> value="true">True
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="active" <?php echo ($active ? "" : "checked") ?> value="false">False
                                </label>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="../index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function handleScale() {
            console.log('scale', document.getElementById('scale').value());
            $scale = document.getElementById('scale').value();
        }
    </script>
</body>

</html>