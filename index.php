<?php
// ============================================================
// ALUCAR - Ponto de entrada do sistema
// ============================================================

// Funções
require_once "funcoes/json.php";
require_once "funcoes/carros.php";
require_once "funcoes/clientes.php";
require_once "funcoes/alugueis.php";

// Menus
require_once "menus/menu_carros.php";
require_once "menus/menu_clientes.php";
require_once "menus/menu_alugueis.php";
require_once "menus/menu_principal.php";

// Inicia o sistema
menuPrincipal();