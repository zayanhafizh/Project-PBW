<?php 
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "sipencari");

if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}


function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query error: " . mysqli_error($conn));
    }
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


function upload() {

    $namaFile = $_FILES["gambar"]["name"];
    $ukuran = $_FILES["gambar"]["size"];
    $error = $_FILES["gambar"]["error"];
    $tmpName = $_FILES["gambar"]["tmp_name"];

    // cek apakah ada gambar yang diupload
    if ($error === 4 ) {
        
        return false;
    }

    // cek yang diupload gambar atau bukan
    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = pathinfo($namaFile, PATHINFO_EXTENSION);

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        
        return false;
    }

    // cek ukurannya
    if ($ukuran > 1000000) {
        
        return false;
    }

    //generate nama file baru yang unik
    $newFileName = uniqid() . '.' . $ekstensiGambar;

    // lolos pengecekan gambar kemudian upload 
    if (!move_uploaded_file($tmpName, '../client/img/goodspict/'.$newFileName)) {
        
        return false;
    }

    return $newFileName;
}


function hapus($id) {
    global $conn;
    $stmt = mysqli_prepare($conn, "DELETE FROM baranghilang WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    
    return mysqli_stmt_affected_rows($stmt);
}


function ubah($data) {
    global $conn;
    $id = htmlspecialchars($data["id"]);
    $namaBarang = htmlspecialchars($data["namaBarang"]);
    $tempat = htmlspecialchars($data["tempat"]);
    $jenisBarang = htmlspecialchars($data["jenisBarang"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    if ($_FILES["gambar"]["error"] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
        if (!$gambar) {
            return false;
        }
    }

    $stmt = mysqli_prepare($conn, "UPDATE baranghilang SET namaBarang = ?, tempat = ?, jenisBarang = ?, gambar = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'ssssi', $namaBarang, $tempat, $jenisBarang, $gambar, $id);
    mysqli_stmt_execute($stmt);
    
    return mysqli_stmt_affected_rows($stmt);
}

function ubahProfil($data) {
    global $conn;
    $id = htmlspecialchars($data["id_user"]);
    $nama = htmlspecialchars($data["nama"]);
    $nim = htmlspecialchars($data["nim"]);
    $kelas = htmlspecialchars($data["kelas"]);
    $email = htmlspecialchars($data["email"]);
    
    $stmt = mysqli_prepare($conn, "UPDATE user SET nama = ?, nim = ?, kelas = ?, email = ? WHERE id_user = ?");
    mysqli_stmt_bind_param($stmt, 'ssssi', $nama, $nim, $kelas, $email, $id);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_affected_rows($stmt);
}

function uploadProfile() {
    $namaFile = $_FILES["gambar"]["name"];
    $ukuran = $_FILES["gambar"]["size"];
    $error = $_FILES["gambar"]["error"];
    $tmpName = $_FILES["gambar"]["tmp_name"];

    // cek apakah ada gambar yang di upload
    if ($error === 4 ) {
        echo "<script> 
            alert('Upload Gambar Terlebih Dahulu')
        </script>";
        return false;
    }

    // cek yang di upload gambar atau bukan
    $ekstensiGambarValid = ['jpg','jpeg','png','HEIC'];
    $ekstensiGambar = explode('.',$namaFile); //memecah nama file yang dipisahkan titik 
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script> 
            alert('yang anda upload bukan gambar')
        </script>";
    }

    // cek ukurannya
    if ($ukuran > 1000000) {
        echo "<script> 
            alert('ukuran gambar terlalu besar')
        </script>";
        return "Gambar terlalu besar";
    }

    //generate nama file baru yang unik
    $newFileName = uniqid();
    $newFileName .= '.';
    $newFileName .= $ekstensiGambar;
    

    // lolos pengecekan gambar kemudian upload 
    move_uploaded_file($tmpName,'../photoProfile/'.$newFileName);

    return $newFileName;
}

function cari($keyword) {
    global $conn;
    $keyword = "%" . $keyword . "%";
    $stmt = mysqli_prepare($conn, "SELECT * FROM baranghilang WHERE namabarang LIKE ? OR jenisBarang LIKE ? OR tempat LIKE ?");
    mysqli_stmt_bind_param($stmt, 'sss', $keyword, $keyword, $keyword);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function validateEmail($string) {
    $result = explode("@", $string);

    if ($result[1] != "stis.ac.id")
        return false;

    else {
        $nim = $result['0'];
        // Potong string menjadi tiga bagian sesuai dengan kriteria
        $firstTwo = substr($nim, 0, 2);
        $nextTwo = substr($nim, 2, 2);
        $lastTwo = substr($nim, 4, 2);

        // Cek dua digit pertama
        if (!in_array($firstTwo, ['22', '21', '11'])) {
            return false;
        }

        // Cek dua digit berikutnya
        if (!in_array($nextTwo, ['23', '22', '21', '20'])) {
            return false;
        }

        // Cek dua digit terakhir dari enam digit pertama
        if ($lastTwo !== '12') {
            return false;
        }

        // Jika semua kondisi terpenuhi, kembalikan true
        return true;
    }
        
}

function register($data) {
    global $conn;
    $username = htmlspecialchars(stripslashes($data["username"]));
    $email = strtolower(stripslashes($data["email"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);

    // Check if username already exists
    $checkusername = mysqli_prepare($conn, "SELECT username FROM user WHERE username = ?");
    mysqli_stmt_bind_param($checkusername, 's', $username);
    mysqli_stmt_execute($checkusername);
    mysqli_stmt_store_result($checkusername);

    // Check if email already exists
    $checkemail = mysqli_prepare($conn, "SELECT email FROM user WHERE email = ?");
    mysqli_stmt_bind_param($checkemail, 's', $email);
    mysqli_stmt_execute($checkemail);
    mysqli_stmt_store_result($checkemail);

    // Check if email already exists
    if (mysqli_stmt_num_rows($checkemail) > 0) {
        mysqli_stmt_close($checkemail);
        return 'emailfound';
    }
    mysqli_stmt_close($checkemail);

    // Check if username already exists
    if (mysqli_stmt_num_rows($checkusername) > 0) {
        mysqli_stmt_close($checkusername);
        return 'usernamefound';
    }
    mysqli_stmt_close($checkusername);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return 'invalidemail';
    }

    // Hash password
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Insert new user
    $stmt = mysqli_prepare($conn, "INSERT INTO user (username, email, password) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'sss', $username, $email, $passwordHash);
    mysqli_stmt_execute($stmt);
    
    $affected_rows = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    
    return $affected_rows;
}

