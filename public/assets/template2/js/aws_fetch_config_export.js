function fetch_key() {
    async function fetchData(configId) {
        try {
            const url = 'https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/config1';
            const data = {
                config_id: configId
            };

            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            const responseData = await response.json();
            return responseData;
        } catch (error) {
            console.error('Error fetching data:', error);
            throw error;
        }
    }

    // Usage
    async function fetchDataMultiple() {
        try {
            const configId1 = 10001;
            const configId2 = 30001;

            let keyword = [];

            const [data1, data2] = await Promise.all([fetchData(configId1), fetchData(configId2)]);
            const data1_a = data1.Items[0].config_data.keyword;
            const data2_a = data2.Items[0].config_data;

            data1_a.forEach(element => {
                keyword.push(element)
            });

            const keys = Object.keys(data2_a);

            for (let i = 0; i < keys.length; i++) {
                const key = keys[i];
                keyword.push(key);
            }
            return keyword;

        } catch (error) {
            console.error('Error:', error);
        }
    }

    // Call the fetchDataMultiple function to fetch data for multiple config IDs
    fetchDataMultiple().then((item) => {
        const widgetContentDiv = document.querySelector('.widget-content');

        const ul = document.createElement('ul');
        ul.className = 'blog-cat';

        for (let i = 0; i < item.length; i++) {
            if (item[i] != "") {
                const txt = item[i];

                const li = document.createElement('li');
                const a = document.createElement('a');
                const span = document.createElement('span');

                a.href = '#';
                a.textContent = `${txt}`;

                // Add onclick event to the list item
                li.onclick = function () {
                    // Call the other function
                    fetch_to_export(`${txt}`, 'key');
                };

                li.appendChild(a);
                ul.appendChild(li);
            }
        }
        const scrollDiv = document.createElement('div');
        scrollDiv.style.overflow = 'auto';
        scrollDiv.style.maxHeight = '300px';
        scrollDiv.appendChild(ul);

        widgetContentDiv.appendChild(scrollDiv);
        // widgetContentDiv.appendChild(ul);
    })

}

