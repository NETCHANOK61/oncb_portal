<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEB-PORTAL</title>

    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="{{ asset('../assets/template2/css/register.css') }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&display=swap" rel="stylesheet">

    <!-- <script src="../assets/template2/js/form-validate.js"></script> -->
    <script src="{{ asset('../assets/template2/js/authen.js') }}"></script>

    <style>
        /* Custom CSS to display radio input and label inline */
        input[type="radio"] {
            display: inline-block;
            vertical-align: middle;
            margin-right: 5px;
        }

        label {
            display: inline-block;
            vertical-align: middle;
        }
    </style>

    <!-- sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <!-- partial:index.partial.html -->
    <div class="container-fluid px-1 px-md-4 py-5 mx-auto">
        <div class="row d-flex justify-content-center" style="padding-top: 5%;">
            <div class="col-12 col-md-11 col-lg-10 col-xl-9">
                <div class="card card0 border-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card00 m-2 border-0">
                                <div class="row text-center justify-content-center px-3">
                                    <!-- <p class="prev"><span class="fa fa-long-arrow-left"> ย้อนกลับ</span></p id="back"> -->
                                    <h3 class="mt-4">ข้อมูลในการลงทะเบียน</h3>
                                </div>
                                <div class="row text-center justify-content-center px-3">
                                    <h4><a href="{{ route('login_screen') }}">กลับหน้าเข้าสู่ระบบ</a></h4>
                                </div>
                                <hr>
                                <div class="d-flex flex-md-row px-3 mt-4 flex-column-reverse">
                                    <div class="col-md-12">
                                        <!-- 1 -->
                                        <div class="card1 ml-2">
                                            <div class="row px-3 mt-4">
                                                <div class="col-6">
                                                    <div class="form-group mt-1 mb-1">
                                                        <label for="firstName">ชื่อ</label>
                                                        <input type="text" id="firstName" class="form-control"
                                                            value="{{ $data->name }}" readonly>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="col-6">
                                                    <div class="form-group mt-1 mb-1">
                                                        <label for="lastName">นามสกุล</label>
                                                        <input type="text" id="lastName" class="form-control"
                                                            value="{{ $data->surname }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row px-3 mt-4">
                                                <div class="col-12">
                                                    <div class="form-group mt-1 mb-1">
                                                        <label for="cardId">เลขที่บัตรประชาชน 13 หลัก</label>
                                                        <input type="text" id="cardId" class="form-control"
                                                            value="{{ $data->card_id }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row px-3 mt-4">
                                                <div class="col-6">
                                                    <div class="form-group mt-1 mb-1">
                                                        <label for="phone">เบอร์โทรศัพท์</label>
                                                        <input type="text" id="phone" class="form-control"
                                                            value="{{ $data->phone }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group mt-1 mb-1">
                                                        <label for="email">อีเมล์</label>
                                                        <input type="text" id="email" class="form-control"
                                                            value="{{ $data->email }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row px-3 mt-4">
                                                <div class="col-12">
                                                    <h5 class="mb-1">สถานะการเป็นสมาชิก</h5>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="fa fa-circle text-success"
                                                                id="letter"></span>
                                                            รออนุมัติ
                                                        </div>
                                                        <div class="col-12">
                                                            <span class="fa fa-circle text-secondary"
                                                                id="number"></span>
                                                            ตรวจสอบคุณสมบัติเรียบร้อย
                                                        </div>
                                                        <div class="col-12">
                                                            <span class="fa fa-circle text-secondary"
                                                                id="capital"></span>
                                                            อนุมัติจากส่วนกลาง
                                                        </div>
                                                        <div class="col-12">
                                                            <span class="fa fa-circle text-secondary"
                                                                id="length"></span>
                                                            ไม่อนุมัติ
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-12">
                                <div class="row px-3">
                                    <h2 class="text-muted get-bonus mt-4 mb-5">เข้าสู่ระบบ<span
                                            class="text-danger"></span></h2>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- partial -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <script src="{{ asset('../assets/template2/js/regis.js') }}"></script>

    <script>
        function toggleElements(role) {
            // role = org_center = ปปส.ส่วนกลาง org_center_Container
            // role = org_region = ปปส.ภาค org_region_Container
            // role = school = สถานศึกษา school_Container
            const org_center_Container = document.getElementById("org_center_Container");
            const org_region_Container = document.getElementById("org_region_Container");
            const school_Container = document.getElementById("school_Container");
            const h1Element = document.getElementById("h1Element");

            if (role === "org_region") {
                org_region_Container.style.display = "block";
                org_center_Container.style.display = "none";
                school_Container.style.display = "none";
                document.getElementById('registerBtn').style.display = 'block';
            } else if (role === "org_center") {
                org_region_Container.style.display = "none";
                org_center_Container.style.display = "block";
                school_Container.style.display = "none";
                document.getElementById('registerBtn').style.display = 'block';
            } else if (role === "school") {
                org_region_Container.style.display = "none";
                org_center_Container.style.display = "none";
                school_Container.style.display = "block";
                document.getElementById('registerBtn').style.display = 'block';
            }
        }
        // Set default selection to 'user' when the page loads
        toggleElements('org_center');

        const checkbox = document.getElementById("customCheck1");
        const nextButton = document.getElementById("nextButton");

        checkbox.addEventListener("change", function() {
            if (checkbox.checked) {
                nextButton.style.display = "block";
            } else {
                nextButton.style.display = "none";
            }
        });

        var provinceSelect = document.getElementById('provinceSelect');
        var ampherSelect = document.getElementById('ampherSelect');

        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('regionSelect').addEventListener('change', function() {
                var regionId = this.value;
                fetch('/get-provinces/' + regionId)
                    .then(response => response.json())
                    .then(data => {
                        provinceSelect.innerHTML = ''; // Clear previous options
                        ampherSelect.innerHTML = ''; // Clear previous options
                        data.forEach(function(province) {
                            var option = document.createElement('option');
                            option.value = province.PROV_ID;
                            option.textContent = province.PROV_NAME;
                            provinceSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching provinces:', error));
            });

            document.getElementById('provinceSelect').addEventListener('change', function() {
                var provinceId = this.value;
                fetch('/get-amphurs/' + provinceId)
                    .then(response => response.json())
                    .then(data => {
                        ampherSelect.innerHTML = ''; // Clear previous options
                        data.forEach(function(amp) {
                            var option = document.createElement('option');
                            option.value = amp.AMP_ID;
                            option.textContent = amp.AMP_NAME;
                            ampherSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching provinces:', error));
            });
        });
    </script>


</body>

</html>
