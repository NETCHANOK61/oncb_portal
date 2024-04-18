function fetch_head() {
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
                    fetch_all_data(`${txt}`, 'key');
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

function fetch_all_data(content, check, source) {
    console.log(content.s)
    const currentDate = new Date();
    currentDate.setDate(currentDate.getDate() - 3);
    const year = currentDate.getFullYear();
    const month = String(currentDate.getMonth() + 1).padStart(2, '0');
    const day = String(currentDate.getDate()).padStart(2, '0');

    document.getElementById('loading').style.display = 'block';

    let data = {};
    if (content == 'all' && check == 'context') {
        data.last = 1000
    } else if (typeof content == 'object' && check == 'date') {
        if (check == 'date') {
            data.datetime_start = content.s
            data.datetime_end = content.e
            data.last = 50
        } else if (check == 'context' && source) {
            data.datetime_start = content.s
            data.datetime_end = content.e
            data.source = source
            data.last = 50
        }
    } else if (typeof content == 'object' && check == 'context') {
        if (source) {
            data.source = source
            if (source == 'facebook' || source == 'twitter') {
                data.last = 100
            }
        }
        data.datetime_start = content.s
        data.datetime_end = content.e
        data.last = 50
    } else if (check == 'context') {
        data.data = content
        // data.source = 'facebook'
    } else if (check == 'key') {
        data.data = content
        // "key_map": "โกง,ระวัง",
    }
    // if (typeof content == 'object') {
    //     data.datetime_start = content.s
    //     data.datetime_end = content.e
    // } else if (check == 'context') {
    //     data.data = content
    // } else if (content == 'all') {
    //     data.datetime_start = startDateTime
    //     data.datetime_end = endDateTime
    // }
    // if (check == 'export') {
    //     data.last = 1000
    // }
    console.log(data)
    fetch('https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/datalake1', {
        method: 'POST', headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(res => {
            renderBox(res);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        }).finally(() => {
            // Hide the loading progress when the fetch is complete
            document.getElementById('loading').style.display = 'none';
        });
}
function renderBox(data) {
    // console.log(data)

    const all = data.Items;
    // sort 
    // const sortedData = Array.from(all).sort((a, b) => {
    //     const dateA = new Date(a.datetime);
    //     const dateB = new Date(b.datetime);
    //     return dateB - dateA;
    // });

    // console.log(sortedData_like);

    const itemsPerPage = 12;
    let currentPage = 1;

    // Function to display items for the current page
    function displayItems() {
        const container = document.getElementById('shop');
        container.innerHTML = '';

        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const itemsToShow = all.slice(startIndex, endIndex);
        // sort 
        const sortedData = Array.from(itemsToShow).sort((a, b) => {
            const dateA = new Date(a.datetime);
            const dateB = new Date(b.datetime);
            return dateB - dateA;
        });

        // console.log(sortedData);
        for (const item of sortedData) {
            const resource = item.source;
            let pathImgIcons = '../images/resource/products/2.jpg';
            let topic = "";
            let post_txt = "";
            let view = 0;
            let link = "";

            if (resource == 'facebook') {
                // console.log(item)
                const jsonObject = JSON.parse(item.data);
                topic = item.head;
                post_txt = jsonObject.post_text;
                view = "ถูกใจ: " + jsonObject.likes;
                pathImgIcons = '../images/facebook-icons.png';
                link = "facebook-detail.html?uuid=";
            } else if (resource == 'twitter') {
                topic = item.head;
                post_txt = item.data.post_text;
                if (item.data.view == "None") {
                    view = "จำนวนการเข้าถึง: 0";
                } else {
                    view = "จำนวนการเข้าถึง: " + item.data.view;
                }
                pathImgIcons = '../images/twitter-icons.png';
                link = "twitter-detail.html?uuid=";
            } else if (resource == 'tiktok') {
                topic = item.head;
                const status = item.data.stats;
                const status_formated = status.replace(/'/g, '"');
                const obj = JSON.parse(status_formated);
                view = "จำนวนการเล่น: " + obj.diggCount + " ครั้ง";
                pathImgIcons = '../images/tiktok-icons.png'
                link = "tiktok-detail.html?uuid=";
            } else if (resource == 'pantip') {
                var date = new Date(item.datetime);
                var options = { day: "numeric", month: "long", year: "numeric" };
                var formattedDate = date.toLocaleString("th-TH", options);

                topic = item.head;
                if (topic.length > 30) {
                    topic = topic.slice(0, 12) + "...";
                }
                view = "วันที่โพสต์: " + formattedDate;
                pathImgIcons = '../images/blog-icons.png'
                link = "pantip-detail.html?uuid=";
            } else if (resource == 'google') {
                topic = item.head;
                var d = item.datetime;
                var splitDate = d.split("T");
                var datePart = splitDate[0];
                var oreders = parseInt(item.order) + 1;
                view = "วันที่: " + datePart + " (#" + oreders + ")";
                pathImgIcons = '../images/google-icons.png'
                link = "trends-detail.html?uuid=";
            } else {
                topic = item.head;
                const date = new Date(item.datetime);
                const options = {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric',
                    hour: 'numeric',
                    minute: 'numeric',
                };
                const formattedDate = date.toLocaleString('th-TH', options);
                view = formattedDate;
                pathImgIcons = '../images/g.png'
                link = "google-keyword.html?uuid=";
            }

            var dataScore = {};

            if (item.hasOwnProperty('dataScore')) {
                dataScore = item.dataScore;
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

            const itemElement = document.createElement('div');
            itemElement.classList.add('single-product-item', 'col-lg-4', 'col-md-6', 'col-sm-12', 'text-center');
            const imgHolder = document.createElement('div');
            imgHolder.classList.add('img-holder');
            const content_post = document.createElement('img');
            // content_post.style.height = '300px';
            // content_post.style.width = '270px';

            // ข้อความโพสต์
            // content_post.textContent = post_txt;
            // content_post.src = '../images/facebook-icons.png';
            content_post.src = pathImgIcons;

            imgHolder.appendChild(content_post);
            itemElement.appendChild(imgHolder);

            const titleHolder = document.createElement('div');
            titleHolder.classList.add('title-holder', 'text-center');
            const staticContent = document.createElement('div');
            staticContent.classList.add('static-content');
            const title = document.createElement('h3');
            title.classList.add('title', 'text-center');
            const titleLink = document.createElement('a');
            // titleLink.href = 'shop-single.html';

            // หัวข้อ
            titleLink.textContent = `Keyword: ${topic}`;
            title.appendChild(titleLink);
            staticContent.appendChild(title);
            const price = document.createElement('span');
            price.classList.add('price');
            const amount = document.createElement('span');
            amount.classList.add('amount');

            // ยอดวิว/ไลค์
            amount.textContent = `${view}`;
            price.appendChild(amount);
            staticContent.appendChild(price);
            titleHolder.appendChild(staticContent);

            const overlayContent = document.createElement('div');
            overlayContent.classList.add('overlay-content');
            const ulList = document.createElement('ul');
            ulList.classList.add('clearfix');
            // const li1 = document.createElement('li');
            const readmore = document.createElement('a');
            readmore.innerHTML = '<h4>ดูรายละเอียด</h4>';
            readmore.href = link + encodeURIComponent(item.uuid);
            overlayContent.addEventListener('click', function () {
                window.location.href = link + encodeURIComponent(item.uuid);
                localStorage.setItem('number', JSON.stringify(numberValue));
                // console.log("jeiwdov");
            });

            // li1.appendChild(readmore);
            ulList.appendChild(readmore);

            overlayContent.appendChild(ulList);
            // overlayContent.appendChild(ulList);
            titleHolder.appendChild(overlayContent);
            itemElement.appendChild(titleHolder);

            container.appendChild(itemElement);

            // const li1 = document.createElement('li');
            // const li1Link = document.createElement('a');
            // const li1Span = document.createElement('span');
            // const li1Img = document.createElement('img');

            // image พอใจมาก
            // li1Img.src = '../images/2.png';
            // li1Img.width = 270;
            // li1Img.height = 200;
            // li1Span.appendChild(li1Img);
            // li1Link.appendChild(li1Span);
            // const li1Tooltip = document.createElement('div');
            // li1Tooltip.classList.add('toltip-content');
            // li1Tooltip.textContent = 'พอใจมาก';
            // li1Link.appendChild(li1Tooltip);
            // li1.appendChild(li1Link);
            // ulList.appendChild(li1);
            // li1Img.onclick = function () {
            //     sendScore(item, 'a');
            // };

            // const li2 = document.createElement('li');
            // const li2Link = document.createElement('a');
            // const li2Span = document.createElement('span');
            // const li2Img = document.createElement('img');

            // image ปานกลาง
            // li2Img.src = '../images/3.png';
            // li2Img.width = 270;
            // li2Img.height = 200;
            // li2Span.appendChild(li2Img);
            // li2Link.appendChild(li2Span);
            // const li2Tooltip = document.createElement('div');
            // li2Tooltip.classList.add('toltip-content');
            // li2Tooltip.textContent = 'ปานกลาง';
            // li2Link.appendChild(li2Tooltip);
            // li2.appendChild(li2Link);
            // ulList.appendChild(li2);
            // li2Img.onclick = function () {
            //     sendScore(item, 'c');
            // };

            // image ไม่พอใจ
            // const li3 = document.createElement('li');
            // const li3Link = document.createElement('a');
            // const li3Span = document.createElement('span');
            // const li3Img = document.createElement('img');
            // li3Img.src = '../images/4.png';
            // li3Img.width = 270;
            // li3Img.height = 200;
            // li3Span.appendChild(li3Img);
            // li3Link.appendChild(li3Span);
            // const li3Tooltip = document.createElement('div');
            // li3Tooltip.classList.add('toltip-content');
            // li3Tooltip.textContent = 'ไม่พอใจ';
            // li3Link.appendChild(li3Tooltip);
            // li3.appendChild(li3Link);
            // ulList.appendChild(li3);
            // li3Img.onclick = function () {
            //     sendScore(item, 'd');
            // };

            // li1.classList.add('list-item');
            // li2.classList.add('list-item');
            // li3.classList.add('list-item');
        }
    }

    // Function to generate page navigation
    function generatePagination() {
        const pagination = document.getElementById('pagination');
        const ulList = document.getElementById('ul-list');
        ulList.innerHTML = '';

        const totalPages = Math.ceil(all.length / itemsPerPage);
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = Math.min(startIndex + itemsPerPage, all.length);

        const startPage = Math.max(currentPage - 5, 1);
        const endPage = Math.min(startPage + 9, totalPages);

        const prevLi = document.createElement('li');
        prevLi.classList.add('prev');
        const prevLink = document.createElement('a');
        prevLink.href = '#';
        prevLink.innerHTML = '<span class="fa fa-angle-left"></span>';
        prevLi.appendChild(prevLink);
        ulList.appendChild(prevLi);

        prevLink.addEventListener('click', function () {
            if (currentPage > 1) {
                currentPage--;
                displayItems();
                generatePagination();
            }
        });

        for (let page = startPage; page <= endPage; page++) {
            const pageLi = document.createElement('li');
            const pageLink = document.createElement('a');
            pageLink.href = '#';
            pageLink.textContent = page;

            if (page === currentPage) {
                pageLi.classList.add('active');
            }

            pageLink.addEventListener('click', function () {
                currentPage = page;
                displayItems();
                generatePagination();
            });

            pageLi.appendChild(pageLink);
            ulList.appendChild(pageLi);
        }

        const nextLi = document.createElement('li');
        nextLi.classList.add('next');
        const nextLink = document.createElement('a');
        nextLink.href = '#';
        nextLink.innerHTML = '<span class="fa fa-angle-right"></span>';
        nextLi.appendChild(nextLink);
        ulList.appendChild(nextLi);

        nextLink.addEventListener('click', function () {
            if (currentPage < totalPages) {
                currentPage++;
                displayItems();
                generatePagination();
            }
        });

        pagination.appendChild(ulList);
    }


    if (Object.keys(data.Items).length !== 0) {
        displayItems();
        generatePagination();
    } else {
        const container = document.getElementById('shop');
        container.innerHTML = '';
        const ulList = document.getElementById('ul-list');
        ulList.innerHTML = '';

        const txt = document.createElement('h4');

        txt.textContent = 'ไม่พบข้อมูล';

        container.appendChild(txt);
    }

}

function sendScore(dataItem, score) {
    let dataScore = {};
    if (dataItem.hasOwnProperty('dataScore')) {
        dataScore = dataItem.dataScore;
    } else {
        dataScore = {
            "a": 0,
            "b": 0,
            "c": 0,
            "d": 0,
            "e": 0
        }
    }
    if (score == "a") {
        dataScore.a += 1
    } else if (score == "c") {
        dataScore.c += 1
    } else if (score == "d") {
        dataScore.d += 1
    }
    let data = {
        ...dataItem,
        "dataScore": dataScore
    }
    fetch('https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/datalake1', {
        method: 'PUT', headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(() => {
            Swal.fire('บันทึกข้อมูลสำเร็จ', 'ขอบคุณที่ร่วมแสดงความคิดเห็น', 'success');
        })
        .catch(error => {
            Swal.fire('เกิดข้อผิดพลาด', 'ไม่สามารถแสดงความคิดเห็นต่อข้อมูลนี้ได้', 'error');
            // console.error('Error fetching data:', error);
        })
}
