<?php

// ============================================================
// MENU PRINCIPAL
// ============================================================

function menuPrincipal() {
    while (true) {
        echo "\n=== ALUCAR - Sistema de Aluguel de Carros ===\n";
        echo "1. Carros\n";
        echo "2. Clientes\n";
        echo "3. Aluguéis\n";
        echo "4. Sair\n";
        $opcao = readline("Escolha uma opção: ");

        switch ($opcao) {
            case "1": menuCarros(); break;
            case "2": menuClientes(); break;
            case "3": menuAlugueis(); break;
            case "4":
                echo "Encerrando o sistema. Até logo!\n";
                exit;
            default:
                echo "Opção inválida.\n";
        }
    }
}