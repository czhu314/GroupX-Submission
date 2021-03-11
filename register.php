<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/register2.css">
    <!-- Used to import the show/hide password eye-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
</head>
<body>
<div class="container" id="container">
    <h1>REGISTER</h1>
    <form action="server.php" method="post">
        <label for="email"><b>Email</b></label><br>
        <div class="email">
            <input type="text" placeholder="Enter Email" name="email" id="email" required>
        </div>
        <label for="username"><b>Full Name</b></label><br>
        <div class="fnamebox">
            <input type="text" placeholder="First Name" name="fname" id="fname" required>
        </div>
        <div class="lnamebox">
            <input type="text" placeholder="Last Name" name="lname" id="lname" required>
        </div>
        <label for="password"><b>Password</b></label><br>
        <div class="pbox">
            <input type="password" placeholder="Enter Password" name="password" id="password" required>
            <i class="fas fa-eye-slash" onClick="revealPwd(this)"> </i>
        </div>
        <br>
        <input type="radio" id="chkYes" name="typeuser" value="student" checked/>
        <label for="student">Student</label>

        <input type="radio" id="staff" name="typeuser" value="staff" />
        <label for="staff">Staff</label>
        <div id="code" class="code">
            <input type="text" placeholder="Enter Code" name="code"><br>
        </div>
        <div class="terms">
            <input type="checkbox" id="terms" name="terms" value="agree" required>
            <label for="terms">I agree to the</label>
            <a onclick= switchPic("container2")> terms of service</a>
        </div>
        <input class="enter" type="submit" name="login" value="Create Account">
    </form>
    <?php
    //
    //    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    //        session_start();
    //        require 'connect.php';
    //        $conn = new mysqli(server,username,password, database, port);
    //        if ($conn->connect_error){
    //            die("Connection failure" . $conn->connect_error);
    //        }
    //        $sql = "INSERT INTO Users(username, password) VALUES ('$_POST[username]','$_POST[password]');";
    //        if ($conn->query($sql)){
    //            echo "User Successfully Stored";
    //        }
    //        else{
    //            echo "Database Error: " . $conn->error;
    //        }
    //        $conn->close();
    //    }
    ?>
    <a class="l1" href="index.html">Back</a>
