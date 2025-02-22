const listImg = document.querySelector('.list-images');
const imgs = document.querySelectorAll('.slideshow-banner-img');
const btnRight = document.querySelector('.btn-right');
const btnLeft = document.querySelector('.btn-left');
const indexItems = document.querySelectorAll('.index-item');

const body = document.querySelector('body')
const btnLights = document.querySelectorAll('.btn-light')
const preloader = document.querySelector('.preloader')
const bgLight = document.querySelectorAll('.bg-light')
const bgDark = document.querySelectorAll('.bg-dark')
const textLight = document.querySelectorAll('.text-light')
const textDark = document.querySelectorAll('.text-dark')
const overPlay = document.querySelector('.overplay')

//change theme
function changeColorText() {
    var theme = localStorage.getItem('theme')

    theme == 'light' ? body.classList.add('light') : body.classList.remove('light');
    if (theme == 'light') {

        btnLights.forEach(element => {
            element.classList.add('btn-dark')
        })

        bgDark.forEach(element => {
            element.classList.remove('bg-dark')
            element.classList.add('bg-light')
        })
        bgLight.forEach(element => {
            element.classList.remove('bg-light')
            element.classList.add('bg-dark')
        })
        textDark.forEach(element => {
            element.classList.remove('text-dark')
            element.classList.add('text-light')
        })
        textLight.forEach(element => {
            element.classList.remove('text-light')
            element.classList.add('text-dark')
        })

    } else {
        btnLights.forEach(element => {
            element.classList.remove('btn-dark')
        })

        bgDark.forEach(element => {
            element.classList.remove('bg-light')
            element.classList.add('bg-dark')
        })
        bgLight.forEach(element => {
            element.classList.remove('bg-dark')
            element.classList.add('bg-light')
        })
        textDark.forEach(element => {
            element.classList.remove('text-light')
            element.classList.add('text-dark')
        })
        textLight.forEach(element => {
            element.classList.remove('text-dark')
            element.classList.add('text-light')
        })
    }
}

function changeTheme() {
    var theme = localStorage.getItem('theme')
    theme == 'dark' ? theme = 'light' : theme = 'dark'
    body.setAttribute('data-bs-theme', theme);
    theme = localStorage.setItem('theme', theme);
    changeColorText();
}

// window.addEventListener('load', () => {
//     var theme = localStorage.getItem('theme')
//     preloader.classList.add("unactive");
//     if (theme == null) {
//         theme = 'dark'
//         body.setAttribute('data-bs-theme', theme)
//         localStorage.setItem('theme', 'dark')
//     } else {
//         if (theme == 'dark') {
//             body.setAttribute('data-bs-theme', theme)
//         } else {
//             theme = 'light'
//             body.setAttribute('data-bs-theme', theme)
//             body.classList.add(theme)
//         }
//     }
//     changeColorText()
// })

// slideshow
var current = 0;
const lengthImgs = imgs.length;


const delayActive = () => {
    document.querySelector('.active').classList.remove('active');
    indexItems[current].classList.add('active');
}
const handleChangeSlide = () => {
    if (current == lengthImgs - 1 && listImg) {
        current = 0;
        listImg.style.transform = `translateX(${-imgs[current].offsetWidth * current}px)`
        delay = setTimeout(delayActive, 400);
        delay = setTimeout(delayActive, 400);
    }
    else {
        current++
        listImg.style.transform = `translateX(${-imgs[current].offsetWidth * current}px)`
        delay = setTimeout(delayActive, 400);
    }
}
if (listImg) {
    var delay = setTimeout(delayActive, 400);
    var handleEventChangeSlide = setInterval(handleChangeSlide, 4000);
}

if (btnRight) {
    btnRight.addEventListener('click', () => {
        clearInterval(handleEventChangeSlide);
        handleChangeSlide();
        handleEventChangeSlide = setInterval(handleChangeSlide, 4000);
    });
} if (btnLeft) {
    btnLeft.addEventListener('click', () => {
        clearInterval(handleEventChangeSlide);
        current = current === 0 ? lengthImgs - 1 : current - 1;
        listImg.style.transform = `translateX(${-imgs[current].offsetWidth * current}px)`;
        setTimeout(delayActive, 400);
        handleEventChangeSlide = setInterval(handleChangeSlide, 4000);
    });
}

