<?php use App\Core\Session; ?>

<?php if (Session::has('success')): ?>
    <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded">
        <?= htmlspecialchars(Session::get('success')) ?>
    </div>
<?php endif; ?>

<?php if (Session::has('error')): ?>
    <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-800 rounded">
        <?= htmlspecialchars(Session::get('error')) ?>
    </div>
<?php endif; ?>
