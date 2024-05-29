<?php
class Product {
    public $id;
    public $name;
    public $price;
    public $amount;
    public $company;
    public $year;
    public $image; // Thêm thuộc tính image

    function __construct($id, $name, $price, $amount, $company, $year, $image) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->amount = $amount;
        $this->company = $company;
        $this->year = $year;
        $this->image = $image; // Khởi tạo thuộc tính image
    }
}

// Hàm này sẽ lưu trữ sản phẩm vào danh sách
function addProductToList($product) {
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!isset($_SESSION['productList'])) {
        $_SESSION['productList'] = [];
    }
    array_unshift($_SESSION['productList'], $product);
}

// Danh sách sản phẩm
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['productList'])) {
    $_SESSION['productList'] = [];
}

// Kiểm tra xem có dữ liệu được gửi từ form hay không và trường hình ảnh đã được gửi hay không
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['image'])) {
    // Lấy dữ liệu từ form và tạo một đối tượng Product mới
    $newProduct = new Product($_POST['id'], $_POST['name'], $_POST['price'], $_POST['amount'], $_POST['company'], $_POST['year'], $_POST['image']);
    // Thêm sản phẩm mới vào danh sách
    addProductToList($newProduct);
}

// Xử lý upload ảnh
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    // Tạo thư mục uploads nếu chưa tồn tại
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    // Di chuyển tệp tin ảnh đã tải lên vào thư mục uploads
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Tạo đối tượng Product chỉ khi upload ảnh thành công
        $newProduct = new Product($_POST['id'], $_POST['name'], $_POST['price'], $_POST['amount'], $_POST['company'], $_POST['year'], $target_file);
        // Thêm sản phẩm mới vào danh sách
        addProductToList($newProduct);
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

// Xóa sản phẩm nếu có yêu cầu từ phía máy khách
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    foreach ($_SESSION['productList'] as $key => $product) {
        if ($product->id == $delete_id) {
            unset($_SESSION['productList'][$key]);
            break;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2, h3 {
            text-align: center;
        }

        form {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"], input[type="file"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .product-list {
            list-style-type: none;
            padding: 0;
        }

        .product-item {
            border: 1px solid #ccc;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
            cursor: pointer;
        }

        .product-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .product-details {
            display: none;
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f2f2f2;
        }

        .product-item.active .product-details {
            display: block;
        }

        .product-details p {
            margin: 5px 0;
            font-size: 14px;
        }

        .product-details img {
            max-width: 100%;
            height: auto;
            display: block;
            margin-top: 10px;
            border-radius: 5px;
        }

        .btn-delete {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-delete:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Product Management</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="id">ID:</label>
                <input type="text" name="id" id="id">
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name">
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" name="price" id="price">
            </div>
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="text" name="amount" id="amount">
            </div>
            <div class="form-group">
                <label for="company">Company:</label>
                <input type="text" name="company" id="company">
            </div>
            <div class="form-group">
                <label for="year">Year:</label>
                <input type="text" name="year" id="year">
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" name="image" id="image">
            </div>
            <input type="submit" value="Add Product">
        </form>

        <h2>Product List</h2>
        <ul class="product-list">
            <?php foreach ($_SESSION['productList'] as $product): ?>
                <li class="product-item">
                    <div class="product-header">
                        <h3><?php echo $product->name; ?></h3>
                        <button class="btn-delete" onclick="deleteProduct('<?php echo $product->id; ?>')">Delete</button>
                    </div>
                    <div class="product-details">
                        <p><strong>Price:</strong> $<?php echo $product->price; ?></p>
                        <p><strong>Amount:</strong> <?php echo $product->amount; ?></p>
                        <p><strong>Company:</strong> <?php echo $product->company; ?></p>
                        <p><strong>Year:</strong> <?php echo $product->year; ?></p>
                        <?php if (!empty($product->image)): ?>
                            <img src="<?php echo $product->image; ?>" alt="<?php echo $product->name; ?>">
                        <?php endif; ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var productItems = document.querySelectorAll(".product-item");
            productItems.forEach(function(item) {
                item.addEventListener("click", function() {
                    var isActive = item.classList.contains("active");
                    productItems.forEach(function(product) {
                        product.classList.remove("active");
                    });
                    if (!isActive) {
                        item.classList.add("active");
                    }
                });
            });
        });

        function deleteProduct(productId) {
            // Send AJAX request to delete product
            // After successful deletion, remove the product from the UI
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    // Remove product from UI
                    var productElement = document.getElementById("product_" + productId);
                    productElement.parentNode.removeChild(productElement);
                }
            };
            xhr.send("delete_id=" + productId);
        }
    </script>
</body>
</html>
