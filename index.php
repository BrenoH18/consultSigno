<?php include('layouts/header.php'); ?>

<body class="content-index">
    <h1 class="text-center mt-5">Descubra seu Signo</h1>
    
    <form id="signo-form" method="POST" action="show_zodiac_sign.php" class="mt-4">
        <div class="mb-3">
            <label for="data_nascimento" class="form-label">Data de Nascimento:</label>
            <input type="date" id="data_nascimento" name="data_nascimento" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Consultar Signo</button>
    </form>
    
</body>