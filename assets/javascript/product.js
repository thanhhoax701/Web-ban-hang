// TAB SẢN PHẨM
var product = {
    tabIndex: function() {
        var boxTab = document.querySelectorAll('.sticky-list-tab');
        var productSuggestions = document.querySelectorAll('.product-suggestions-container');
        var result = boxTab.forEach(function(tab, index) {
            var pane = productSuggestions[index];
            tab.onclick = function() {
                document.querySelector('.sticky-list-tab.sticky-active').classList.remove('sticky-active');
                document.querySelector('.product-suggestions-container.block-active').classList.remove('block-active');

                this.classList.add('sticky-active')
                pane.classList.add('block-active')
            }
        })
    },

    start: function() {
        this.tabIndex();
    }
};
product.start();



// Show and hide trên PC

// Show and hide Điện thoại
var showMoreProductPhone = document.querySelector('.show-more-prod-phone');
var productMain2Phone = document.querySelector('#product__main-2-phone');
var hideMoreProductPhone = document.querySelector('.hide-more-prod-phone');

showMoreProductPhone.addEventListener('click', function() {
    productMain2Phone.style.display = 'flex';
    hideMoreProductPhone.style.display = 'block';
    showMoreProductPhone.style.display = 'none';
});

hideMoreProductPhone.addEventListener('click', function() {
    productMain2Phone.style.display = 'none';
    showMoreProductPhone.style.display = 'block';
    hideMoreProductPhone.style.display = 'none';
});

// Show and hide Máy tính bảng
var showMoreProductTablet = document.querySelector('.show-more-prod-tablet');
var productMain2Tablet = document.querySelector('#product__main-2-tablet');
var hideMoreProductTablet = document.querySelector('.hide-more-prod-tablet');

showMoreProductTablet.addEventListener('click', function() {
    productMain2Tablet.style.display = 'flex';
    hideMoreProductTablet.style.display = 'block';
    showMoreProductTablet.style.display = 'none';
});

hideMoreProductTablet.addEventListener('click', function() {
    productMain2Tablet.style.display = 'none';
    showMoreProductTablet.style.display = 'block';
    hideMoreProductTablet.style.display = 'none';
});