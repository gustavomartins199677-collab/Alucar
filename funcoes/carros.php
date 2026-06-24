<?php

// ============================================================
// FUNÇÕES DE CARROS
// ============================================================

function cadastrarCarro() {
    $carros = carregarDados("carros.json");

    echo "\n--- Cadastrar Carro ---\n";
    $modelo = readline("Modelo: ");
    $marca  = readline("Marca: ");
    $placa  = readline("Placa: ");
    $ano    = readline("Ano: ");
    $diaria = readline("Valor da diária (R$): ");

    $carros[] = [
        "id"         => count($carros) + 1,
        "modelo"     => $modelo,
        "marca"      => $marca,
        "placa"      => $placa,
        "ano"        => $ano,
        "diaria"     => $diaria,
        "disponivel" => true
    ];

    salvarDados("carros.json", $carros);
    echo "Carro cadastrado com sucesso!\n";
}

function editarCarro() {
    $carros = carregarDados("carros.json");
    listarCarros();
    if (empty($carros)) return;

    $id = readline("\nDigite o ID do carro que deseja editar: ");
    $encontrado = false;

    foreach ($carros as &$carro) {
        if ($carro["id"] == $id) {
            echo "Deixe em branco para manter o valor atual.\n";
            $modelo = readline("Novo modelo ({$carro['modelo']}): ");
            $marca  = readline("Nova marca ({$carro['marca']}): ");
            $placa  = readline("Nova placa ({$carro['placa']}): ");
            $ano    = readline("Novo ano ({$carro['ano']}): ");
            $diaria = readline("Nova diária ({$carro['diaria']}): ");

            if ($modelo) $carro["modelo"] = $modelo;
            if ($marca)  $carro["marca"]  = $marca;
            if ($placa)  $carro["placa"]  = $placa;
            if ($ano)    $carro["ano"]    = $ano;
            if ($diaria) $carro["diaria"] = $diaria;

            $encontrado = true;
            break;
        }
    }

    if ($encontrado) {
        salvarDados("carros.json", $carros);
        echo "Carro atualizado com sucesso!\n";
    } else {
        echo "Carro não encontrado.\n";
    }
}

function deletarCarro() {
    $carros   = carregarDados("carros.json");
    $alugueis = carregarDados("alugueis.json");

    listarCarros();
    if (empty($carros)) return;

    $id = readline("\nDigite o ID do carro que deseja deletar: ");

    foreach ($alugueis as $aluguel) {
        if ($aluguel["carro_id"] == $id && $aluguel["ativo"]) {
            echo "Não é possível deletar: carro está alugado!\n";
            return;
        }
    }

    foreach ($carros as $key => $carro) {
        if ($carro["id"] == $id) {
            unset($carros[$key]);
            $carros = array_values($carros);
            salvarDados("carros.json", $carros);
            echo "Carro deletado com sucesso!\n";
            return;
        }
    }

    echo "Carro não encontrado.\n";
}

function listarCarros() {
    $carros = carregarDados("carros.json");

    echo "\n--- Lista de Carros ---\n";
    if (empty($carros)) {
        echo "Nenhum carro cadastrado.\n";
        return;
    }
    foreach ($carros as $carro) {
        $status = $carro["disponivel"] ? "Disponível" : "Alugado";
        echo "ID: {$carro['id']} | {$carro['marca']} {$carro['modelo']} | Placa: {$carro['placa']} | Ano: {$carro['ano']} | Diária: R${$carro['diaria']} | {$status}\n";
    }
}