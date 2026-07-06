<?php

session_start();

include '../backend/config/database.php';

$sql = "SELECT * FROM items ORDER BY created_at DESC";

$result = mysqli_query($conn, $sql);

?>

<!doctype html>
<html lang="en" class="h-full">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Explore Items – FoundIt</title>

    <script src="https://cdn.tailwindcss.com/3.4.17"></script>

    <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/style.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: '#2563EB',
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

<div class="min-h-screen flex flex-col">

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
                class="text-brand font-semibold">
                Explore
            </a>

            <a href="post_item.php"
                class="text-txt-secondary hover:text-brand transition">
                Post Item
            </a>

            <?php if(isset($_SESSION['user_id'])) { ?>

                <?php if($_SESSION['role'] == 'admin') { ?>

                    <a href="admin_dashboard.php"
                        class="text-txt-secondary hover:text-brand transition">
                        Admin Dashboard
                    </a>

                <?php } else { ?>

                    <a href="dashboard.php"
                        class="text-txt-secondary hover:text-brand transition">
                        Dashboard
                    </a>

                <?php } ?>

            <?php } ?>

        </div>

        <!-- RIGHT -->

        <div class="flex items-center gap-3">

            <?php if(isset($_SESSION['user_id'])) { ?>

                <!-- PROFILE -->

                <a href="profile.php"
                    class="hidden md:flex items-center gap-2 px-4 py-2 text-sm font-medium text-brand border border-brand/20 rounded-xl hover:bg-blue-50 transition-all">

                    <i data-lucide="user" class="w-4 h-4"></i>

                    <?php echo $_SESSION['first_name']; ?>

                </a>

                <!-- LOGOUT -->

                <a href="../backend/logout.php"
                    class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-red-500 border border-red-200 rounded-xl hover:bg-red-50 transition-all">

                    <i data-lucide="log-out" class="w-4 h-4"></i>

                    Logout

                </a>

            <?php } else { ?>

                <!-- LOGIN -->

                <a href="login.php"
                    class="hidden md:flex items-center gap-2 px-4 py-2 text-sm font-medium text-brand border border-brand/20 rounded-xl hover:bg-blue-50 transition-all">

                    <i data-lucide="log-in" class="w-4 h-4"></i>

                    Login

                </a>

            <?php } ?>

        </div>

    </div>

</nav>

<!-- MAIN -->

<main class="flex-1 max-w-[1200px] mx-auto w-full px-6 py-12">

    <!-- HEADER -->

    <div class="mb-12">

        <span class="text-xs font-semibold text-brand uppercase tracking-wider">

            Discover

        </span>

        <h1 class="font-heading font-bold text-4xl mt-2 mb-6">
            Explore Items
        </h1>

        <div class="flex flex-col md:flex-row gap-4">

            <!-- SEARCH -->

            <div class="flex-1 relative">

                <i data-lucide="search"
                    class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 w-5 h-5"></i>

                <input
                    type="text"
                    id="searchInput"
                    placeholder="Search items..."
                    class="w-full pl-12 pr-4 py-4 rounded-2xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-brand/20">

            </div>

            <!-- CATEGORY FILTER -->

            <select
                id="categoryFilter"
                class="px-6 py-4 rounded-2xl border border-slate-200 bg-white focus:outline-none">

                <option value="">All Categories</option>

                <option value="Electronics">Electronics</option>

                <option value="Accessories">Accessories</option>

                <option value="Pets">Pets</option>

                <option value="Documents">Documents</option>

                <option value="Keys">Keys</option>

                <option value="Others">Others</option>

            </select>

        </div>

    </div>

    <!-- ITEMS GRID -->

    <div id="explore-grid"
        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <?php while($row = mysqli_fetch_assoc($result)) { ?>

            <a href="detail.php?id=<?php echo $row['id']; ?>"
               class="item-card bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 block">

                <!-- IMAGE -->

                <img
                    src="../uploads/<?php echo $row['image']; ?>"
                    alt="item"
                    class="w-full h-56 object-cover">

                <!-- CONTENT -->

                <div class="p-5">

                    <div class="flex items-center justify-between mb-2">

                        <span class="text-xs font-bold px-3 py-1 rounded-full bg-blue-100 text-brand category-text">

                            <?php echo $row['category']; ?>

                        </span>

                        <span class="text-xs text-slate-400">

                            <?php echo $row['status']; ?>

                        </span>

                    </div>

                    <h2 class="font-bold text-lg mb-2 item-title line-clamp-1">

                        <?php echo $row['title']; ?>

                    </h2>

                    <p class="text-sm text-txt-secondary mb-3 line-clamp-2">

                        <?php echo $row['description']; ?>

                    </p>

                    <div class="flex items-center gap-2 text-sm text-slate-500 item-location">

                        <i data-lucide="map-pin"
                            class="w-4 h-4"></i>

                        <?php echo $row['location']; ?>

                    </div>

                </div>

            </a>

        <?php } ?>

    </div>

</main>

<!-- FOOTER -->

<footer class="bg-white border-t border-slate-100">

    <div class="max-w-[1200px] mx-auto px-6 py-8 flex flex-col md:flex-row items-center justify-between gap-4">

        <div class="text-sm text-txt-secondary font-bold">
            FoundIt © 2026
        </div>

        <div class="flex items-center gap-6 text-xs text-txt-secondary">

            <a href="privacy.php"
                class="hover:text-brand transition">
                Privacy
            </a>

            <a href="terms.php"
                class="hover:text-brand transition">
                Terms
            </a>

        </div>

    </div>

</footer>

</div>

<!-- SCRIPT -->

<script>

    lucide.createIcons();

    const searchInput = document.getElementById('searchInput');

    const categoryFilter = document.getElementById('categoryFilter');

    const cards = document.querySelectorAll('.item-card');

    function filterItems() {

        const search = searchInput.value.toLowerCase();

        const category = categoryFilter.value.toLowerCase();

        cards.forEach(card => {

            const title = card.querySelector('.item-title').innerText.toLowerCase();

            const location = card.querySelector('.item-location').innerText.toLowerCase();

            const cardCategory = card.querySelector('.category-text').innerText.toLowerCase();

            const matchSearch =
                title.includes(search) ||
                location.includes(search);

            const matchCategory =
                category === "" ||
                cardCategory === category;

            if(matchSearch && matchCategory){

                card.style.display = "block";

            } else {

                card.style.display = "none";

            }

        });

    }

    searchInput.addEventListener('keyup', filterItems);

    categoryFilter.addEventListener('change', filterItems);

</script>

</body>
</html>