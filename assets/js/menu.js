const user_btn = document.querySelector('#user-btn');
const user_menu = document.querySelector('#user-menu');

user_btn.addEventListener('click', () => {
  user_menu.classList.toggle('hidden');
  console.log('titoto');
})

user_menu.addEventListener('click', () => {
  user_menu.classList.toggle('hidden');
})