<?php

use App\Enums\TransactionTypeEnum;

return function ($db) {
    $db->query("
        CREATE TABLE IF NOT EXISTS transactions (
            id INT AUTO_INCREMENT PRIMARY KEY,
            client_id INT NOT NULL,
            amount DECIMAL(10,2) NOT NULL,
            currency VARCHAR(100) NOT NULL,
            type ENUM(:earning, :expense) NOT NULL,
            description TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE
        ) ENGINE=InnoDB;
    ", ['earning' => TransactionTypeEnum::EARNING->value, 'expense' => TransactionTypeEnum::EXPENSE->value]);
};
