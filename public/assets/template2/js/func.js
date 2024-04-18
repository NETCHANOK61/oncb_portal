function logout() {
    // Clear the session storage data
    localStorage.clear();
    sessionStorage.removeItem('user');
    sessionStorage.clear();

    // Clear the browsing history
    if (typeof history.pushState === "function") {
        history.pushState({}, "Logout", "#logout");
        history.replaceState({}, "Logout", "#logout");
    }

    // Redirect the user to the login page after logout
    window.location.replace('login.html');

}

function state() {
    const user = localStorage.getItem("user");
    if (user == undefined) {
        window.location.href = 'login.html';
    }
    const obj = JSON.parse(user);
    var check = obj.Items[0].user_role
    if (check == "staff") {
        document.getElementById('staff').style.display = "block";
    } else if (check == "admin") {
        document.getElementById('admin').style.display = "block";
    }
}

function special(page) {
    const user = localStorage.getItem("user");
    if (user == undefined) {
        window.location.href = 'login.html';
    }
    const obj = JSON.parse(user);
    var check = obj.Items[0].user_role
    if (page == "admin") {
        if (check == "staff" || check == "user") {
            logout();
        }
    } else if (page == "staff") {
        if (check == "admin" || check == "user") {
            logout();
        }
    }
}