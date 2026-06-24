<?php

// ============================================================
// FUNÇÕES DE ALUGUÉIS
// ============================================================

function alugarCarro() {
    $carros   = carregarDados("carros.json");
    $clientes = carregarDados("clientes.json");
    $alugueis = carregarDados("alugueis.json");

    echo "\n--- Alugar Carro ---\n";

    $carrosDisponiveis = array_filter($carros, fn($c) => $c["disponivel"]);
    if (empty($carrosDisponiveis)) {
        echo "Nenhum carro disponível no momento.\n";
        return;
    }

    if (empty($clientes)) {
        echo "Nenhum cliente cadastrado.\n";
        return;
    }

    listarCarros();
    listarClientes();

    $carroId   = readline("\nDigite o ID do carro: ");
    $clienteId = readline("Digite o ID do cliente: ");
    $dias      = readline("Quantos dias de aluguel: ");

    $carroEncontrado   = false;
    $clienteEncontrado = false;
    $valorTotal        = 0;

    foreach ($carros as &$carro) {
        if ($carro["id"] == $carroId) {
            if (!$carro["disponivel"]) {
                echo "Carro não está disponível!\n";
                return;
            }
            $carro["disponivel"] = false;
            $valorTotal = $carro["diaria"] * $dias;
            $carroEncontrado = true;
            break;
        }
    }

    foreach ($clientes as $cliente) {
        if ($cliente["id"] == $clienteId) {
            $clienteEncontrado = true;
            break;
        }
    }

    if (!$carroEncontrado)   { echo "Carro não encontrado.\n"; return; }
    if (!$clienteEncontrado) { echo "Cliente não encontrado.\n"; return; }

    $alugueis[] = [
        "id"         => count($alugueis) + 1,
        "carro_id"   => $carroId,
        "cliente_id" => $clienteId,
        "dias"       => $dias,
        "valor"      => $valorTotal,
        "ativo"      => true
    ];

    salvarDados("carros.json", $carros);
    salvarDados("alugueis.json", $alugueis);
    echo "Aluguel realizado com sucesso! Valor total: R$" . $valorTotal . "\n";
}

function devolverCarro() {
    $carros   = carregarDados("carros.json");
    $alugueis = carregarDados("alugueis.json");

    listarAlugueis();
    if (empty($alugueis)) return;

    $id = readline("\nDigite o ID do aluguel para devolver: ");

    foreach ($alugueis as &$aluguel) {
        if ($aluguel["id"] == $id && $aluguel["ativo"]) {
            $aluguel["ativo"] = false;
            foreach ($carros as &$carro) {
                if ($carro["id"] == $aluguel["carro_id"]) {
                    $carro["disponivel"] = true;
                    break;
                }
            }
            salvarDados("alugueis.json", $alugueis);
            salvarDados("carros.json", $carros);
            echo "Carro devolvido com sucesso!\n";
            return;
        }
    }

    echo "Aluguel não encontrado ou já encerrado.\n";
}

function listarAlugueis() {
    $alugueis = carregarDados("alugueis.json");
    $carros   = carregarDados("carros.json");

    echo "\n--- Aluguéis Ativos ---\n";
    $temAtivo = false;
    foreach ($alugueis as $aluguel) {
        if ($aluguel["ativo"]) {
            $temAtivo = true;
            $modelo = "?";
            foreach ($carros as $carro) {
                if ($carro["id"] == $aluguel["carro_id"]) {
                    $modelo = "{$carro['marca']} {$carro['modelo']}";
                    break;
                }
            }
            echo "ID: " . $aluguel['id'] . " | Carro: " . $modelo . " | Cliente ID: " . $aluguel['cliente_id'] . " | Dias: " . $aluguel['dias'] . " | Valor: R$" . $aluguel['valor'] . "\n";
        }
    }
    if (!$temAtivo) echo "Nenhum aluguel ativo.\n";
}