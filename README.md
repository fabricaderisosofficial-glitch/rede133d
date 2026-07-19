# RedeM - Plataforma Integrada de Saúde 🏥

Uma plataforma completa e moderna para conectar pacientes, médicos, clínicas, farmácias e laboratórios.

## 🎯 Funcionalidades

### Para Pacientes
- ✅ Busca inteligente de médicos e serviços
- ✅ Agendar consultas
- ✅ Histórico de consultas
- ✅ Favoritos
- ✅ Comparador de preços de medicamentos
- ✅ Busca de exames
- ✅ Avaliações e comentários

### Para Médicos
- ✅ Página profissional personalizada
- ✅ Agendamento de consultas
- ✅ Publicar artigos
- ✅ Planos de assinatura (Bronze, Prata, Ouro)
- ✅ Gerenciar horários
- ✅ Chat com pacientes

### Para Clínicas
- ✅ Perfil completo da clínica
- ✅ Equipe de profissionais
- ✅ Especialidades
- ✅ Agendamento integrado
- ✅ Planos de assinatura

### Para Farmácias
- ✅ Catálogo de medicamentos
- ✅ Comparador de preços
- ✅ Localização com mapa
- ✅ Integração com laboratórios

### Para Laboratórios
- ✅ Catálogo de exames
- ✅ Convênios
- ✅ Agendamento de exames
- ✅ Resultados online

## 🔍 Busca Inteligente

A plataforma reconhece sintomas e os mapeia para especialistas:
- "Dor no peito" → Cardiologista
- "Dor nas costas" → Ortopedista
- "Dor de cabeça" → Neurologista
- "Febre" → Clínico Geral

## 📱 Tecnologias

- **Backend:** PHP com MySQLi
- **Frontend:** HTML5, CSS3, JavaScript
- **Banco de Dados:** MySQL
- **Localização:** OpenStreetMap + Leaflet JS (sem API key)
- **Autenticação:** Sessions + Password Hash

## 🚀 Como Começar

### 1. Importar o Banco de Dados
```sql
CREATE DATABASE redem_db;
USE redem_db;
SOURCE database/redem_db.sql;
```

### 2. Configurar
```php
// config.php já está configurado para localhost
$conn = mysqli_connect("localhost", "root", "", "redem_db");
```

### 3. Acessar
- Abra `http://localhost/rede133d/` no navegador
- Crie uma conta (Paciente, Médico, Clínica ou Farmácia)
- Faça login

## 📂 Estrutura de Arquivos

```
├── config.php              # Conexão com banco
├── index.php               # Registro
├── login.php               # Login
├── register.php            # Processar registro
├── auth_login.php          # Processar login
├── home.php                # Página inicial com busca
├── search.php              # Busca avançada
├── profile.php             # Perfil do usuário
├── logout.php              # Sair
├── database/
│   └── redem_db.sql        # Schema do banco
└── css/
    └── style.css           # Estilos globais
```

## 💾 Banco de Dados

### Tabelas Principais
1. **users** - Usuários (pacientes, médicos, clínicas, farmácias)
2. **doctors** - Perfil de médicos
3. **clinics** - Dados de clínicas
4. **pharmacies** - Dados de farmácias
5. **laboratories** - Dados de laboratórios
6. **medicines** - Catálogo de medicamentos
7. **appointments** - Agendamentos
8. **reviews** - Avaliações
9. **favorites** - Favoritos do usuário
10. **articles** - Artigos publicados
11. **keywords** - Mapeamento de sintomas para especialistas

## 🔐 Segurança

- ✅ Senhas com hash bcrypt
- ✅ Prepared statements contra SQL injection
- ✅ Sessions seguras
- ✅ Validação de entrada

## 📊 Planos de Assinatura

### Médicos
- **Gratuito:** Página básica
- **Bronze:** Página + Mapa + SEO
- **Prata:** Bronze + Mini Site + Blog
- **Ouro:** Tudo + Landing Page + Email Marketing + Google Ads

### Clínicas
- **Bronze:** Página básica
- **Prata:** Página + Mini Site
- **Ouro:** Tudo + recursos premium

## 🎨 Design

- Gradiente moderno (Roxo → Azul)
- Interface limpa e responsiva
- Ícones emoji para melhor UX
- Cards intuitivos

## 🤝 Contribuindo

Este é um projeto em desenvolvimento. Sinta-se livre para adicionar funcionalidades!

## 📄 Licença

MIT License - Use livremente!

---

**RedeM - Sua plataforma de saúde integrada** 🏥💊💼
