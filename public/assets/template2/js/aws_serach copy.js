function search_withInput(input, type, id, table, status) {
    let data = {}
    if (type == "bank") {
        data = { "result_data": input, "result_id": 90021 }
    } else if (type == "name") {
        data = { "result_data": input, "result_id": 90022 }
    } else if (type == "phone") {
        data = { "result_data": input, "result_id": 90020 }
    }
    // console.log(data);
    fetch('https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/result1', {
        method: 'POST', headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(data => {
            renderBox(data.Items, id, table, status)
            // renderTable(data.Items, id)
        })
        .catch(error => {
            document.getElementById(status).innerText = "เกิดข้อผิดพลาด โปรดรีเฟชหน้าจอนี้";
            console.error('Error fetching data:', error);
        });
}

function search_name(input, type, id, table, status, divPage) {
    let data = {
        data: input
    }
    fetch('https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/datalake1', {
        method: 'POST', headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(data => {
            renderBox2(data.Items, id, table, status, divPage)
            // renderTable(data.Items, id)
        })
        .catch(error => {
            document.getElementById(status).innerText = "เกิดข้อผิดพลาด โปรดรีเฟชหน้าจอนี้";
            console.error('Error fetching data:', error);
        });
}

async function renderBox(data, id, table, status) {
    // console.log(data)
    if (data.length == 0) {
        document.getElementById(status).innerText = "ไม่พบข้อมูลที่คุณค้นหา";
        document.getElementById(table).innerHTML = "";
    } else {
        document.getElementById(status).innerText = "";
    }

    const container = document.getElementById(id);
    container.innerHTML = '';

    for (let index = 0; index < data.length; index++) {
        const from = data[index].source;
        var pathLogo = "";

        if (from == 'twitter') {
            pathLogo = '/images/twitter-icons.png';
        } else if (from == 'facebook') {
            pathLogo = '/images/facebook-icons.png';
        } else if (from == 'tiktok') {
            pathLogo = '/images/tiktok-icons.png';
        } else if (from == 'pantip') {
            pathLogo = '/images/blog-icons.png';
        }

        // Create new elements for figure and image
        const figure = document.createElement('figure');
        const img = document.createElement('img');

        // Set the image source
        img.src = pathLogo;

        // Add classes to the figure and image (if needed)
        figure.classList.add('post-thumb');
        img.classList.add('your-image-class');

        // Create an overlay link if needed
        const link = document.createElement('a');
        link.classList.add('overlay-box');
        link.innerHTML = '<span style="color:white" class="icon fa fa-eye"></span>';
        // Add onclick event to the link to show the hidden div
        // link.onmouseover = function () {
        //     renderTable(data, table)
        // };

        // Add onmouseover event to the link to show the hidden div
        link.onmouseover = function () {
            renderDetail(data[index], table)
            // renderTable(data, table)
        };

        // Append the image and overlay link to the figure
        figure.appendChild(img);
        figure.appendChild(link);

        // Append the figure to the container
        container.appendChild(figure);
    }
}

async function renderBox2(data, id, table, status, divPage) {
    if (data.length == 0) {
        document.getElementById(status).innerText = "ไม่พบข้อมูลที่คุณค้นหา";
        document.getElementById(table).innerHTML = "";
    } else {
        document.getElementById(status).innerText = "";
    }

    const container = document.getElementById(id);
    const control = document.getElementById(divPage);
    // const contentDiv = document.createElement('div');
    // const paginationDiv = document.createElement('div');

    // contentDiv.id = 'content';
    // paginationDiv.id = 'pagination';

    // container.appendChild(contentDiv);
    // container.appendChild(paginationDiv);

    const itemsPerPage = 8;
    const totalPages = Math.ceil(data.length / itemsPerPage);

    let currentPage = 1;

    function renderPage(page) {
        container.innerHTML = '';

        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = Math.min(startIndex + itemsPerPage, data.length);

        for (let index = startIndex; index < endIndex; index++) {
            const from = data[index].source;
            var pathLogo = "";

            if (from == 'twitter') {
                pathLogo = '/images/twitter-icons.png';
            } else if (from == 'facebook') {
                pathLogo = '/images/facebook-icons.png';
            } else if (from == 'tiktok') {
                pathLogo = '/images/tiktok-icons.png';
            } else if (from == 'pantip') {
                pathLogo = '/images/blog-icons.png';
            }

            // Create new elements for figure and image
            const figure = document.createElement('figure');
            const img = document.createElement('img');

            // Set the image source
            img.src = pathLogo;

            // Add classes to the figure and image (if needed)
            figure.classList.add('post-thumb');

            // Create an overlay link if needed
            const link = document.createElement('a');
            link.classList.add('overlay-box');
            link.innerHTML = '<span style="color:white" class="icon fa fa-eye"></span>';

            // Add onmouseover event to the link to show the hidden div
            link.onmouseover = function () {
                renderDetail2(data[index], table);
                // renderTable(data, table)
            };

            // Append the image and overlay link to the figure
            figure.appendChild(img);
            figure.appendChild(link);

            // Append the figure to the content
            container.appendChild(figure);
        }
    }


    function renderPagination() {
        control.innerHTML = '';

        const pagination = document.createElement('div');
        pagination.classList.add('pagination');

        for (let page = 1; page <= totalPages; page++) {
            const pageButton = document.createElement('button');
            pageButton.classList.add("btn", "btn-primary");
            
            pageButton.textContent = page;
            pageButton.addEventListener('click', () => {
                currentPage = page;
                renderPage(currentPage);
            });

            pagination.appendChild(pageButton);
        }

        control.appendChild(pagination);
    }
    // Event delegation for pagination buttons
    control.addEventListener('click', function (event) {
        if (event.target.tagName === 'BUTTON') {

            currentPage = parseInt(event.target.textContent);
            renderPage(currentPage);
        }
    });

    renderPage(currentPage);
    renderPagination();


    // const container = document.getElementById(id);
    // container.innerHTML = '';

    // for (let index = 0; index < data.length; index++) {
    //     const from = data[index].source;
    //     var pathLogo = "";

    //     if (from == 'twitter') {
    //         pathLogo = '/images/twitter-icons.png';
    //     } else if (from == 'facebook') {
    //         pathLogo = '/images/facebook-icons.png';
    //     } else if (from == 'tiktok') {
    //         pathLogo = '/images/tiktok-icons.png';
    //     } else if (from == 'pantip') {
    //         pathLogo = '/images/blog-icons.png';
    //     }

    //     // Create new elements for figure and image
    //     const figure = document.createElement('figure');
    //     const img = document.createElement('img');

    //     // Set the image source
    //     img.src = pathLogo;

    //     // Add classes to the figure and image (if needed)
    //     figure.classList.add('post-thumb');

    //     // Create an overlay link if needed
    //     const link = document.createElement('a');
    //     link.classList.add('overlay-box');
    //     link.innerHTML = '<span style="color:white" class="icon fa fa-eye"></span>';
    //     // Add onclick event to the link to show the hidden div

    //     // Add onmouseover event to the link to show the hidden div
    //     link.onmouseover = function () {
    //         renderDetail2(data[index], table)
    //         // renderTable(data, table)
    //     };

    //     // Append the image and overlay link to the figure
    //     figure.appendChild(img);
    //     figure.appendChild(link);

    //     // Append the figure to the container
    //     container.appendChild(figure);
    // }
}

async function renderDetail(dataA, id) {
    console.log(dataA)
    // Get the container element where we want to add new inner-box divs
    const container = document.getElementById(id);
    container.innerHTML = "";
    // Loop through the sampleData and create inner-box divs for each entry
    const from = dataA.source;

    var readmoreLink = "";

    if (from == 'twitter') {
        pathLogo = '/images/twitter-icons.png';
        readmoreLink = "twitter-detail.html?uuid=";
    } else if (from == 'facebook') {
        pathLogo = '/images/facebook-icons.png';
        readmoreLink = "facebook-detail.html?uuid=";
    } else if (from == 'tiktok') {
        pathLogo = '/images/tiktok-icons.png';
        readmoreLink = "tiktok-detail.html?uuid=";
    } else if (from == 'pantip') {
        pathLogo = '/images/blog-icons.png';
        readmoreLink = "pantip-detail.html?uuid=";
    }

    // Create new elements for inner-box and its content
    const innerBox = document.createElement('div');
    innerBox.classList.add('inner-box');

    const lowerContent = document.createElement('div');
    lowerContent.classList.add('lower-content');

    const postTitle = document.createElement('h4');
    const postTitleLink = document.createElement('a');
    postTitleLink.href = '#'; // Replace with your desired link URL
    postTitle.appendChild(postTitleLink);

    const postText = document.createElement('div');
    postText.classList.add('text');
    postText.textContent = dataA.text;

    const lowerBox = document.createElement('div');
    lowerBox.classList.add('lower-box', 'clearfix');

    const pullLeftDiv = document.createElement('div');
    pullLeftDiv.classList.add('pull-left');

    const postMetaList = document.createElement('ul');
    postMetaList.classList.add('post-meta');

    const numCommentsItem = document.createElement('li');

    const authorItem = document.createElement('li');
    authorItem.innerHTML = '<span class="icon flaticon-user"></span>' + from;

    const pullRightDiv = document.createElement('div');
    pullRightDiv.classList.add('pull-right');

    const readMoreLink = document.createElement('a');
    readMoreLink.classList.add('read-more');
    readMoreLink.href = readmoreLink + encodeURIComponent(dataA.uuid);
    readMoreLink.innerHTML = '<span class="arrow flaticon-long-arrow-pointing-to-the-right"></span> Read More';
    // Add click event listener to handle form reset
    readMoreLink.addEventListener('click', function () {
        const searchForm = document.getElementById('searchForm');
        searchForm.reset();
    });

    lowerBox.appendChild(pullLeftDiv);
    postMetaList.appendChild(numCommentsItem);
    postMetaList.appendChild(authorItem);
    pullLeftDiv.appendChild(postMetaList);

    // lowerContent.appendChild(postDate);
    lowerContent.appendChild(postTitle);
    lowerContent.appendChild(postText);
    lowerContent.appendChild(lowerBox);
    pullRightDiv.appendChild(readMoreLink);
    lowerBox.appendChild(pullRightDiv);

    // innerBox.appendChild(imageDiv);
    innerBox.appendChild(lowerContent);

    // Append the inner-box div to the container
    container.appendChild(innerBox);
    // }

}

async function renderDetail2(dataA, id) {
    console.log(dataA)
    // Get the container element where we want to add new inner-box divs
    const container = document.getElementById(id);
    container.innerHTML = "";
    // Loop through the sampleData and create inner-box divs for each entry
    const from = dataA.source;
    var post_content = "";

    var readmoreLink = "";

    if (from == "twitter") {
        post_content = dataA.data.content;
        pathLogo = '/images/twitter-icons.png';
        readmoreLink = "twitter-detail.html?uuid=";
    } else if (from == "facebook") {
        const jsonObject = JSON.parse(dataA.data);
        post_content = jsonObject.text;
        pathLogo = '/images/facebook-icons.png';
        readmoreLink = "facebook-detail.html?uuid=";
    } else if (from == "tiktok") {
        post_content = (dataA.data.desc).replace(/\s/g, '');
        pathLogo = '/images/tiktok-icons.png';
        readmoreLink = "tiktok-detail.html?uuid=";
    } else if (from == "pantip") {
        console.log(dataA)
        if (dataA.data.postcontent == "") {
            post_content = dataA.head
        } else {
            post_content = (dataA.data.postcontent).replace(/\s/g, '');
        }
        pathLogo = '/images/blog-icons.png';
        readmoreLink = "pantip-detail.html?uuid=";
    }

    // Create new elements for inner-box and its content
    const innerBox = document.createElement('div');
    innerBox.classList.add('inner-box');

    const lowerContent = document.createElement('div');
    lowerContent.classList.add('lower-content');

    const postTitle = document.createElement('h4');
    const postTitleLink = document.createElement('a');
    postTitleLink.href = '#'; // Replace with your desired link URL
    postTitle.appendChild(postTitleLink);

    const postText = document.createElement('div');
    postText.classList.add('text');
    postText.textContent = post_content;
    // postText.textContent = dataA.data.content;

    const lowerBox = document.createElement('div');
    lowerBox.classList.add('lower-box', 'clearfix');

    const pullLeftDiv = document.createElement('div');
    pullLeftDiv.classList.add('pull-left');

    const postMetaList = document.createElement('ul');
    postMetaList.classList.add('post-meta');

    const numCommentsItem = document.createElement('li');

    const authorItem = document.createElement('li');
    authorItem.innerHTML = '<span class="icon flaticon-user"></span>' + from;

    const pullRightDiv = document.createElement('div');
    pullRightDiv.classList.add('pull-right');

    const readMoreLink = document.createElement('a');
    readMoreLink.classList.add('read-more');
    readMoreLink.href = readmoreLink + encodeURIComponent(dataA.uuid);
    readMoreLink.innerHTML = '<span class="arrow flaticon-long-arrow-pointing-to-the-right"></span> Read More';
    // Add click event listener to handle form reset
    readMoreLink.addEventListener('click', function () {
        const searchForm = document.getElementById('searchForm');
        searchForm.reset();
    });

    lowerBox.appendChild(pullLeftDiv);
    postMetaList.appendChild(numCommentsItem);
    postMetaList.appendChild(authorItem);
    pullLeftDiv.appendChild(postMetaList);

    // lowerContent.appendChild(postDate);
    lowerContent.appendChild(postTitle);
    lowerContent.appendChild(postText);
    lowerContent.appendChild(lowerBox);
    pullRightDiv.appendChild(readMoreLink);
    lowerBox.appendChild(pullRightDiv);

    // innerBox.appendChild(imageDiv);
    innerBox.appendChild(lowerContent);

    // Append the inner-box div to the container
    container.appendChild(innerBox);
    // }

}

async function renderTable(data, id) {
    $(`#${id}`).DataTable().clear().draw();
    for (let index = 0; index < data.length; index++) {
        const element = data[index];
        const from = element.source;
        var pathLogo = "";

        if (from == 'twitter') {
            pathLogo = '/images/twitter-icons.png';
        } else if (from == 'facebook') {
            pathLogo = '/images/facebook-icons.png';
        } else if (from == 'tiktok') {
            pathLogo = '/images/tiktok-icons.png';
        } else if (from == 'pantip') {
            pathLogo = '/images/blog-icons.png';
        }

        const row = document.createElement('tr');
        const platform = document.createElement('td');
        const platform_img = document.createElement('img');
        platform_img.src = pathLogo;
        platform_img.width = 80;
        // platform_img.className = 'prod-title';
        // platform_img.innerText = from;
        platform.appendChild(platform_img);
        row.appendChild(platform);

        const header = document.createElement('td');
        const header_title = document.createElement('h6');
        header_title.className = 'prod-title';
        header_title.innerText = 'เบอร์โทรศัพท์มิจฉาชีพ'
        header.appendChild(header_title);
        row.appendChild(header);

        const example = document.createElement('td');
        const example_title = document.createElement('h6');
        example_title.className = 'prod-title';
        example_title.innerText = element.text;
        example.appendChild(example_title);
        row.appendChild(example);

        $(`#${id}`).DataTable().row.add(row).draw();

    }
}