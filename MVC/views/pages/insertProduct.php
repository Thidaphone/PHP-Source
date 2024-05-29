<?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $newAction = "";
                    }
                    else {
                        $newAction = "insertProduct";
                    }
                    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIP Pro Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-header {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-header">
            <h1 class="text-center">INSERT Form</h1>
        </div>
        <form>
            <div class="mb-3" method="post" enctype="mutipart/form-data">
                <label for="productId" class="form-label"><h4>ID Product</h4></label>
                <input type="text" class="form-control" name="productId" id="productId" placeholder="Enter product ID">
            </div>
            <div class="mb-3">
                <label for="productName" class="form-label"><h4>Product Name</h4></label>
                <input type="text" class="form-control" name="productName" id="productName" placeholder="Enter product name">
            </div>
            <div class="mb-3">
                <label for="companyId" class="form-label"><h4>ID Company</h4></label>
                <input type="text" class="form-control" name="companyId" id="companyId" placeholder="Enter company ID">
            </div>
            <div class="mb-3">
                <label for="selectBand" class="form-label"><h4>Select Band</h4></label>
                <select class="form-select form-select-lg" name="selectBand" id="selectBand">
                    <option selected>Select one</option>
                    <option value="minocin">Minocin</option>
                    <option value="istanbul">Istanbul</option>
                    <option value="jakarta">Jakarta</option>
                </select>
            </div>
            <label for="" class="from-label">Select Year</label>
            <select class="form-select form-select-lg" name="selectYear" id="">
            <?php
            for ($year = 2015; $year <= 2025; $year++) {
                echo '<option value="' . $year . '">' . $year . '</option>';
                }
            ?>
            </select>
            <div class="mb-3">
                <label for="fileInput" class="form-label"><h4>Choose Image</h4></label>
                <input type="file" class="form-control" name="imageFile" id="fileInput">
                <div id="fileHelpId" class="form-text">Select an image file to upload</div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg">Insert</button>
            </div>
        </form>
        <?php
        if (isset($data["result"])){
            if($data["result"]){
                echo "them moi thanh cong";
            }else{
                echo "them moi that bai";
            }
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
