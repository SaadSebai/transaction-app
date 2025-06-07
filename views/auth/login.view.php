<h2 class="text-2xl font-semibold text-center mb-6 text-gray-800">Login</h2>

<form action="/login" method="POST" class="space-y-4">
    <?php use App\Core\Helpers\Csrf;
    use App\Core\Session;

    if (Session::has('errors'))
    {
        $errors = Session::get('errors');
        foreach (Session::get('errors') as $error)
            echo "<p class='text-red-600 text-sm'>$error</p>";
    }
    ?>
    <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" id="email" name="email" value="<?= old('email') ?>"
               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
               required>
    </div>

    <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" id="password" name="password"
               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
               required>
    </div>

    <input type="hidden" name="_csrf" value="<?= Csrf::getToken() ?>">

    <div>
        <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
            Sign In
        </button>
    </div>
</form>
