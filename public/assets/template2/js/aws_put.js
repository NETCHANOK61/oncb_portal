// function addNewData(newData, check) {
//     getData(check)
//         .then(data => {
//             var dataArray1 = data.Items[0].data ? data.Items[0].data : [];
//             // console.log(data);
//             const mergedDataArray = [...dataArray1, ...newData];
//             putData_to_config1(mergedDataArray, check).then(() => {
//                 document.getElementById('addForm').reset();
//                 Swal.fire('บันทึกข้อมูลสำเร็จ', 'ระบบทำการบันทึกข้อมูลของคุณสำเร็จ', 'success');
//             }).catch(() => {
//                 Swal.fire('เกิดข้อผิดพลาด', 'ระบบไม่สามารถบันทึกข้อมูลนี้ได้', 'error');
//             });
//         })
//         .catch(error => {
//             console.error('Error fetching data:', error);
//         });
// }

function addNewData(newData, check, user) {
    // console.log(data);
    // const mergedDataArray = [...newData];
    putData_to_config1(newData, check).then(() => {
        putData_to_user(newData, check, user).then(() => {
            document.getElementById('addForm').reset();
            Swal.fire('บันทึกข้อมูลสำเร็จ', 'ระบบทำการบันทึกข้อมูลของคุณสำเร็จ', 'success');
        }).catch((error) => {
            console.log(error)
            // Swal.fire('เกิดข้อผิดพลาด', 'ระบบไม่สามารถบันทึกข้อมูลนี้ได้', 'error');
        });
    }).catch(() => {
        Swal.fire('เกิดข้อผิดพลาด', 'ระบบไม่สามารถบันทึกข้อมูลนี้ได้', 'error');
    });

}

// async function getData(check) {
//     let data = {};
//     if (check == 'group') {
//         data = {
//             config_id: 999
//         }
//     } else {
//         data = {
//             config_id: 998
//         }
//     }
//     try {
//         const response = await fetch('https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/config1', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json'
//             },
//             body: JSON.stringify(data)
//         });
//         return await response.json();
//     } catch (error) {
//         console.error('Error fetching data:', error);
//     }
// }

async function putData_to_config1(dataFromInput, check) {
    let data = {};
    const formattedObj = {
        [dataFromInput[0].name]: dataFromInput[0].id
    };

    if (check == 'group') {
        data = {
            "config_id": 30001,
            "config_data": {
                "keyword": { ...formattedObj }
            }
        }
    } else {
        data = {
            "config_id": 10001,
            'config_data': {
                'keyword': dataFromInput
            }
        }
    }
    // console.log(data);
    try {
        const response = await fetch('https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/config1', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });
        return await response.json();
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}

async function putData_to_user(dataFromInput, check, user) {
    // let data = {};
    const jsonObject = JSON.parse(user);
    var arr = [];
    arr.push(dataFromInput[0].name);
    // console.log(dataFromInput[0].name);

    if (check == 'group') {
        data = {
            "id": jsonObject.Items[0].id,
            "keyword": arr,
            "username": jsonObject.Items[0].username,
            "user_password": jsonObject.Items[0].user_password,
            "user_email": jsonObject.Items[0].user_email,
            "user_status": jsonObject.Items[0].user_status,
            "user_role": jsonObject.Items[0].user_role,
            "user_department": jsonObject.Items[0].user_department,
            "user_token": jsonObject.Items[0].user_token
        }
    } else {
        data = {
            "id": jsonObject.Items[0].id,
            "keyword": dataFromInput,
            "username": jsonObject.Items[0].username,
            "user_password": jsonObject.Items[0].user_password,
            "user_email": jsonObject.Items[0].user_email,
            "user_status": jsonObject.Items[0].user_status,
            "user_role": jsonObject.Items[0].user_role,
            "user_department": jsonObject.Items[0].user_department,
            "user_token": jsonObject.Items[0].user_token
        }
    }
    // console.log(data);
    try {
        const response = await fetch('https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/user1_dsi', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });
        return await response.json();
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}
