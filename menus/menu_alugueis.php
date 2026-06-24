<?php

// ============================================================
// MENU DE ALUGUÉIS
// ============================================================

function menuAlugueis() {
    while (true) {
        echo "\n=== ALUGUÉIS ===\n";
        echo "1. Alugar carro\n";
        echo "2. Devolver carro\n";
        echo "3. Listar aluguéis ativos\n";
        echo "4. Voltar\n";
        $opcao = readline("Escolha: ");

        switch ($opcao) {
            case "1": alugarCarro(); break;
            case "2": devolverCarro(); break;
            case "3": listarAlugueis(); break;
            case "4": return;
            default: echo "Opção inválida.\n";
        }
    }
}