<?php

session_start();

include 'backend/config/database.php';

$sql = "SELECT * FROM items ORDER BY created_at DESC LIMIT 4";

$result = mysqli_query($conn, $sql);

?>

<!doctype html>
<html lang="en" class="h-full">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>FoundIt - Smart Lost & Found</title>

    <script src="https://cdn.tailwindcss.com/3.4.17"></script>

    <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Sora:wght@600;700;800&display=swap"
          rel="stylesheet">

    <link rel="stylesheet"
          href="assets/css/style.css">

    <script>

        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: '#2563EB',
                        'brand-dark': '#1D4ED8',
                        accent: '#22C55E',
                        surface: '#F8FAFC',
                        txt: '#0F172A',
                        'txt-secondary': '#64748B',
                    },
                    fontFamily: {
                        heading: ['Sora', 'sans-serif'],
                        body: ['DM Sans', 'sans-serif'],
                    }
                }
            }
        }

    </script>

</head>

<body class="h-full bg-surface text-txt">

<div id="app-wrapper"
     class="h-full w-full overflow-auto">

<!-- NAVBAR -->

<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-lg border-b border-slate-100">

    <div class="max-w-[1200px] mx-auto px-6 h-16 flex items-center justify-between">

        <!-- LOGO -->

        <a href="index.php"
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

            <a href="index.php"
               class="text-brand">

                Home

            </a>

            <a href="pages/explore.php"
               class="text-txt-secondary hover:text-brand transition">

                Explore

            </a>

            <a href="pages/post_item.php"
               class="text-txt-secondary hover:text-brand transition">

                Post Item

            </a>

            <?php if(isset($_SESSION['user_id'])) { ?>

                <?php if($_SESSION['role'] == 'admin') { ?>

                    <a href="pages/admin_dashboard.php"
                       class="text-txt-secondary hover:text-brand transition">

                        Admin Dashboard

                    </a>

                <?php } else { ?>

                    <a href="pages/dashboard.php"
                       class="text-txt-secondary hover:text-brand transition">

                        Dashboard

                    </a>

                <?php } ?>

            <?php } ?>

        </div>

        <!-- RIGHT -->

        <div class="flex items-center gap-3">

            <?php if(isset($_SESSION['user_id'])) { ?>

                <a href="pages/profile.php"
                   class="hidden md:flex items-center gap-2 px-4 py-2 text-sm font-medium text-brand border border-brand/20 rounded-xl hover:bg-blue-50 transition-all">

                    <i data-lucide="user"
                       class="w-4 h-4"></i>

                    <?php echo $_SESSION['first_name']; ?>

                </a>

                <a href="backend/logout.php"
                   class="hidden md:flex items-center gap-2 px-4 py-2 text-sm font-medium text-red-500 border border-red-200 rounded-xl hover:bg-red-50 transition-all">

                    <i data-lucide="log-out"
                       class="w-4 h-4"></i>

                    Logout

                </a>

            <?php } else { ?>

                <a href="pages/login.php"
                   class="hidden md:flex items-center gap-2 px-4 py-2 text-sm font-medium text-brand border border-brand/20 rounded-xl hover:bg-blue-50 transition-all">

                    <i data-lucide="log-in"
                       class="w-4 h-4"></i>

                    Login

                </a>

            <?php } ?>

        </div>

    </div>

</nav>

<!-- HERO -->

