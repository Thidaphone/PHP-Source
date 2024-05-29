<?php
            //kiem tra xam form da dc gui di hay chua
            if($_SERVER['REQUEST_METHOD']=="POST"){
                //xu ly du lieu formo day

                //gan gia tri cho action sau khi xu ly form
                $newAction= "";
            }else{
                //gia tri action ban dau
                $newAction = "displayProductByBand";
            }
?>

<form method="post" action="<?php echo $newAction; ?>">
                <div class="mb-3 mt-3">
                    <label for="" class="form-label">Select Band</label>
                    <select class="form-select form-select-lg" name="selectBand" id="">
                    <option value="Assured Night time Cold and Cough">Assured Night time Cold and Cough</option>
                    <option value="AeroGreen Antibac">AeroGreen Antibac</option>
                    <option value="Bodycology">Bodycology</option>
                    <option value="Ibuprofen">Ibuprofen</option>
                    </select>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" name="btSearch">
                        Submit
                    </button>
                </div>
            </form>



        <?php

if(isset($data["Products"])){
    //hien thi ket qua
    echo "<table>";
    echo "<tbody>";

    echo "<thead>";
    echo "<tr>";

    $fiedNames = $data["Products"]->fetch_fields();

    foreach ($fiedNames as $field){
        echo "<th class=\"text-center\">". strtoupper($field -> name)."</th>";
    }

echo "</tr>";
echo "</thead>";

while ($row = mysqli_fetch_array($data["Products"])) { // Lấy từng hàng dữ liệu của bảng "Products"
    echo "<tr>"; // Bắt đầu một hàng mới trong bảng
    
    echo "<td class=\"text-left\">" . $row["id"] . "</td>"; // Hiển thị mã sản phẩm
    echo "<td class=\"text-left\">" . $row["pid"] . "</td>"; // Hiển thị mã PID của sản phẩm
    echo "<td class=\"text-left\">" . $row["pname"] . "</td>"; // Hiển thị tên sản phẩm
    echo "<td class=\"text-left\">" . $row["company"] . "</td>"; // Hiển thị tên công ty
    echo "<td class=\"text-left\">" . $row["year"] . "</td>"; // Hiển thị năm sản xuất
    echo "<td class=\"text-left\">" . $row["band"] . "</td>"; // Hiển thị tên ban nhạc
    echo "<td class=\"text-left\">" . '<img src="' . $row["pimage"] . '" alt="Image">' . "</td>"; // Hiển thị hình ảnh sản phẩm
    
    echo "</tr>"; // Kết thúc hàng trong bảng
}

echo "</tbody>"; // Đóng phần thân của bảng
echo "</table>"; // Đóng bảng
}
?>      