// On click view password
const showPassword_btn = document.querySelector("#show_password"),
    txtPasswd = document.querySelector("input[type=password][name=txtPasswd]#txtPasswd"),
    showPassword_icon = document.querySelector(".input-group .input-group-append #show_password i");
if (showPassword_btn != null) {
    showPassword_btn.onclick = () => {
        if (txtPasswd.type == "password") {
            txtPasswd.type = "text";
            showPassword_icon.classList.add("fa-eye-slash");
            showPassword_icon.classList.remove("fa-eye");
        } else {
            showPassword_icon.classList.remove("fa-eye-slash");
            showPassword_icon.classList.add("fa-eye");
            txtPasswd.type = "password";
        }
        // txtPasswd.focus();
    }
}

// On click view confirm password
const showConfPassword_btn = document.querySelector("#show_conf_password"),
    txtConfirmPassword = document.querySelector("input[type=password][name=txtConfirmPassword]#txtConfirmPassword"),
    showConfPassword_icon = document.querySelector(".input-group .input-group-append #show_conf_password i");
if (showConfPassword_btn != null) {
    showConfPassword_btn.onclick = () => {
        if (txtConfirmPassword.type == "password") {
            txtConfirmPassword.type = "text";
            txtConfirmPassword.focus;
            showConfPassword_icon.classList.add("fa-eye-slash");
            showConfPassword_icon.classList.remove("fa-eye");
        } else {
            showConfPassword_icon.classList.remove("fa-eye-slash");
            showConfPassword_icon.classList.add("fa-eye");
            txtConfirmPassword.type = "password";
        }
        // txtConfirmPassword.focus();
    }
}
// On click view old password
const txtOldPasswd = document.querySelector("input[type=password][name=txtOldPasswd]#txtOldPasswd"),
    showOldPassword_btn = document.querySelector("#show_old_password"),
    showOldPassword_icon = document.querySelector(".input-group .input-group-append #show_old_password i");
if (showOldPassword_btn != null) {
    showOldPassword_btn.onclick = () => {
        if (txtOldPasswd.type == "password") {
            txtOldPasswd.type = "text";
            showOldPassword_icon.classList.add("fa-eye-slash");
            showOldPassword_icon.classList.remove("fa-eye");
        } else {
            showOldPassword_icon.classList.remove("fa-eye-slash");
            showOldPassword_icon.classList.add("fa-eye");
            txtOldPasswd.type = "password";
        }
        // txtOldPasswd.focus();
    }
}

// On click view new password
const showNewPassword_btn = document.querySelector("#show_new_password"),
    txtNewPasswd = document.querySelector("input[type=password][name=txtNewPasswd]#txtNewPasswd"),
    showNewPassword_icon = document.querySelector(".input-group .input-group-append #show_new_password i");
if (showNewPassword_btn != null) {
    showNewPassword_btn.onclick = () => {
        if (txtNewPasswd.type == "password") {
            txtNewPasswd.type = "text";
            showNewPassword_icon.classList.add("fa-eye-slash");
            showNewPassword_icon.classList.remove("fa-eye");
        } else {
            showNewPassword_icon.classList.remove("fa-eye-slash");
            showNewPassword_icon.classList.add("fa-eye");
            txtNewPasswd.type = "password";
        }
        // txtNewPasswd.focus();
    }
}
// On click view new password
const showConfNewPassword_btn = document.querySelector("#show_confirm_new_password"),
    txtConfirmNewPasswd = document.querySelector("input[type=password][name=txtConfirmNewPasswd]#txtConfirmNewPasswd"),
    showConfNewPassword_icon = document.querySelector(".input-group .input-group-append #show_confirm_new_password i");
if (showConfNewPassword_btn != null) {
    showConfNewPassword_btn.onclick = () => {
        if (txtConfirmNewPasswd.type == "password") {
            txtConfirmNewPasswd.type = "text";
            showConfNewPassword_icon.classList.add("fa-eye-slash");
            showConfNewPassword_icon.classList.remove("fa-eye");
        } else {
            showConfNewPassword_icon.classList.remove("fa-eye-slash");
            showConfNewPassword_icon.classList.add("fa-eye");
            txtConfirmNewPasswd.type = "password";
        }
        // txtConfirmNewPasswd.focus();
    }
}