function fetch_context(inputText) {
    document.getElementById('loading').style.display = 'block';
    document.getElementById('status').innerHTML = '';
    let data = { data: inputText }
    fetch('https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/datalake1', {
        method: 'POST', headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(res => {
            const container_a = document.getElementById('dataTable');
            container_a.innerHTML = '';
            renderTable(res);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        }).finally(() => {
            // Hide the loading progress when the fetch is complete
            document.getElementById('loading').style.display = 'none';
        });
}

function fetch_to_export(content, check, source) {
    // console.log(content, check, source)
    const currentDate = new Date();
    currentDate.setDate(currentDate.getDate() - 7);
    const year = currentDate.getFullYear();
    const month = String(currentDate.getMonth() + 1).padStart(2, '0');
    const day = String(currentDate.getDate()).padStart(2, '0');

    const startDateTime = `${year}-${month}-${day}T00:00:00`;
    const endDateTime = currentDate.toISOString();

    document.getElementById('loading').style.display = 'block';
    document.getElementById('status').innerHTML = '';

    let data = {};
    if (content == 'all' && check == 'export') {
        data.last = 1000
    } else if (typeof content == 'object' && check == 'date') {
        if (check == 'date') {
            data.datetime_start = content.s
            data.datetime_end = content.e
        } else if (check == 'export' && source) {
            console.log('a')
            data.datetime_start = content.s
            data.datetime_end = content.e
            data.source = source
        }
    } else if (typeof content == 'object' && check == 'export') {
        if (source) {
            data.source = source
            if (source == 'facebook' || source == 'twitter') {
                data.last = 100
            }
        }
        data.datetime_start = content.s
        data.datetime_end = content.e
    } else if (check == 'context') {
        data.data = content
    } else if (check == 'key') {
        data.data = content
        // "key_map": "โกง,ระวัง",
    }
    console.log(data)
    fetch('https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/datalake1', {
        method: 'POST', headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(res => {
            const container_a = document.getElementById('dataTable');
            container_a.innerHTML = '';
            renderTable(res);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        }).finally(() => {
            // Hide the loading progress when the fetch is complete
            document.getElementById('loading').style.display = 'none';
        });
}

// function click_platform(a) {
//     var button = document.getElementById(a);
//     button.classList.toggle("active");

//     if (activeButton !== null && activeButton !== button) {
//         activeButton.classList.remove("active");
//     }

//     activeButton = button;

//     // Get the filter value from the clicked button's ID
//     const filterValue = a.toLowerCase(); // Convert to lowercase

//     // Get the table rows (only rows in the <tbody>)
//     const rows = document.querySelectorAll('#dataTable tbody tr');

//     // Filter the rows based on the platform value in the first <td> of each row
//     rows.forEach(row => {
//         const platformCell = row.querySelector('td:first-child');
//         if (platformCell && platformCell.innerText.toLowerCase() === filterValue) {
//             // Show rows with the matching platform value
//             row.style.display = 'table-row';
//         } else {
//             // Hide rows that don't match the platform value
//             row.style.display = 'none';
//         }
//     });

//     // Assuming you have 's' and 'e' defined somewhere before this function
//     if (s !== "" || e !== "") {
//         fetch_to_export({ "s": s, "e": e }, "export", a);
//     } else {
//         const searchField = document.getElementById('searchForm').elements['search-field'].value
//         fetch_context(searchField);
//     }
// }


// function click_platform(a) {
//     document.getElementById('dataTable').innerHTML = '';
//     var button = document.getElementById(a);
//     button.classList.toggle("active");

//     if (activeButton !== null && activeButton !== button) {
//         activeButton.classList.remove("active");
//     }

//     activeButton = button;

//     // Get the filter value from the clicked button's ID
//     const filterValue = a;

//     // Assuming you have the data to filter in an array named 'tableData'
//     const filteredData = tableData.filter(item => item.platform === filterValue);

//     // Call a function to render the filtered data in the table
//     renderTable(filteredData);
// }

async function renderTable(data, source) {
    var data_arr = data.Items;
    // console.log(data)
    var dataTable = document.getElementById('dataTable');
    dataTable.innerHTML = "<thead><th>Platform</th><th>ผู้ใช้งาน</th><th>วันที่โพสต์</th><th>ข้อมูลที่โพสต์</th></thead>";

    var username = '';
    var post = '';
    for (let i = 0; i < data_arr.length; i++) {
        var date = data_arr[i].datetime;
        // console.log(data_arr[i].data);
        if (data_arr[i].source == 'twitter') {
            username = data_arr[i].data.user
            post = data_arr[i].data.content.trim()
        } else if (data_arr[i].source == 'facebook') {
            var a = data.Items;
            // username post_text post_url >>datetime
            const jsonString = a[i].data;
            const obj = JSON.parse(jsonString);
            username = obj.username
            post = obj.post_text
            // console.log(obj.username)
        } else if (data_arr[i].source == 'tiktok') {
            username = data_arr[i].data.author
            post = data_arr[i].caption

        } else if (data_arr[i].source == 'pantip') {
            username = data_arr[i].data.userid
            post = data_arr[i].data.postcontent

        } else if (data_arr[i].source == 'google') {
            // google head order >>datetime
            username = "Google"
            post = data_arr[i].head

        } else if (data_arr[i].source == 'google-keyword') {
            // DSI head >>datetime
            username = "DSI"
        }

        // var formattedPost = post.replace(/\n/g, " ").replace(/\s+/g, " ").trim();
        // var formattedPost = post.replace(/[\n\r]+/g, " ").trim();
        var formattedPost = post;

        const date_a = new Date(date);
        const options = { day: 'numeric', month: 'short', year: 'numeric' };
        const formattedDate = date_a.toLocaleDateString('th-TH', options);

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

        const headCell = document.createElement('td');
        const headTitle = document.createElement('p');
        headTitle.className = 'prod-title';
        headTitle.innerText = data_arr[i].source;
        headCell.appendChild(headTitle);
        row.appendChild(headCell);

        const headCell2 = document.createElement('td');
        const headTitle2 = document.createElement('p');
        headTitle2.className = 'prod-title';
        headTitle2.innerText = username;
        headCell2.appendChild(headTitle2);
        row.appendChild(headCell2);

        const headCell3 = document.createElement('td');
        const headTitle3 = document.createElement('p');
        headTitle3.className = 'prod-title';
        headTitle3.innerText = formattedDate;
        headCell3.appendChild(headTitle3);
        row.appendChild(headCell3);

        const headCell4 = document.createElement('td');
        const headTitle4 = document.createElement('p');
        // headCell4.style.maxWidth = width;
        // headTitle4.className = 'prod-title';
        headTitle4.innerText = formattedPost;
        headCell4.appendChild(headTitle4);
        row.appendChild(headCell4);

        dataTable.appendChild(row);

        // $('#dataTable').DataTable().row.add(row).draw();
    }
    // for (let i = 0; i < data_arr.length; i++) {
    //     // console.log(data_arr[i].source)
    //     const element = data_arr[i];

    //     var dataTable = document.getElementById('dataTable');
    //     var tbody = dataTable.querySelector('tbody');

    //     var row = tbody.insertRow();

    //     var keyMapCell = row.insertCell();
    //     keyMapCell.innerText = element.key_map;

    //     var datetimeCell = row.insertCell();
    //     datetimeCell.innerText = element.datetime;

    //     // var dataCell = row.insertCell();
    //     // dataCell.innerText = JSON.stringify(element.data);

    //     var uuidCell = row.insertCell();
    //     uuidCell.innerText = element.uuid;

    //     var sourceCell = row.insertCell();
    //     sourceCell.innerText = element.source;
    // }
}

async function renderExport(data) {
    var data_arr = data.Items;
    console.log(data_arr[0].data.userid);
    var dataTable = document.getElementById('dataTable');
    dataTable.innerHTML = "<thead><th>Platform</th><th>ผู้ใช้งาน</th><th>วันที่โพสต์</th><th>ข้อมูลที่โพสต์</th></thead>";
    // <th>URL</th><th>การมีส่วนร่วม</th>

    var username = '';
    var post = '';
    for (let i = 0; i < data_arr.length; i++) {

        var date = data_arr[i].datetime;

        if (data_arr[i].source == 'twitter') {
            username = data_arr[i].data.user;
            post = data_arr[i].data.content;
        } else if (data_arr[i].source == 'facebook') {
            // username post_text post_url >>datetime
            username = data_arr[i].data.username
            post = data_arr[i].data.post_text
        } else if (data_arr[i].source == 'tiktok') {

        } else if (data_arr[i].source == 'pantip') {
            username = data_arr[i].data.userid
            post = data_arr[i].data.postcontent
        } else if (data_arr[i].source == 'google') {
            // google head order >>datetime
            username = "Google"
            post = data_arr[i].head
        } else if (data_arr[i].source == 'google-keyword') {
            // DSI head >>datetime
            username = "DSI"
        }
        // console.log(post);

        const date_a = new Date(date);
        const options = { day: 'numeric', month: 'short', year: 'numeric' };
        const formattedDate = date_a.toLocaleDateString('th-TH', options);

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

        const headCell = document.createElement('td');
        const headTitle = document.createElement('h6');
        headTitle.className = 'prod-title';
        headTitle.innerText = data_arr[i].source;
        headCell.appendChild(headTitle);
        row.appendChild(headCell);

        const headCell2 = document.createElement('td');
        const headTitle2 = document.createElement('h6');
        headTitle2.className = 'prod-title';
        headTitle2.innerText = username;
        headCell2.appendChild(headTitle2);
        row.appendChild(headCell2);

        const headCell3 = document.createElement('td');
        const headTitle3 = document.createElement('h6');
        headTitle3.className = 'prod-title';
        headTitle3.innerText = formattedDate;
        headCell3.appendChild(headTitle3);
        row.appendChild(headCell3);

        const headCell4 = document.createElement('td');
        const headTitle4 = document.createElement('h6');
        headTitle4.className = 'prod-title';
        headTitle4.innerText = post.slice(0, 30) + '...';
        headCell4.appendChild(headTitle4);
        row.appendChild(headCell4);

        dataTable.append(row);
    }
}
