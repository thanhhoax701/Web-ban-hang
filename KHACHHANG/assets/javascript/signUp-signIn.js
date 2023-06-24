// Đối tượng `Validator`
function Validator(options) {
    // được sử dụng khi thẻ input nằm ở vị trí ngẫu nhiên
    function getParent(element, selector) {
        while (element.parentElement) {
            // Kiểm tra xem element có match với css selector hay không
            if (element.parentElement.matches(selector)) {
                return element.parentElement;
            }
            element = element.parentElement;
        }
    }


    var selectorRules = {};

    // Hàm thực hiện validate
    function validate(inputElement, rule) {
        // Thay vì ghi '.form-message' thì nên thay bằng options.errorSelector để có thể tái sử dụng ở nhiều form khác nhau. Khi cần sửa chỉ cần vào errorSelector để sửa
        var errorElement = getParent(inputElement, options.formGroupSelector).querySelector(options.errorSelector);
        var errorMessage;

        // Lấy ra các rules của selector
        var rules = selectorRules[rule.selector];

        // Lặp qua từng rule & kiểm tra (mỗi lần lặp qua sẽ lấy được các rules)
        for (var i = 0; i < rules.length; ++i) {
            errorMessage = rules[i](inputElement.value);
            // Nếu có lỗi thì dừng việc kiểm
            if (errorMessage) break;
        }

        if (errorMessage) {
            errorElement.innerText = errorMessage;
            getParent(inputElement, options.formGroupSelector).classList.add('invalid');
        } else {
            errorElement.innerText = '';
            getParent(inputElement, options.formGroupSelector).classList.remove('invalid');
        }

        return !errorMessage;
    }

    // Lấy element của form cần validate
    var formElement = document.querySelector(options.form);
    if (formElement) {
        // Khi submit form
        formElement.onsubmit = function(e) {
            e.preventDefault();

            var isFormValid = true;

            // Lặp qua từng rules và validate
            options.rules.forEach(function(rule) {
                var inputElement = formElement.querySelector(rule.selector);
                var isValid = validate(inputElement, rule);
                if (!isValid) {
                    isFormValid = false;
                }
            });

            if (isFormValid) {
                // Trường hợp submit với javascript
                if (typeof options.onSubmit === 'function') {
                    var enableInputs = formElement.querySelectorAll('[name]');
                    // Array.from chuyển enableInputs sang array để sử dụng phương thức reduce -> lấy ra tất cả value của tất cá input
                    var formValues = Array.from(enableInputs).reduce(function(values, input) {
                        // gán input value cho object value và cuối cùng sẽ trả về values
                        values[input.name] = input.value;
                        return values;
                    }, {});

                    // Lấy ra tất cả input ở trạng thái enable trong form
                    options.onSubmit(formValues);
                }
                // Trường hợp submit với hành vi mặc định
                else {
                    formElement.submit();
                }
            }
        }

        // Lặp qua mỗi rule và xử lý (lắng nghe sự kiện blur, input, ...)
        options.rules.forEach(function(rule) {
            // Lưu lại các rules cho mỗi input
            if (Array.isArray(selectorRules[rule.selector])) {
                selectorRules[rule.selector].push(rule.test);
            } else {
                // nếu nó không phải là mảng thì gán cho nó bằng mảng có phần tử đầu tiên là rule
                selectorRules[rule.selector] = [rule.test];
            }

            // Lấy ra input (inputElement) nằm trong form-1
            var inputElement = formElement.querySelector(rule.selector);

            if (inputElement) {
                // Xử lý trường hợp blur khỏi input
                inputElement.onblur = function() {
                    validate(inputElement, rule);
                }

                // Xử lý mỗi khi người dùng nhập vào input
                inputElement.oninput = function() {
                    var errorElement = getParent(inputElement, options.formGroupSelector).querySelector(options.errorSelector);
                    errorElement.innerText = '';
                    getParent(inputElement, options.formGroupSelector).classList.remove('invalid');
                }
            }
        });
    }
}



