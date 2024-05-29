<?php

use LDAP\Result;

class ProductModel extends dbProduct{ //xu li du lieu(them sua xoa o day het)
    public function getRecords($tablename){
        $qr = "SELECT * FROM $tablename";
        return mysqli_query($this->con, $qr);
    }

    public function getRecordsbyField($tablename,$field, $keyword){
        $sql = "SELECT * FROM $tablename WHERE $field ='$keyword'";
        return mysqli_query($this->con, $sql);
    }

    public function getRecordsbyFields($tablename, $field1, $keyword1, $field2, $keyword2){
        $sql = "SELECT * FROM $tablename WHERE $field1 ='$keyword1' AND $field2 = '$keyword2'";
        return mysqli_query($this->con, $sql);
    }

    //insert
    public function insertProduct($id, $pname, $company, $year, $band, $pimage){
        $result = false;
        $sql = "insert into tblProduct(pid, pname, company, year, band, piamge)
        values('$id', '$pname', '$company', '$year', '$band', '$pimage')";
        if (mysqli_query($this -> con, $sql)){
            $result = true;
        }
        //return mysqli_query($this->con, $sql);
        return json_decode($result);

    
}
}
?>