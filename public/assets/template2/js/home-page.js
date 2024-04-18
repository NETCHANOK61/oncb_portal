$(document).ready(function () {
    $('#dataTable').DataTable({
        "language": {
            "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
            "zeroRecords": "ไม่พบข้อมูล",
            "info": "หน้า _PAGE_ จาก _PAGES_",
            "infoEmpty": "ไม่พบข้อมูล",
            "infoFiltered": "(กรองจากทั้งหมด _MAX_ ข้อมูล)",
            "loadingRecords": "Loading...",
            "search": "ค้นหา:",
            "zeroRecords": "ไม่พบข้อมูลที่ตรงกับคำค้นหา",
            "paginate": {
                "first": "หน้าแรก",
                "last": "สุดท้าย",
                "next": "ถัดไป",
                "previous": "ย้อนกลับ"
            }
        }
    });
});
async function openQRCodePopup() {
    var popup = window.open("", "_blank", "width=300,height=400");
    var qrcode = new QRCode(popup.document.body, {
        width: 250,
        height: 250
    });

    qrcode.makeCode("http://dsi-ai.s3-website-ap-southeast-1.amazonaws.com/suffer_board.html");

    // Create a button inside the popup to download QR code
    var downloadButton = popup.document.createElement("button");
    downloadButton.innerText = "ดาวน์โหลด QR Code";
    downloadButton.onclick = function () {
        var qrCanvas = popup.document.querySelector("canvas");
        var imageURL = qrCanvas.toDataURL("image/png");

        var link = popup.document.createElement("a");
        link.href = imageURL;
        link.download = "qrcode.png";
        link.click();
    };
    popup.document.body.appendChild(downloadButton);

    // Close the popup when clicking outside
    popup.document.onclick = function () {
        popup.blur();
    };

    // Close the popup when losing focus
    popup.onblur = function () {
        popup.close();
    };
}

