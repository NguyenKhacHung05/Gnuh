const body = document.querySelector('body')
const sideBar = document.querySelector('.sidebar');
const mainContent = document.querySelector('.main-content')
const btnOpenBar = document.querySelector('.openbar')
const btnCloseBar = document.querySelector('.closebar')
const navItems = document.querySelectorAll('.nav-items')
const btnLights = document.querySelectorAll('.btn-light')
const preloader = document.querySelector('.preloader')
const btnIconList = document.querySelector('.btn-icon-list')
const bgLight = document.querySelectorAll('.bg-light')
const bgDark = document.querySelectorAll('.bg-dark')
const textLight = document.querySelectorAll('.text-light')
const textDark = document.querySelectorAll('.text-dark')
const overPlay = document.querySelector('.overplay')

//change theme
function changeColorText(){
    var theme = localStorage.getItem('theme')
    
    theme == 'light' ? body.classList.add('light') : body.classList.remove('light');
    if(theme == 'light'){
        
        btnLights.forEach(element => {
            element.classList.add('btn-dark')
        })

        btnIconList.classList.add('bg-light')

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

    }else{
        btnLights.forEach(element => {
            element.classList.remove('btn-dark')
        })

        btnIconList.classList.remove('bg-light')
        
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
    theme = localStorage.setItem('theme', theme)
    changeColorText();
}

window.addEventListener('load', () => {
    var theme = localStorage.getItem('theme')
    preloader.classList.add("unactive");
    if(theme == null){
        theme = 'dark'
        body.setAttribute('data-bs-theme', theme)
        localStorage.setItem('theme', 'dark')
    }else{
        if(theme == 'dark'){
            body.setAttribute('data-bs-theme', theme)
        }else{
            theme = 'light'
            body.setAttribute('data-bs-theme', theme)
            body.classList.add(theme)
        }
    }
    changeColorText()
})


//sidebar
function toggleBar() {
    if (sideBar.classList.toggle('active')) {
        btnOpenBar.hidden = true
        btnCloseBar.hidden = false
        navItems.forEach(navItems => {
            navItems.classList.toggle('d-none')
        });
        overPlay.classList.toggle('active')
    }
    else {
        btnOpenBar.hidden = false
        btnCloseBar.hidden = true
        navItems.forEach(navItems => {
            navItems.classList.toggle('d-none')
        });
        overPlay.classList.toggle('active')
    }
}

btnIconList.addEventListener('click', () => {
    sideBar.classList.toggle('d-none')
    mainContent.classList.toggle('d-none')
})

