<?php
include "config.php";
session_start();

if(!isset($_SESSION["username"])) {
    header('Location: login.php');
    exit;
}

$user_type = $_SESSION['user_type'];
$search_query = '';
$results = [];

if(isset($_POST['search'])) {
    $search_query = mysqli_real_escape_string($conn, $_POST['search']);
    
    if($user_type == 'patient') {
        // Busca inteligente
        $keyword_sql = "SELECT specialist_type FROM keywords WHERE keyword LIKE '%{$search_query}%' LIMIT 1";
        $keyword_result = mysqli_query($conn, $keyword_sql);
        
        if(mysqli_num_rows($keyword_result) > 0) {
            $keyword_row = mysqli_fetch_assoc($keyword_result);
            $specialist = $keyword_row['specialist_type'];
            
            // Buscar médicos da especialidade
            $doctor_sql = "SELECT u.*, d.specialty, d.rating FROM users u 
                          JOIN doctors d ON u.user_id = d.user_id 
                          WHERE d.specialty LIKE '%{$specialist}%' LIMIT 10";
            $results['doctors'] = mysqli_query($conn, $doctor_sql);
        } else {
            // Busca normal por nome
            $doctor_sql = "SELECT u.*, d.specialty, d.rating FROM users u 
                          JOIN doctors d ON u.user_id = d.user_id 
                          WHERE u.firstname LIKE '%{$search_query}%' OR u.lastname LIKE '%{$search_query}%' LIMIT 10";
            $results['doctors'] = mysqli_query($conn, $doctor_sql);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RedeM - Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Nunito', sans-serif;
            background: #f5f5f5;
        }
        .navbar {
            background: white;
            padding: 15px 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .navbar-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #667eea;
        }
        .nav-links {
            display: flex;
            gap: 20px;
            list-style: none;
        }
        .nav-links a {
            text-decoration: none;
            color: #333;
            font-weight: 600;
            transition: color 0.3s;
        }
        .nav-links a:hover {
            color: #667eea;
        }
        .logout-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
        }
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 50px;
            border-radius: 15px;
            text-align: center;
            margin-bottom: 40px;
        }
        .hero h1 {
            font-size: 48px;
            margin-bottom: 15px;
        }
        .hero p {
            font-size: 18px;
            opacity: 0.9;
        }
        .search-box {
            background: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 40px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .search-form {
            display: flex;
            gap: 10px;
        }
        .search-form input {
            flex: 1;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
        }
        .search-form button {
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
        }
        .results {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        .card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-img {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
        }
        .card h3 {
            color: #333;
            margin-bottom: 5px;
        }
        .card-subtitle {
            color: #999;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .card-rating {
            color: #ffc107;
            font-weight: bold;
        }
        .btn {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            cursor: pointer;
            border: none;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-content">
            <div class="logo">🏥 RedeM</div>
            <ul class="nav-links">
                <li><a href="home.php">Home</a></li>
                <li><a href="search.php">Buscar</a></li>
                <li><a href="profile.php">Perfil</a></li>
            </ul>
            <a href="logout.php" class="logout-btn">Sair</a>
        </div>
    </nav>

    <div class="container">
        <div class="hero">
            <h1>🏥 Bem-vindo ao RedeM</h1>
            <p>Sua plataforma de saúde integrada</p>
        </div>

        <div class="search-box">
            <form method="POST" class="search-form">
                <input type="text" name="search" placeholder="O que você procura hoje? (Médico, Exame, Medicamento...)" value="<?php echo htmlspecialchars($search_query); ?>">
                <button type="submit">Buscar</button>
            </form>
        </div>

        <?php if(!empty($search_query) && isset($results['doctors'])): ?>
            <h2>Resultados para "<?php echo htmlspecialchars($search_query); ?>"</h2>
            <div class="results">
                <?php while($doctor = mysqli_fetch_assoc($results['doctors'])): ?>
                    <div class="card">
                        <div class="card-img">👨‍⚕️</div>
                        <h3><?php echo $doctor['firstname'] . ' ' . $doctor['lastname']; ?></h3>
                        <div class="card-subtitle"><?php echo $doctor['specialty']; ?></div>
                        <div class="card-rating">⭐ <?php echo $doctor['rating'] ?? '0'; ?>/5</div>
                        <button class="btn">Agendar Consulta</button>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <h2>Categorias Populares</h2>
            <div class="results">
                <div class="card">
                    <div class="card-img">👨‍⚕️</div>
                    <h3>Médicos</h3>
                    <div class="card-subtitle">Encontre especialistas</div>
                    <a href="search.php?type=doctors" class="btn">Explorar</a>
                </div>
                <div class="card">
                    <div class="card-img">🏥</div>
                    <h3>Clínicas</h3>
                    <div class="card-subtitle">Clínicas perto de você</div>
                    <a href="search.php?type=clinics" class="btn">Explorar</a>
                </div>
                <div class="card">
                    <div class="card-img">💊</div>
                    <h3>Farmácias</h3>
                    <div class="card-subtitle">Compare preços</div>
                    <a href="search.php?type=pharmacies" class="btn">Explorar</a>
                </div>
                <div class="card">
                    <div class="card-img">🔬</div>
                    <h3>Laboratórios</h3>
                    <div class="card-subtitle">Exames e testes</div>
                    <a href="search.php?type=labs" class="btn">Explorar</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>