(async () => {

    valueSource = "all";
    console.log("valueSource: " + valueSource);

    function countOccurrences(info) {
        let data_count = [];

        for (let i = 0; i < data_name.length; i++) {
            let name = data_name[i];
            let count = 0;

            for (let j = 0; j < info.Items.length; j++) {
                if (info.Items[j].province == name) {
                    count++;
                }
            }
            data_count[i] = count;
        }
        return data_count;
    }

    async function populateTable(data_name, data_count) {
        // Create an array of objects for sorting
        const dataArray = [];
        for (let i = 0; i < data_name.length; i++) {
            dataArray.push({ name: data_name[i], count: data_count[i] });
        }

        // Sort the array by count in descending order
        dataArray.sort((a, b) => b.count - a.count);


        for (let i = 0; i < dataArray.length; i++) {
            const row = document.createElement("tr");
            const headCell = document.createElement('td');
            const headTitle = document.createElement('h6');
            headTitle.className = 'prod-title';
            headTitle.innerText = dataArray[i].name;
            headCell.appendChild(headTitle);
            row.appendChild(headCell);

            const exampleCell = document.createElement('td');
            const exampleTitle = document.createElement('h6');
            exampleTitle.className = 'prod-title';
            exampleTitle.innerText = dataArray[i].count;
            exampleCell.appendChild(exampleTitle);
            row.appendChild(exampleCell);

            $('#dataTable').DataTable().row.add(row).draw();

            // const nameCell = document.createElement("td");
            // nameCell.textContent = dataArray[i].name;
            // row.appendChild(nameCell);

            // const countCell = document.createElement("td");
            // countCell.textContent = dataArray[i].count;
            // row.appendChild(countCell);

            // tbody.appendChild(row);
        }
    }
    async function getSource() {
        valueSource = document.getElementById("get-source").value;
        // console.log("valueSource: " + valueSource);

        let url = 'https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/datalake2';

        // Example payload data to be sent in the request body
        if (valueSource == "all") {
            payload = {
                // "source": "facebook",
                // "province": "Bangkok"
            };
        }
        else {
            var dataTable = $('#dataTable').DataTable();
            dataTable.clear().draw();
            payload = {
                "source": valueSource,
                // "province": "Bangkok"
            };
        }


        let headers = {
            'Content-Type': 'application/json'
        };

        // Send the POST request
        await fetch(url, {
            method: 'POST',
            body: JSON.stringify(payload),
            headers: headers
        })
            .then(response => response.json())
            .then(data => {
                // Print the response
                stone = data
                // console.log(data);
            })
            .catch((error) => {
                console.error('Error:', error);
            });

        let topology = await fetch(
            'th-all.topo.json'
        ).then(response => response.json());

        // Prepare demo data. The data is joined to map using value of 'hc-key'
        // property by default. See API docs for 'joinBy' for more info on linking
        // data and map.

        let info = stone
        console.log(info);

        data_name = [
            'Chanthaburi', 'None', 'Phangnga', 'Surat_Thani',
            'Krabi', 'Satun', 'Trang', 'Trat',
            'Phatthalung', 'Phitsanulok', 'Kamphaeng_Phet', 'Phichit',
            'Suphan_Buri', 'Ang_Thong', 'Lop_Buri', 'Ayutthaya',
            'Nakhon_Pathom', 'Sing_Buri', 'Chai_Nat', 'Bangkok',
            'Pathum_Thani', 'Pathum_Thani', 'Samut_Prakan', 'Samut_Sakhon',
            'Samut_Songkhram', 'Phetchaburi', 'Chachoengsao', 'Nakhon_Nayok',
            'Chon_Buri', 'Buri_Ram', 'Khon_Kaen', 'Phetchabun',
            'Kalasin', 'Saraburi', 'Nakhon_Ratchasima', 'Si_Sa_Ket',
            'Roi_Et', 'Loei', 'Nong_Khai', 'Amnat_Charoen',
            'Mukdahan', 'Sakon_Nakhon', 'Narathiwat', 'Pattani',
            'Ranong', 'Nakhon_Si_Thammarat', 'Songkhla', 'Phrae',
            'Phayao', 'Sukhothai', 'Uttaradit', 'Kanchanaburi',
            'Tak', 'Uthai_Thani', 'Nakhon_Sawan', 'Prachuap_Khiri_Khan',
            'Ubon_Ratchathani', 'Sa_Kaeo', 'Rayong', 'Chaiyaphum',
            'Chaiyaphum', 'Nakhon_Phanom', 'Bueng_Kan', 'Mae_Hong_Son',
            'Phuket', 'Chumphon', 'Yala', 'Chiang_Rai',
            'Chiang_Rai', 'Lamphun', 'Nan', 'Lampang',
            'Prachin_Buri', 'Ratchaburi', 'Yasothon', 'Maha_Sarakham',
            'Udon_Thani', 'Nong_Bua_Lam_Phu'
        ];

        data_name_th = [
            'จันทบุรี', 'ไม่มี', 'พังงา', 'สุราษฎร์ธานี',
            'กระบี่', 'สตูล', 'ตรัง', 'ตราด',
            'พัทลุง', 'พิษณุโลก', 'กำแพงเพชร', 'พิจิตร',
            'สุพรรณบุรี', 'อ่างทอง', 'ลพบุรี', 'อยุธยา',
            'นครปฐม', 'สิงห์บุรี', 'ชัยนาท', 'กรุงเทพฯ',
            'ปทุมธานี', 'ปทุมธานี', 'สมุทรปราการ', 'สมุทรสาคร',
            'สมุทรสงคราม', 'เพชรบุรี', 'ฉะเชิงเทรา', 'นครนายก',
            'ชลบุรี', 'บุรีรัมย์', 'ขอนแก่น', 'เพชรบูรณ์',
            'กาฬสินธุ์', 'สระบุรี', 'นครราชสีมา', 'ศรีสะเกษ',
            'ร้อยเอ็ด', 'เลย', 'หนองคาย', 'อำนาจเจริญ',
            'มุกดาหาร', 'สกลนครนคร', 'นราธิวาส', 'ปัตตานี',
            'ระนอง', 'นครศรีธรรมราช', 'สงขลา', 'แพร่',
            'พะเยา', 'สุโขทัย', 'อุตรดิตถ์', 'กาญจนบุรี',
            'ตาก', 'อุทัยธานี', 'นครสวรรค์', 'ประจวบคีรีขันธ์',
            'อุบลราชธานี', 'สระแก้ว', 'ระยอง', 'ชัยภูมิ',
            'ชัยภูมิ', 'นครพนม', 'บึงกาฬ', 'แม่ฮ่องสอน',
            'ภูเก็ต', 'ชุมพร', 'ยะลา', 'เชียงราย',
            'เชียงราย', 'ลำพูน', 'น่าน', 'ลำปาง',
            'ปราจีนบุรี', 'ราชบุรี', 'ยโสธร', 'มหาสารคาม',
            'อุดรธานี', 'หนองบัวลำภู'
        ];

        let data_count = await countOccurrences(info);
        // console.log(data_count);
        // populateTable(data_name, data_count);

        let data = [
            ['th-ct', data_count[0]], ['th-4255', data_count[1]], ['th-pg', data_count[2]], ['th-st', data_count[3]],
            ['th-kr', data_count[4]], ['th-sa', data_count[5]], ['th-tg', data_count[6]], ['th-tt', data_count[7]],
            ['th-pl', data_count[8]], ['th-ps', data_count[9]], ['th-kp', data_count[10]], ['th-pc', data_count[11]],
            ['th-sh', data_count[12]], ['th-at', data_count[13]], ['th-lb', data_count[14]], ['th-pa', data_count[15]],
            ['th-np', data_count[16]], ['th-sb', data_count[17]], ['th-cn', data_count[18]], ['th-bm', data_count[19]],
            ['th-pt', data_count[20]], ['th-no', data_count[21]], ['th-sp', data_count[22]], ['th-ss', data_count[23]],
            ['th-sm', data_count[24]], ['th-pe', data_count[25]], ['th-cc', data_count[26]], ['th-nn', data_count[27]],
            ['th-cb', data_count[28]], ['th-br', data_count[29]], ['th-kk', data_count[30]], ['th-ph', data_count[31]],
            ['th-kl', data_count[32]], ['th-sr', data_count[33]], ['th-nr', data_count[34]], ['th-si', data_count[35]],
            ['th-re', data_count[36]], ['th-le', data_count[37]], ['th-nk', data_count[38]], ['th-ac', data_count[39]],
            ['th-md', data_count[40]], ['th-sn', data_count[41]], ['th-nw', data_count[42]], ['th-pi', data_count[43]],
            ['th-rn', data_count[44]], ['th-nt', data_count[45]], ['th-sg', data_count[46]], ['th-pr', data_count[47]],
            ['th-py', data_count[48]], ['th-so', data_count[49]], ['th-ud', data_count[50]], ['th-kn', data_count[51]],
            ['th-tk', data_count[52]], ['th-ut', data_count[53]], ['th-ns', data_count[54]], ['th-pk', data_count[55]],
            ['th-ur', data_count[56]], ['th-sk', data_count[57]], ['th-ry', data_count[58]], ['th-cy', data_count[59]],
            ['th-su', data_count[60]], ['th-nf', data_count[61]], ['th-bk', data_count[62]], ['th-mh', data_count[63]],
            ['th-pu', data_count[64]], ['th-cp', data_count[65]], ['th-yl', data_count[66]], ['th-cr', data_count[67]],
            ['th-cm', data_count[68]], ['th-ln', data_count[69]], ['th-na', data_count[70]], ['th-lg', data_count[71]],
            ['th-pb', data_count[72]], ['th-rt', data_count[73]], ['th-ys', data_count[74]], ['th-ms', data_count[75]],
            ['th-un', data_count[76]], ['th-nb', data_count[77]]
        ];

        populateTable(data_name_th, data_count);

        // Create the chart
        await Highcharts.mapChart('container', {
            chart: {
                map: topology
            },

            title: {
                text: ''
            },

            // subtitle: {
            //     text: 'Source map: <a href="http://code.highcharts.com/mapdata/countries/th/th-all.topo.json">Thailand</a>'
            // },

            mapNavigation: {
                enabled: true,
                buttonOptions: {
                    verticalAlign: 'bottom'
                }
            },

            colorAxis: {
                min: 0
            },

            series: [{
                data: data,
                name: 'จำนวนเเจ้งเหตุ',
                states: {
                    hover: {
                        color: '#BADA55'
                    }
                },
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }]
        });

    }

    getSource()
    window.getSource = getSource;

})();
