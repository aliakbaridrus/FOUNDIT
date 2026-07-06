<!doctype html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login – FoundIt</title>

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

<body class="h-full bg-surface text-txt flex items-center justify-center p-6">

    <div class="w-full max-w-[400px] anim-fade-up">

        <div class="text-center mb-8">

            <a href="../index.php"
                class="inline-flex items-center gap-2 font-heading font-bold text-2xl mb-2">

                <div
                    class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand to-blue-400 flex items-center justify-center">

                    <i data-lucide="compass" class="w-6 h-6 text-white"></i>

                </div>

                <span>
                    Found<span class="text-brand">It</span>
                </span>

            </a>

            <p class="text-txt-secondary text-sm">
                Welcome back! Please enter your details.
            </p>

        </div>

        <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">

            <?php
            $error = isset($_GET['error']) ? $_GET['error'] : '';
            if ($error): 
                $errorMessages = [
                    'wrong_password' => '❌ Password salah. Silakan coba lagi.',
                    'email_not_found' => '❌ Email tidak ditemukan. Silakan periksa email Anda.',
                    'empty_fields' => '❌ Email dan password harus diisi.',
                    'database_error' => '❌ Terjadi kesalahan database. Silakan coba lagi.'
                ];
                $message = isset($errorMessages[$error]) ? $errorMessages[$error] : '❌ Terjadi kesalahan. Silakan coba lagi.';
            ?>
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                    <p class="text-red-700 text-sm font-medium"><?php echo $message; ?></p>
                </div>
            <?php endif; ?>

            <form action="../backend/login.php"
                  method="POST"
                  class="space-y-5">

                <div>

                    <label class="block text-sm font-medium mb-1.5">
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-transparent focus:border-brand/30 focus:ring-2 focus:ring-brand/10 outline-none transition-all text-sm"
                        placeholder="name@company.com"
                        required>

                </div>

                <div>

                    <div class="flex justify-between mb-1.5">

                        <label class="text-sm font-medium">
                            Password
                        </label>

                    </div>

                    <input
                        type="password"
                        name="password"
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-transparent focus:border-brand/30 focus:ring-2 focus:ring-brand/10 outline-none transition-all text-sm"
                        placeholder="••••••••"
                        required>

                </div>

                <button
                    type="submit"
                    class="w-full btn-primary py-3.5 text-white font-bold rounded-xl shadow-lg shadow-brand/20 transition-all text-sm">

                    Sign In

                </button>

            </form>

            <div class="mt-8 pt-6 border-t border-slate-100 text-center">

                <p class="text-sm text-txt-secondary">

                    Don't have an account?

                    <a href="register.php"
                        class="text-brand font-bold hover:underline">

                        Sign up for free

                    </a>

                </p>

            </div>

        </div>

        <a href="../index.php"
            class="flex items-center justify-center gap-2 mt-8 text-sm text-txt-secondary hover:text-brand transition-colors">

            <i data-lucide="arrow-left" class="w-4 h-4"></i>

            Back to Home

        </a>

    </div>

    <script>
        lucide.createIcons();
    </script>

</body>

</html>