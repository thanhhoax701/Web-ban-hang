// Sản phẩm chi tiết (Image Gallery)
const images = document.querySelectorAll('.product__content-left-small .product__content-left-small--image img')
const gallery = document.querySelector('.product__content--gallery')
const galleryImg = document.querySelector('.product__content--gallery-inner img')
const close = document.querySelector('.product__content--gallery .close')

const next = document.querySelector('.product__content--control.next')
const prev = document.querySelector('.product__content--control.prev')

let currentIndex = 0

images.forEach((img, index) => {
    img.addEventListener('click', () => {
        currentIndex = index
        showGallery()
    })
})

function showGallery() {
    currentIndex == images.length - 1 ?
        next.classList.add('hide') :
        next.classList.remove('hide')

    currentIndex == 0 ? prev.classList.add('hide') : prev.classList.remove('hide')

    gallery.classList.add('show')
    galleryImg.src = images[currentIndex].src
}

close.addEventListener('click', () => {
    gallery.classList.remove('show')
})

next.addEventListener('click', () => {
    currentIndex != images.length - 1 ? currentIndex++ : undefined
    showGallery()
})
prev.addEventListener('click', () => {
    currentIndex != 0 ? currentIndex-- : undefined
    showGallery()
})

// esc click
document.addEventListener('keydown', (e) => {
    if (e.keyCode == 27) gallery.classList.remove('show')
})


// Zoom image by https://www.nodemy.vn/
const zoomer = document.querySelector('.product__content-left-big')
const wrapImg = document.querySelectorAll('.product__content-left-big .product__content-left--image')
const result = document.querySelector('.product__content-left-big .product__content-left--result')

const size = 4

wrapImg.forEach((item) => {
    item.addEventListener('mousemove', function(e) {
        result.classList.remove('hide')

        const img = item.querySelector('img')

        let x = (e.offsetX / this.offsetWidth) * 100
        let y = (e.offsetY / this.offsetHeight) * 100

        // move result
        let posX = e.pageX - zoomer.offsetLeft
        let posY = e.pageY - zoomer.offsetTop

        result.style.cssText = `
			background-image: url(${img.src});
			background-size: ${img.width * size}px ${img.height * size}px;
			background-position : ${x}% ${y}%;
			left: ${posX}px;
			top: ${posY}px;
		`
    })

    item.addEventListener('mouseleave', function(e) {
        result.style = ``
        result.classList.add('hide')
    })
})