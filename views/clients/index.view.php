<h2 class="text-xl font-semibold mb-4 flex items-center justify-between">
    Clients
    <a href="/clients/create"
       class="text-sm bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        + Create Client
    </a>
</h2>

<?php use App\Core\Helpers\Csrf;

if(!empty($clients)): ?>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded shadow-sm">
            <thead class="bg-gray-100">
            <tr>
                <th class="text-left text-sm font-medium text-gray-700 px-4 py-3 border-b">#</th>
                <th class="text-left text-sm font-medium text-gray-700 px-4 py-3 border-b">Name</th>
                <th class="text-left text-sm font-medium text-gray-700 px-4 py-3 border-b">Email</th>
                <th class="text-left text-sm font-medium text-gray-700 px-4 py-3 border-b">Phone</th>
                <th class="text-left text-sm font-medium text-gray-700 px-4 py-3 border-b">Created At</th>
                <th class="text-left text-sm font-medium text-gray-700 px-4 py-3 border-b">Actions</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
            <?php foreach ($clients as $index => $client): ?>
                <tr>
                    <td class="px-4 py-3 text-sm text-gray-800"><?= $index + 1 ?></td>
                    <td class="px-4 py-3 text-sm"><?= htmlspecialchars($client->getName()) ?></td>
                    <td class="px-4 py-3 text-sm"><?= htmlspecialchars($client->getEmail()) ?></td>
                    <td class="px-4 py-3 text-sm"><?= htmlspecialchars($client->getPhone()) ?></td>
                    <td class="px-4 py-3 text-sm"><?= htmlspecialchars($client->getCreatedAt()) ?></td>
                    <td class="px-4 py-3 text-sm space-x-2">
                        <a href="/clients/<?= $client->getId() ?>/transactions"
                           class="text-green-600 hover:underline">Transactions</a>

                        <a href="/clients/<?= $client->getId() ?>/edit" class="text-blue-600 hover:underline">Edit</a>

                        <form action="/clients/<?= $client->getId() ?>" method="POST" class="inline">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_csrf" value="<?= Csrf::getToken() ?>">
                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p class="text-gray-600">No clients found.</p>
<?php endif ?>
