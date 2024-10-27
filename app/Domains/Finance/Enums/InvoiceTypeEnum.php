<?php

namespace App\Domains\Finance\Enums;

enum InvoiceTypeEnum: string
{

    case GENERAL = 'general'; // Общий итог по типам транзакций (Доход/Расход/Сбережения)

    case PERCENTAGE_OF_INCOME = 'percentage_of_income'; // % соотношение Расходов и сбережений к доходам

    case EXPENSE_CATEGORY_TYPE = 'expense_category_type'; // по типам категорий расходов (Постоянные, переменные)

    case EXPENSE_FIXED_CATEGORY = 'expense_fixed_category'; // постоянные расходы

    case EXPENSE_DYNAMIC_CATEGORY = 'expense_dynamic_category'; // переменные расходы

    case EXPENSE_CATEGORY = 'expense_category'; // категории расходов

}
