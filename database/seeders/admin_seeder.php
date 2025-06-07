<?php

use App\Core\Helpers\Hash;

return function ($db) {
    $admin = $db->query("SELECT * FROM admins WHERE email = :email", ['email' => 'admin@test.com'])->first();

    if (!$admin) {
        $hashedPassword = Hash::hash('password');

        $db->query(
            "INSERT INTO admins (username, email, password) VALUES (:username, :email, :password)",
            ['username' => 'admin', 'email' => 'admin@test.com', 'password' => $hashedPassword]
        );

        echo "Default admin user created.\n";
    } else {
        echo "Default admin user already exists.\n";
    }
};