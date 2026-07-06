<?php

session_start();

if(!isset($_SESSION['role'])){

    header("Location: login.php");
    exit();

}

if($_SESSION['role'] != 'admin'){

    header("Location: dashboard.php");
    exit();

}

include '../backend/config/database.php';

/*
|--------------------------------------------------------------------------
| DELETE ITEM
|--------------------------------------------------------------------------
*/

if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    // ambil gambar dulu
    $imgQuery = mysqli_query($conn, "SELECT image FROM items WHERE id='$id'");
    $imgData = mysqli_fetch_assoc($imgQuery);

    if($imgData){

        if(file_exists("../uploads/" . $imgData['image'])){

            unlink("../uploads/" . $imgData['image']);

        }

    }

    mysqli_query($conn, "DELETE FROM items WHERE id='$id'");

    header("Location: admin_dashboard.php");
    exit();

}

/*
|--------------------------------------------------------------------------
| GET DATA
|--------------------------------------------------------------------------
*/

$sql = "SELECT * FROM items ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);

$total = 0;
$lost = 0;
$found = 0;
$returned = 0;

$items = [];

while($row = mysqli_fetch_assoc($result)){

    $items[] = $row;

    $total++;

    if($row['status'] == 'Lost'){

        $lost++;

    }

    if($row['status'] == 'Found'){

        $found++;

    }

    if($row['status'] == 'Returned'){

        $returned++;

    }

}

?>

<!doctype html>
<html lang="en" class="h-full">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard – FoundIt</title>

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

<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-lg border-b border-slate-100">

    <div class="max-w-[1200px] mx-auto px-6 flex items-center justify-between h-16">

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

        <div class="flex items-center gap-4">

            <span class="text-sm text-slate-500">

                Admin:
                <b><?php echo $_SESSION['first_name']; ?></b>

            </span>

            <a href="../backend/logout.php"
                class="px-4 py-2 rounded-xl border border-red-200 text-red-600 hover:bg-red-50 text-sm font-medium">

                Logout

            </a>

        </div>

    </div>

</nav>

<!-- MAIN -->

<main class="max-w-[1200px] mx-auto px-6 py-10">

    <div class="mb-8">

        <h1 class="font-heading font-bold text-4xl mb-2">

            Admin Dashboard

        </h1>

        <p class="text-txt-secondary">

            Manage all lost & found items

        </p>

    </div>

    <!-- STATS -->

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

        <!-- TOTAL -->

        <div class="bg-white rounded-2xl border border-slate-100 p-6">

            <p class="text-sm text-slate-500 mb-2">
                Total Items
            </p>

            <h2 class="text-3xl font-bold">

                <?php echo $total; ?>

            </h2>

        </div>

        <!-- LOST -->

        <div class="bg-white rounded-2xl border border-slate-100 p-6">

            <p class="text-sm text-slate-500 mb-2">
                Lost Items
            </p>

            <h2 class="text-3xl font-bold text-red-500">

                <?php echo $lost; ?>

            </h2>

        </div>

        <!-- FOUND -->

        <div class="bg-white rounded-2xl border border-slate-100 p-6">

            <p class="text-sm text-slate-500 mb-2">
                Found Items
            </p>

            <h2 class="text-3xl font-bold text-green-500">

                <?php echo $found; ?>

            </h2>

        </div>

        <!-- RETURNED -->

        <div class="bg-white rounded-2xl border border-slate-100 p-6">

            <p class="text-sm text-slate-500 mb-2">
                Returned
            </p>

            <h2 class="text-3xl font-bold text-purple-500">

                <?php echo $returned; ?>

            </h2>

        </div>

    </div>

    <!-- TABLE -->

    <div class="bg-white rounded-3xl border border-slate-100 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-sm">
                            Image
                        </th>

                        <th class="px-6 py-4 text-left text-sm">
                            Title
                        </th>

                        <th class="px-6 py-4 text-left text-sm">
                            Category
                        </th>

                        <th class="px-6 py-4 text-left text-sm">
                            Location
                        </th>

                        <th class="px-6 py-4 text-left text-sm">
                            Status
                        </th>

                        <th class="px-6 py-4 text-left text-sm">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                <?php foreach($items as $item){ ?>

                    <tr class="border-t">

                        <!-- IMAGE -->

                        <td class="px-6 py-4">

                            <img
                                src="../uploads/<?php echo $item['image']; ?>"
                                alt="<?php echo $item['title']; ?>"
                                class="w-20 h-20 rounded-xl object-cover">
                                onerror="this.src='../assets/img/no-image.png'">

                        </td>

                        <!-- TITLE -->

                        <td class="px-6 py-4">

                            <div class="font-bold">

                                <?php echo $item['title']; ?>

                            </div>

                            <div class="text-sm text-slate-500">

                                <?php echo $item['description']; ?>

                            </div>

                        </td>

                        <!-- CATEGORY -->

                        <td class="px-6 py-4">

                            <?php echo $item['category']; ?>

                        </td>

                        <!-- LOCATION -->

                        <td class="px-6 py-4">

                            <?php echo $item['location']; ?>

                        </td>

                        <!-- STATUS -->

                        <td class="px-6 py-4">

                            <span class="px-3 py-1 rounded-full text-xs font-bold

                            <?php

                                if($item['status'] == 'Lost'){

                                    echo 'bg-red-100 text-red-600';

                                }

                                else if($item['status'] == 'Found'){

                                    echo 'bg-green-100 text-green-600';

                                }

                                else{

                                    echo 'bg-purple-100 text-purple-600';

                                }

                            ?>

                            ">

                                <?php echo $item['status']; ?>

                            </span>

                        </td>

                        <!-- ACTION -->

                        <td class="px-6 py-4">

                            <a href="admin_dashboard.php?delete=<?php echo $item['id']; ?>"
                                onclick="return confirm('Delete this item?')"
                                class="px-4 py-2 rounded-xl bg-red-500 text-white text-sm hover:bg-red-600">

                                Delete

                            </a>

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</main>

<script>

    lucide.createIcons();

</script>

</body>
</html>