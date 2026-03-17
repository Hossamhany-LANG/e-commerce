@extends('layouts.app')

@section('title', 'Privacy Policy')

@section('content')
<div class="container my-5">
    <h2 class="mb-4 text-center font-weight-bold display-4 text-primary"><b>Privacy Policy</b></h2>

    <div class="card shadow-sm p-4 text-left">
        <h3 class="mb-4 font-weight-bold display-4 text-primary"><b>Introduction</b></h3>
        <p>
            At <strong>{{ $information->pagename }}</strong>, we place great importance on protecting the privacy of our users and visitors. This policy explains how we collect, use, and safeguard your personal data while you use our services.
        </p>

        <h3 class="mb-4 font-weight-bold display-4 text-primary"><b>Data We Collect</b></h3>
        <ul>
            <li><strong>Personal Data:</strong> such as name, email address, and phone number.</li>
            <li><strong>Non-Personal Data:</strong> such as IP address, browser type, and cookies.</li>
            <li><strong>Payment Data:</strong> when making purchases through our website.</li>
        </ul>

        <h3 class="mb-4 font-weight-bold display-4 text-primary"><b>How We Use Data</b></h3>
        <ul>
            <li>Enhance user experience and personalize content.</li>
            <li>Respond to inquiries and provide technical support.</li>
            <li>Send notifications or newsletters (with your consent).</li>
            <li>Process orders and purchases.</li>
            <li>Conduct analytics and statistics to improve our services.</li>
        </ul>

        <h3 class="mb-4 font-weight-bold display-4 text-primary"><b>Data Protection</b></h3>
        <p>
            We are committed to using the latest security measures and technologies to protect your data from unauthorized access, alteration, disclosure, or destruction.
        </p>

        <h3 class="mb-4 font-weight-bold display-4 text-primary"><b>Cookies</b></h3>
        <p>
            Our website uses cookies to personalize your experience and analyze site usage. You can disable cookies in your browser settings, but this may affect certain functionalities of the site.
        </p>

        <h3 class="mb-4 font-weight-bold display-4 text-primary"><b>Data Sharing with Third Parties</b></h3>
        <p>
            We may share some of your data with payment providers, shipping companies, or analytics tools, solely to provide better service. We confirm that we do not sell your data to any third party.
        </p>

        <h3 class="mb-4 font-weight-bold display-4 text-primary"><b>User Rights</b></h3>
        <ul>
            <li>The right to access your personal data.</li>
            <li>The right to modify or delete your data.</li>
            <li>The right to refuse the use of your data for marketing purposes.</li>
        </ul>

        <h3 class="mb-4 font-weight-bold display-4 text-primary"><b>Policy Updates</b></h3>
        <p>
            We may update this Privacy Policy from time to time to reflect changes in our services or applicable laws. Updates will be posted on this page along with the date of the last modification.
        </p>

        <h3 class="mb-4 font-weight-bold display-4 text-primary"><b>Contact Information</b></h3>
        <p>
            If you have any questions regarding this Privacy Policy, you can contact us via: <br>
            📧 Email: <strong>{{ $information->email }}</strong><br>
            📞 Phone: <strong>{{ $information->phone }}</strong>
        </p>
    </div>
</div>
@endsection
