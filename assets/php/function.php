<?php

$koneksi = mysqli_connect("localhost","root","","mirorim");

if(isset($_POST['addnew'])){
    $nama = $_POST['nama'];
    $skut = $_POST['skutoko'];
    $skug = $_POST['skugudang'];
    $gudang = $_POST['gudang'];
    $quantity = $_POST['quantity'];

    $addnew = mysqli_query($koneksi, "SELECT * FROM stok where skutoko='$skut'");
    $ceksku = mysqli_num_rows($addnew);

    if($ceksku==0){
        mysqli_query($koneksi, "insert into stok(nama, skutoko, skugudang, gudang, quantity) values('$nama','$skut','$skug','$gudang','$quantity')");
        header('location:gudang.html');
    
    } else {
        header('location:baru.php');
    }
}


?>