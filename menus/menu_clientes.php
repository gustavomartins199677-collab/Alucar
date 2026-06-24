<?php

// ============================================================
// MENU DE CLIENTES
// ============================================================

function menuClientes() {
    while (true) {
        echo "\n=== CLIENTES ===\n";
        echo "1. Cadastrar cliente\n";
        echo "2. Editar cliente\n";
        echo "3. Deletar cliente\n";
        echo "4. Listar clientes\n";
        echo "5. Voltar\n";
        $opcao = readline("Escolha: ");

        switch ($opcao) {
            case "1": cadastrarCliente(); break;
            case "2": editarCliente(); break;
            case "3": deletarCliente(); break;
            case "4": listarClientes(); break;
            case "5": return;
            default: echo "Opção inválida.\n";
        }
    }
}