function indexImgs(index) {
    current = index;
    clearInterval(handleEventChangeSlide)

    listImg.style.transform = `translateX(${-imgs[current].offsetWidth * current}px)`

    handleEventChangeSlide = setInterval(handleChangeSlide, 4000);
    delay = setTimeout(delayActive, 100);
}
// if (indexItems) {
//     indexItems[0].addEventListener('click', () => {
//         indexImgs(0);
//     })
// }

// slideshow

//load Images
function load(img) {
    const url = img.getAttribute('lazy-src')
    if (url != null) {
        img.setAttribute('src', url)
        img.removeAttribute('lazy-src')
    }
}
function ready() {
    if ('IntersectionObserver' in window) {
        var lazyImgs = document.querySelectorAll('[lazy-src]')
        let observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    load(entry.target)
                }
            })
        });
        lazyImgs.forEach(img => {
            observer.observe(img)
        })
    }
}
document.addEventListener('DOMContentLoaded', ready)


//scroll to top

const btnScrollToTop = document.getElementById('btnScrollToTop')
const docEl = document.documentElement

document.addEventListener('scroll', () => {
    if (docEl.scrollTop > 500) {
        btnScrollToTop.hidden = false;
    }
    else {
        btnScrollToTop.hidden = true;
    }
})

btnScrollToTop.addEventListener('click', () => {
    docEl.scrollTo({
        top: 0,
        behavior: 'smooth'
    })
})
function scrollToElementY(selector, offsetY, event) {
    const element = document.querySelector(selector);

    if (element) {
        const elementRect = element.getBoundingClientRect();
        window.scrollTo({
            top: elementRect.top + window.pageYOffset + offsetY,
            behavior: 'smooth' // Cuộn mượt mà
        });
    }
    event.addEventListener('click', function (event) {
        event.preventDefault();
    })
}

// deal time
document.addEventListener("DOMContentLoaded", () => {
    // Xác định thời điểm đếm ngược (5 ngày trước, lúc 23:59:59)
    const targetDate = new Date();
    targetDate.setDate(targetDate.getDate() + 5);
    targetDate.setHours(23, 59, 59, 999);
    const countdownDate = targetDate.getTime();

    // Lấy phần tử HTML một lần để tối ưu
    const daysEl = document.getElementById("days");
    const hoursEl = document.getElementById("hours");
    const minutesEl = document.getElementById("minutes");
    const secondsEl = document.getElementById("seconds");
    const countdownEl = document.getElementById("countdown");

    let interval; // Khai báo biến interval trước
    const formatNumber = (num) => String(num).padStart(2, "0");
    // Cập nhật thời gian mỗi giây
    const updateCountdown = () => {
        const now = Date.now(); // Lấy timestamp hiện tại
        const distance = countdownDate - now;

        if (distance <= 0) {
            clearInterval(interval);
            countdownEl.textContent = "Time's up!";
            return;
        }

        // Tính toán thời gian
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Cập nhật HTML nếu phần tử tồn tại
        if (daysEl && hoursEl && minutesEl && secondsEl) {
            daysEl.textContent = formatNumber(days);
            hoursEl.textContent = formatNumber(hours);
            minutesEl.textContent = formatNumber(minutes);
            secondsEl.textContent = formatNumber(seconds);
        }
    };

    // Chạy ngay lần đầu và lặp lại mỗi giây
    updateCountdown();
    interval = setInterval(updateCountdown, 1000);
});



// header sticky
document.addEventListener("DOMContentLoaded", function () {
    const header = document.querySelector(".header");
    const scrollOffset = 80; // Số pixel từ đỉnh để thêm hiệu ứng sticky

    window.addEventListener("scroll", () => {
        if (window.scrollY > scrollOffset) {
            header.classList.add("sticky", "animated", "fadeIn");
        } else {
            header.classList.remove("sticky", "animated", "fadeIn");
        }
    });
});
// header sticky

// search
// document.querySelector('.search-toggles').addEventListener('click', function (event) {
//     let searchValue = document.querySelector('.search-input').value;
//     if (searchValue == '') {
//         event.preventDefault();
//         const searchInput = document.querySelector('.search-input');
//         searchInput.classList.toggle('open');
//     }
// });
// search


