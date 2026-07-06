<?php

session_start();

if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit();

}

?>

<!doctype html>
<html lang="en" class="h-full">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Post Item – FoundIt</title>

    <script src="https://cdn.tailwindcss.com/3.4.17"></script>

    <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>

    <link rel="stylesheet"
          href="../assets/css/style.css">

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Sora:wght@600;700;800&display=swap"
          rel="stylesheet">

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

<body class="h-full bg-surface text-txt font-body">

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
               class="text-txt-secondary hover:text-brand transition">

                Explore

            </a>

            <a href="post_item.php"
               class="text-brand font-semibold">

                Post Item

            </a>

            <a href="dashboard.php"
               class="text-txt-secondary hover:text-brand transition">

                Dashboard

            </a>

        </div>

        <!-- RIGHT BUTTON -->

        <div class="flex items-center gap-3">

            <a href="profile.php"
               class="hidden md:flex items-center gap-2 px-4 py-2 text-sm font-medium text-brand border border-brand/20 rounded-xl hover:bg-blue-50 transition-all">

                <i data-lucide="user"
                   class="w-4 h-4"></i>

                <?php echo $_SESSION['first_name']; ?>

            </a>

        <a href="../backend/logout.php"
                class="hidden md:flex items-center gap-2 px-4 py-2 text-sm font-medium text-red-500 border border-red-200 rounded-xl hover:bg-red-50 transition-all">

            <i data-lucide="log-out"
                class="w-4 h-4"></i>

            Logout

        </a>

        </div>

    </div>

</nav>

<!-- MAIN -->

<main class="flex-1 max-w-[1200px] mx-auto px-6 py-10">

    <!-- TITLE -->

    <div class="mb-8">

        <span class="text-xs font-semibold text-brand uppercase tracking-wider">

            Submit

        </span>

        <h1 class="font-heading font-bold text-4xl text-txt mt-2">

            Post an Item

        </h1>

        <p class="text-txt-secondary mt-2">

            Report lost or found items to help the community.

        </p>

    </div>

    <!-- FORM -->

    <form action="../backend/post_item.php"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">

        <div class="flex flex-col lg:flex-row">

            <!-- LEFT SIDE -->

            <div class="lg:w-5/12 p-8 bg-slate-50 flex flex-col items-center justify-center border-r border-slate-100">

                <div id="upload-zone"
                     class="w-full aspect-square rounded-3xl border-2 border-dashed border-slate-200 bg-white flex flex-col items-center justify-center cursor-pointer hover:border-brand transition-all">

                    <div class="w-16 h-16 rounded-2xl bg-blue-50 flex items-center justify-center mb-4">

                        <i data-lucide="image-plus"
                           class="w-8 h-8 text-brand"></i>

                    </div>

                    <p id="upload-text"
                       class="font-semibold text-txt text-sm mb-1">

                        Upload Image

                    </p>

                    <p id="upload-subtext"
                       class="text-xs text-txt-secondary text-center px-6">

                        PNG, JPG up to 5MB

                    </p>

                </div>

                <input type="file"
                       name="image"
                       id="imageInput"
                       accept="image/png, image/jpeg"
                       class="hidden"
                       required>

            </div>

            <!-- RIGHT SIDE -->

            <div class="lg:w-7/12 p-8 space-y-5">

                <!-- ITEM NAME -->

                <div>

                    <label class="block text-sm font-medium mb-2">

                        Item Name

                    </label>

                    <input type="text"
                           name="title"
                           placeholder="e.g. Black Leather Wallet"
                           required
                           class="w-full px-4 py-3 bg-slate-50 rounded-xl border border-transparent focus:border-brand/30 focus:ring-2 focus:ring-brand/10 outline-none text-sm">

                </div>

                <!-- CATEGORY & STATUS -->

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- CATEGORY -->

                    <div>

                        <label class="block text-sm font-medium mb-2">

                            Category

                        </label>

                        <select name="category"
                                required
                                class="w-full px-4 py-3 bg-slate-50 rounded-xl border border-transparent focus:border-brand/30 focus:ring-2 focus:ring-brand/10 outline-none text-sm">

                            <option value="">Select Category</option>

                            <option>Electronics</option>

                            <option>Accessories</option>

                            <option>Documents</option>

                            <option>Pets</option>

                            <option>Keys</option>

                        </select>

                    </div>

                    <!-- STATUS -->

                    <div>

                        <label class="block text-sm font-medium mb-2">

                            Status

                        </label>

                        <div class="flex gap-3">

                            <label class="flex-1 cursor-pointer">

                                <input type="radio"
                                       name="status"
                                       value="Lost"
                                       class="peer hidden"
                                       checked>

                                <div class="px-4 py-3 rounded-xl bg-slate-50 border border-transparent text-center text-sm font-medium peer-checked:bg-red-50 peer-checked:border-red-200 peer-checked:text-red-600 transition">

                                    Lost

                                </div>

                            </label>

                            <label class="flex-1 cursor-pointer">

                                <input type="radio"
                                       name="status"
                                       value="Found"
                                       class="peer hidden">

                                <div class="px-4 py-3 rounded-xl bg-slate-50 border border-transparent text-center text-sm font-medium peer-checked:bg-green-50 peer-checked:border-green-200 peer-checked:text-green-600 transition">

                                    Found

                                </div>

                            </label>

                        </div>

                    </div>

                </div>

                <!-- DESCRIPTION -->

                <div>

                    <label class="block text-sm font-medium mb-2">

                        Description

                    </label>

                    <textarea name="description"
                              rows="4"
                              required
                              placeholder="Describe the item..."
                              class="w-full px-4 py-3 bg-slate-50 rounded-xl border border-transparent focus:border-brand/30 focus:ring-2 focus:ring-brand/10 outline-none text-sm resize-none"></textarea>

                </div>

                <!-- LOCATION -->

                <div>

                    <label class="block text-sm font-medium mb-2">

                        Location

                    </label>

                    <div class="flex items-center gap-2 px-4 py-3 bg-slate-50 rounded-xl">

                        <i data-lucide="map-pin"
                           class="w-4 h-4 text-slate-400"></i>

                        <input type="text"
                               name="location"
                               required
                               placeholder="Where was it lost/found?"
                               class="bg-transparent w-full outline-none text-sm">

                    </div>

                </div>

                <!-- BUTTON -->

                <button type="submit"
                        class="w-full py-4 rounded-xl bg-brand hover:bg-blue-700 text-white font-semibold flex items-center justify-center gap-2 transition shadow-lg shadow-blue-200">

                    <i data-lucide="send"
                       class="w-4 h-4"></i>

                    Submit Item

                </button>

            </div>

        </div>

    </form>

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

</div>

<script>

    lucide.createIcons();

    const uploadZone = document.getElementById('upload-zone');

    const imageInput = document.getElementById('imageInput');

    const uploadText = document.getElementById('upload-text');

    const uploadSubtext = document.getElementById('upload-subtext');

    uploadZone.addEventListener('click', () => {

        imageInput.click();

    });

    imageInput.addEventListener('change', function(){

        if(this.files && this.files[0]){

            uploadText.textContent = this.files[0].name;

            uploadSubtext.textContent = 'Image ready to upload';

        }

    });

</script>

</body>
</html>