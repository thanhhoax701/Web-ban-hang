// Show on scroll
// Lấy tất cả phần tử có class là show-on-scroll
let elToShow = document.querySelectorAll('.show-on-scroll')

let isElInViewPort = (el) => {
    // Trả về kích thước và vị trí của phần tử trong trang
    let rect = el.getBoundingClientRect()
        // Trả về chiều cao của vùng hiển thị cho một đối tượng, tính bằng pixel. Giá trị chứa chiều cao với phần đệm, nhưng nó không bao gồm scrollBar, viền và lề.
    let viewHeight = window.innerHeight || document.documentElement.clientHeight

    return (
        (rect.top <= 0 && rect.bottom >= 0) ||
        (rect.bottom >= viewHeight && rect.top <= viewHeight) ||
        (rect.top >= 0 && rect.bottom <= viewHeight)
    )
}

function loop() {
    elToShow.forEach((item) => {
        if (isElInViewPort(item)) {
            // Thêm class start vào từng dạng cuộn tương ứng
            item.classList.add('start')
        } else {
            // Xóa class start ở từng dạng cuộn tương ứng
            item.classList.remove('start')
        }
    })
}

window.onscroll = loop

loop()


// Back To Top
const backToTopButton = document.querySelector('.footer__active-up>button');
window.addEventListener('scroll', scrollFunction);

function scrollFunction() {
    //Show backToTopButton
    // Khi cuộn tới mức nhất định sẽ hiện button back to top
    if (window.pageYOffset > 100) {
        if (!backToTopButton.classList.contains('btnEntrance')) {
            backToTopButton.classList.remove('btnExit');
            backToTopButton.classList.add('btnEntrance');
            backToTopButton.style.display = 'block';
        }
    }
    //Hide backToTopButton
    else {
        if (backToTopButton.classList.contains('btnEntrance')) {
            backToTopButton.classList.remove('btnEntrance');
            backToTopButton.classList.add('btnExit');
            setTimeout(function() {
                backToTopButton.style.display = 'none';
            }, 250)
        }
    }
}
backToTopButton.addEventListener('click', smoothScrollBackToTop);

// Khi bấm vào nút thì nó sẽ quay về điểm trên cùng của thanh cuộn, cộng thêm scroll-behavior: smooth; ở thẻ html
function smoothScrollBackToTop() {
    window.scrollTo(0, 0);
}