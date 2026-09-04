<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Register Admin - KracakNu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background:
                linear-gradient(
                    135deg,
                    #f4f8f5,
                    #e7f1ea
                );
        }

        .register-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 15px;
        }

        .register-card {
            width: 100%;
            max-width: 950px;
            background: #ffffff;
            border: none;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.12);
        }

        /* LEFT SIDE */

        .register-info {
            height: 100%;
            min-height: 650px;
            padding: 50px;
            background:
                linear-gradient(
                    145deg,
                    #1f5135,
                    #2d6a46
                );
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo {
            width: 65px;
            height: 65px;
            border-radius: 18px;
            background: rgba(255,255,255,0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            margin-bottom: 25px;
        }

        .register-info h1 {
            font-size: 38px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .register-info p {
            color: rgba(255,255,255,0.85);
            line-height: 1.7;
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 22px;
            color: rgba(255,255,255,0.9);
        }

        .feature-icon {
            width: 35px;
            height: 35px;
            border-radius: 10px;
            background: rgba(255,255,255,0.15);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* RIGHT SIDE */

        .register-form {
            padding: 50px;
        }

        .register-form h2 {
            font-weight: 700;
            color: #222;
        }

        .register-subtitle {
            color: #777;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: 600;
            color: #444;
        }

        .form-control {
            height: 50px;
            border-radius: 12px;
            border: 1px solid #dfe4e1;
            padding: 0 15px;
        }

        .form-control:focus {
            border-color: #2d6a46;
            box-shadow: 0 0 0 3px rgba(45,106,70,0.12);
        }

        .btn-register {
            height: 50px;
            border: none;
            border-radius: 12px;
            background: #2d6a46;
            color: white;
            font-weight: 600;
            transition: .2s;
        }

        .btn-register:hover {
            background: #1f5135;
            color: white;
            transform: translateY(-1px);
        }

        .approval-info {
            border-radius: 12px;
            background: #f0f7f2;
            border: 1px solid #d8e9dd;
            padding: 15px;
            color: #3f5f4a;
            font-size: 14px;
            line-height: 1.6;
        }

        .login-link {
            color: #2d6a46;
            font-weight: 600;
            text-decoration: none;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 767px) {

            .register-info {
                min-height: auto;
                padding: 35px;
            }

            .register-info h1 {
                font-size: 30px;
            }

            .register-form {
                padding: 35px 25px;
            }

        }

    </style>

</head>

<body>

<div class="register-wrapper">

    <div class="register-card">

        <div class="row g-0">

            {{-- LEFT SIDE --}}

            <div class="col-lg-5">

                <div class="register-info">

                    <div class="logo">
                        🌿
                    </div>

                    <h1>
                        KracakNu
                    </h1>

                    <h5 class="mb-3">
                        Administrator Registration
                    </h5>

                    <p>
                        Create an administrator account to help
                        manage information, news, citizens, and
                        activities of Kracak Village.
                    </p>

                    <div class="feature">

                        <div class="feature-icon">
                            ✓
                        </div>

                        <span>
                            Manage village information
                        </span>

                    </div>

                    <div class="feature">

                        <div class="feature-icon">
                            ✓
                        </div>

                        <span>
                            Manage news and activities
                        </span>

                    </div>

                    <div class="feature">

                        <div class="feature-icon">
                            ✓
                        </div>

                        <span>
                            Secure administrator access
                        </span>

                    </div>

                </div>

            </div>


            {{-- RIGHT SIDE --}}

            <div class="col-lg-7">

                <div class="register-form">

                    <h2>
                        Create Account
                    </h2>

                    <p class="register-subtitle">
                        Register as a KracakNu administrator.
                    </p>


                    {{-- ERROR --}}

                    @if($errors->any())

                        <div class="alert alert-danger">

                            <strong>
                                Registration failed
                            </strong>

                            <ul class="mb-0 mt-2">

                                @foreach($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    @endif


                    {{-- FORM --}}

                    <form action="{{ route('register.process') }}"
                          method="POST">

                        @csrf


                        {{-- NAME --}}

                        <div class="mb-3">

                            <label class="form-label">
                                Full Name
                            </label>

                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   value="{{ old('name') }}"
                                   placeholder="Enter your full name"
                                   required>

                        </div>


                        {{-- EMAIL --}}

                        <div class="mb-3">

                            <label class="form-label">
                                Email Address
                            </label>

                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   value="{{ old('email') }}"
                                   placeholder="Enter your email"
                                   required>

                        </div>


                        {{-- PASSWORD --}}

                        <div class="mb-3">

                            <label class="form-label">
                                Password
                            </label>

                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   placeholder="Minimum 8 characters"
                                   required>

                        </div>


                        {{-- CONFIRM PASSWORD --}}

                        <div class="mb-4">

                            <label class="form-label">
                                Confirm Password
                            </label>

                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control"
                                   placeholder="Repeat your password"
                                   required>

                        </div>


                        {{-- APPROVAL INFO --}}

                        <div class="approval-info mb-4">

                            <strong>
                                Account Approval Required
                            </strong>

                            <br>

                            Your registration will be reviewed by
                            the Super Admin. You can log in only
                            after your account has been approved.

                        </div>


                        {{-- REGISTER BUTTON --}}

                        <button type="submit"
                                class="btn btn-register w-100">

                            Create Administrator Account

                        </button>

                    </form>


                    {{-- LOGIN --}}

                    <div class="text-center mt-4">

                        <span class="text-muted">
                            Already have an account?
                        </span>

                        <a href="{{ route('login') }}"
                           class="login-link">

                            Login here

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>