<section class="hero-gradient">

    <div class="max-w-[1200px] mx-auto px-6 py-16 lg:py-24 flex flex-col lg:flex-row items-center gap-12">

        <!-- LEFT -->

        <div class="flex-1">

            <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-white rounded-full shadow-sm text-xs font-medium text-brand mb-6">

                <span class="w-2 h-2 bg-accent rounded-full"></span>

                Trusted by community

            </div>

            <h1 class="font-heading font-800 text-4xl lg:text-5xl xl:text-[56px] leading-tight text-txt mb-5">

                Lost Something?<br>

                We Help You

                <span class="text-brand">Find It.</span>

            </h1>

            <p class="text-txt-secondary text-lg max-w-lg mb-8">

                Connect with your community to recover lost belongings quickly and safely.

            </p>

            <div class="flex flex-wrap gap-4">

                <a href="pages/post_item.php"
                   class="btn-primary px-7 py-3.5 text-white font-semibold rounded-xl flex items-center gap-2">

                    <i data-lucide="search"
                       class="w-5 h-5"></i>

                    Report Lost

                </a>

                <a href="pages/post_item.php"
                   class="btn-accent px-7 py-3.5 text-white font-semibold rounded-xl flex items-center gap-2">

                    <i data-lucide="package-check"
                       class="w-5 h-5"></i>

                    Report Found

                </a>

            </div>

        </div>

        <!-- RIGHT -->

        <div class="flex-1 flex justify-center">

            <div class="w-80 h-80 lg:w-96 lg:h-96 rounded-3xl bg-gradient-to-br from-blue-100 to-green-50 flex items-center justify-center shadow-inner">

                <i data-lucide="search"
                   class="w-32 h-32 text-brand opacity-20"></i>

            </div>

        </div>

    </div>

</section>

<!-- RECENT ITEMS -->

<section class="max-w-[1200px] mx-auto px-6 py-16">

    <div class="flex items-end justify-between mb-8">

        <div>

            <span class="text-xs font-semibold text-brand uppercase tracking-wider">

                Browse

            </span>

            <h2 class="font-heading font-bold text-3xl text-txt mt-1">

                Recent Items

            </h2>

        </div>

        <a href="pages/explore.php"
           class="text-sm font-medium text-brand hover:text-brand-dark flex items-center gap-1">

            View all

            <i data-lucide="arrow-right"
               class="w-4 h-4"></i>

        </a>

    </div>

    <!-- GRID -->

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <?php while($row = mysqli_fetch_assoc($result)) { ?>

            <a href="pages/detail.php?id=<?php echo $row['id']; ?>"
               class="bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 block">

                <!-- IMAGE -->

                <img src="uploads/<?php echo $row['image']; ?>"
                     alt="item"
                     class="w-full h-56 object-cover">

                <!-- CONTENT -->

                <div class="p-5">

                    <div class="flex items-center justify-between mb-2">

                        <span class="text-xs font-bold px-3 py-1 rounded-full bg-blue-100 text-brand">

                            <?php echo $row['category']; ?>

                        </span>

                        <span class="text-xs text-slate-400">

                            <?php echo $row['status']; ?>

                        </span>

                    </div>

                    <h3 class="font-bold text-lg mb-2">

                        <?php echo $row['title']; ?>

                    </h3>

                    <p class="text-sm text-txt-secondary mb-3 line-clamp-2">

                        <?php echo $row['description']; ?>

                    </p>

                    <div class="flex items-center gap-2 text-sm text-slate-500">

                        <i data-lucide="map-pin"
                           class="w-4 h-4"></i>

                        <?php echo $row['location']; ?>

                    </div>

                </div>

            </a>

        <?php } ?>

    </div>

</section>

<!-- FOOTER -->

<footer class="bg-white border-t border-slate-100 mt-auto">

    <div class="max-w-[1200px] mx-auto px-6 py-8 flex flex-col md:flex-row items-center justify-between gap-4">

        <div class="text-sm text-txt-secondary font-bold">

            FoundIt © 2026

        </div>

        <div class="flex items-center gap-6 text-xs text-txt-secondary">

            <a href="pages/privacy.php"
               class="hover:text-brand">

                Privacy

            </a>

            <a href="pages/terms.php"
               class="hover:text-brand">

                Terms

            </a>

            <a href="#"
               class="hover:text-brand">

                Contact

            </a>

        </div>

    </div>

</footer>

</div>

<script>

    lucide.createIcons();

</script>

</body>
</html>