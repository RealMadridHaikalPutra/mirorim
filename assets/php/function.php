<?php

$koneksi = mysqli_connect("localhost","root","","mirorim");


//Add New
if(isset($_POST['addnew'])){
    $namabarang = $_POST['nama'];
    $skut = $_POST['skutoko'];
    $skug = $_POST['skugudang'];
    $gudang = $_POST['gudang'];
    $quantity = $_POST['quantity'];
    $from = $_POST['from'];

    //gambar
    $allowed_extension = array('png','jpg','jpeg','svg');
    $nama = $_FILES['file']['name']; //ambil gambar
    $dot = explode('.',$nama);
    $ekstensi = strtolower(end($dot)); //ambil ekstensi
    $ukuran = $_FILES['file']['size']; //ambil size
    $file_tmp = $_FILES['file']['tmp_name']; //lokasi

    //nama acak
    $image = md5(uniqid($nama,true) . time()).'.'.$ekstensi; //compile

    $ambil = mysqli_query($koneksi, "SELECT * FROM stok where skutoko='$skut'");
    $ceksku = mysqli_num_rows($ambil);

    if($ceksku<1){
        //jika belom ada

        //proses upload
        if(in_array($ekstensi, $allowed_extension) === true){
            //validasi ukuran
            if($ukuran < 5000000){
                move_uploaded_file($file_tmp, '../images/'.$image);
                 
                $addnew = mysqli_query($koneksi, "insert into stok(nama, skutoko, skugudang, gudang, quantity, image) values('$namabarang','$skut','$skug','$gudang','$quantity','$image')");
                if($addnew){
                    header('location:gudang.php');
                } else {
                    header('location:baru.php');
                }
            } else {
                //kalau file lebih dari 5mb
                echo '
                    <script>
                        alert("Kelebihan muatan woiii ga muat database");
                        window.location.href="baru.php";
                    </script>'; 
            }
        } else {
            //kalau gambar selain filter
            $addnew = mysqli_query($koneksi, "insert into stok(nama, skutoko, skugudang, gudang, quantity) values('$namabarang','$skut','$skug','$gudang','$quantity')");
                if($addnew){
                    header('location:gudang.php');
                } else {
                    header('location:baru.php');
                }
        }
    } else {
        header('location:baru.php');
    }
}

//Update Item

if(isset($_POST['update'])){
    $skut = $_POST['skutoko'];
    $skug = $_POST['skugudang'];
    $quantity = $_POST['quantity'];
    $from = $_POST['from'];
    $gudang = $_POST['gudang'];

    $ambildatastok = mysqli_query($koneksi, "SELECT * FROM stok WHERE skutoko='$skut'");
    $cekdata = mysqli_num_rows($ambildatastok);

    if($cekdata==0){
        echo '
            <script>
                alert("Data Barang tidak ada silahkan masukan data barang baru");
                window.location.href="baru.php";
            </script>'; 
    } else {
        $tambahqty = mysqli_query($koneksi, "SELECT * FROM  stok WHERE skutoko='$skut'");
        $ambilqty = mysqli_fetch_array($tambahqty);

        $qtysekarang = $ambilqty['quantity'];
        $tambahkan = $qtysekarang+$quantity;

        $masuk = mysqli_query($koneksi, "INSERT INTO updateitem(skutoko, skugudang, quantityup, fromitem, gudang) values('$skut','$skug','$quantity','$from','$gudang')");
        $updatestok = mysqli_query($koneksi, "update stok set quantity='$tambahkan' where skutoko='$skut'");
        if($masuk&&$updatestok){
            header('location:updatebarang.php');
        } else {
            echo '
            <script>
                alert("Barang tidak bisa diupdate");
                window.location.href="update.php";
            </script>'; 
        }
    }
}

