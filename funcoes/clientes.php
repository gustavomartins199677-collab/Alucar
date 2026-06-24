<?php

// ============================================================
// FUNÇÕES DE CLIENTES
// ============================================================

function cadastrarCliente() {
    $clientes = carregarDados("clientes.json");

    echo "\n--- Cadastrar Cliente ---\n";
    $nome     = readline("Nome: ");
    $endereco = readline("Endereço: ");

    $clientes[] = [
        "id"       => count($clientes) + 1,
        "nome"     => $nome,
        "endereco" => $endereco
    ];

    salvarDados("clientes.json", $clientes);
    echo "Cliente cadastrado com sucesso!\n";
}

function editarCliente() {
    $clientes = carregarDados("clientes.json");
    listarClientes();
    if (empty($clientes)) return;

    $id = readline("\nDigite o ID do cliente que deseja editar: ");
    $encontrado = false;

    foreach ($clientes as &$cliente) {
        if ($cliente["id"] == $id) {
            echo "Deixe em branco para manter o valor atual.\n";
            $nome     = readline("Novo nome ({$cliente['nome']}): ");
            $endereco = readline("Novo endereço ({$cliente['endereco']}): ");

            if ($nome)     $cliente["nome"]     = $nome;
            if ($endereco) $cliente["endereco"] = $endereco;

            $encontrado = true;
            break;
        }
    }

    if ($encontrado) {
        salvarDados("clientes.json", $clientes);
        echo "Cliente atualizado com sucesso!\n";
    } else {
        echo "Cliente não encontrado.\n";
    }
}

function deletarCliente() {
    $clientes = carregarDados("clientes.json");
    $alugueis = carregarDados("alugueis.json");

    listarClientes();
    if (empty($clientes)) return;

    $id = readline("\nDigite o ID do cliente que deseja deletar: ");

    foreach ($alugueis as $aluguel) {
        if ($aluguel["cliente_id"] == $id && $aluguel["ativo"]) {
            echo "Não é possível deletar: cliente possui aluguel ativo!\n";
            return;
        }
    }

    foreach ($clientes as $key => $cliente) {
        if ($cliente["id"] == $id) {
            unset($clientes[$key]);
            $clientes = array_values($clientes);
            salvarDados("clientes.json", $clientes);
            echo "Cliente deletado com sucesso!\n";
            return;
        }
    }

    echo "Cliente não encontrado.\n";
}

function listarClientes() {
    $clientes = carregarDados("clientes.json");

    echo "\n--- Lista de Clientes ---\n";
    if (empty($clientes)) {
        echo "Nenhum cliente cadastrado.\n";
        return;
    }
    foreach ($clientes as $cliente) {
        echo "ID: {$cliente['id']} | Nome: {$cliente['nome']} | Endereço: {$cliente['endereco']}\n";
    }
}