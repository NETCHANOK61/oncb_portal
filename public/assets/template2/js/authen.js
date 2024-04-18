function authenUser(username, password) {
    const form = document.getElementById('login_form');
    let data = {
        "username": username,
        "user_password": password,
    }
    fetch('https://ndacvutb8j.execute-api.ap-southeast-1.amazonaws.com/dsi1/user1_dsi', {
        method: 'POST', headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then((data) => {
            if (data.Count != 0) {
                var user_data = JSON.stringify(data);
                localStorage.setItem("user", user_data);
                sessionStorage.setItem("user", user_data);
                window.location.replace('index.html');
                form.reset();
            } else {
                Swal.fire('การเข้าสู่ระบบผิดพลาด', 'Username หรือ Password ของคุณไม่ถูกต้อง', 'error');
            }

        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
}