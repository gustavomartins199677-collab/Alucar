<?php

// ============================================================
// FUNÇÕES DE JSON - Leitura e escrita dos dados
// ============================================================

define('DADOS_DIR', __DIR__ . '/../dados/');

function carregarDados($arquivo) {
    $caminho = DADOS_DIR . $arquivo;
    if (!file_exists($caminho)) return [];
    $conteudo = file_get_contents($caminho);
    return json_decode($conteudo, true) ?? [];
}

function salvarDados($arquivo, $dados) {
    $caminho = DADOS_DIR . $arquivo;
    file_put_contents($caminho, json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}