<!DOCTYPE html>
<html lang="en">
<?php include '../components/html.php'; ?>

<body>
    <section class="flex center row">
        <div>
            <br><br>
            <span class="textLogo">AnyfaceHub</span>
            <br><br>
        </div>
        <div class="box">
            <h1>Create a new account</h1>
            <p>It's quick and easy.</p>
            <hr>
            <br>
            <form action="" method="post">
                <div id="step1" class="">
                    <div class="flex">
                        <input type="text" class="input" name="FullName" placeholder="Full Name" required>
                    </div>

                    <div class="flex row">
                        <span style="text-align: left;">Date of birth</span>
                        <input type="date" class="input" name="DateOfBirth" required>
                    </div>

                    <div class="flex row">
                        <select id="gender" class="input" name="Gender" required>
                            <option value="" disabled selected hidden>Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="flex row">
                        <button id="nxtBtn" onclick="nextStep()" class="btn" type="button">
                            Proceed
                            <i class="icon bi bi-arrow-right-short"></i>
                        </button>
                        <br>
                        <sub id="error"></sub>
                    </div>
                </div>
                <div class="vcc" id="step2">
                    <div class="flex">
                        <input type="text" class="input" name="phoneoremail" placeholder="Mobile Number or email"
                            required>
                    </div>
                    <div class="flex">
                        <input type="password" class="input" name="FullName" placeholder="A new password" required>
                        <div class="show-password">
                            <input type="checkbox" name="show-password" id="show-password">
                        </div>
                        </div>
                        <div class="flex  around">
                            <button id="nxtBtn" onclick="prevStep()" class="btn" type="button">
                                <i class="icon bi bi-arrow-left-short"></i>
                                Previous
                                
                            </button>

                            <button id="nxtBtn" onclick="sendRequest()" class="btn" type="button">
                                Create Account
                                <i class="icon bi bi-arrow-right-short"></i>
                            </button>
                        </div>
                    
                </div>


            </form>
        </div>
    </section>
    <script src="/src/js/Create_account.js"></script>
</body>

</html>