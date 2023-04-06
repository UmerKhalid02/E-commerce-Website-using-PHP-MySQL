let userBox = document.querySelector('.header .header-2 .user-box');

document.querySelector('#user-btn').onclick = () =>{
    userBox.classList.toggle('active');
}

window.onscroll = () => {
    userBox.classList.remove('active');

    if(window.scrollY > 390){
        document.querySelector('.header .header-2').classList.add('active');
    }else{
        document.querySelector('.header .header-2').classList.remove('active');
    }
}