// Định nghĩa rules
// Nguyên tắc của các rules:
// 1. Khi có lỗi => Trả ra message lỗi
// 2. Khi hợp lệ => Không trả ra cái gì cả (undefined)

// Nếu rỗng thì yêu cầu nhập lại
Validator.isRequired = function(selector, message) {
    return {
        selector: selector,
        // Kiểm tra điều kiện nhập
        test: function(value) {
            return value.trim() ? undefined : message || 'Vui lòng nhập trường này'
        }
    };
}

// Điều kiện khi nhập email
Validator.isEmail = function(selector, message) {
    return {
        selector: selector,
        // Kiểm tra điều kiện nhập
        test: function(value) {
            var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            // Ở đây sử dụng toán tử 3 ngôi nên có thể thay cho if
            return regex.test(value) ? undefined : message || 'Trường này phải là email';
        }
    };
}

// Mật khẩu phải có độ dài tối thiểu 6 ký tự
Validator.minLength = function(selector, min, message) {
    return {
        selector: selector,
        // Kiểm tra điều kiện nhập
        test: function(value) {
            // Ở đây sử dụng toán tử 3 ngôi nên có thể thay cho if
            return value.length >= min ? undefined : message || `Vui lòng nhập tối thiểu ${min} kí tự`;
        }
    };
}

Validator.isConfirmed = function(selector, getConfirmValue, message) {
    return {
        selector: selector,
        // Kiểm tra điều kiện nhập
        test: function(value) {
            // Ở đây sử dụng toán tử 3 ngôi nên có thể thay cho if
            return value.trim() === getConfirmValue() ? undefined : message || 'Giá trị nhập vào không chính xác';
        }
    }
}

// Khi nhập hơn 3 kí tự vào ô input thì nó sẽ đổi màu
var input_fields = document.querySelectorAll('.auth-from__input');
var login_btn = document.querySelector('.form-submit');

input_fields.forEach(function(input_item) {
    input_item.addEventListener('input', function() {
        if (input_item.value.length > 3) {
            login_btn.disabled = false;
            login_btn.className = 'btn enabled'
        }
    })
})



// Nút or di chuyển khi submit
var clickSub = document.querySelector('.form-submit');
var moveOrDownSignUp = document.querySelector('#or');
var moveOrDownSignIn = document.querySelector('#or_sign-in');

clickSub.addEventListener('click', function() {
    moveOrDownSignUp.style.top = '62.65%'
    moveOrDownSignUp.style.display = 'none'
});

clickSub.addEventListener('click', function() {
    moveOrDownSignIn.style.top = '51.75%'
    moveOrDownSignIn.style.display = 'none'
})



// Cho biết độ mạnh yếu của password
var pass = document.getElementById("password1");
var msg = document.getElementById("message");
var str = document.getElementById("strenght");

pass.addEventListener('input', function() {
    if (pass.value.length > 0) {
        msg.style.display = "block";
    } else {
        msg.style.display = "none";
    }
    if (pass.value.length < 4) {
        str.innerHTML = "weak";
        pass.style.borderColor = "#ff5925";
        msg.style.color = "#ff5925";
    } else if (pass.value.length >= 4 && pass.value.length < 8) {
        str.innerHTML = "medium";
        pass.style.borderColor = "#fbd233";
        msg.style.color = "#fbd233";
    } else if (pass.value.length >= 8) {
        str.innerHTML = "strong";
        pass.style.borderColor = "#26d730";
        msg.style.color = "#26d730";
    }
});

msg.addEventListener('blur', function() {
    msg.style.visibility = 'hidden'
})

// Show and hide password
// 
const togglePassword = document.querySelector('#eye1');
const password = document.querySelector('#password1');

togglePassword.addEventListener('click', function(e) {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});

// 
const togglePassword2 = document.querySelector('#eye2');
const password2 = document.querySelector('#password2');

togglePassword2.addEventListener('click', function(e) {
    const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
    password2.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});