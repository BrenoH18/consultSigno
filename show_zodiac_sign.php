<?php include('layouts/header.php'); ?>

<body class="content-result">
    <?php
    $data_nascimento = $_POST['data_nascimento']; // Recebe a data de nascimento enviada via POST
    $signos = simplexml_load_file("signos.xml"); // Carrega o arquivo XML que contém os signos

    $signoEncontrado = null; // Variável para armazenar o signo correspondente à data de nascimento
    
    // Converte a data de nascimento recebida para um objeto DateTime
    $dataNascimento = DateTime::createFromFormat('Y-m-d', $data_nascimento);

    // Converte a data de nascimento para o formato 'd/m' (String)
    $dataNascimento = $dataNascimento->format('d/m');
    
    // Loop para percorrer cada signo no arquivo XML
    for ($i = 0; $i < count($signos->signo); $i++) {
        $signo = $signos->signo[$i]; // Acessa o signo atual pelo índice

        // Converte a data de Nascimento e as datas de início e fim do signo para o ano atual (DateTime)
        $dataNascimentoObj = DateTime::createFromFormat('d/m/Y', $dataNascimento . '/' . date('Y'));
        $dataInicio = DateTime::createFromFormat('d/m/Y', $signo->dataInicio . '/' . date('Y'));
        $dataFim = DateTime::createFromFormat('d/m/Y', $signo->dataFim . '/' . date('Y'));

        // Verifica se o mês da dataFim é janeiro (01), e se sim, ajusta o ano para o próximo
        if ($dataFim->format('m') == '01') {
            $dataFim->modify('+1 year');
        }
        
        if($dataInicio->format('m') == '12'){
            $dataInicio->modify('-1 year');
        }

        // Verifica se a data de nascimento está dentro do intervalo de um signo
        if ($dataNascimentoObj >= $dataInicio && $dataNascimentoObj <= $dataFim) {
            $signoEncontrado = $signo->signoNome; // Atribui o nome do signo encontrado

            // echo ('Data de Nascimento: ' . $dataNascimentoObj->format('d/m') . '<br>');
            // echo ('Data de Início: ' . $dataInicio->format('d/m') . '<br>');
            // echo ('Data de Fim: ' . $dataFim->format('d/m') . '<br>');
            // echo ('Signo encontrado: ' . $signoEncontrado . '<br>');
            break; // Interrompe o loop quando o signo é encontrado
        }
    }

    // Exibe o resultado para o usuário
    if ($signoEncontrado) {
        echo "<h2 class='mt-5'>{$signoEncontrado}</h2>";
        echo "<p>{$signos->signo[$i]->descricao}</p>"; // Exibe a descrição do signo (se disponível no XML)
    } else {
        echo "<h2 class='mt-5'>Signo não encontrado para a data informada.</h2>"; // Exibe um aviso caso nenhum signo corresponda à data
    }
    ?>
    
    <!-- Botão para voltar à página inicial -->
    <a href="index.php" class="btn btn-secondary">Voltar</a>
    
</body>
