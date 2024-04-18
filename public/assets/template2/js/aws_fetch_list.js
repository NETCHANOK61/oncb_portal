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
async function fetchDataAndAddToTable() {
    const storedData = localStorage.getItem('myData');
    const originalData = JSON.parse(storedData);
    var a = originalData[1].data;
    // console.log(a);
    document.getElementById('word').innerText = "'" + originalData[0] + "'";
    for (let i = 0; i < a.length; i++) {
        const element = a[i];

        const data = {
            uuid: element
        };
        try {
            const response = await fetch('https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/datalake1', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });


            if (response.ok) {
                const responseData = await response.json();
                var dataItems = responseData.Items;
                var from = dataItems[0].source;

                var head = dataItems[0].head;
                var dataScore = {};

                if (dataItems[0].hasOwnProperty('dataScore')) {
                    dataScore = dataItems[0].dataScore;
                } else {
                    dataScore = {
                        "a": 0,
                        "b": 0,
                        "c": 0,
                        "d": 0,
                        "e": 0
                    }
                }

                let sumValue = 0;
                for (const value of Object.values(dataScore)) {
                    sumValue += value;
                }

                var content = '';
                var pathLogo = "";
                console.log(dataItems);

                if (from == 'twitter') {
                    var txt = dataItems[0].data.content;
                    content = txt.slice(0, 50) + '...';
                    pathLogo = '/images/twitter-icons.png';
                }
                else if (from == 'facebook') {
                    // content = dataItems[0].data.post_text;
                    const jsonObject = JSON.parse(dataItems[0].data);
                    // console.log(jsonObject)
                    content = jsonObject.text;
                    pathLogo = '/images/facebook-icons.png';
                } else if (from == 'tiktok') {
                    content = dataItems[0].data.desc;
                    pathLogo = '/images/tiktok-icons.png';
                } else if (from == 'pantip') {
                    if (dataItems[0].data.postcontent == '') {
                        content = dataItems[0].head;
                    } else {
                        content = dataItems[0].data.postcontent;
                    }
                    pathLogo = '/images/blog-icons.png';
                }

                const row = document.createElement('tr');
                const titleCell = document.createElement('td');
                titleCell.className = 'prod-column';
                const columnBox = document.createElement('div');
                columnBox.className = 'column-box';
                const figure = document.createElement('figure');
                figure.className = 'prod-thumb';
                const link = document.createElement('a');
                link.href = '#';
                const image = document.createElement('img');
                image.src = pathLogo;

                link.appendChild(image);
                figure.appendChild(link);
                columnBox.appendChild(figure);
                titleCell.appendChild(columnBox);
                row.appendChild(titleCell);

                const headCell = document.createElement('td');
                const headTitle = document.createElement('h6');
                headTitle.className = 'prod-title';
                headTitle.innerText = head;
                headCell.appendChild(headTitle);
                row.appendChild(headCell);

                const exampleCell = document.createElement('td');
                const exampleTitle = document.createElement('h6');
                exampleTitle.className = 'prod-title';
                exampleTitle.innerText = content.slice(0, 35) + '...';
                exampleCell.appendChild(exampleTitle);
                row.appendChild(exampleCell);

                const scoreCell = document.createElement('td');
                const ScoreTitle = document.createElement('h6');
                ScoreTitle.className = 'prod-title';
                ScoreTitle.innerText = sumValue;
                scoreCell.appendChild(ScoreTitle);
                row.appendChild(scoreCell);

                const optionsCell = document.createElement('td');
                const button = document.createElement('button');
                button.type = 'submit';
                button.className = 'btn btn-warning';
                button.onclick = function () {
                    // console.log(dataItems)
                    localStorage.setItem('detail_item', JSON.stringify(responseData.Items));
                    localStorage.setItem('number', JSON.stringify(sumValue));
                    window.location.href = 'news-detail.html';
                };
                const buttonText = document.createElement('span');
                buttonText.className = 'txt';
                buttonText.innerText = 'รายละเอียด';
                button.appendChild(buttonText);
                optionsCell.appendChild(button);
                row.appendChild(optionsCell);
                $('#dataTable').DataTable().row.add(row).draw();
            } else {
                throw new Error('Error fetching data');
            }
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    }
}
fetchDataAndAddToTable();