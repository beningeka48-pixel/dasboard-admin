<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login - KracakNu</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
          rel="stylesheet">

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            background:
                linear-gradient(135deg, #eef7f1, #f8faf9);
            font-family: "Segoe UI", Arial, sans-serif;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }

        .login-container {
            width: 100%;
            max-width: 1050px;
            min-height: 620px;
            background: white;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.10);
        }

        /* =========================
           LEFT SIDE
        ========================= */

        .login-left {
            background: linear-gradient(
                145deg,
                #1f5135,
                #2d6a4f
            );

            color: white;

            min-height: 620px;

            padding: 55px;

            display: flex;
            flex-direction: column;
            justify-content: space-between;

            position: relative;

            overflow: hidden;
        }

        .login-left::before {
            content: "";

            position: absolute;

            width: 300px;
            height: 300px;

            background: rgba(255,255,255,0.07);

            border-radius: 50%;

            top: -100px;
            right: -100px;
        }

        .login-left::after {
            content: "";

            position: absolute;

            width: 250px;
            height: 250px;

            background: rgba(255,255,255,0.05);

            border-radius: 50%;

            bottom: -100px;
            left: -80px;
        }

        .brand {
            position: relative;
            z-index: 2;
        }

        .brand-icon {
            width: 55px;
            height: 55px;

            background: rgba(255,255,255,0.15);

            border-radius: 16px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 27px;

            margin-bottom: 20px;
        }

        .brand h1 {
            font-size: 34px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .brand p {
            opacity: 0.85;
            line-height: 1.7;
            max-width: 400px;
        }

        .welcome-text {
            position: relative;
            z-index: 2;
        }

        .welcome-text h2 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .welcome-text p {
            opacity: 0.85;
            line-height: 1.8;
        }

        .copyright {
            position: relative;
            z-index: 2;
            font-size: 13px;
            opacity: 0.7;
        }

        /* =========================
           RIGHT SIDE
        ========================= */

        .login-right {
            padding: 55px;

            display: flex;
            align-items: center;
        }

        .login-form {
            width: 100%;
            max-width: 420px;
            margin: auto;
        }

        .login-form h2 {
            font-size: 30px;
            font-weight: 700;
            color: #1f2937;
        }

        .login-form .subtitle {
            color: #6b7280;
            margin-bottom: 35px;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
        }

        .input-group-custom {
            position: relative;
        }

        .input-group-custom .form-control {
            height: 52px;

            border-radius: 12px;

            border: 1px solid #dfe5e1;

            padding-left: 45px;

            transition: 0.2s;
        }

        .input-group-custom .form-control:focus {
            border-color: #2d6a4f;

            box-shadow:
                0 0 0 4px rgba(45,106,79,0.10);
        }

        .input-icon {
            position: absolute;

            left: 16px;
            top: 50%;

            transform: translateY(-50%);

            color: #7a8a80;

            z-index: 5;
        }

        .btn-login {
            width: 100%;

            height: 52px;

            border: none;

            border-radius: 12px;

            background: #2d6a4f;

            color: white;

            font-weight: 600;

            font-size: 16px;

            transition: 0.25s;
        }

        .btn-login:hover {
            background: #1f5135;

            transform: translateY(-1px);

            box-shadow:
                0 8px 20px rgba(45,106,79,0.25);
        }

        .alert {
            border-radius: 12px;
        }

        .login-info {
            background: #f4f8f5;

            border-radius: 12px;

            padding: 15px;

            margin-top: 25px;

            font-size: 13px;

            color: #64746b;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 768px) {

            .login-wrapper {
                padding: 15px;
            }

            .login-container {
                min-height: auto;
            }

            .login-left {
                min-height: 330px;
                padding: 35px;
            }

            .welcome-text h2 {
                font-size: 25px;
            }

            .brand h1 {
                font-size: 28px;
            }

            .login-right {
                padding: 35px 25px;
            }

        }

    </style>

</head>


<body>


<div class="login-wrapper">

    <div class="login-container">

        <div class="row g-0 h-100">


            <!-- =========================
                 LEFT SIDE
            ========================== -->

            <div class="col-lg-6">

                <div class="login-left">

                    <div class="brand">

                        <div class="brand-icon">

                            <i class="bi bi-flower1"></i>

                        </div>

                        <h1>
                            KracakNu
                        </h1>

                        <p>
                            Kracak Village Information & Management System
                        </p>

                    </div>


                    <div class="welcome-text">

                        <h2>
                            Welcome Back!
                        </h2>

                        <p>
                            Manage village information, news,
                            citizen data, and other KracakNu
                            administration features from one place.
                        </p>

                    </div>


                    <div class="copyright">

                        © {{ date('Y') }} KracakNu.
                        All rights reserved.

                    </div>

                </div>

            </div>


            <!-- =========================
                 RIGHT SIDE
            ========================== -->

            <div class="col-lg-6">

                <div class="login-right">

                    <div class="login-form">


                        <div class="mb-4">

                            <h2>
                                Admin Login
                            </h2>

                            <p class="subtitle">

                                Sign in to access the administration dashboard.

                            </p>

                        </div>


                        <!-- ERROR -->

                        @if($errors->any())

                            <div class="alert alert-danger">

                                <i class="bi bi-exclamation-circle me-2"></i>

                                {{ $errors->first() }}

                            </div>

                        @endif


                        <!-- LOGIN FORM -->

                        <form action="{{ route('login.process') }}"
                              method="POST">

                            @csrf


                            <!-- EMAIL -->

                            <div class="mb-4">

                                <label class="form-label">

                                    Email Address

                                </label>

                                <div class="input-group-custom">

                                    <i class="bi bi-envelope input-icon"></i>

                                    <input type="email"
                                           name="email"
                                           value="{{ old('email') }}"
                                           class="form-control"
                                           placeholder="admin@example.com"
                                           required
                                           autofocus>

                                </div>

                            </div>


                            <!-- PASSWORD -->

                            <div class="mb-4">

                                <label class="form-label">

                                    Password

                                </label>

                                <div class="input-group-custom">

                                    <i class="bi bi-lock input-icon"></i>

                                    <input type="password"
                                           name="password"
                                           id="password"
                                           class="form-control"
                                           placeholder="Enter your password"
                                           required>

                                </div>

                            </div>


                            <!-- LOGIN BUTTON -->

                            <button type="submit"
                                    class="btn-login">

                                <i class="bi bi-box-arrow-in-right me-2"></i>

                                Sign In

                            </button>

                        </form>


                        <!-- INFORMATION -->

                        <div class="login-info">

                            <i class="bi bi-shield-check me-2"></i>

                            This page is restricted to authorized
                            KracakNu administrators.

                        </div>


                    </div>

                </div>

            </div>


        </div>

    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>