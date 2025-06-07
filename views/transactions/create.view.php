<?php use App\Core\Helpers\Csrf;
use App\Enums\CurrencyEnum;
use App\Enums\TransactionTypeEnum; ?>

<h2 class="text-xl font-semibold mb-6">Add Transaction</h2>

<form action="/clients/<?= $client ?>/transactions" method="POST" class="space-y-4">
    <input type="hidden" name="_csrf" value="<?= Csrf::getToken() ?>">

    <div>
        <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
        <input type="number" step="0.01" id="amount" name="amount" value="<?= old('amount') ?>"
               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
               required>
    </div>

    <div>
        <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
        <select id="type" name="type"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
            <?php foreach (TransactionTypeEnum::cases() as $case): ?>
                <option value="<?= $case->value ?>" <?= old('type') === $case->value ? 'selected' : '' ?>>
                    <?= ucfirst(strtolower($case->name)) ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>

    <div>
        <label for="currency" class="block text-sm font-medium text-gray-700">Currency</label>
        <select id="currency" name="currency"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
            <?php foreach (CurrencyEnum::cases() as $case): ?>
                <option value="<?= $case->value ?>" <?= old('currency') === $case->value ? 'selected' : '' ?>>
                    <?= strtoupper($case->name) ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
        <textarea id="description" name="description" rows="3"
                  class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                  ><?= old('description') ?></textarea>
    </div>

    <div class="pt-4">
        <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
            Save Transaction
        </button>
    </div>
</form>
