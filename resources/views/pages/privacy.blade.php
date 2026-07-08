@extends('layouts.app')

@section('title', 'Privacy Policy – FoundIt')

@section('content')

<div class="max-w-4xl mx-auto px-6 py-16">

    <div class="mb-12">
        <h1 class="font-heading font-bold text-4xl text-txt mb-2">Privacy Policy</h1>
        <p class="text-txt-secondary">Last updated: April 11, 2026</p>
    </div>

    <div class="space-y-8 text-txt-secondary">

        <section>
            <h2 class="font-heading font-bold text-2xl text-txt mb-4">1. Introduction</h2>
            <p class="leading-relaxed mb-4">
                FoundIt ("we", "our", or "us") operates the FoundIt platform and website. This page informs you of our
                policies regarding the collection, use, and disclosure of personal data when you use our service and
                the choices you have associated with that data.
            </p>
            <p class="leading-relaxed">
                We are committed to protecting your privacy and ensuring you have a positive experience on our
                platform. This Privacy Policy explains how we collect, use, disclose, and safeguard your information.
            </p>
        </section>

        <section>
            <h2 class="font-heading font-bold text-2xl text-txt mb-4">2. Information Collection and Use</h2>
            <p class="leading-relaxed mb-4">We collect several different types of information for various purposes to provide and improve our service to you.</p>
            <h3 class="font-semibold text-txt mb-2">Types of Data Collected:</h3>
            <ul class="list-disc list-inside space-y-2 ml-2">
                <li><strong>Personal Data:</strong> Name, email address, phone number, location, and profile information</li>
                <li><strong>Item Data:</strong> Description, photos, category, and status of lost/found items</li>
                <li><strong>Usage Data:</strong> Information about how you interact with our platform</li>
                <li><strong>Technical Data:</strong> IP address, browser type, and device information</li>
            </ul>
        </section>

        <section>
            <h2 class="font-heading font-bold text-2xl text-txt mb-4">3. Use of Data</h2>
            <p class="leading-relaxed mb-4">FoundIt uses the collected data for various purposes:</p>
            <ul class="list-disc list-inside space-y-2 ml-2">
                <li>To provide and maintain our service</li>
                <li>To notify you about changes to our service</li>
                <li>To match lost and found items</li>
                <li>To allow you to participate in interactive features</li>
                <li>To provide customer support</li>
                <li>To gather analysis or valuable information to improve the service</li>
                <li>To monitor the usage of our service</li>
                <li>To detect, prevent and address technical issues</li>
            </ul>
        </section>

        <section>
            <h2 class="font-heading font-bold text-2xl text-txt mb-4">4. Security of Data</h2>
            <p class="leading-relaxed">
                The security of your data is important to us, but remember that no method of transmission over the
                Internet or method of electronic storage is 100% secure. While we strive to use commercially
                acceptable means to protect your personal data, we cannot guarantee its absolute security.
            </p>
        </section>

        <section>
            <h2 class="font-heading font-bold text-2xl text-txt mb-4">5. Changes to This Privacy Policy</h2>
            <p class="leading-relaxed">
                We may update our Privacy Policy from time to time. We will notify you of any changes by posting the
                new Privacy Policy on this page and updating the "effective date" at the top of this Privacy Policy.
                You are advised to review this Privacy Policy periodically for any changes.
            </p>
        </section>

        <section>
            <h2 class="font-heading font-bold text-2xl text-txt mb-4">6. Contact Us</h2>
            <p class="leading-relaxed mb-4">If you have any questions about this Privacy Policy, please contact us:</p>
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                <p class="mb-2"><strong>Email:</strong> privacy@foundit.com</p>
                <p class="mb-2"><strong>Address:</strong> Jakarta, Indonesia</p>
                <p><strong>Phone:</strong> +62-800-FOUND-IT</p>
            </div>
        </section>

        <section class="bg-white border border-slate-100 rounded-xl p-6">
            <h2 class="font-heading font-bold text-xl text-txt mb-4">7. Your Privacy Rights</h2>
            <p class="leading-relaxed mb-4">You have the right to:</p>
            <ul class="list-disc list-inside space-y-2 ml-2">
                <li>Access your personal data</li>
                <li>Correct inaccurate data</li>
                <li>Request deletion of your data</li>
                <li>Opt-out of marketing communications</li>
                <li>Data portability</li>
            </ul>
        </section>

    </div>

</div>

@endsection
