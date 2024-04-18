function scrollToDiv(divId, source, at) {
    var element = document.getElementById(divId);
    element.scrollIntoView({ behavior: 'smooth' });
    fetch_top_rank(source, at);
    var resultDiv = document.getElementById('resultDiv');
    resultDiv.innerHTML = '';
}

function fetch_top_rank(source, at) {
    document.getElementById('loading').style.display = 'block';
    var resultDiv = document.getElementById('resultDiv');
    resultDiv.innerHTML = '';

    // console.log(endDateTime);

    var path = "datalake1";
    var data = {
        "source": source,
        "last": 6
        // "datetime_start": startDateTime,
        // "datetime_end": endDateTime
    }

    if (at == 'socialtreat') {
        path = 'result1';
        if (source == 'facebook') {
            data = { "result_id": 90011 }
        } else if (source == 'twitter') {
            data = { "result_id": 90012 }
        } else if (source == 'pantip') {
            data = { "result_id": 90013 }
        } else if (source == 'tiktok') {
            data = { "result_id": 90014 }
        }
    }
    // console.log(data);

    fetch('https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/' + path, {
        method: 'POST', headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(data => {
            // console.log(data)
            if (at == 'socialtreat') {
                render_word_top(data.Items[0]);
            } else {
                var data_all = data.Items;
                render_top_rank(data_all);
            }
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        }).finally(() => {
            // Hide the loading progress when the fetch is complete
            document.getElementById('loading').style.display = 'none';
        });

}

function render_top_rank(data) {
    var data_a = data;
    var resultDiv = document.getElementById('resultDiv');

    // Loop through the data array
    data_a.forEach(function (item, index) {
        const source = item.source;
        var content = "";
        let link = "";
        if (source == 'twitter') {
            content = item.data.content;
            link = "twitter-detail.html?uuid=";
        } else if (source == 'facebook') {
            const jsonObject = JSON.parse(item.data);
            // console.log(jsonObject)
            content = jsonObject.text;
            link = "facebook-detail.html?uuid=";
        } else if (source == 'tiktok') {
            content = item.data.desc;
            link = "tiktok-detail.html?uuid=";
        } else if (source == 'pantip') {
            content = item.data.postcontent;
            link = "pantip-detail.html?uuid=";
        }

        // Create the elements dynamically
        var divBlock = document.createElement('div');
        divBlock.className = 'process-block col-lg-4 col-md-6 col-sm-12';

        var innerBox = document.createElement('div');
        innerBox.className = 'inner-box wow fadeInUp';
        innerBox.style.height = '400px';
        innerBox.setAttribute('data-wow-delay', '0ms');
        innerBox.setAttribute('data-wow-duration', '1500ms');

        var numberBox = document.createElement('div');
        numberBox.className = 'number-box';
        numberBox.textContent = index + 1;

        var titleLink = document.createElement('h4');
        var titleAnchor = document.createElement('a');
        titleAnchor.href = link + item.uuid;
        titleAnchor.textContent = item.source + ": " + item.head;
        titleLink.appendChild(titleAnchor);

        var description = document.createElement('div');
        description.className = 'text';
        description.textContent = content.slice(0, 150) + '...';

        var readmore = document.createElement('a');
        readmore.href = link + item.uuid;
        readmore.textContent = 'อ่านต่อ'
        description.appendChild(readmore);

        var readMoreLink = document.createElement('a');
        readMoreLink.className = 'read-more';

        var txt = document.createElement('span');
        txt.innerHTML = 'ให้คะแนนความพึงพอใจ ';

        var arrowSpan = document.createElement('span');
        arrowSpan.className = 'arrow flaticon-long-arrow-pointing-to-the-right';

        readMoreLink.appendChild(arrowSpan);

        var images = ['../images/1.png', '../images/2.png', '../images/3.png', '../images/4.png', '../images/5.png'];
        var score = ['a', 'b', 'c', 'd', 'e'];

        // Loop through the images array and create image elements
        images.forEach(function (imageSrc, index) {
            var img = document.createElement('img');
            img.src = imageSrc;
            img.width = 40;
            img.height = 40;
            img.onclick = function () {
                // Call your new function here
                sendScore(item, score[index]);
            };
            var space = document.createTextNode(' ');

            readMoreLink.appendChild(img);
            readMoreLink.appendChild(space);
        });
        // var txt = document.createElement('p');
        // txt.textContent = 'พอใจมาก: ' + item.dataScore.a + ', พอใจ: ' + item.dataScore.b + ', ปานกลาง: ' + item.dataScore.c + ', ไม่พอใจ: ' + item.dataScore.d + ', ไม่พอใจมาก: ' + item.dataScore.e;

        // Append the elements to the DOM
        innerBox.appendChild(numberBox);
        innerBox.appendChild(titleLink);
        innerBox.appendChild(description);
        // innerBox.appendChild(txt);
        innerBox.appendChild(readMoreLink);
        // innerBox.appendChild(txt);

        divBlock.appendChild(innerBox);

        resultDiv.appendChild(divBlock);
    });
}

// function render_top_rank(data) {
//     var data_a = data;
//     var resultDiv = document.getElementById('resultDiv');

//     // Loop through the data array
//     data_a.forEach(function (item, index) {
//         const source = item.source;
//         var content = "";
//         let link = "";
//         if (source == 'twitter') {
//             content = item.data.content;
//             link = "twitter-detail.html?uuid=";
//         } else if (source == 'facebook') {
//             content = item.data.text;
//             link = "facebook-detail.html?uuid=";
//         } else if (source == 'tiktok') {
//             content = item.data.desc;
//             link = "tiktok-detail.html?uuid=";
//         } else if (source == 'pantip') {
//             content = item.data.postcontent;
//             link = "pantip-detail.html?uuid=";
//         }

//         // Create the elements dynamically
//         var divBlock = document.createElement('div');
//         divBlock.className = 'process-block col-lg-4 col-md-6 col-sm-12';

//         var innerBox = document.createElement('div');
//         innerBox.className = 'inner-box wow fadeInUp';
//         innerBox.style.height = '400px';
//         innerBox.setAttribute('data-wow-delay', '0ms');
//         innerBox.setAttribute('data-wow-duration', '1500ms');

//         var numberBox = document.createElement('div');
//         numberBox.className = 'number-box';
//         numberBox.textContent = index + 1;

//         var titleLink = document.createElement('h4');
//         var titleAnchor = document.createElement('a');
//         // var t = document.createElement('h5');
//         titleAnchor.href = link + item.uuid;
//         titleAnchor.textContent = item.source + ": " + item.head;
//         // t.textContent = "หัวข้อ: " + item.head;

//         titleLink.appendChild(titleAnchor);

//         var readmore = document.createElement('a');
//         readmore.href = link + item.uuid;
//         readmore.textContent = 'อ่านต่อ'

//         var description = document.createElement('div');
//         description.className = 'text';
//         description.textContent = content.slice(0, 60) + '...';
//         description.appendChild(readmore);

//         var readMoreLink = document.createElement('div');
//         // readMoreLink.textContent = 'ให้คะแนนความพึงพอใจ ';

//         var arrowSpan = document.createElement('span');
//         arrowSpan.className = 'arrow flaticon-long-arrow-pointing-to-the-right';

//         // readMoreLink.appendChild(arrowSpan);
//         // readMoreLink.appendChild(document.createElement('br')); 

//         var images = ['../images/1.png', '../images/2.png', '../images/3.png', '../images/4.png', '../images/5.png'];
//         var score = ['a', 'b', 'c', 'd', 'e'];

//         // Loop through the images array and create image elements
//         images.forEach(function (imageSrc, index) {
//             var img = document.createElement('img');
//             img.src = imageSrc;
//             img.width = 40;
//             img.height = 40;
//             img.onclick = function () {
//                 // Call your new function here
//                 sendScore(item, score[index]);
//             };
//             var space = document.createTextNode(' ');

//             readMoreLink.appendChild(img);
//             readMoreLink.appendChild(space);
//         });
//         // var txt = document.createElement('p');
//         // txt.textContent = 'พอใจมาก: ' + item.dataScore.a + ', พอใจ: ' + item.dataScore.b + ', ปานกลาง: ' + item.dataScore.c + ', ไม่พอใจ: ' + item.dataScore.d + ', ไม่พอใจมาก: ' + item.dataScore.e;

//         // Append the elements to the DOM
//         innerBox.appendChild(numberBox);
//         innerBox.appendChild(titleLink);
//         // innerBox.appendChild(t);
//         innerBox.appendChild(description);
//         innerBox.appendChild(readMoreLink);
//         // innerBox.appendChild(txt);

//         divBlock.appendChild(innerBox);

//         resultDiv.appendChild(divBlock);
//     });
// }

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

function render_word_top(data) {
    var resultDiv = document.getElementById('resultDiv');
    var result_data = data.result_data;
    const sortedData = Object.entries(result_data).sort((a, b) => b[1].value - a[1].value);
    const slicedData = sortedData.slice(0, 6);
    // console.log(slicedData);
    if (slicedData.length > 0) {
        for (const item in slicedData) {
            const div = document.createElement('div');
            div.classList.add('service-block-two', 'col-lg-4', 'col-md-4', 'col-sm-12');

            const innerDiv = document.createElement('div');
            innerDiv.classList.add('inner-box', 'wow', 'fadeInLeft');
            innerDiv.setAttribute('data-wow-delay', '0ms');
            innerDiv.setAttribute('data-wow-duration', '1500ms');

            const shapeOneDiv = document.createElement('div');
            shapeOneDiv.classList.add('shape-one');

            const shapeTwoDiv = document.createElement('div');
            shapeTwoDiv.classList.add('shape-two');

            const iconBoxDiv = document.createElement('div');
            iconBoxDiv.classList.add('icon-box');

            const h5 = document.createElement('h5');
            const a = document.createElement('a');
            a.innerText = slicedData[item][0];
            div.onclick = function () {
                gotoNextpage(JSON.stringify(slicedData[item]));
            };

            h5.appendChild(a);

            const textDiv = document.createElement('div');
            textDiv.classList.add('text');
            textDiv.innerText = `จำนวนข้อมูลที่มีคำปรากฎอยู่: ${slicedData[item][1].value} ข้อมูล`;

            innerDiv.appendChild(shapeOneDiv);
            innerDiv.appendChild(shapeTwoDiv);
            innerDiv.appendChild(h5);
            innerDiv.appendChild(textDiv);
            div.appendChild(innerDiv);
            div.appendChild(iconBoxDiv);
            resultDiv.appendChild(div);
        }
    }
    else {
        const div = document.createElement('div');
        div.classList.add('service-block-two', 'col-lg-12', 'col-md-12', 'col-sm-12');
        div.innerHTML = `
        <center>
          <div class="inner-box" data-wow-delay="0ms" data-wow-duration="1500ms">
            <h5><a>ไม่พบข้อมูล...กรุณาเลือกแหล่งที่มาอื่น</a></h5>
          </div>
        </center>
        `;
        resultDiv.appendChild(div);
    }
}

function gotoNextpage(data) {
    localStorage.setItem('myData', data);
    window.location.href = 'list_word.html';
}


function fetch_phone() {
    let data = {
        "result_id": 90020
    }
    fetch('https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/result1', {
        method: 'POST', headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(data => {
            // console.log(data.Items[0].result_data)
            var phone_data = data.Items[0].result_data;
            render_phone(phone_data);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        }).finally(() => {
            // Hide the loading progress when the fetch is complete
            document.getElementById('loading').style.display = 'none';
        });
}

function render_phone(data) {
    // console.log(data);
    const phoneList = document.getElementById("phone-list");
    phoneList.innerHTML = '';

    const ul = document.createElement('ul');
    ul.classList.add('sponsors-carousel', 'owl-carousel', 'owl-theme');

    for (const phoneNumber in data) {
        // console.log(data);
        const listItem = document.createElement("li");
        const div = document.createElement("div");
        div.classList.add("image-box");
        const h5 = document.createElement('h5');
        const a = document.createElement('a');
        const p = document.createElement('p');
        a.textContent = phoneNumber;
        a.style.color = 'blue';

        div.addEventListener('click', function () {
            showPhoneDetail(data[phoneNumber][0]);
        });

        div.addEventListener('mouseover', function () {
            a.style.color = 'red';
        });
        div.addEventListener('mouseout', function () {
            a.style.color = 'blue';
        });

        p.textContent = 'ข้อมูลจาก:' + data[phoneNumber][0].source;
        h5.appendChild(a);
        h5.appendChild(p);
        div.appendChild(h5);

        listItem.appendChild(div);
        ul.appendChild(listItem);
    }

    phoneList.appendChild(ul);

    // $('.sponsors-carousel').owlCarousel({
    //     items: 4,
    //     loop: true,
    //     margin: 10,
    //     nav: true,
    //     autoplay: true,
    //     autoplayTimeout: 3000
    // });

    $('.sponsors-carousel').owlCarousel({
        items: 6,
        nav: true,
        dots: false,
        mouseDrag: true,
        responsiveClass: true,
        autoplay: true, // Enable autoplay
        autoplayTimeout: 3000,
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 3
            },
            769: {
                items: 6
            }
        }
    });
}

function showPhoneDetail(detail) {
    // console.log(detail);
    // var source = 'แหล่งที่มา: ' + detail.source;
    var iconsPath = '';
    var content = detail.text;
    if (detail.source == 'twitter') {
        iconsPath = '../images/twitter-icons.png';
    } else if (detail.source == 'facebook') {
        iconsPath = '../images/facebook-icons.png';
    } else if (detail.source == 'tiktok') {
        iconsPath = '../images/tiktok-icons.png';
    } else if (detail.source == 'pantip') {
        iconsPath = '../images/blog-icons.png';
    }
    Swal.fire({
        title: '',
        imageUrl: iconsPath,
        imageWidth: 100,
        imageHeight: 100,
        text: content,
        confirmButtonText: "ปิด",
    });
}