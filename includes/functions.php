<?php
/**
 * INTRANET MAIRIE D'YZEURE
 * Fonctions utilitaires globales
 */

/**
 * Démarre une session sécurisée si pas déjà démarrée
 */
function start_secure_session(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

/**
 * Protège contre les failles XSS (échappe le HTML)
 */
function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

/**
 * Redirection simple vers une URL relative
 */
function redirect(string $path): void
{
    header('Location: ' . $path);
    exit;
}

/**
 * Vérifie si un utilisateur est connecté
 */
function is_logged_in(): bool
{
    start_secure_session();
    return isset($_SESSION['user']);
}

/**
 * Retourne l'utilisateur connecté ou null
 */
function current_user(): ?array
{
    start_secure_session();
    return $_SESSION['user'] ?? null;
}

/**
 * Exige que l'utilisateur soit connecté, sinon redirige vers login
 */
function require_login(): void
{
    if (!is_logged_in()) {
        redirect('/intranet-yzeure/public/index.php?route=login');
    }
}
/**À quoi ça sert (pour toi):

start_secure_session() : lance la session proprement.

e() : sert à afficher du texte en étant protégé contre XSS.

redirect() : redirige vers une autre page.

is_logged_in() / current_user() / require_login() : base du système d’authentification.

 */