//exit item
if(isset($_POST['exit'])){
    $skut = $_POST['skutoko'];
    $quantity = $_POST['quantity'];
    $picker = $_POST['picker'];
    $status = $_POST['status'];

    $ambildatastok = mysqli_query($koneksi, "SELECT * FROM stok WHERE skutoko='$skut'");
    $cekdata = mysqli_num_rows($ambildatastok);

    if($cekdata==0){
        echo '
            <script>
                alert("Data Barang tidak ada silahkan masukan data barang baru");
                window.location.href="baru.php";
            </script>'; 
    } else {
        $kurangqty = mysqli_query($koneksi, "SELECT * FROM  stok WHERE skutoko='$skut'");
        $ambilqty = mysqli_fetch_array($kurangqty);

        $qtysekarang = $ambilqty['quantity'];
        $kurangkan = $qtysekarang-$quantity;

        $masuk = mysqli_query($koneksi, "INSERT INTO exititem(skutoko, quantityx, picker, status) values('$skut','$quantity','$picker','$status')");
        $updatestok = mysqli_query($koneksi, "update stok set quantity='$kurangkan' where skutoko='$skut'");
        if($masuk&&$updatestok){
            header('location:barangkeluar.php');
        } else {
            echo '
            <script>
                alert("Barang tidak bisa dikeluarkan mohon kocok lagi");
                window.location.href="update.php";
            </script>'; 
        }
    }
}

//updateee aja
if(isset($_POST['editaja'])){
    $idb = $_POST['idstok'];
    $namabarang = $_POST['nama'];
    $skug  = $_POST['skugudang'];
    $quantity = $_POST['quantity'];
    $gudang = $_POST['gudang'];
    $skut = $_POST['skutoko'];

    //gambar
    $allowed_extension = array('png','jpg','jpeg','svg');
    $nama = $_FILES['file']['name']; //ambil gambar
    $dot = explode('.',$nama);
    $ekstensi = strtolower(end($dot)); //ambil ekstensi
    $ukuran = $_FILES['file']['size']; //ambil size
    $file_tmp = $_FILES['file']['tmp_name']; //lokasi

    //nama acak
    $image = md5(uniqid($nama,true) . time()).'.'.$ekstensi; //compile

    if($ukuran==0){
        $update = mysqli_query($koneksi, "UPDATE stok SET nama = '$namabarang',  skugudang = '$skug', quantity = '$quantity', gudang = '$gudang' WHERE skutoko='$skut'");
        if($update){
            header('location:gudang.php');
        } else {
            echo '
            <script>
                alert("Barang Tidak bisa di update");
                window.location.href="gudang.php";
            </script>'; 
            }
        } else {
        move_uploaded_file($file_tmp, '../images/'.$image);
        $update = mysqli_query($koneksi, "UPDATE stok SET nama = '$namabarang',  skugudang = '$skug', image = '$image', quantity = '$quantity', gudang = '$gudang' WHERE skutoko='$skut'");
        if($update){
            header('location:gudang.php');
        } else {
            echo '
            <script>
                alert("Barang dan Gambar Tidak bisa di update");
                window.location.href="gudang.php";
            </script>'; 
            }
        }
}

//updateee 5
if(isset($_POST['edit5'])){
    $idb = $_POST['idstok'];
    $namabarang = $_POST['nama'];
    $skug  = $_POST['skugudang'];
    $quantity = $_POST['quantity'];
    $gudang = $_POST['gudang'];
    $skut = $_POST['skutoko'];

    //gambar
    $allowed_extension = array('png','jpg','jpeg','svg');
    $nama = $_FILES['file']['name']; //ambil gambar
    $dot = explode('.',$nama);
    $ekstensi = strtolower(end($dot)); //ambil ekstensi
    $ukuran = $_FILES['file']['size']; //ambil size
    $file_tmp = $_FILES['file']['tmp_name']; //lokasi

    //nama acak
    $image = md5(uniqid($nama,true) . time()).'.'.$ekstensi; //compile

    if($ukuran==0){
        $update = mysqli_query($koneksi, "UPDATE stok SET nama = '$namabarang',  skugudang = '$skug', quantity = '$quantity', gudang = '$gudang' WHERE skutoko='$skut'");
        if($update){
            header('location:gudang5.php');
        } else {
            echo '
            <script>
                alert("Barang Tidak bisa di update");
                window.location.href="gudang5.php";
            </script>'; 
            }
        } else {
        move_uploaded_file($file_tmp, '../images/'.$image);
        $update = mysqli_query($koneksi, "UPDATE stok SET nama = '$namabarang',  skugudang = '$skug', image = '$image', quantity = '$quantity', gudang = '$gudang' WHERE skutoko='$skut'");
        if($update){
            header('location:gudang5.php');
        } else {
            echo '
            <script>
                alert("Barang dan Gambar Tidak bisa di update");
                window.location.href="gudang5.php";
            </script>'; 
            }
        }
}




?>