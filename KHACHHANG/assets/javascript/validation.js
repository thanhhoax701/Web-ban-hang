// Đây là file validation có thể được tái sử dụng ở hầu hết các loại form
// Đối tượng `Validator`
function Validator(options) {
    function getParent(element, selector) {
        while (element.parentElement) {
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

        // Lặp qua từng rule & kiểm tra
        // Nếu có lỗi thì dừng việc kiểm
        for (var i = 0; i < rules.length; ++i) {
            switch (inputElement.type) {
                case 'radio':
                case 'checkbox':
                    errorMessage = rules[i](
                        formElement.querySelector(rule.selector + ':checked')
                    );
                    break;
                default:
                    errorMessage = rules[i](inputElement.value);
            }
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
            // e.preventDefault();

            var isFormValid = true;

            // Lặp qua từng rules và validate
            options.rules.forEach(function(rule) {
                // Lấy ra input (inputElement) nằm trong form-1
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
                    var formValues = Array.from(enableInputs).reduce(function(values, input) {

                        switch (input.type) {
                            case 'radio':
                                values[input.name] = formElement.querySelector('input[name="' + input.name + '"]:checked').value;
                                break;
                            case 'checkbox':
                                if (!input.matches(':checked')) {
                                    values[input.name] = '';
                                    return values;
                                }
                                if (!Array.isArray(values[input.name])) {
                                    values[input.name] = [];
                                }
                                values[input.name].push(input.value);
                                break;
                            case 'file':
                                values[input.name] = input.files;
                                break;
                            default:
                                values[input.name] = input.value;
                        }

                        return values;
                    }, {});
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
                selectorRules[rule.selector] = [rule.test];
            }

            var inputElements = formElement.querySelectorAll(rule.selector);

            Array.from(inputElements).forEach(function(inputElement) {
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
            });
        });
    }

}



// Định nghĩa rules
// Nguyên tắc của các rules:
// 1. Khi có lỗi => Trả ra message lỗi
// 2. Khi hợp lệ => Không trả ra cái gì cả (undefined)
const focusInput = document.querySelectorAll('.auth-from__input');

// Nếu rỗng thì yêu cầu nhập lại
Validator.isRequired = function(selector, message) {
    return {
        selector: selector,
        // Kiểm tra điều kiện nhập
        test: function(value) {
            // Loại bỏ khoảng cách
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
            return value === getConfirmValue() ? undefined : message || 'Giá trị nhập vào không chính xác';
        }
    }
}



// Nút or di chuyển khi submit
var clickSub = document.querySelector('.form-submit');
var moveOrDownSignUp = document.querySelector('#or');
var moveOrDownSignIn = document.querySelector('#or_sign-in');

clickSub.addEventListener('click', function() {
    moveOrDownSignUp.style.top = '65.5%'
    moveOrDownSignUp.style.display = 'none'
});

clickSub.addEventListener('click', function() {
    moveOrDownSignIn.style.top = '56.5%'
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