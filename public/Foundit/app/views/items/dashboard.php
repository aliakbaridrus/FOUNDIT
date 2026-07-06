<!doctype html>
<html lang="en" class="h-full">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Dashboard – FoundIt</title>

    <script src="https://cdn.tailwindcss.com/3.4.17"></script>

    <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>

    <link rel="stylesheet"
          href="../assets/css/style.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: '#2563EB',
                        accent: '#22C55E',
                        surface: '#F8FAFC',
                        txt: '#0F172A',
                        'txt-secondary': '#64748B'
                    },
                    fontFamily: {
                        heading: ['Sora', 'sans-serif'],
                        body: ['DM Sans', 'sans-serif']
                    }
                }
            }
        }
    </script>

</head>

<body class="h-full bg-surface text-txt">

<!-- NAVBAR -->

<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-lg border-b border-slate-100">

    <div class="max-w-[1200px] mx-auto px-6 h-16 flex items-center justify-between">

        <!-- LOGO -->

        <a href="../index.php"
           class="flex items-center gap-2 font-heading font-bold text-xl">

            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-brand to-blue-400 flex items-center justify-center">

                <i data-lucide="compass"
                   class="w-5 h-5 text-white"></i>

            </div>

            <span>
                Found<span class="text-brand">It</span>
            </span>

        </a>

        <!-- MENU -->

        <div class="hidden md:flex items-center gap-8 text-sm font-medium">

            <a href="../index.php"
               class="text-txt-secondary hover:text-brand transition">
                Home
            </a>

            <a href="explore.php"
               class="text-txt-secondary hover:text-brand transition">
                Explore
            </a>

            <a href="post_item.php"
               class="text-txt-secondary hover:text-brand transition">
                Post Item
            </a>

            <a href="dashboard.php"
               class="text-brand">
                Dashboard
            </a>

        </div>

        <!-- RIGHT -->

        <div class="flex items-center gap-3">

            <a href="profile.php"
               class="hidden md:flex items-center gap-2 px-4 py-2 text-sm font-medium text-brand border border-brand/20 rounded-xl hover:bg-blue-50 transition-all">

                <i data-lucide="user"
                   class="w-4 h-4"></i>

                <?php echo htmlspecialchars($_SESSION['first_name'] ?? 'User'); ?>

            </a>

            <a href="../backend/logout.php"
               class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-red-500 border border-red-200 rounded-xl hover:bg-red-50 transition-all">

                <i data-lucide="log-out"
                   class="w-4 h-4"></i>

                Logout

            </a>

        </div>

    </div>

</nav>

<!-- MAIN -->

