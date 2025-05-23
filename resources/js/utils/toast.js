import Toastify from "toastify-js";

const Toast = (text) => {
    Toastify({
        text: text,
        duration: 3000,
        close: true,
        gravity: "top",
        position: "right",
        stopOnFocus: true,
    }).showToast();
};

export default Toast;
