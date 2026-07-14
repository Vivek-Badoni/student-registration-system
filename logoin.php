<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

    <style>
        .card {
            border: none;
            border-radius: 40px;
            box: shadow 20px;
            overflow: hidden;
        }

        .card-header {
            background-color: #6c5ce7;
        }

        .form-control {
            border-radius: 8px;
        }

        .form-control:focus {
            border-color: #6c5ce7;
            box-shadow: 0 0 0 0.2rem rgba(108, 92, 231, 0.25);
        }

        .btn-primary {
            background-color: #6c5ce7;
            border-color: #6c5ce7;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background-color: #5a4bd6;
            border-color: #5a4bd6;
        }

        .btn-outline-secondary {
            border-radius: 8px;
        }

        body {
            background: linear-gradient(140deg, #a29bfe 0%, #5c4ae7 50%, #7965fc 100%);
            min-height: 100vh;
        }
    </style>
</head>

<body class=" align-items-center">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow">
                    <div class="card-header text-white text-center py-3">
                        <h3 class="mb-0">User Registration Form</h3>
                    </div>
                    <div class="card-body p-4">
                        <form action="data.php" method="post" enctype="multipart/form-data" id="myform">
                            <div class="mb-3">
                                <label class="form-label"><b>Name</b></label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Full Name">
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><b>Email Address</b></label>
                                <input type="email" class="form-control" name="email" placeholder="Enter Email">
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><b>Phone Number</b></label>
                                <input type="tel" class="form-control" name="phone" placeholder="000-000-0000">
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><b>Date Of Birth</b></label>
                                <input type="date" name="dob" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label"> <b>select the file :</b></label>
                                <input type="file" name="file" class="form-control"> <!-- < accept=".jpg,.jpeg,.png,.pdf"
                                    required> -->
                            </div>
                            <div class="mb-3 g-4">
                                <label><b>Qualification :</b></label><br>

                                <input type="checkbox" name="check[]" value="10" > 10th
                                <input type="checkbox" name="check[]" value="12" > 12th
                                <input type="checkbox" name="check[]" value="Graduation" > Graduation
                            </div>
                            <div class="mb-3" >
                                <label ><b>Gender :</b></label><br>

                                <input type="radio" name="gender" value="Male"> Male
                                <input type="radio" name="gender" value="Female"> Female
                                <input type="radio" name="gender" value="other"> Other
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><b>Message</b></label>
                                <textarea class="form-control" name="messagee" rows="4"
                                    placeholder="Write Your Message" required></textarea>
                            </div>

                            <div class="d-flex gap-3">
                                <button type="submit" class="btn btn-primary flex-grow-1 py-2"
                                    name="save">Submit</button>

                                <button type="reset" class="btn btn-outline-secondary py-2 px-5">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <a href="data.php" class="btn btn-primary"> Show Data</a>
        </div>
    </div>
    <script>
        $(document).ready(function () {

            $("#myform").validate({

                rules: {
                    name: {
                        required: true
                    },

                    email: {
                        required: true,
                        email: true
                    },

                    phone : {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 10
                    },

                    dob: {
                        required: true,
                        date: true
                    },

                    file: {
                        required: true,
                        extension: "jpg|jpeg|png"
                    },

                    "check[]": {
                        required: true
                    

                    },

                    gender: {
                        required: true
                    },

                    messagee: {
                        required: true
                    }
                },

                messages: {

                    name: {
                        required: "Please enter your name"
                    },

                    email: {
                        required: "Please enter your email",
                        email: "Please enter a valid email"
                    },

                    phone: {
                        required: "Please enter your phone number",
                        digits: "Only numbers are allowed",
                        minlength: "Phone number must be 10 digits",
                        maxlength: "Phone number must be 10 digits"
                    },

                    dob: {
                        required: "Please select your date of birth",
                        date: "Please enter a valid date"
                    },

                    file: {
                        required: "Please select a file",
                        extension: "Only JPG, JPEG and PNG files are allowed"
                    },

                    "check[]": {
                        required: "Please select at least one qualification"
                    },

                    gender: {
                        required: "Please select your gender"
                    },

                    message: {
                        required: "Please enter your message"
                    }
                }

            });

        });
    </script>
</body>

</html>