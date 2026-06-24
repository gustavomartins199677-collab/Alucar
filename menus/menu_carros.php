<?php

// ============================================================
// MENU DE CARROS
// ============================================================

function menuCarros() {
    while (true) {
        echo "\n=== CARROS ===\n";
        echo "1. Cadastrar carro\n";
        echo "2. Editar carro\n";
        echo "3. Deletar carro\n";
        echo "4. Listar carros\n";
        echo "5. Voltar\n";
        $opcao = readline("Escolha: ");

        switch ($opcao) {
            case "1": cadastrarCarro(); break;
            case "2": editarCarro(); break;
            case "3": deletarCarro(); break;
            case "4": listarCarros(); break;
            case "5": return;
            default: echo "Opção inválida.\n";
        }
    }
}