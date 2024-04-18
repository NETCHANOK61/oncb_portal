// bar + numbering
function fetech_aws(source, elementID) {
    let element = document.getElementById(elementID);
    let data = {
        // "source": source
        "count_source": source
    }
    fetch('https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/datalake1', {
        method: 'POST', headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(data => {
            let count = data.Count;
            // console.log(data);
            element.textContent = count;
            element.setAttribute('data-stop', count);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
}

// new 04/07/2023
// function fetech_Num() {
//     async function fetchData(source) {
//         try {
//             const url = 'https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/datalake1';
//             const data = {
//                 "source": source
//             };

//             const response = await fetch(url, {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json'
//                 },
//                 body: JSON.stringify(data)
//             });

//             const responseData = await response.json();
//             return responseData;
//         } catch (error) {
//             console.error('Error fetching data:', error);
//             throw error;
//         }
//     }
//     async function fetchDataMultiple() {
//         try {
//             const source1 = "twitter";
//             const source2 = "facebook";
//             const source3 = "tiktok";
//             const source4 = "pantip";

//             const [data1, data2, data3, data4] = await Promise.all([fetchData(source1), fetchData(source2), fetchData(source3), fetchData(source4)]);
//             const data_twitter = data1.Count;
//             const data_facebook = data2.Count;
//             const data_tiktok = data3.Count;
//             const data_webboard = data4.Count;

//             let keyword = {
//                 "twitter-count": data_twitter,
//                 "facebook-count": data_facebook,
//                 "tiktok-count": data_tiktok,
//                 "web-count": data_webboard,
//             }

//             return keyword;

//         } catch (error) {
//             console.error('Error:', error);
//         }
//     }
//     fetchDataMultiple().then((item) => {
//         console.log(item);
//         const data = item;
//         for (const key in data) {
//             const value = data[key];

//             const column = document.createElement("div");
//             column.className = "column counter-column col-lg-3 col-md-6 col-sm-12";

//             const inner = document.createElement("div");
//             inner.className = "inner wow fadeInLeft";
//             inner.setAttribute("data-wow-delay", "0ms");
//             inner.setAttribute("data-wow-duration", "1500ms");

//             const content = document.createElement("div");
//             content.className = "content";

//             const countOuter = document.createElement("div");
//             countOuter.className = "count-outer count-box";
//             countOuter.id = key;

//             const countText = document.createElement("span");
//             countText.className = "count-text";
//             countText.id = key + "-text"; // Add an ID for CountUp.js to target

//             const title = document.createElement("h4");
//             title.className = "counter-title";
//             title.textContent = key.toUpperCase().replace("-", " ");

//             countOuter.appendChild(countText);
//             content.appendChild(countOuter);
//             content.appendChild(title);
//             inner.appendChild(content);
//             column.appendChild(inner);

//             // Assuming there is a container element with the id "counter-container"
//             const container = document.getElementById("numOfdata");
//             container.appendChild(column);

//             // Create a new CountUp instance and start the counting animation
//             // const countUp = new CountUp(countText.id, 0, value, 0, 2.5);
//             // if (!countUp.error) {
//             //   countUp.start();
//             // } else {
//             //   console.error(countUp.error);
//             // }
//         }
//     })

// }

function fetech_source(source) {
    let data = {
        "source": source,
        "datetime_start": "2023-06-15T00:00",
        "datetime_end": "2023-06-18T13:55"
    }
    fetch('https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/datalake1', {
        method: 'POST', headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(data => {
            // console.log(data);
            if (source == 'facebook') {
                renderdDataFacebook(data.Items);
            } else {
                renderData(data.Items);
            }

            // console.log(data.Items);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
}

function fetch_uuid(source, uuid) {
    let data = {
        "source": source,
        "uuid": uuid
    }
    fetch('https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/datalake1', {
        method: 'POST', headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(data => {
            // console.log(data);
            // console.log(data.Items[0].data);
            // dataContainer.innerHTML = JSON.stringify(data.Items[0].data);
            if (source == 'facebook') {
                const jsonString = data.Items[0].data;
                const obj = JSON.parse(jsonString);
                // console.log(data.Items[0], source)
                renderDetail(obj, source);
            }
            else if (source == 'twitter') {
                // console.log(data.Items[0])
                renderDetail(data.Items[0], source);
            }
            else if (source == 'tiktok') {
                renderDetail(data.Items[0], source);
            } else if (source == 'pantip') {
                renderDetail(data.Items[0], source);
            } else if (source == 'google-keyword') {
                renderDetail_google_keyword(data)
            } else {
                renderDetail(data.Items[0], source);
            }
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
}

function renderDetail(data, from) {
    // console.log(data);

    let user_name = "";
    let post_content = "";
    let post_time = "";
    let post_likes = "";
    let post_shares = "";
    let post_comment_num = "";
    let post_comment_all = "";
    let pathLogo = "";
    let postUrl = "-";

    if (from == 'twitter') {
        // console.log(data.data)
        post_content = data.data.content;
        user_name = data.data.user;
        post_time = data.data.datetime;
        post_likes = data.data.view;
        pathLogo = '/images/Twitter-Logo.webp';
        postUrl = data.data.url;
    }
    else if (from == 'facebook') {
        post_content = (data.text).replace(/\s/g, '')
        user_name = data.username;
        post_time = data.time;
        post_likes = data.likes;
        post_shares = data.shares;
        post_comment_num = data.comments;
        post_comment_all = data.comments_full;
        pathLogo = '/images/Facebook-Logo.png';
        postUrl = data.post_url;
    } else if (from == 'tiktok') {
        // console.log(data);
        post_content = (data.data.desc).replace(/\s/g, '');
        user_name = data.data.author;
        post_time = data.datetime;
        pathLogo = '/images/tiktok-Logo.png';
        postUrl = data.url;
    } else if (from == 'pantip') {
        if (data.data.postcontent == '') {
            post_content = data.head
            // console.log(post_content)
        } else {
            post_content = (data.data.postcontent).replace(/\s/g, '');
        }
        user_name = data.data.userid;
        post_time = data.datetime;
        pathLogo = '/images/pantip-Logo.png';
        postUrl = data.data.url;
    } else {
        post_content = "'" + data.head + "'";
        user_name = data.order;
        post_time = data.datetime;
        pathLogo = '/images/google-trends.jpg';
    }

    const dateObj = new Date(post_time);

    const options = { day: "numeric", month: "short", year: "numeric" };
    const formattedDate = dateObj.toLocaleDateString("th-TH", options);

    var dataScore = {};

    if (data.hasOwnProperty('dataScore')) {
        dataScore = data.dataScore;
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

    const img = document.getElementById('image-post');
    img.style.width = '90%';
    img.style.height = '40%';
    const imgTest = new Image();

    if (data.hasOwnProperty('image_lowquality') == false) {
        if (from == "twitter") {
            if (data.data.media) {
                img.src = data.data.media[0];
            } else {
                img.src = pathLogo;
            }
        } else {
            img.src = pathLogo;
        }
    }
    else if (data.image_lowquality == "None") {
        img.src = pathLogo;
    } else {
        img.src = data.image_lowquality;
    }

    img.onerror = function () {
        // Update the image source to a fallback static image
        img.src = pathLogo;
    };

    const content = document.getElementById('post-content');
    content.textContent = post_content;

    const username = document.getElementById('username');
    // username.textContent = data.username;
    username.textContent = user_name;

    const date = document.getElementById('date-post');
    // date.textContent = data.time;
    date.textContent = formattedDate;

    const source = document.getElementById('source-post');
    source.textContent = from;

    const refer = document.getElementById('refer');
    var anchorElement = document.createElement("a");
    anchorElement.href = postUrl;
    anchorElement.target = "_blank";
    anchorElement.textContent = postUrl;
    refer.appendChild(anchorElement);

    var images = ['../images/1.png', '../images/2.png', '../images/3.png', '../images/4.png', '../images/5.png'];
    var score = ['a', 'b', 'c', 'd', 'e'];

    var readMoreLink = document.createElement('div');
    // Loop through the images array and create image elements
    images.forEach(function (imageSrc, index) {
        var img = document.createElement('img');
        img.src = imageSrc;
        img.width = 40;
        img.height = 40;
        img.onclick = function () {
            // Call your new function here
            sendScore(data, score[index]);
            sumValue += 1;
            document.getElementById('opinion_total').innerText = sumValue;
        };
        var space = document.createTextNode(' ');

        readMoreLink.appendChild(img);
        readMoreLink.appendChild(space);
    });
    document.getElementById('opinion').appendChild(readMoreLink);

    document.getElementById('opinion_total').innerText = sumValue;

    if (from != 'pantip' && from != 'google' && from != 'tiktok') {
        const like = document.getElementById('like-post');
        // like.textContent = data.likes;
        like.textContent = post_likes;
        var container = document.getElementById('comment-post');
        container.style.height = '110px';
        container.style.overflow = 'auto';
    }

    if (from == 'facebook') {
        const shared = document.getElementById('shares-post');
        shared.textContent = post_shares;

        const comment = document.getElementById('comment-num');
        comment.textContent = post_comment_num;

        // var originalString = post_comment_all;

        // originalString = originalString.replace(/None/g, '"None"');

        // console.log(originalString);

        // var modifiedString = originalString.replace(/'/g, "\"");

        // var formattedJsonString = modifiedString.replace(/datetime.datetime\((\d{4}), (\d{1,2}), (\d{1,2}), (\d{1,2}), (\d{1,2})\)/g, '"datetime.datetime($1, $2, $3, $4, $5)"');

        // const comments = JSON.parse(formattedJsonString);

        post_comment_all.forEach(function (comment) {
            var commentContainer = document.createElement('div');
            commentContainer.classList.add('comment-container');

            var usr = document.createElement('p');
            var txt = document.createElement('p');

            let comment_before = comment.comment_text;
            const formattedWord = comment_before.replace(/\s/g, '');

            txt.style.color = '#000';
            usr.style.color = '#C2B51FFF';
            usr.textContent = comment.commenter_name + ': ';
            txt.textContent = formattedWord;

            commentContainer.appendChild(usr);
            commentContainer.appendChild(txt);
            container.appendChild(commentContainer);
        });
    }
}

function renderDetail_google_keyword(data) {
    // console.log(data);
    var h = data.Items[0].head;
    var all = data.Items[0].data[h];
    const img = document.getElementById('image-post');
    img.style.width = '50%';
    img.style.height = '40%';
    img.src = '/images/g.png';

    const content = document.getElementById('post-content');
    content.textContent = "'" + h + "'";

    const parentElement = document.getElementById('main-list');

    // const refer = document.getElementById('refer');
    if (all) {
        for (const [key, value] of Object.entries(all)) {
            const listItem = document.createElement('h6');
            var date = key.split(' ');

            listItem.textContent = date[0] + ': [' + value + '], ';

            parentElement.appendChild(listItem);
        }
    }

    // Apply CSS styles for inline display
    parentElement.style.display = 'flex';
    parentElement.style.flexWrap = 'wrap';
    parentElement.style.alignItems = 'center';
    parentElement.style.gap = '10px';

    // Apply CSS styles for <h4> elements
    const listItems = parentElement.getElementsByTagName('h4');
    for (let i = 0; i < listItems.length; i++) {
        listItems[i].style.display = 'inline';
    }

    var dataScore = {};

    if (data.Items[0].hasOwnProperty('dataScore')) {
        dataScore = data.Items[0].dataScore;
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

    var images = ['../images/1.png', '../images/2.png', '../images/3.png', '../images/4.png', '../images/5.png'];
    var score = ['a', 'b', 'c', 'd', 'e'];

    var readMoreLink = document.createElement('div');
    // Loop through the images array and create image elements
    images.forEach(function (imageSrc, index) {
        var img = document.createElement('img');
        img.src = imageSrc;
        img.width = 40;
        img.height = 40;
        img.onclick = function () {
            // Call your new function here
            sendScore(data.Items[0], score[index]);
            sumValue += 1;
            document.getElementById('opinion_total').innerText = sumValue;
        };
        var space = document.createTextNode(' ');

        readMoreLink.appendChild(img);
        readMoreLink.appendChild(space);
    });
    document.getElementById('opinion').appendChild(readMoreLink);

    document.getElementById('opinion_total').innerText = sumValue;

    const dateObj = new Date(data.Items[0].datetime);
    const options = { day: "numeric", month: "short", year: "numeric" };

    const formattedDate = dateObj.toLocaleDateString("th-TH", options);
    document.getElementById('fetch_date').innerText = formattedDate;

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
    } else if (score == "b") {
        dataScore.b += 1
    } else if (score == "c") {
        dataScore.c += 1
    } else if (score == "d") {
        dataScore.d += 1
    } else if (score == "e") {
        dataScore.e += 1
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


function renderData(data) {
    const testimonialContainer = document.getElementById('testimonial-container');

    // Render new elements using a loop
    for (let item of data) {
        // console.log(item);
        const testimonialBlock = document.createElement('div');

        const innerBox = document.createElement('div');
        innerBox.classList.add('inner-box');

        innerBox.style.padding = '20px';
        innerBox.style.border = '1px solid #ccc';
        innerBox.style.height = '200px';

        const upperBox = document.createElement('div');

        const h4 = document.createElement('h4');
        h4.textContent = item.data.user;

        const dateTxt = document.createElement('div');
        dateTxt.textContent = item.data.datetime;

        const text = document.createElement('div');
        text.classList.add('text');
        text.style.overflowWrap = 'break-word';

        const view_txt = document.createElement('div');
        view_txt.classList.add('text');
        view_txt.textContent = 'จำนวนผู้เข้าถึง: ' + item.data.view + ' views';

        upperBox.appendChild(h4);
        upperBox.appendChild(dateTxt);

        innerBox.appendChild(upperBox);
        innerBox.appendChild(view_txt);

        const maxCharacters = 105; // Adjust the maximum character count as needed

        if (item.data.content.length > maxCharacters) {
            const truncatedText = item.data.content.substring(0, maxCharacters) + '...';
            text.textContent = truncatedText;

            const readMoreLink = document.createElement('a');
            readMoreLink.textContent = 'อ่านเพิ่มเติม';
            readMoreLink.style.color = 'blue';
            readMoreLink.style.cursor = 'pointer';

            const readLessLink = document.createElement('a');
            readLessLink.textContent = 'น้อยลง';
            readLessLink.style.color = 'blue';
            readLessLink.style.display = 'none';

            readMoreLink.addEventListener('click', function () {
                text.textContent = item.data.content;
                readMoreLink.style.display = 'none';
                readLessLink.style.display = 'inline';
            });

            readLessLink.addEventListener('click', function () {
                text.textContent = truncatedText;
                readLessLink.style.display = 'none';
                readMoreLink.style.display = 'inline';
            });

            innerBox.appendChild(text);
            innerBox.appendChild(readMoreLink);
            innerBox.appendChild(readLessLink);
        } else {
            text.textContent = item.data.content;
            innerBox.appendChild(text);
        }

        testimonialBlock.appendChild(innerBox);

        testimonialContainer.appendChild(testimonialBlock);
    }
}

function renderdDataFacebook(data) {

    const testimonialContainer = document.getElementById('testimonial-container');

    // Render new elements using a loop
    for (let item of data) {
        // console.log(item);
        const testimonialBlock = document.createElement('div');

        const innerBox = document.createElement('div');
        innerBox.classList.add('inner-box');

        innerBox.style.padding = '20px';
        innerBox.style.border = '1px solid #ccc';
        innerBox.style.height = '200px'

        const upperBox = document.createElement('div');

        const h4 = document.createElement('h4');
        h4.textContent = item.data.username;

        const dateTxt = document.createElement('div');
        dateTxt.textContent = item.datetime;

        const text = document.createElement('div');
        text.classList.add('text');
        text.style.overflowWrap = 'break-word';

        const view_txt = document.createElement('div');
        view_txt.classList.add('text');
        view_txt.textContent = 'จำนวนถูกใจ: ' + item.data.likes;

        upperBox.appendChild(h4);
        upperBox.appendChild(dateTxt);

        innerBox.appendChild(upperBox);
        innerBox.appendChild(view_txt);

        const maxCharacters = 105;
        if (item.data.text.length > maxCharacters) {
            const truncatedText = item.data.text.substring(0, maxCharacters) + '...';
            text.textContent = truncatedText;

            innerBox.appendChild(text);
        } else {
            text.textContent = item.data.text;
            innerBox.appendChild(text);
        }

        const anchorElement = document.createElement('a');
        const detailsUrl = 'facebook-detail.html?uuid=' + encodeURIComponent(item.uuid); // Add the data you want to pass as query parameters
        anchorElement.href = detailsUrl;
        anchorElement.style.color = '#141d38';
        // Add hover color
        innerBox.addEventListener('mouseenter', () => {
            innerBox.style.backgroundColor = '#141d38';
            anchorElement.style.color = '#fff';
        });

        innerBox.addEventListener('mouseleave', () => {
            innerBox.style.backgroundColor = '#fff'; // Revert text color back to black
            anchorElement.style.color = '#141d38';
        });

        anchorElement.appendChild(innerBox);

        testimonialBlock.appendChild(anchorElement);

        testimonialContainer.appendChild(testimonialBlock);
    }

}

function fetch_google(page) {
    const today = new Date();
    const currentDate = new Date();
    currentDate.setDate(currentDate.getDate() - 5);
    const year = currentDate.getFullYear();
    const month = String(currentDate.getMonth() + 1).padStart(2, '0');
    const day = String(currentDate.getDate()).padStart(2, '0');

    const startDateTime = `${year}-${month}-${day}T00:00:00`;

    data = {
        "source": "google",
        "datetime_start": startDateTime,
        "datetime_end": today.toISOString()
    }


    fetch('https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/datalake1', {
        method: 'POST', headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(data => {
            // console.log(data);
            const data_a = data.Items
            data_a.sort((a, b) => a.order - b.order);
            if (page == 'detail') {
                renderData_google_trends(data_a)
            } else {
                const slicedData = data_a.slice(0, 5);
                renderData_google(slicedData);
            }
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });

}

function renderData_google(data) {

    let total = 0;
    let sum_list = [];
    for (let index = 0; index < data.length; index++) {
        const element = data[index].data.value;
        // console.log(element);
        let sum = 0;
        for (let key in element) {
            if (element.hasOwnProperty(key)) {
                sum += element[key];
            }
        }
        sum_list.push(sum);
        total += sum;
    }

    data.forEach((item, index) => {
        let a = 'word-' + index;
        const word = document.getElementById(a);
        word.textContent = item.head;

        let b = Math.round((sum_list[index] / total) * 100);

        const num_location = 'numpercent-' + index;
        // console.log(b);
        const ele = document.getElementById(num_location);
        ele.setAttribute('data-stop', b);

        const bar_location = 'bar-' + index;
        const bar = document.getElementById(bar_location);
        bar.setAttribute('data-width', b);
    })
}

function renderData_google_trends(data) {
    // console.log(data)
    if (data.length === 0) {
        var container = document.getElementById('trends-list');
        const txt = document.createElement('h4');
        txt.textContent = 'ไม่พบข้อมูล';
        container.appendChild(txt);
    } else {
        // console.log(data)
        var container = document.getElementById('trends-list'); // Replace 'trends-list' with the ID of the <ul> element.
        var dateString = data[0].datetime;
        var date = new Date(dateString);
        var options = { day: "numeric", month: "long", year: "numeric" };
        var formattedDate = date.toLocaleString("th-TH", options);

        // var date_title = document.getElementById('date');
        // date_title.textContent = formattedDate;

        data.forEach(function (item) {

            var li = document.createElement('li');
            li.classList.add('accordion', 'block');

            var divBtn = document.createElement('div');
            divBtn.classList.add('acc-btn');
            divBtn.textContent = "หัวข้อ: " + item.head;

            var icon = document.createElement('div');
            icon.classList.add('icon', 'fa', 'fa-angle-right');

            divBtn.onclick = function () {
                divInnerContent.style.display = divInnerContent.style.display == 'none' ? 'block' : 'none';
            };

            divBtn.appendChild(icon);

            var divContent = document.createElement('div');
            divContent.classList.add('acc-content');

            var divInnerContent = document.createElement('div');
            divInnerContent.classList.add('content');

            var title = document.createElement('h5');
            title.textContent = 'คำค้นหาที่ใช้ค้นหามากที่สุด - เปอร์เซ็นที่จะพบเจอคำเหล่านี้ในการค้นหา';
            divInnerContent.appendChild(title);

            let sum = 0;
            let obj = item.data.value;
            for (let key in obj) {
                if (obj.hasOwnProperty(key)) {
                    sum += obj[key];
                }
            }
            // console.log(sum);

            var word = document.createElement('div');
            for (var i = 0; i < Object.keys(item.data.query).length; i++) {
                var div = document.createElement('div');
                var a = (item.data.value[i] / sum) * 100;
                div.textContent = item.data.query[i] + ' - ' + a.toFixed(2) + '%';
                if (i <= 2) {
                    div.classList.add('highlight');
                }
                divInnerContent.appendChild(div);
            }

            divInnerContent.appendChild(word);
            divContent.appendChild(divInnerContent);
            li.appendChild(divBtn);
            li.appendChild(divContent);
            container.appendChild(li);

        });
    }
}

function fetech_content(content) {

    let data = {
        "key_map": content
    }
    fetch('https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/datalake1', {
        method: 'POST', headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(data => {
            renderBox(data)
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
}

function renderBox(data) {
    // console.log(data.Items);
    const all = data.Items;

    const itemsPerPage = 12;
    let currentPage = 1;

    // Function to display items for the current page
    function displayItems() {
        const container = document.getElementById('shop');
        container.innerHTML = '';

        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const itemsToShow = all.slice(startIndex, endIndex);

        for (const item of itemsToShow) {
            const itemElement = document.createElement('div');
            itemElement.classList.add('single-product-item', 'col-lg-4', 'col-md-6', 'col-sm-12', 'text-center');

            const imgHolder = document.createElement('div');
            imgHolder.classList.add('img-holder');
            const image = document.createElement('p');
            image.style.height = '300px';
            image.textContent = item.data.content;
            imgHolder.appendChild(image);
            itemElement.appendChild(imgHolder);

            const titleHolder = document.createElement('div');
            titleHolder.classList.add('title-holder', 'text-center');
            const staticContent = document.createElement('div');
            staticContent.classList.add('static-content');
            const title = document.createElement('h3');
            title.classList.add('title', 'text-center');
            const titleLink = document.createElement('a');
            titleLink.href = 'shop-single.html';
            titleLink.textContent = `หัวข้อ: ${item.head}`;
            title.appendChild(titleLink);
            staticContent.appendChild(title);
            const price = document.createElement('span');
            price.classList.add('price');
            const amount = document.createElement('span');
            amount.classList.add('amount');
            amount.textContent = `จำนวนการเข้าถึง: ${item.data.view}`;
            price.appendChild(amount);
            staticContent.appendChild(price);
            titleHolder.appendChild(staticContent);

            const overlayContent = document.createElement('div');
            overlayContent.classList.add('overlay-content');
            const ulList = document.createElement('ul');
            ulList.classList.add('clearfix');

            const items = [
                { imageSrc: '../images/2.png', tooltipText: 'พอใจมาก' },
                { imageSrc: '../images/3.png', tooltipText: 'ปานกลาง' },
                { imageSrc: '../images/4.png', tooltipText: 'ไม่พอใจ' }
            ];

            items.forEach(item => {
                const li = document.createElement('li');
                const liLink = document.createElement('a');
                liLink.href = 'shop-single.html';
                const liSpan = document.createElement('span');
                const liImg = document.createElement('img');
                liImg.src = item.imageSrc;
                liImg.width = 270;
                liImg.height = 300;
                liSpan.appendChild(liImg);
                liLink.appendChild(liSpan);
                const liTooltip = document.createElement('div');
                liTooltip.classList.add('toltip-content');
                liTooltip.textContent = item.tooltipText;
                liLink.appendChild(liTooltip);
                li.appendChild(liLink);
                ulList.appendChild(li);
            });

            overlayContent.appendChild(ulList);
            titleHolder.appendChild(overlayContent);
            itemElement.appendChild(titleHolder);

            container.appendChild(itemElement);
        }
    }

    // Function to generate page navigation
    function generatePagination() {
        const pagination = document.getElementById('pagination');
        const ulList = document.getElementById('ul-list');
        ulList.innerHTML = '';

        const totalPages = Math.ceil(all.length / itemsPerPage);

        // Add previous page link
        const prevLi = document.createElement('li');
        prevLi.classList.add('prev');
        const prevLink = document.createElement('a');
        prevLink.href = '#';
        prevLink.innerHTML = '<span class="fa fa-angle-left"></span>';
        prevLi.appendChild(prevLink);
        ulList.appendChild(prevLi);

        // Handle click on previous page link
        prevLink.addEventListener('click', function () {
            if (currentPage > 1) {
                currentPage--;
                displayItems();
                generatePagination();
            }
        });

        for (let page = 1; page <= totalPages; page++) {
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

        // Add next page link
        const nextLi = document.createElement('li');
        nextLi.classList.add('next');
        const nextLink = document.createElement('a');
        nextLink.href = '#';
        nextLink.innerHTML = '<span class="fa fa-angle-right"></span>';
        nextLi.appendChild(nextLink);
        ulList.appendChild(nextLi);

        // Handle click on next page link
        nextLink.addEventListener('click', function () {
            if (currentPage < totalPages) {
                currentPage++;
                displayItems();
                generatePagination();
            }
        });

        pagination.appendChild(ulList);
    }


    // Initial display
    displayItems();
    generatePagination();

    // for (let i = 0; i < all.length; i++) {
    //     const item = all[i];

    //     const productItemDiv = document.createElement('div');
    //     productItemDiv.className = 'single-product-item col-lg-4 col-md-6 col-sm-12 text-center';

    //     const titleHolderDiv = document.createElement('div');
    //     titleHolderDiv.className = 'title-holder text-center';

    //     const staticContentDiv = document.createElement('div');
    //     staticContentDiv.className = 'static-content';

    //     const title = document.createElement('h3');
    //     const titleLink = document.createElement('a');
    //     titleLink.textContent = "หัวข้อ: " + item.head;

    //     title.appendChild(titleLink);
    //     staticContentDiv.appendChild(title);

    //     const priceSpan = document.createElement('span');
    //     priceSpan.className = 'price';
    //     const amountSpan = document.createElement('span');
    //     amountSpan.className = 'amount';
    //     amountSpan.textContent = item.data.content;

    //     priceSpan.appendChild(amountSpan);
    //     staticContentDiv.appendChild(priceSpan);

    //     titleHolderDiv.appendChild(staticContentDiv);

    //     productItemDiv.appendChild(titleHolderDiv); // กล่องขาวเล็ก

    //     container.append(productItemDiv);

    //     // const overlayContentDiv = document.createElement('div');
    //     // overlayContentDiv.className = 'overlay-content';

    //     // const ul = document.createElement('ul');
    //     // ul.className = 'clearfix';

    //     // overlayContentDiv.appendChild(ul);

    //     // titleHolderDiv.appendChild(staticContentDiv);
    //     // titleHolderDiv.appendChild(overlayContentDiv);

    //     // container.appendChild(productItemDiv);
    // }
}