<main class="max-w-[1200px] mx-auto px-6 py-10">

    <!-- TITLE -->

    <div class="mb-10">

        <span class="text-xs font-semibold text-brand uppercase tracking-wider">
            Dashboard
        </span>

        <h1 class="font-heading font-bold text-4xl mt-2">
            My Items
        </h1>

        <p class="text-txt-secondary mt-2">
            Manage your lost and found posts
        </p>

    </div>

    <!-- STATS -->

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        <!-- TOTAL -->

        <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-sm">

            <div class="flex items-center gap-4">

                <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center">

                    <i data-lucide="package"
                       class="w-7 h-7 text-brand"></i>

                </div>

                <div>

                    <p class="text-sm text-txt-secondary">
                        Total Posts
                    </p>

                    <h2 class="text-3xl font-bold">
                        <?php echo htmlspecialchars($total); ?>
                    </h2>

                </div>

            </div>

        </div>

        <!-- LOST -->

        <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-sm">

            <div class="flex items-center gap-4">

                <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center">

                    <i data-lucide="alert-circle"
                       class="w-7 h-7 text-red-500"></i>

                </div>

                <div>

                    <p class="text-sm text-txt-secondary">
                        Lost Items
                    </p>

                    <h2 class="text-3xl font-bold">
                        <?php echo htmlspecialchars($lost); ?>
                    </h2>

                </div>

            </div>

        </div>

        <!-- FOUND -->

        <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-sm">

            <div class="flex items-center gap-4">

                <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center">

                    <i data-lucide="check-circle"
                       class="w-7 h-7 text-green-500"></i>

                </div>

                <div>

                    <p class="text-sm text-txt-secondary">
                        Found Items
                    </p>

                    <h2 class="text-3xl font-bold">
                        <?php echo htmlspecialchars($found); ?>
                    </h2>

                </div>

            </div>

        </div>

    </div>

    <!-- FILTER -->

    <div class="flex flex-wrap gap-4 mb-8">

        <button onclick="filterItems('all')"
                class="px-5 py-2 rounded-xl bg-brand text-white font-medium">
            All
        </button>

        <button onclick="filterItems('Lost')"
                class="px-5 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 transition">
            Lost
        </button>

        <button onclick="filterItems('Found')"
                class="px-5 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 transition">
            Found
        </button>

    </div>

    <!-- ITEMS -->

    <div class="space-y-6">

        <?php if (count($items) > 0) { ?>

            <?php foreach ($items as $item) { ?>

                <div class="dashboard-item block bg-white rounded-3xl border border-slate-100 p-5 hover:shadow-lg transition-all duration-300"
                     data-status="<?php echo htmlspecialchars($item['status']); ?>">

                    <div class="flex flex-col md:flex-row gap-6">

                        <!-- IMAGE -->

                        <a href="detail.php?id=<?php echo htmlspecialchars($item['id']); ?>">

                            <img src="../uploads/<?php echo htmlspecialchars($item['image']); ?>"
                                 alt="<?php echo htmlspecialchars($item['title']); ?>"
                                 class="w-full md:w-56 h-44 object-cover rounded-2xl">

                        </a>

                        <!-- CONTENT -->

                        <div class="flex-1">

                            <div class="flex items-center justify-between mb-3">

                                <span class="px-3 py-1 rounded-full bg-blue-100 text-brand text-xs font-bold">
                                    <?php echo htmlspecialchars($item['category']); ?>
                                </span>

                                <span class="text-sm text-txt-secondary">
                                    <?php echo htmlspecialchars($item['status']); ?>
                                </span>

                            </div>

                            <h2 class="text-2xl font-bold mb-3">
                                <?php echo htmlspecialchars($item['title']); ?>
                            </h2>

                            <p class="text-txt-secondary mb-4 line-clamp-2">
                                <?php echo htmlspecialchars($item['description']); ?>
                            </p>

                            <!-- BOTTOM -->

                            <div class="flex items-center justify-between mt-4">

                                <div class="flex items-center gap-2 text-sm text-txt-secondary">

                                    <i data-lucide="map-pin"
                                       class="w-4 h-4"></i>

                                    <?php echo htmlspecialchars($item['location']); ?>

                                </div>

                                <!-- ACTIONS -->

                                <div class="flex items-center gap-3">

                                    <a href="detail.php?id=<?php echo htmlspecialchars($item['id']); ?>"
                                       class="px-4 py-2 rounded-xl bg-brand hover:bg-blue-700 text-white text-sm font-medium transition">
                                        View
                                    </a>

                                    <a href="../backend/delete_item.php?id=<?php echo htmlspecialchars($item['id']); ?>"
                                       onclick="return confirm('Delete this item?')"
                                       class="px-4 py-2 rounded-xl bg-red-500 hover:bg-red-600 text-white text-sm font-medium transition">
                                        Delete
                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            <?php } ?>

        <?php } else { ?>

            <div class="bg-white rounded-3xl border border-slate-100 p-14 text-center">

                <div class="w-20 h-20 mx-auto rounded-3xl bg-blue-50 flex items-center justify-center mb-5">

                    <i data-lucide="inbox"
                       class="w-10 h-10 text-brand"></i>

                </div>

                <h2 class="text-2xl font-bold mb-2">
                    No Items Yet
                </h2>

                <p class="text-txt-secondary mb-6">
                    Start posting your lost or found items now.
                </p>

                <a href="post_item.php"
                   class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-brand text-white font-semibold hover:bg-blue-700 transition">

                    <i data-lucide="plus"
                       class="w-4 h-4"></i>

                    Post Item

                </a>

            </div>

        <?php } ?>

    </div>

</main>

<!-- FOOTER -->

<footer class="bg-white border-t border-slate-100 mt-16">

    <div class="max-w-[1200px] mx-auto px-6 py-8 flex flex-col md:flex-row items-center justify-between gap-4">

        <div class="text-sm text-txt-secondary font-bold">
            FoundIt © 2026
        </div>

        <div class="flex items-center gap-6 text-xs text-txt-secondary">

            <a href="privacy.php"
               class="hover:text-brand">
                Privacy
            </a>

            <a href="terms.php"
               class="hover:text-brand">
                Terms
            </a>

        </div>

    </div>

</footer>

<script>
    lucide.createIcons();

    function filterItems(status) {
        const items = document.querySelectorAll('.dashboard-item');

        items.forEach(item => {
            if (status === 'all') {
                item.style.display = 'block';
            } else {
                if (item.dataset.status === status) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            }
        });
    }
</script>

</body>
</html>