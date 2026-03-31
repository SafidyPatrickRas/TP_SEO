<?php
namespace App\Model;

class User
{
    public static function findByEmail(string $email): ?array
    {
        $db = $GLOBALS['db'] ?? null;
        if (!$db) {
            return null;
        }

        $user = $db->fetchOne(
            'SELECT id, name, email, password, role FROM users WHERE email = ? LIMIT 1',
            [$email]
        );

        return $user ?: null;
    }

    public static function verifyPassword(string $plain, string $stored): bool
    {
        if ($stored === '') {
            return false;
        }

        $info = password_get_info($stored);
        if (($info['algo'] ?? 0) !== 0) {
            return password_verify($plain, $stored);
        }

        return hash_equals($stored, $plain);
    }
}
