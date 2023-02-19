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