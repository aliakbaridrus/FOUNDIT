<?php

session_start();

if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit();

}

include '../backend/config/database.php';

$user_id = $_SESSION['user_id'];

$user_query = mysqli_query($conn, "
    SELECT * FROM users
    WHERE id='$user_id'
");

$user = mysqli_fetch_assoc($user_query);

$item_query = mysqli_query($conn, "
    SELECT * FROM items
    WHERE posted_by='$user_id'
    ORDER BY created_at DESC
");

?>

<!doctype html>
<html lang="en" class="h-full">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>My Profile – FoundIt</title>

    <script src="https://cdn.tailwindcss.com/3.4.17"></script>

    <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>

    <link rel="stylesheet"
          href="../assets/css/style.css">

</head>

<body class="h-full bg-slate-50 text-slate-800">

<!-- NAVBAR -->

<nav class="sticky top-0 z-50 bg-white border-b border-slate-200">

    <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">

        <a href="../index.php"
           class="flex items-center gap-2 text-xl font-bold">

            <div class="w-9 h-9 rounded-xl bg-blue-600 flex items-center justify-center">

                <i data-lucide="compass"
                   class="w-5 h-5 text-white"></i>

            </div>

            Found<span class="text-blue-600">It</span>

        </a>

        <div class="hidden md:flex items-center gap-8 text-sm font-medium">

            <a href="../index.php"
               class="text-slate-500 hover:text-blue-600">

                Home

            </a>

            <a href="explore.php"
               class="text-slate-500 hover:text-blue-600">

                Explore

            </a>

            <a href="dashboard.php"
               class="text-slate-500 hover:text-blue-600">

                Dashboard

            </a>

            <a href="profile.php"
               class="text-blue-600 font-semibold">

                Profile

            </a>

        </div>

        <div class="flex items-center gap-4">

            <span class="text-sm font-medium">

                Hi,
                <?php echo $user['first_name']; ?>

            </span>

            <a href="../backend/logout.php"
               class="px-4 py-2 rounded-xl border border-red-200 text-red-500 hover:bg-red-50 transition">

                Logout

            </a>

        </div>

    </div>

</nav>

<!-- MAIN -->

<main class="max-w-7xl mx-auto px-6 py-10">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- PROFILE CARD -->

        <div class="bg-white rounded-3xl border p-8 h-fit">

            <div class="flex flex-col items-center text-center">

                <div class="w-24 h-24 rounded-full bg-blue-100 flex items-center justify-center mb-4">

                    <i data-lucide="user"
                       class="w-12 h-12 text-blue-600"></i>

                </div>

                <h2 class="text-2xl font-bold">

                    <?php
                    echo $user['first_name'] . ' ' . $user['last_name'];
                    ?>

                </h2>

                <p class="text-slate-500 mt-1">

                    <?php echo $user['email']; ?>

                </p>

                <span class="mt-4 px-4 py-1 rounded-full bg-blue-100 text-blue-600 text-sm font-semibold">

                    <?php echo ucfirst($user['role']); ?>

                </span>

            </div>

            <div class="border-t mt-8 pt-6 space-y-4">

                <div>

                    <p class="text-sm text-slate-500">
                        First Name
                    </p>

                    <p class="font-semibold">
                        <?php echo $user['first_name']; ?>
                    </p>

                </div>

                <div>

                    <p class="text-sm text-slate-500">
                        Last Name
                    </p>

                    <p class="font-semibold">
                        <?php echo $user['last_name']; ?>
                    </p>

                </div>

                <div>

                    <p class="text-sm text-slate-500">
                        Email
                    </p>

                    <p class="font-semibold">
                        <?php echo $user['email']; ?>
                    </p>

                </div>

            </div>

        </div>

        <!-- USER ITEMS -->

        <div class="lg:col-span-2">

            <div class="bg-white rounded-3xl border p-8">

                <div class="flex items-center justify-between mb-8">

                    <h2 class="text-2xl font-bold">

                        My Items

                    </h2>

                    <a href="post_item.php"
                       class="px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">

                        + Post Item

                    </a>

                </div>

                <div class="space-y-5">

                    <?php while($item = mysqli_fetch_assoc($item_query)) { ?>

                        <a href="detail.php?id=<?php echo $item['id']; ?>"
                           class="block border rounded-3xl overflow-hidden hover:shadow-lg transition">

                            <div class="flex flex-col md:flex-row">

                                <img src="../uploads/<?php echo $item['image']; ?>"
                                     class="w-full md:w-56 h-48 object-cover">

                                <div class="p-6 flex-1">

                                    <div class="flex items-center justify-between mb-3">

                                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-600 text-xs font-bold">

                                            <?php echo $item['category']; ?>

                                        </span>

                                        <span class="text-sm text-slate-500">

                                            <?php echo $item['status']; ?>

                                        </span>

                                    </div>

                                    <h3 class="text-2xl font-bold mb-2">

                                        <?php echo $item['title']; ?>

                                    </h3>

                                    <p class="text-slate-500 mb-4">

                                        <?php echo $item['description']; ?>

                                    </p>

                                    <div class="flex items-center gap-2 text-sm text-slate-500">

                                        <i data-lucide="map-pin"
                                           class="w-4 h-4"></i>

                                        <?php echo $item['location']; ?>

                                    </div>

                                </div>

                            </div>

                        </a>

                    <?php } ?>

                </div>

            </div>

        </div>

    </div>

</main>

<script>

lucide.createIcons();

</script>

</body>
</html>