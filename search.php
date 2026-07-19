<?php
include "config.php";
session_start();

if(!isset($_SESSION["username"])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar - RedeM</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">
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
        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }
        .search-filters {
            background: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
        }
        .filter-btn {
            padding: 10px;
            border: 2px solid #ddd;
            background: white;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .filter-btn:hover,
        .filter-btn.active {
            border-color: #667eea;
            background: #667eea;
            color: white;
        }
        .results {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        .card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            text-align: center;
        }
        .card-body {
            padding: 20px;
        }
        .card-body h3 {
            color: #333;
            margin-bottom: 5px;
        }
        .card-body p {
            color: #999;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .btn {
            display: inline-block;
            padding: 8px 15px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Buscar Serviços de Saúde</h1>
        
        <div class="search-filters">
            <h2>O que você procura?</h2>
            <div class="filter-grid">
                <button class="filter-btn" onclick="filterSearch('doctors')">👨‍⚕️ Médicos</button>
                <button class="filter-btn" onclick="filterSearch('clinics')">🏥 Clínicas</button>
                <button class="filter-btn" onclick="filterSearch('pharmacies')">💊 Farmácias</button>
                <button class="filter-btn" onclick="filterSearch('labs')">🔬 Laboratórios</button>
                <button class="filter-btn" onclick="filterSearch('articles')">📰 Artigos</button>
            </div>
        </div>

        <div id="results-container" class="results">
            <p>Selecione uma categoria para começar</p>
        </div>
    </div>

    <script>
        function filterSearch(type) {
            const container = document.getElementById('results-container');
            
            // Simular resultados
            const results = {
                doctors: '<div class="card"><div class="card-header">👨‍⚕️ Dr. João Silva</div><div class="card-body"><h3>Cardiologista</h3><p>⭐ 4.8/5 (120 avaliações)</p><p>📍 São Paulo, SP</p><button class="btn">Ver Perfil</button></div></div>',
                clinics: '<div class="card"><div class="card-header">🏥 Clínica Saúde Plus</div><div class="card-body"><h3>Clínica Geral</h3><p>⭐ 4.5/5 (85 avaliações)</p><p>📍 Próximo a você</p><button class="btn">Ver Detalhes</button></div></div>',
                pharmacies: '<div class="card"><div class="card-header">💊 Farmácia Central</div><div class="card-body"><h3>Farmácia 24h</h3><p>Dipirona - R$ 12,90</p><p>📍 Zona Central</p><button class="btn">Comprar</button></div></div>',
                labs: '<div class="card"><div class="card-header">🔬 Lab Análises</div><div class="card-body"><h3>Laboratório de Análises</h3><p>Hemograma: R$ 85,00</p><p>📍 Próximo a você</p><button class="btn">Agendar</button></div></div>',
                articles: '<div class="card"><div class="card-header">📰 Artigo</div><div class="card-body"><h3>Saúde do Coração</h3><p>Dicas e cuidados essenciais</p><p>Por Dr. Silva</p><button class="btn">Ler Mais</button></div></div>'
            };
            
            container.innerHTML = results[type] || '<p>Nenhum resultado encontrado</p>';
        }
    </script>
</body>
</html>