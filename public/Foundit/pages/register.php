<!doctype html>
<html lang="en" class="h-full">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register – FoundIt</title>

    <script src="https://cdn.tailwindcss.com/3.4.17"></script>

    <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>

    <link rel="stylesheet" href="../assets/css/style.css">

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

<body class="h-full bg-surface text-txt flex items-center justify-center p-6">

    <div class="w-full max-w-[450px] anim-fade-up">

        <div class="bg-white p-8 lg:p-10 rounded-3xl border border-slate-100 shadow-sm">

            <div class="mb-8">

                <h1 class="font-heading font-bold text-2xl mb-2">
                    Create Account
                </h1>

                <p class="text-txt-secondary text-sm">
                    Join the community to start finding.
                </p>

            </div>

            <!-- FORM -->

            <form action="../backend/register.php"
                  method="POST"
                  class="space-y-4">

                <!-- NAME -->

                <div class="grid grid-cols-2 gap-4">

                    <div>

                        <label class="block text-sm font-medium mb-1.5">
                            First Name
                        </label>

                        <input
                            type="text"
                            name="first_name"
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-transparent focus:border-brand/30 focus:ring-2 focus:ring-brand/10 outline-none text-sm"
                            placeholder="John"
                            required>

                    </div>

                    <div>

                        <label class="block text-sm font-medium mb-1.5">
                            Last Name
                        </label>

                        <input
                            type="text"
                            name="last_name"
                            class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-transparent focus:border-brand/30 focus:ring-2 focus:ring-brand/10 outline-none text-sm"
                            placeholder="Doe"
                            required>

                    </div>

                </div>

                <!-- EMAIL -->

                <div>

                    <label class="block text-sm font-medium mb-1.5">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-transparent focus:border-brand/30 focus:ring-2 focus:ring-brand/10 outline-none text-sm"
                        placeholder="john@example.com"
                        required>

                </div>

                <!-- WHATSAPP -->

                <div>

                    <label class="block text-sm font-medium mb-1.5">
                        WhatsApp Number
                    </label>

                    <input
                        type="text"
                        name="whatsapp"
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-transparent focus:border-brand/30 focus:ring-2 focus:ring-brand/10 outline-none text-sm"
                        placeholder="628123456789"
                        required>

                </div>

                <!-- PASSWORD -->

                <div>

                    <label class="block text-sm font-medium mb-1.5">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-transparent focus:border-brand/30 focus:ring-2 focus:ring-brand/10 outline-none text-sm"
                        placeholder="Minimum 8 characters"
                        required>

                </div>

                <!-- TERMS -->

                <div class="flex items-start gap-2">

                    <input
                        type="checkbox"
                        class="mt-1 rounded border-slate-300 text-brand focus:ring-brand"
                        id="terms"
                        required>

                    <label
                        for="terms"
                        class="text-xs text-txt-secondary leading-normal">

                        I agree to the

                        <a href="terms.php"
                           class="text-brand hover:underline">

                            Terms of Service

                        </a>

                        and

                        <a href="privacy.php"
                           class="text-brand hover:underline">

                            Privacy Policy

                        </a>

                    </label>

                </div>

                <!-- BUTTON -->

                <button
                    type="submit"
                    class="w-full btn-primary py-3.5 text-white font-bold rounded-xl shadow-lg shadow-brand/20 transition-all text-sm">

                    Create Account

                </button>

            </form>

            <!-- LOGIN -->

            <div class="mt-8 text-center">

                <p class="text-sm text-txt-secondary">

                    Already have an account?

                    <a href="login.php"
                       class="text-brand font-bold hover:underline">

                        Log in

                    </a>

                </p>

            </div>

        </div>

    </div>

    <!-- FOOTER -->

    <footer class="absolute bottom-0 left-0 right-0 bg-white border-t border-slate-100">

        <div class="max-w-[1200px] mx-auto px-6 py-6 flex flex-col md:flex-row items-center justify-between gap-4">

            <div class="text-xs text-txt-secondary font-bold">
                FoundIt © 2026
            </div>

            <div class="flex items-center gap-6 text-xs text-txt-secondary">

                <a href="privacy.php" class="hover:text-brand">
                    Privacy
                </a>

                <a href="terms.php" class="hover:text-brand">
                    Terms
                </a>

                <a href="#" class="hover:text-brand">
                    Contact
                </a>

            </div>

        </div>

    </footer>

    <script>
        lucide.createIcons();
    </script>

</body>

</html>