</div>
<div class="container2" id="container2">
    <h1>TERMS OF SERVICE</h1>
    Last Updated: 22ND FEBRUARY 2021
    <br>
    <br>
    These terms of service ("Terms") apply to your access and use of Exeter Forum (the "Service").
    Please read them carefully.
    <br>
    <h3>ACCEPTING THESE TERMS</h3>
    If you access or use the Service, it means you agree to be bound by all of the terms below. So, before you use
    the Service, please read all of the terms. If you don't agree to all of the terms below, please do not use the
    Service. Also, if a term does not make sense to you, please let us know by e-mailing groupx@exeter.ac.uk.
    <br>
    <h3>CHANGES TO THESE TERMS</h3>
    We reserve the right to modify these Terms at any time. For instance, we may need to change these Terms if
    we come out with a new feature or for some other reason.
    <br>
    <br>
    Whenever we make changes to these Terms, the changes are effective after we post such revised
    Terms (indicated by revising the date at the top of these Terms) or upon your acceptance if we provide a mechanism
    for your immediate acceptance of the revised Terms (such as a click-through confirmation or acceptance button).
    It is your responsibility to check the website for changes to these Terms.
    <br>
    <br>
    If you continue to use the Service after the revised Terms go into effect, then you have accepted the changes
    to these Terms.
    <br>
    <h3>THIRD-PARTY SERVICES</h3>
    From time to time, we may provide you with links to third party websites or services that we do not own or control.
    Your use of the Service may also include the use of applications that are developed or owned by a third party.
    Your use of such third party applications, websites, and services is governed by that party's own terms of service
    or privacy policies. We encourage you to read the terms and conditions and privacy policy of any third party
    application, website or service that you visit or use.
    <br>
    <h3>CREATING ACCOUNTS</h3>
    When you create an account or use another service to log in to the Service, you agree to maintain the
    security of your password and accept all risks of unauthorized access to any data or other information
    you provide to the Service.
    <br>
    <br>
    If you discover or suspect any Service security breaches, please let us know as soon as possible.
    <br>
    <h3>YOUR CONTENT AND CONDUCT</h3>
    Our Service allows you and other users to post, link and otherwise make available content.
    You are responsible for the content that you make available to the Service, including its legality,
    reliability, and appropriateness.
    <br>
    <br>
    When you post, link or otherwise make available content to the Service, you grant us the right and license
    to use, reproduce, modify, publicly perform, publicly display and distribute your content on or through the
    Service. We may format your content for display throughout the Service, but we will not edit or revise the
    substance of your content itself.
    <br>
    <br>
    Aside from our limited right to your content, you retain all of your rights to the content you post, link and
    otherwise make available on or through the Service.
    <br>
    <br>
    You can remove the content that you posted by deleting it. Once you delete your content, it will not appear on the
    Service, but copies of your deleted content may remain in our system or backups for some period of time.
    We will retain web server access logs for a maximum of 365 days and then delete them.

    You may not post, link and otherwise make available on or through the Service any of the following:
    <ul>
        <li>Content that is libelous, defamatory, bigoted, fraudulent or deceptive;</li>
        <li>Content that is illegal or unlawful, that would otherwise create liability;</li>
        <li>Content that may infringe or violate any patent, trademark, trade secret, copyright, right of privacy,
            right of publicity or other intellectual or other right of any party;</li>
        <li>Mass or repeated promotions, political campaigning or commercial messages directed at users who do
            not follow you (SPAM);</li>
        <li>Private information of any third party (e.g., addresses, phone numbers, email addresses,
            Social Security numbers and credit card numbers); and</li>
        <li>Viruses, corrupted data or other harmful, disruptive or destructive files or code.</li>
    </ul>
    Also, you agree that you will not do any of the following in connection with the Service or other users:
    <ul>
        <li>Use the Service in any manner that could interfere with, disrupt, negatively affect or inhibit other
            users from fully enjoying the Service or that could damage, disable, overburden or impair the
            functioning of the Service;</li>
        <li>Impersonate or post on behalf of any person or entity or otherwise misrepresent your affiliation
            with a person or entity;</li>
        <li>Collect any personal information about other users, or intimidate, threaten, stalk or otherwise harass
            other users of the Service;</li>
        <li>Create an account or post any content if you are not over 13 years of age years of age; and</li>
        <li>Circumvent or attempt to circumvent any filtering, security measures, rate limits or other features
            designed to protect the Service, users of the Service, or third parties.</li>
    </ul>
    <h3>GROUP X MATERIALS</h3>
    We put a lot of effort into creating the Service including, the logo and all designs, text, graphics, pictures,
    information and other content (excluding your content). This property is owned by us or our licensors and it is
    protected by UK and international copyright laws. We grant you the right to use it.
    <br>
    <br>
    However, unless we expressly state otherwise, your rights do not include: (i) publicly performing or publicly
    displaying the Service; (ii) modifying or otherwise making any derivative uses of the Service or any portion
    thereof; (iii) using any data mining, robots or similar data gathering or extraction methods; (iv) downloading
    (other than page caching) of any portion of the Service or any information contained therein; (v) reverse
    engineering or accessing the Service in order to build a competitive product or service; or (vi) using the Service
    other than for its intended purposes. If you do any of this stuff, we may terminate your use of the Service.
    <br>
    <h3>HYPERLINKS AND THIRD PARTY CONTENT</h3>
    You may create a hyperlink to the Service. But, you may not use, frame or utilize framing techniques to enclose
    any of our trademarks, logos or other proprietary information without our express written consent.
    <br>
    <br>
    Group X makes no claim or representation regarding, and accepts no responsibility for third party
    websites accessible by hyperlink from the Service or websites linking to the Service. When you leave the Service,
    you should be aware that these Terms and our policies no longer govern.
    <br>
    <br>
    If there is any content on the Service from you and others, we don't review, verify or authenticate it, and it
    may include inaccuracies or false information. We make no representations, warranties, or guarantees relating to
    the quality, suitability, truth, accuracy or completeness of any content contained in the Service. You acknowledge
    sole responsibility for and assume all risk arising from your use of or reliance on any content.
    <br>
    <h3>UNAVOIDABLE LEGAL STUFF</h3>
    THE SERVICE AND ANY OTHER SERVICE AND CONTENT INCLUDED ON OR OTHERWISE MADE AVAILABLE TO YOU THROUGH THE SERVICE
    ARE PROVIDED TO YOU ON AN AS IS OR AS AVAILABLE BASIS WITHOUT ANY REPRESENTATIONS OR WARRANTIES OF ANY KIND.
    WE DISCLAIM ANY AND ALL WARRANTIES AND REPRESENTATIONS (EXPRESS OR IMPLIED, ORAL OR WRITTEN) WITH RESPECT TO THE
    SERVICE AND CONTENT INCLUDED ON OR OTHERWISE MADE AVAILABLE TO YOU THROUGH THE SERVICE WHETHER ALLEGED TO ARISE BY
    OPERATION OF LAW, BY REASON OF CUSTOM OR USAGE IN THE TRADE, BY COURSE OF DEALING OR OTHERWISE.
    <br>
    <br>
    IN NO EVENT WILL GROUP X BE LIABLE TO YOU OR ANY THIRD PARTY FOR ANY SPECIAL, INDIRECT, INCIDENTAL,
    EXEMPLARY OR CONSEQUENTIAL DAMAGES OF ANY KIND ARISING OUT OF OR IN CONNECTION WITH THE SERVICE OR ANY OTHER
    SERVICE AND/OR CONTENT INCLUDED ON OR OTHERWISE MADE AVAILABLE TO YOU THROUGH THE SERVICE, REGARDLESS OF THE FORM
    OF ACTION, WHETHER IN CONTRACT, TORT, STRICT LIABILITY OR OTHERWISE, EVEN IF WE HAVE BEEN ADVISED OF THE
    POSSIBILITY OF SUCH DAMAGES OR ARE AWARE OF THE POSSIBILITY OF SUCH DAMAGES. OUR TOTAL LIABILITY FOR ALL CAUSES
    OF ACTION AND UNDER ALL THEORIES OF LIABILITY WILL BE LIMITED TO THE AMOUNT YOU PAID TO GROUP X. THIS
    SECTION WILL BE GIVEN FULL EFFECT EVEN IF ANY REMEDY SPECIFIED IN THIS AGREEMENT IS DEEMED TO HAVE FAILED OF ITS
    ESSENTIAL PURPOSE.
    <br>
    <br>
    You agree to defend, indemnify and hold us harmless from and against any and all costs, damages, liabilities,
    and expenses (including attorneys' fees, costs, penalties, interest and disbursements) we incur in relation to,
    arising from, or for the purpose of avoiding, any claim or demand from a third party relating to your use of the
    Service or the use of the Service by any person using your account, including any claim that your use of the
    Service violates any applicable law or regulation, or the rights of any third party, and/or your violation of
    these Terms.
    <br>
    <h3>TERMINATION</h3>
    If you breach any of these Terms, we have the right to suspend or disable your access to or use of the Service.
    <br>
    <h3>ENTIRE AGREEMENT</h3>
    These Terms constitute the entire agreement between you and Group X regarding the use of the Service,
    superseding any prior agreements between you and Group X relating to your use of the Service.
    <br>
    <h3>FEEDBACK</h3>
    Please let us know what you think of the Service, these Terms and, in general, Exeter Forum.
    When you provide us with any feedback, comments or suggestions about the Service, these Terms and,
    in general, Exeter Forum, you irrevocably assign to us all of your right, title and interest in and to your
    feedback, comments and suggestions.
    <br>
    <h3>QUESTIONS & CONTACT INFORMATION</h3>
    Questions or comments about the Service may be directed to us at the email address groupx@exeter.ac.uk
    <br>
    <br>
    <br>
    <a class="back" onclick = switchBack("container2") >Back</a>
    <br>
    <br>
</div>
<script>
    function revealPwd(element) {
        let x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
            element.className = 'fas fa-eye'
        }
        else {
            x.type = "password";
            element.className = 'fas fa-eye-slash'
        }
    }
    function switchPic(picID){
        document.getElementById(picID).style.display="block";
        document.getElementById("container").style.display="none";
    }
    function switchBack(picID){
        document.getElementById(picID).style.display="none";
        document.getElementById("container").style.display="block";
    }
</script>
</body>
</html>