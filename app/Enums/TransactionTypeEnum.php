<?php

namespace App\Enums;

enum TransactionTypeEnum: string
{
    case EARNING = 'earning';
    case EXPENSE = 'expense';
}