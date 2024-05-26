<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NISPA-2024</title>

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
                                    <h3 class="mt-4">กรุณากรอกข้อมูลให้ครบถ้วนเพื่อส่งคำขอสร้างบัญชีใหม่</h3>
                                </div>
                                <hr>
                                <div class="d-flex flex-md-row px-3 mt-4 flex-column-reverse">
                                    <div class="col-md-6">
                                        <div class="card1">
                                            <ul id="progressbar" class="text-center">
                                                <li class="active step0"></li>
                                                <li class="step0"></li>
                                                <li class="step0"></li>
                                            </ul>
                                            <h6 class="mb-5">ข้อกำหนดและข้อตกลง
                                            </h6>
                                            <h6 class="mb-5">ข้อมูลพื้นฐาน</h6>
                                            <h6 class="mb-5">ข้อมูลหน่วยงาน</h6>
                                        </div>
                                    </div>
                                    <form action="{{ route('register.request') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-md-6 col-lg-12">
                                            <!-- 1 -->
                                            <div class="card2 first-screen show ml-2">
                                                <h5>ข้อกำหนดและข้อตกลง</h5>
                                                <div class="agreement">
                                                    <b><u>ข้อกำหนด นโยบายความเป็นส่วนตัว</u></b> <br>
                                                    <span style="font-size: 12px;">
                                                        นโยบายความเป็นส่วนตัวฉบับนี้ (“นโยบาย”) อธิบายถึงวิธีการที่
                                                        ศูนย์เทคโนโลยีสารสนเทศ สำนักงาน ปปส. (หรือ“เรา”) เก็บรวบรวม ใช้
                                                        และเปิดเผย ข้อมูลส่วนบุคคล (“ข้อมูลส่วนบุคคล”) ที่ท่าน (“ผู้ใช้”
                                                        หรือ “ท่าน”) ได้ให้สำหรับการใช้งานเว็บไซต์ user management
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
                                                <div class="row px-3 mt-1 mb-5">
                                                    <div class="custom-control custom-checkbox"><input id="customCheck1"
                                                            type="checkbox" class="custom-control-input">
                                                        <label for="customCheck1"
                                                            class="custom-control-label">ฉันเข้าใจและยินยอม</label>
                                                    </div>
                                                </div>
                                                <center>
                                                    <button id="nextButton" style="display: none;" type="button"
                                                        class="next-button">
                                                        <span class="fa fa-arrow-right"> ดำเนินการต่อ</span>
                                                    </button>
                                                </center>
                                                <br>
                                            </div>
                                            <!-- 2 -->
                                            <div class="card2 ml-2">
                                                <div class="row px-3 mt-4">
                                                    <div class="col-12">
                                                        <div class="form-group mt-1 mb-1">
                                                            <input type="text" name="card_id" id="cardId"
                                                                class="form-control">
                                                            <label class="ml-3 form-control-placeholder"
                                                                for="cardId">เลขที่บัตรประชาชน 13 หลัก</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group mt-1 mb-1">
                                                            <input type="text" name="name" id="firstName"
                                                                class="form-control">
                                                            <label class="ml-3 form-control-placeholder"
                                                                for="firstName">ชื่อ</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group mt-1 mb-1">
                                                            <input type="text" name="surname" id="lastName"
                                                                class="form-control">
                                                            <label class="ml-3 form-control-placeholder"
                                                                for="lastName">นามสกุล</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group mt-1 mb-1">
                                                            <input type="text" name="phone" id="phone"
                                                                class="form-control">
                                                            <label class="ml-3 form-control-placeholder"
                                                                for="phone">เบอร์โทรศัพท์</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group mt-1 mb-1">
                                                            <input type="text" name="email" id="email"
                                                                class="form-control">
                                                            <label class="ml-3 form-control-placeholder"
                                                                for="email">อีเมล์</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <center>
                                                    <br>
                                                    <button id="twoBtn" type="button"
                                                        class="next-button text-center mt-1 ml-2">
                                                        <span class="fa fa-arrow-right">
                                                            ดำเนินการต่อ
                                                        </span>
                                                    </button>
                                                </center>
                                                <br>
                                            </div>
                                            <!-- 3 -->
                                            <div class="card2 ml-2">
                                                <p>กรุณาเลือกประเภทผู้ใช้งานของคุณ:</p>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <input type="radio" id="org_center" name="role"
                                                            value="user" onclick="toggleElements('org_center')"
                                                            checked>
                                                        <label for="org_center">ปปส.ส่วนกลาง</label>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="radio" id="org_region" name="role"
                                                            value="staff" onclick="toggleElements('org_region')">
                                                        <label for="org_region">ปปส.ภาค</label>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="radio" id="school" name="role"
                                                            value="staff" onclick="toggleElements('school')">
                                                        <label for="school">สถานศึกษา</label>
                                                    </div>
                                                </div>

                                                <div class="row px-3 mt-3">
                                                    <div class="form-group mt-3">
                                                        <div id="org_region_Container" class="">
                                                            <p class="mb-0 w-100">ภาค</p>
                                                            <select name="account" class="form-control"
                                                                id="regionSelect">
                                                                @foreach ($region as $key => $item)
                                                                    <option value="{{ $item->REG_ONCB }}">
                                                                        {{ $item->REG_NAME }}</option>
                                                                @endforeach
                                                                <!-- Options will be added dynamically using JavaScript -->
                                                            </select>
                                                            <p class="mb-0 w-100">จังหวัด</p>
                                                            <select name="account" class="form-control"
                                                                id="provinceSelect">
                                                                @foreach ($province as $key => $item)
                                                                    <option value="{{ $item->PROV_ID }}">
                                                                        {{ $item->PROV_NAME }}</option>
                                                                @endforeach
                                                                <!-- Options will be added dynamically using JavaScript -->
                                                            </select>
                                                            <p class="mb-0 w-100">อำเภอ</p>
                                                            <select name="account" class="form-control"
                                                                id="ampherSelect">
                                                                @foreach ($ampher as $key => $item)
                                                                    <option value="{{ $item->AMP_ID }}">
                                                                        {{ $item->AMP_NAME }}</option>
                                                                @endforeach
                                                                <!-- Options will be added dynamically using JavaScript -->
                                                            </select>
                                                        </div>
                                                        <div id="org_center_Container" class="select">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label class=""
                                                                            for="username_ad_input">username AD</label>
                                                                        <input type="text" name="username_ad"
                                                                            id="username_ad" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label class=""
                                                                            for="password_ad_input">password AD</label>
                                                                        <input type="text" name="password_ad"
                                                                            id="password_ad" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <label class="w-100">แผนก</label>
                                                            <select name="account" class="form-control"
                                                                id="">
                                                                @foreach ($agencies as $key => $item)
                                                                    <option value="{{ $item->div_code }}">
                                                                        {{ $item->dept_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div id="school_Container" class="select">
                                                            <p class="mb-0 w-100">จังหวัด</p>
                                                            <select name="provinceSelect_edu"
                                                                class="form-control"
                                                                id="provinceSelect_edu">
                                                                @foreach ($province as $key => $item)
                                                                    <option value="{{ $item->PROV_ID }}">
                                                                        {{ $item->PROV_NAME }}</option>
                                                                @endforeach
                                                            </select>
                                                            <p class="mb-0 w-100">สำนักงานการศึกษาขั้นพื้นฐาน</p>
                                                            <select name="edu_area" class="form-control"
                                                                id="edu_area"></select>
                                                            <p class="mb-0 w-100">โรงเรียน</p>
                                                            <select name="school_list"
                                                                class="form-control" id="school_list">
                                                            </select>
                                                        </div>
                                                        <div id="" class="select">
                                                            <p class="mb-0 w-100">แนบไฟล์ขอใช้งาน</p>
                                                            <input type="file" name="file_upload">
                                                        </div>
                                                    </div>
                                                </div>
                                                <center>
                                                    <button type="submit" id="registerBtn"
                                                        class="next-button text-center mt-1 ml-2">
                                                        <span class="fa fa-arrow-right">
                                                            ส่งคำขอ</span>
                                                    </button>
                                                </center>
                                                <br>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
        var provinceSelect_edu = document.getElementById('provinceSelect_edu');
        var edu_area = document.getElementById('edu_area');
        var school_list = document.getElementById('school_list');

        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('regionSelect').addEventListener('change', function() {
                var regionId = this.value;
                fetch('/get-provinces/' + regionId)
                    .then(response => response.json())
                    .then(data => {
                        provinceSelect.innerHTML = ''; // Clear previous options
                        ampherSelect.innerHTML = ''; // Clear previous options

                        var defaultOption = document.createElement('option');
                        defaultOption.value = '';
                        defaultOption.textContent = '-เลือก-';
                        provinceSelect.appendChild(defaultOption);

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

            document.getElementById('provinceSelect_edu').addEventListener('change', function() {
                var provinceId_edu = this.value;
                fetch('/get-edu_area/' + provinceId_edu)
                    .then(response => response.json())
                    .then(data => {
                        edu_area.innerHTML = ''; // Clear previous options
                        data.forEach(function(item) {
                            var option = document.createElement('option');
                            option.value = item.edu_area_id;
                            option.textContent = item.edu_area_name;
                            edu_area.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching provinces:', error));
            });

            document.getElementById('edu_area').addEventListener('change', function() {
                var edu_area = this.value;
                fetch('/get-school_with_edu/' + provinceSelect_edu.value + "/" + edu_area)
                    .then(response => response.json())
                    .then(data => {
                        school_list.innerHTML = ''; // Clear previous options
                        data.forEach(function(item) {
                            var option = document.createElement('option');
                            option.value = item.Dep_id;
                            option.textContent = item.Thai_Name;
                            school_list.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching provinces:', error));
            });
        });
    </script>


</body>

</html>
