<h2 class="text-xl font-semibold mb-4 flex items-center justify-between">
    Client Transactions
    <a href="/clients/<?= $client ?>/transactions/create"
       class="text-sm bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        + Transactions Client
    </a>
</h2>

<form method="GET" class="mb-6 flex gap-4 items-end">
    <div>
        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
        <input type="date" id="start_date" name="start_date" value="<?= old('start_date', $start_date) ?>"
               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" />
    </div>

    <div>
        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
        <input type="date" id="end_date" name="end_date" value="<?= old('end_date', $end_date) ?>"
               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" />
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Filter
    </button>

    <a href="?" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
        Clear
    </a>
</form>

<?php use App\Enums\TransactionTypeEnum;

if (!empty($transactions)): ?>

    <div class="mb-4 p-4 bg-gray-100 border border-gray-300 rounded text-gray-800 font-medium">
        Current Balance:
        <span class="<?= $balance >= 0 ? 'text-green-600' : 'text-red-600' ?>">
            <?= number_format($balance, 2) ?> <?= htmlspecialchars($transactions[0]->getCurrency()->value) ?>
        </span>
    </div>

    <div class="overflow-x-auto">

        <table class="min-w-full bg-white border border-gray-200 rounded shadow-sm">
            <thead class="bg-gray-100">
            <tr>
                <th class="text-left text-sm font-medium text-gray-700 px-4 py-3 border-b">#</th>
                <th class="text-left text-sm font-medium text-gray-700 px-4 py-3 border-b">Amount</th>
                <th class="text-left text-sm font-medium text-gray-700 px-4 py-3 border-b">Type</th>
                <th class="text-left text-sm font-medium text-gray-700 px-4 py-3 border-b">Description</th>
                <th class="text-left text-sm font-medium text-gray-700 px-4 py-3 border-b">Created At</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
            <?php foreach ($transactions as $index => $transaction): ?>
                <tr>
                    <td class="px-4 py-3 text-sm text-gray-800"><?= $index + 1 ?></td>
                    <td class="px-4 py-3 text-sm text-blue-700 font-semibold"><?= number_format($transaction->getAmount(), 2) . ' ' . htmlspecialchars($transaction->getCurrency()->value) ?></td>
                    <td class="px-4 py-3 text-sm">
                        <span class="<?= $transaction->getType() === TransactionTypeEnum::EARNING ? 'text-green-600' : 'text-red-600' ?>">
                            <?= htmlspecialchars($transaction->getType()->value) ?>
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm"><?= htmlspecialchars($transaction->getDescription()) ?></td>
                    <td class="px-4 py-3 text-sm"><?= htmlspecialchars($transaction->getCreatedAt()) ?></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p class="text-gray-600">No transactions found for this client.</p>
<?php endif ?>
