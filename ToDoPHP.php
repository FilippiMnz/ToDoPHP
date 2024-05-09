<?php
function exibirTarefas($tarefas) {
    echo "=== Lista de Tarefas ===\n";
    foreach ($tarefas as $indice => $tarefa) {
        echo ($indice + 1) . ". $tarefa\n";
    }
    echo "========================\n";
    sleep(2);
}

function carregarTarefas() {
    $nomeArquivo = "ListaTarefas.txt";
    if (file_exists($nomeArquivo)) {
        $conteudo = file_get_contents($nomeArquivo);
        return explode("\n", $conteudo);
    } else {
        file_put_contents($nomeArquivo, "");
        return [];
    }
}


function salvarTarefas($tarefas) {
    $nomeArquivo = "ListaTarefas.txt";
    $conteudo = implode("\n", $tarefas);
    file_put_contents($nomeArquivo, $conteudo);
}

// Carregar as tarefas existentes
$tarefas = carregarTarefas();


while (true) {
    // Exibe o menu
    echo "=== Menu ===\n";
    echo "1. Adicionar tarefa\n";
    echo "2. Remover tarefa\n";
    echo "3. Exibir tarefas\n";
    echo "4. Sair\n";
    echo "===========\n";
    echo "Escolha uma opção: ";

    $opcao = trim(fgets(STDIN));

    switch ($opcao) {
        case 1:
            echo "Digite a tarefa a ser adicionada: ";
            $novaTarefa = trim(fgets(STDIN));
            $tarefas[] = $novaTarefa;
            echo "Tarefa adicionada com sucesso!\n";
            sleep(2);
            break;
        case 2:
            exibirTarefas($tarefas);
            echo "Digite o número da tarefa a ser removida: ";
            $indiceRemover = intval(trim(fgets(STDIN))) - 1;
            if (isset($tarefas[$indiceRemover])) {
                unset($tarefas[$indiceRemover]);
                $tarefas = array_values($tarefas);
                echo "Tarefa removida com sucesso!\n";
            } else {
                echo "Tarefa não encontrada!\n";
            }
            break;
        case 3:
            exibirTarefas($tarefas);
            sleep(2);
            break;
        case 4:
            salvarTarefas($tarefas);
            echo "Saindo...\n";
            exit;
        default:
            echo "Opção inválida!\n";
            break;
    }
}

?>
