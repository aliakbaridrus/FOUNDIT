<?php

include '../backend/config/database.php';

if(!isset($_GET['id'])){

    header("Location: explore.php");
    exit();

}

$id = $_GET['id'];

/*
|--------------------------------------------------------------------------
| GET ITEM + USER WHATSAPP
|--------------------------------------------------------------------------
*/

$sql = "SELECT items.*, users.whatsapp
        FROM items
        JOIN users ON items.user_id = users.id
        WHERE items.id = '$id'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 0){

    die("Item not found");

}

$item = mysqli_fetch_assoc($result);

/*
|--------------------------------------------------------------------------
| WHATSAPP LINK
|--------------------------------------------------------------------------
*/

$whatsapp = preg_replace('/[^0-9]/', '', $item['whatsapp']);

/*
|--------------------------------------------------------------------------
| FORMAT NOMOR
|--------------------------------------------------------------------------
| Ubah 08xxxx menjadi 628xxxx
*/

if(substr($whatsapp, 0, 1) == '0'){

    $whatsapp = '62' . substr($whatsapp, 1);

}

$message = urlencode(
    "Hi, I found your item on FoundIt: " . $item['title']
);

$wa_link = "https://wa.me/" . $whatsapp . "?text=" . $message;

?>

<!doctype html>
<html lang="en" class="h-full">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $item['title']; ?> – FoundIt</title>

    <script src="https://cdn.tailwindcss.com/3.4.17"></script>

    <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>

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

<!-- NAVBAR -->

<nav class="bg-white border-b border-slate-100">

    <div class="max-w-[1200px] mx-auto px-6 flex items-center h-16">

        <a href="explore.php"
           class="flex items-center gap-2 font-heading font-bold text-xl">

            <i data-lucide="arrow-left"
               class="w-5 h-5 text-brand"></i>

            <span>

                Back to
                <span class="text-brand">Explore</span>

            </span>

        </a>

    </div>

</nav>

<!-- MAIN -->

<main class="max-w-[900px] mx-auto px-6 py-12">

    <div class="bg-white rounded-3xl border border-slate-100 overflow-hidden shadow-sm">

        <!-- IMAGE -->

        <div class="relative">

            <img src="../uploads/<?php echo $item['image']; ?>"
                 alt="<?php echo $item['title']; ?>"
                 class="w-full h-[450px] object-cover"
                 onerror="this.src='../assets/img/no-image.png'">

            <span class="absolute top-6 right-6 px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider

                <?php echo $item['status'] == 'Lost'
                    ? 'bg-red-100 text-red-600'
                    : 'bg-green-100 text-green-600'; ?>">

                <?php echo $item['status']; ?>

            </span>

        </div>

        <!-- CONTENT -->

        <div class="p-8 lg:p-12">

            <!-- CATEGORY -->

            <div class="flex flex-wrap items-center gap-3 mb-5">

                <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-full text-xs font-medium">

                    <?php echo $item['category']; ?>

                </span>

                <span class="text-txt-secondary text-sm flex items-center gap-1.5">

                    <i data-lucide="calendar"
                       class="w-4 h-4"></i>

                    <?php echo date("d M Y", strtotime($item['created_at'])); ?>

                </span>

            </div>

            <!-- TITLE -->

            <h1 class="font-heading font-bold text-4xl text-txt mb-3">

                <?php echo $item['title']; ?>

            </h1>

            <!-- POSTED BY -->

            <p class="text-sm text-txt-secondary mb-6">

                Posted by

                <span class="font-semibold text-txt">

                    <?php echo $item['posted_by']; ?>

                </span>

            </p>

            <!-- LOCATION -->

            <div class="flex items-center gap-2 text-txt-secondary mb-8">

                <i data-lucide="map-pin"
                   class="w-5 h-5 text-brand"></i>

                <span class="font-medium">

                    <?php echo $item['location']; ?>

                </span>

            </div>

            <!-- DESCRIPTION -->

            <div class="bg-slate-50 rounded-2xl p-6 mb-8">

                <h4 class="font-semibold mb-3 text-sm uppercase tracking-wider text-slate-400">

                    Description

                </h4>

                <p class="text-txt-secondary leading-relaxed">

                    <?php echo nl2br($item['description']); ?>

                </p>

            </div>

            <!-- CONTACT OWNER -->

            <?php if(!empty($whatsapp)){ ?>

                <a href="<?php echo $wa_link; ?>"
                   target="_blank"
                   class="w-full bg-brand hover:bg-blue-700 transition py-4 rounded-2xl text-white font-bold flex items-center justify-center gap-2 shadow-lg shadow-brand/20">

                    <i data-lucide="message-circle"
                       class="w-5 h-5"></i>

                    Contact Owner

                </a>

            <?php } else { ?>

                <div class="w-full bg-slate-200 py-4 rounded-2xl text-center text-slate-500 font-semibold">

                    Owner has no WhatsApp number

                </div>

            <?php } ?>

        </div>

    </div>

</main>

<script>

    lucide.createIcons();

</script>

</body>
</html>