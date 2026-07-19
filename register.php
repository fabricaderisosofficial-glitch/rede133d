<?php
include "config.php";

$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$user_type = mysqli_real_escape_string($conn, $_POST['user_type']);
$profile_img = "profile-placeholder.jpg";

// Verificar se usuário já existe
$check_sql = "SELECT username FROM users WHERE username = '{$username}' OR email = '{$email}'";
$check_result = mysqli_query($conn, $check_sql);

if(mysqli_num_rows($check_result) > 0) {
    header('Location: index.php?msg=user_exists');
    exit;
}

// Inserir novo usuário
$sql = "INSERT INTO users (firstname, lastname, email, username, password, user_type, profile_img) 
        VALUES ('{$firstname}', '{$lastname}', '{$email}', '{$username}', '{$password}', '{$user_type}', '{$profile_img}')";

if(mysqli_query($conn, $sql)) {
    $user_id = mysqli_insert_id($conn);
    
    // Se for médico, criar registro em doctors
    if($user_type == 'doctor') {
        $doctor_sql = "INSERT INTO doctors (user_id, specialty, crm) VALUES ({$user_id}, 'Geral', 'CRM-PLACEHOLDER')";
        mysqli_query($conn, $doctor_sql);
    }
    // Se for clínica
    else if($user_type == 'clinic') {
        $clinic_sql = "INSERT INTO clinics (user_id, clinic_name) VALUES ({$user_id}, '{$firstname}')";
        mysqli_query($conn, $clinic_sql);
    }
    // Se for farmácia
    else if($user_type == 'pharmacy') {
        $pharmacy_sql = "INSERT INTO pharmacies (user_id, pharmacy_name) VALUES ({$user_id}, '{$firstname}')";
        mysqli_query($conn, $pharmacy_sql);
    }
    
    header('Location: login.php?msg=success');
} else {
    echo "Erro no cadastro: " . mysqli_error($conn);
}

mysqli_close($conn);
?>