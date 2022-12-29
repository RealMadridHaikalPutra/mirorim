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
    $quantity = $_POST['quantity'];
    $from = $_POST['from'];

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

        $masuk = mysqli_query($koneksi, "INSERT INTO updateitem(skutoko, quantityup, fromitem) values('$skut','$quantity','$from')");
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

//Update Item 5

if(isset($_POST['update5'])){
    $skut = $_POST['skutoko'];
    $quantity = $_POST['quantity'];
    $worker = $_POST['worker'];

    $ambildatastok = mysqli_query($koneksi, "SELECT * FROM stok5 WHERE skutoko='$skut'");
    $cekdata = mysqli_num_rows($ambildatastok);

    if($cekdata==0){
        echo '
            <script>
                alert("Data Barang tidak ada silahkan masukan data barang baru");
                window.location.href="baru.php";
            </script>'; 
    } else {
        $tambahqty = mysqli_query($koneksi, "SELECT * FROM  stok5 WHERE skutoko='$skut'");
        $ambilqty = mysqli_fetch_array($tambahqty);

        $qtysekarang = $ambilqty['quantity'];
        $tambahkan = $qtysekarang+$quantity;

        $masuk = mysqli_query($koneksi, "INSERT INTO updateitem5(skutoko, quantityup, worker) values('$skut','$quantity','$worker')");
        $updatestok = mysqli_query($koneksi, "update stok5 set quantity='$tambahkan' where skutoko='$skut'");
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


//exit item
if(isset($_POST['exit5'])){
    $skut = $_POST['skutoko'];
    $quantity = $_POST['quantity'];
    $picker = $_POST['picker'];
    $status = $_POST['status'];

    $ambildatastok = mysqli_query($koneksi, "SELECT * FROM stok5 WHERE skutoko='$skut'");
    $cekdata = mysqli_num_rows($ambildatastok);

    if($cekdata==0){
        echo '
            <script>
                alert("Data Barang tidak ada silahkan masukan data barang baru");
                window.location.href="baru.php";
            </script>'; 
    } else {
        $kurangqty = mysqli_query($koneksi, "SELECT * FROM  stok5 WHERE skutoko='$skut'");
        $ambilqty = mysqli_fetch_array($kurangqty);

        $qtysekarang = $ambilqty['quantity'];
        $kurangkan = $qtysekarang-$quantity;

        $masuk = mysqli_query($koneksi, "INSERT INTO exititem5(skutoko, quantityx, picker, status) values('$skut','$quantity','$picker','$status')");
        $updatestok = mysqli_query($koneksi, "update stok5 set quantity='$kurangkan' where skutoko='$skut'");
        if($masuk&&$updatestok){
            header('location:barangkeluar5.php');
        } else {
            echo '
            <script>
                alert("Barang tidak bisa dikeluarkan mohon masukan kembali lagi");
                window.location.href="update5.php";
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

//edit 5
if(isset($_POST['edit5'])){
    $namabarang = $_POST['nama'];
    $quantity = $_POST['quantity'];
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
        $update = mysqli_query($koneksi, "UPDATE stok5 SET nama = '$namabarang', quantity = '$quantity' WHERE skutoko='$skut'");
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
        move_uploaded_file($file_tmp, '../images5/'.$image);
        $update = mysqli_query($koneksi, "UPDATE stok5 SET nama = '$namabarang', image = '$image', quantity = '$quantity' WHERE skutoko='$skut'");
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

//edit ds
if(isset($_POST['editds'])){
    $skutoko = $_POST['sku'];
    $toko = $_POST['toko'];
    $tokped = $_POST['tokped'];
    $shopee = $_POST['shopee'];
    $ds = $_POST['dropshipper'];
    $adj = $_POST['adjust'];

    $updateds = mysqli_query($koneksi, "UPDATE stok SET qtytoko='$toko', tokped='$tokped', shopee='$shopee', dropshipper='$ds', adj='$adj' WHERE skutoko='$skutoko'");
    if($updateds){
        header('location:stokds.php');

    } else {
        header('location:stokds.php');
    }

}

//exit ds

if(isset($_POST['exitds'])){
    $skut = $_POST['skutoko'];
    $qty = $_POST['quantity'];

    $kurangqty = mysqli_query($koneksi, "SELECT * FROM  stok WHERE skutoko='$skut'");
    $ambilqty = mysqli_fetch_array($kurangqty);

    $qtysekarang = $ambilqty['dropshipper'];
    $kurangkan = $qtysekarang-$qty;

    $exitds = mysqli_query($koneksi, "INSERT INTO exitds (skuds,quantityds)VALUES('$skut','$qty')");
    $updatestok = mysqli_query($koneksi, "UPDATE stok SET dropshipper='$kurangkan' WHERE skutoko='$skut'");

    if($exitds&&$updatestok){
        header('location:exitds.php');
    } else {
        echo '
        <script>
            alert("Barang tidak bisa dikeluarkan");
            window.location.href="exitds.php";
        </script>'; 
    }
}

//tf bro
if(isset($_POST['tfbro'])){
    $namabarang = $_POST['nama'];
    $skut = $_POST['skutoko'];
    $quantity = $_POST['quantity'];

    //gambar
    $allowed_extension = array('png','jpg','jpeg','svg');
    $nama = $_FILES['file']['name']; //ambil gambar
    $dot = explode('.',$nama);
    $ekstensi = strtolower(end($dot)); //ambil ekstensi
    $ukuran = $_FILES['file']['size']; //ambil size
    $file_tmp = $_FILES['file']['tmp_name']; //lokasi

    //nama acak
    $image = md5(uniqid($nama,true) . time()).'.'.$ekstensi; //compile

    $ambil = mysqli_query($koneksi, "SELECT * FROM dsstok where skutoko='$skut'");
    $ceksku = mysqli_num_rows($ambil);

    if($ceksku<1){
        //jika belom ada

        //proses upload
        if(in_array($ekstensi, $allowed_extension) === true){
            //validasi ukuran
            if($ukuran < 5000000){
                move_uploaded_file($file_tmp, '../images/'.$image);
                 
                $addnew = mysqli_query($koneksi, "insert into dsstok(nama, skutoko, quantity, image) values('$namabarang','$skut','$quantity','$image')");
                if($addnew){
                    header('location:dropstok.php');
                } else {
                    header('location:stokall.php');
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
            $addnew = mysqli_query($koneksi, "insert into dsstok(nama, skutoko, quantity) values('$namabarang','$skut','$quantity')");
                if($addnew){
                    header('location:dropstok.php');
                } else {
                    header('location:stokall.php');
                }
        }
    } else {
        header('location:stokall.php');
    }
}


//add new 5
if(isset($_POST['addnew5'])){
    $namabarang = $_POST['nama'];
    $skut = $_POST['skutoko'];
    $quantity = $_POST['quantity'];

    //gambar
    $allowed_extension = array('png','jpg','jpeg','svg');
    $nama = $_FILES['file']['name']; //ambil gambar
    $dot = explode('.',$nama);
    $ekstensi = strtolower(end($dot)); //ambil ekstensi
    $ukuran = $_FILES['file']['size']; //ambil size
    $file_tmp = $_FILES['file']['tmp_name']; //lokasi

    //nama acak
    $image = md5(uniqid($nama,true) . time()).'.'.$ekstensi; //compile

    $ambil = mysqli_query($koneksi, "SELECT * FROM stok5 where skutoko='$skut'");
    $ceksku = mysqli_num_rows($ambil);

    if($ceksku<1){
        //jika belom ada

        //proses upload
        if(in_array($ekstensi, $allowed_extension) === true){
            //validasi ukuran
            if($ukuran < 5000000){
                move_uploaded_file($file_tmp, '../images5/'.$image);
                 
                $addnew = mysqli_query($koneksi, "insert into stok5(nama, skutoko, quantity, image) values('$namabarang','$skut','$quantity','$image')");
                if($addnew){
                    header('location:gudang5.php');
                } else {
                    header('location:baru5.php');
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
            $addnew = mysqli_query($koneksi, "insert into stok5(nama, skutoko, quantity) values('$namabarang','$skut','$quantity')");
                if($addnew){
                    header('location:gudang5.php');
                } else {
                    header('location:baru5.php');
                }
        }
    } else {
        header('location:baru5.php');
    }
}

//hapus semua exit item
if(isset($_POST['hapusexit'])){
    $idb = $_POST['idb'];

    $hapussemua = mysqli_query($koneksi,"DELETE FROM exititem");
    if($hapussemua){
        echo '
        <script>
            alert("Barang Berhasil di hapus akhirnya lega database nya:)");
            window.location.href="barangkeluar.php";
        </script>';
    } else {
        echo '
        <script>
            alert("Maaf barang tidak bisa di hapus");
            window.location.href="barangkeluar.php";
        </script>';
    }
}

//hapus semua update item
if(isset($_POST['hapusupdate'])){
    $idb = $_POST['idb'];

    $hapussemua = mysqli_query($koneksi,"DELETE FROM updateitem");
    if($hapussemua){
        echo '
        <script>
            alert("Barang Berhasil di hapus akhirnya lega database nya:)");
            window.location.href="updatebarang.php";
        </script>';
    } else {
        echo '
        <script>
            alert("Maaf barang tidak bisa di hapus");
            window.location.href="updatebarang.php";
        </script>';
    }
}

?>