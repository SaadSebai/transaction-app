<h2 class="text-xl font-semibold mb-6">Edit Client</h2>

<form action="/clients/<?= $client->getId() ?>" method="POST" class="space-y-4">
    <input type="hidden" name="_csrf" value="<?= \App\Core\Helpers\Csrf::getToken() ?>">
    <input type="hidden" name="_method" value="PUT">

    <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
        <input type="text" id="name" name="name" value="<?= old('name', $client->getName()) ?>"
               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
               required>
    </div>

    <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" id="email" name="email" value="<?= old('email', $client->getEmail()) ?>"
               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
               required>
    </div>

    <div>
        <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
        <input type="text" id="phone" name="phone" value="<?= old('phone', $client->getPhone()) ?>"
               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div class="pt-4">
        <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
            Update Client
        </button>
    </div>
</form>
