<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Notice - JLF Metal Gates</title>
    <link rel="stylesheet" href="./public/css/style.css">

    <style>
        body.white {
            background-color: #f9f9f9;
            color: #333;
        }

        body main {
            padding: 64px 128px;
            display: flex;
            flex-flow: column nowrap;
            gap: 16px;
        }

        body.white h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: var(--primary);
            width: 100%;
            text-align: center;
        }

        body.white p,
        label {
            color: #333;
            text-align: justify;
        }

        .consent div {
            display: flex;
            flex-flow: column nowrap;
            gap: 8px;
        }

        header {
            width: 100%;
            display: flex;
            flex-flow: row nowrap;
            padding: 24px;
            background-color: var(--primary-dark);
        }

        header a {
            text-decoration: none;
        }

        header a img {
            width: 250px;
            height: auto;
            object-fit: scale-down;
        }
    </style>
</head>

<body class="white">
    <header>
        <a href="/"><img src="../public/img/logo-blanco.svg" alt=""></a>
    </header>
    <main>
        <h1>Privacy Notice</h1>
        <p>
            JLF Metal Gates is a legally established company under the laws of the United States, with its principal
            office located at [ADDRESS OF JLF METAL GATES IN THE UNITED STATES]. JLF Metal Gates is responsible for the
            management and protection of your personal data, which will be treated with strict confidentiality and used
            only for the purposes specified below. By providing us with your personal information, you consent to the
            terms of this Privacy Notice.
        </p>

        <h2>Personal Data Collected</h2>
        <p>JLF Metal Gates may collect the following personal data to fulfill our business purposes:</p>
        <ul>
            <li>Full name and, if applicable, the name of the company you represent.</li>
            <li>Taxpayer Identification Number (TIN) or your company identifier.</li>
            <li>Residential or business address.</li>
            <li>Email address.</li>
            <li>Business and/or personal phone number.</li>
            <li>Information regarding your workplace and position.</li>
        </ul>

        <p><strong>Sensitive Data:</strong> JLF Metal Gates may require additional information if necessary for specific
            transactions:</p>
        <ul>
            <li>A valid photo ID.</li>
            <li>Documentation supporting income, such as bank statements.</li>
            <li>Documents proving ownership of assets.</li>
        </ul>

        <h2>Purposes of Processing Personal Data</h2>
        <p><strong>Primary Purposes (do not require express consent):</strong> This data is necessary to carry out
            business transactions and fulfill the services you have requested:</p>
        <ol>
            <li>Facilitate the purchase-sale process of requested goods or services and issue tax receipts.</li>
            <li>Advise you on the use and handling of products and services offered by JLF Metal Gates.</li>
            <li>Conduct satisfaction surveys regarding our products and services.</li>
            <li>Update our customer database and maintain statistical records.</li>
        </ol>

        <p><strong>Secondary Purposes (require express consent):</strong> These activities are not essential to the
            transaction but allow us to enhance our services. You may choose whether or not to participate in these
            activities:</p>
        <ol>
            <li>Marketing and promotion of products.</li>
            <li>Invitations to events, raffles, or contests.</li>
        </ol>

        <div class="consent">
            <p>If you do not wish for your data to be used for these secondary purposes, please indicate below:</p>
            <div>
                <label><input type="checkbox"> I do not consent to the use of my data for secondary purpose "1".</label>
                <label><input type="checkbox"> I do not consent to the use of my data for secondary purpose "2".</label>
            </div>
        </div>

        <h2>Data Transfer</h2>
        <p>To fulfill the purposes mentioned above, JLF Metal Gates may share your personal data with suppliers and
            affiliated companies within the United States that support our operations and services. However, JLF Metal
            Gates does not sell or transfer your personal data for purposes other than those specified herein without
            your consent.</p>

        <h2>Your Privacy Rights</h2>
        <p>In accordance with applicable privacy laws, you have the right to access, correct, delete, and restrict the
            use of your personal data. To exercise these rights or for any other privacy-related inquiries, please
            contact our Privacy Department at info@jlfmetalgates.com or write to us at our physical address at
            [ADDRESS IN THE UNITED STATES].</p>

        <h2>Rights under the CCPA (for California Residents)</h2>
        <p>If you are a California resident, you have the right to:</p>
        <ul>
            <li>Request information about the personal data we collect and the purpose of its processing.</li>
            <li>Request the deletion of your personal data (with certain exceptions).</li>
            <li>Opt out of the sale of your personal data.</li>
        </ul>
        <p>To exercise these rights, please contact us at info@jlfmetalgates.com or +1 (214) 734 2383.</p>

        <h2>Withdrawal of Consent and Limitation of Use</h2>
        <p>You may revoke your consent for processing your personal data at any time; however, please note that we may
            need to retain certain information to meet our legal obligations. If you choose to revoke consent, please
            email us at info@jlfmetalgates.com, specifying the data to which the revocation applies.</p>

        <h2>Use of Cookies and Similar Technologies</h2>
        <p>On our website, we use cookies and tracking technologies to improve your browsing experience. These tools may
            collect data such as IP address, general geographic location, browsing time, browser type, and pages
            visited. You can disable cookies by configuring your browser, but doing so may affect the functionality of
            the site.</p>

        <h2>Changes to the Privacy Notice</h2>
        <p>JLF Metal Gates reserves the right to update this Privacy Notice in accordance with changes in applicable
            laws or business needs. Updates will be posted on our website https://jlfmetalgates.com and, when
            appropriate, we will notify you of changes via the contact methods you have provided.</p>
    </main>
    <?php
    include_once "./views/footer.php"
        ?>
</body>

</html>