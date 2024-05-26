<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: rgba(42, 49, 100, 0.95);
            color: #fff;
        }

        .container {
            background-color: #fff;
            color: #2a3f54;
            border-radius: 8px;
            padding: 20px;
            margin-top: 10ch;
        }

        .step-bar {
            position: relative;
            margin-bottom: 30px;
        }

        .step {
            position: relative;
            padding-left: 50px;
            margin-bottom: 30px;
        }

        .step::before {
            content: "";
            position: absolute;
            left: 15px;
            top: 0;
            width: 25px;
            height: 25px;
            border: 2px solid #2a3f54;
            border-radius: 50%;
            background: white;
            z-index: 1;
        }

        .step:last-child::after {
            display: none;
        }

        .step.active::before {
            background: #2a3f54;
        }

        .step.completed::before {
            background: #2a3f54;
            content: "\2713";
            color: white;
            text-align: center;
            line-height: 25px;
            font-size: 20px;
        }

        .step-content {
            display: none;
        }

        .step-content.active {
            display: block;
        }

        .scrollable {
            max-height: 200px;
            overflow-y: auto;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .error_box {
            border: 2px solid red;
        }

        .error-message {
            color: red;
            margin-top: 5px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h4 class="text-center">กรุณากรอกข้อมูลให้ครบถ้วนเพื่อส่งคำขอสร้างบัญชีใหม่</h4>
        <div class="row">
            <div class="col-md-3">
                <div class="step-bar">
                    <div class="step active" id="step1">
                        <span>ข้อกำหนดและข้อตกลง</span>
                    </div>
                    <div class="step" id="step2">
                        <span>ข้อมูลพื้นฐาน</span>
                    </div>
                    <div class="step" id="step3">
                        <span>ข้อมูลหน่วยงาน</span>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <form action="{{ route('register') }}" method="POST" id="registrationForm">
                    @csrf
                    <div id="step1Content" class="step-content active">
                        <!-- Content for step 1 -->
                        <div class="mb-3">
                            <hr>
                            <h5>ข้อกำหนดและข้อตกลง</h5>
                            <div class="agreement scrollable">
                                <b><u>ข้อกำหนด นโยบายความเป็นส่วนตัว</u></b> <br>
                                <span style="font-size: 12px;">
                                    นโยบายความเป็นส่วนตัวฉบับนี้ (“นโยบาย”) อธิบายถึงวิธีการที่
                                    ศูนย์เทคโนโลยีสารสนเทศ สำนักงาน ปปส. (หรือ“เรา”) เก็บรวบรวม ใช้
                                    และเปิดเผย ข้อมูลส่วนบุคคล (“ข้อมูลส่วนบุคคล”) ที่ท่าน (“ผู้ใช้”
                                    หรือ “ท่าน”) ได้ให้สำหรับการใช้งานเว็บไซต์ Web Portal
                                    และผลิตภัณฑ์หรือบริการดังกล่าว (เรียกรวมกันว่า “เว็บไซต์” หรือ
                                    “บริการ”)
                                    เพื่อให้สอดคล้องกับพระราชบัญญัติคุ้มครองข้อมูลส่วนบุคคล
                                    พ.ศ. 2562 (“PDPA”)</span>
                                <br>
                                <b><u>การจัดเก็บข้อมูลส่วนบุคคล</u></b> <br>
                                <span style="font-size: 12px;">
                                    เราจะเก็บรักษาข้อมูลส่วนบุคคลของท่านไว้ตามระยะเวลาที่จำเป็นสำหรับการปฏิบัติตามหน้าที่ตามกฎหมายของเรา
                                    ยุติข้อพิพาท
                                    และเพื่อการบังคับใช้สัญญาและข้อกำหนดและเงื่อนไขของเรา
                                    เว้นเสียแต่มีความจำเป็นที่จะต้องเก็บต่อไปหรือตามที่กฎหมายกำหนด
                                    เราอาจใช้ข้อมูลที่รวมขึ้นที่ได้มาจากการรวบรวมข้อมูลส่วนบุคคลของท่านที่ได้ทำให้เป็นปัจจุบันหรือลบทิ้งไปแต่เราจะไม่นำมาใช้ในทางที่สามารถระบุตัวตนของท่านได้
                                    เมื่อครบกำหนดระยะเวลาการจัดเก็บ ข้อมูลส่วนบุคคลจะถูกลบทิ้ง
                                    ดังนั้น
                                    สิทธิขอเข้าถึง สิทธิขอให้ลบ สิทธิขอให้แก้ไข สิทธิขอถ่ายโอนข้อมูล
                                    จะไม่สามารถบังคับใช้ได้เมื่อครบกำหนดระยะเวลาการจัดเก็บ</span>
                                <br>
                            </div>
                        </div>
                        <div class="form-check pb-3">
                            <input class="form-check-input" type="checkbox" id="termsCheck" name="termsCheck" required>
                            <label class="form-check-label" for="termsCheck">
                                ฉันยอมรับข้อกำหนดและเงื่อนไข
                            </label>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="nextStep(2)">ถัดไป</button>
                    </div>
                    <div id="step2Content" class="step-content">
                        <!-- Content for step 2 -->
                        <hr>
                        <h5>ข้อมูลพื้นฐานของผู้ใช้งาน</h5>
                        <div class="mb-3">
                            <label for="cardID" class="form-label">เลขประจำตัวประชาชน 13 หลัก</label>
                            <input type="text" class="form-control" id="card_id" name="card_id" size="13"
                                maxlength="13" required>
                            <div id="card_id-error-message" class="error-message" style="display: none;"></div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">ชื่อ</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <div id="name-error-message" class="error-message" style="display: none;"></div>
                        </div>
                        <div class="mb-3">
                            <label for="surname" class="form-label">นามสกุล</label>
                            <input type="text" class="form-control" id="surname" name="surname" required>
                            <div id="surname-error-message" class="error-message" style="display: none;"></div>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">เบอร์โทรศัพท์</label>
                            <input type="text" class="form-control" id="phone" name="phone" required
                                size="10" maxlength="10">
                            <div id="phone-error-message" class="error-message" style="display: none;"></div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">อีเมล์</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div id="email-error-message" class="error-message" style="display: none;"></div>
                        </div>
                        <button type="button" class="btn btn-secondary" onclick="prevStep(1)">ย้อนกลับ</button>
                        <button type="button" class="btn btn-primary" onclick="nextStep(3)">ถัดไป</button>
                    </div>
                    <div id="step3Content" class="step-content">
                        <!-- Content for step 3 -->
                        <div class="mb-3">
                            <label for="organization" class="form-label">ชื่อหน่วยงาน</label>
                            <input type="text" class="form-control" id="organization" name="organization"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="position" class="form-label">ตำแหน่ง</label>
                            <input type="text" class="form-control" id="position" name="position" required>
                        </div>
                        <button type="button" class="btn btn-secondary" onclick="prevStep(2)">ย้อนกลับ</button>
                        <button type="submit" class="btn btn-primary">ส่งคำขอ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showAlert(type, title, text_body) {
            Swal.fire({
                icon: type == 1 ? "warning" : "error",
                title: title,
                text: text_body,
            });
        }

        $(document).ready(function() {
            function validateInputs() {
                var isCardIdValid = validateCardId();
                var isEmailValid = validateEmail();
                var isNameValid = validateName();
                var isSurnameValid = validateSurname();
                var isPhoneValid = validatePhone();
                return isCardIdValid && isEmailValid && isNameValid && isSurnameValid && isPhoneValid;
            }

            function validateCardId() {
                var card_id = $('#card_id').val();
                var isNumeric = /^\d{13}$/.test(card_id); // Regular expression to check for exactly 13 digits

                if (!isNumeric) {
                    $('#card_id').addClass('error_box');
                    $('#card_id-error-message').text(
                        'เลขประจำตัวประชาชนต้องมีความยาว 13 หลัก และเป็นตัวเลขเท่านั้น').show();
                    return false;
                } else {
                    $('#card_id').removeClass('error_box');
                    $('#card_id-error-message').hide();
                    return true;
                }
            }

            function validateEmail() {
                var email = $('#email').val();
                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Regular expression to validate email format

                if (!emailPattern.test(email)) {
                    $('#email').addClass('error_box');
                    $('#email-error-message').text('รูปแบบอีเมลไม่ถูกต้อง').show();
                    return false;
                } else {
                    $('#email').removeClass('error_box');
                    $('#email-error-message').hide();
                    return true;
                }
            }

            function validateName() {
                var name = $('#name').val().trim();
                if (name === '') {
                    $('#name').addClass('error_box');
                    $('#name-error-message').text('กรุณากรอกชื่อ').show();
                    return false;
                } else {
                    $('#name').removeClass('error_box');
                    $('#name-error-message').hide();
                    return true;
                }
            }

            function validateSurname() {
                var surname = $('#surname').val().trim();
                if (surname === '') {
                    $('#surname').addClass('error_box');
                    $('#surname-error-message').text('กรุณากรอกนามสกุล').show();
                    return false;
                } else {
                    $('#surname').removeClass('error_box');
                    $('#surname-error-message').hide();
                    return true;
                }
            }

            function validatePhone() {
                var phone = $('#phone').val();
                var isNumeric = /^\d{10}$/.test(phone); // Regular expression to check for exactly 10 digits

                if (!isNumeric) {
                    $('#phone').addClass('error_box');
                    $('#phone-error-message').text('เบอร์โทรศัพท์ต้องมีความยาว 10 หลัก และเป็นตัวเลขเท่านั้น')
                        .show();
                    return false;
                } else {
                    $('#phone').removeClass('error_box');
                    $('#phone-error-message').hide();
                    return true;
                }
            }

            $('#card_id').on('blur', function() {
                validateCardId();
                $('#next-button').prop('disabled', !validateInputs());
            });


            $('#email').on('blur', function() {
                validateEmail();
                $('#next-button').prop('disabled', !validateInputs());
            });

            $('#name').on('blur', function() {
                validateName();
                $('#next-button').prop('disabled', !validateInputs());
            });

            $('#surname').on('blur', function() {
                validateSurname();
                $('#next-button').prop('disabled', !validateInputs());
            });

            $('#phone').on('blur', function() {
                validatePhone();
                $('#next-button').prop('disabled', !validateInputs());
            });


            function checkAvailability(inputId, route, errorMessage) {
                var value = $(inputId).val();
                $.ajax({
                    url: route,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        value: value
                    },
                    success: function(response) {
                        if (!response.isAvailable) {
                            showAlert(1, "ไม่สามารถดำเนินการได้", errorMessage);
                            $(inputId).addClass('error_box');
                            $(inputId + '-error-message').text(errorMessage).show();
                            $('#next-button').prop('disabled', true);
                        } else {
                            $(inputId).removeClass('error_box');
                            $(inputId + '-error-message').hide();
                            $('#next-button').prop('disabled', !validateInputs());
                        }
                    }
                });
            }

            $('#card_id').on('blur', function() {
                if (validateCardId()) {
                    checkAvailability('#card_id', '{{ route('check.card_id') }}',
                        'เลขประจำตัวประชาชนนี้ มีบัญชีผู้ใช้งานแล้ว');
                }
            });

            $('#email').on('blur', function() {
                if (validateEmail()) {
                    checkAvailability('#email', '{{ route('check.email') }}',
                        'อีเมล์นี้มีบัญชีผู้ใช้งานแล้ว');
                }
            });

            $('#phone').on('blur', function() {
                validatePhone();
            });

            window.nextStep = function(step) {
                if (step === 2 && !document.getElementById('termsCheck').checked) {
                    showAlert(1, "ไม่สามารถดำเนินการได้", "กรุณายอมรับข้อกำหนดและเงื่อนไข เพื่อดำเนินการต่อ");
                    return;
                }

                if (step === 3 && !validateInputs()) {
                    showAlert(1, "ไม่สามารถดำเนินการได้", "กรุณากรอกข้อมูลให้ครบถ้วน เพื่อดำเนินการต่อ");
                    return;
                }

                document.querySelectorAll('.step').forEach(el => el.classList.remove('active'));
                document.getElementById(`step${step}`).classList.add('active');
                document.querySelectorAll('.step-content').forEach(el => el.classList.remove('active'));
                document.getElementById(`step${step}Content`).classList.add('active');

                // Mark previous steps as completed
                for (let i = 1; i < step; i++) {
                    document.getElementById(`step${i}`).classList.add('completed');
                }
            }

            window.prevStep = function(step) {
                document.querySelectorAll('.step').forEach(el => el.classList.remove('active'));
                document.getElementById(`step${step}`).classList.add('active');
                document.querySelectorAll('.step-content').forEach(el => el.classList.remove('active'));
                document.getElementById(`step${step}Content`).classList.add('active');
            }
        });
    </script>
</body>

</html>
