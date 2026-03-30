<?php
namespace App\Controller;

use App\Model\User;

class AdminAuthController
{
    public function showLogin(): void
    {
        if (!empty($_SESSION['auth_user'])) {
            header('Location: /admin');
            exit;
        }

        $error = $_SESSION['auth_error'] ?? null;
        unset($_SESSION['auth_error']);

        \View::render('backend/login.php', [
            'title' => 'Connexion Admin - TP_SEO',
            'error' => $error,
        ], 'admin');
    }

    public function login(): void
    {
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($email == '' || $password == '') {
            $_SESSION['auth_error'] = 'Email et mot de passe requis.';
            header('Location: /login');
            exit;
        }

        $user = User::findByEmail($email);
        if (!$user || ($user['role'] ?? '') !== ROLE_ADMIN) {
            $_SESSION['auth_error'] = 'Compte admin introuvable.';
            header('Location: /login');
            exit;
        }

        if (!User::verifyPassword($password, $user['password'] ?? '')) {
            $_SESSION['auth_error'] = 'Mot de passe invalide.';
            header('Location: /login');
            exit;
        }

        $_SESSION['auth_user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'],
        ];

        header('Location: /admin');
        exit;
    }

    public function logout(): void
    {
        unset($_SESSION['auth_user']);
        header('Location: /login');
        exit;
    }
}
