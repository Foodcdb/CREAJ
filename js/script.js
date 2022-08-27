let navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   profile.classList.remove('active');
}

let profile = document.querySelector('.header .flex .profile');

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   navbar.classList.remove('active');
}

window.onscroll = () =>{
   profile.classList.remove('active');
   navbar.classList.remove('active');
}

const open= document.getElementById('open');
const modal_container= document.getElementById('modal_container');
const close= document.getElementById('close');


open.addEventListener('click',() =>{
   modal_container.classList.add('show')
});

close.addEventListener('click',() =>{
   modal_container.classList.remove('show')
});


//Validacion para el formulario//

//Degradado//


//Metodo de pago//

 






