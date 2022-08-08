function updateList() {
	const titles = [...document.querySelectorAll('h1, h2')].sort((a, b) => {
		return Math.abs(a.getBoundingClientRect().top) - Math.abs(b.getBoundingClientRect().top);
	});

	document.querySelectorAll(".selected-circle").forEach(c => c.classList.remove("selected-circle"));
	
	document.querySelectorAll(".nav-dot")[[...document.querySelectorAll('h1, h2')].indexOf(titles[0])].classList.add("selected-circle");
}

updateList();
window.addEventListener('scroll', () => {
    updateList();
})

const btn = document.querySelector("button.mobile-menu-button");

const mobile_menu = document.querySelector('.mobile-menu');

btn.addEventListener('click', () => { 
  mobile_menu.classList.toggle('hidden');
});

mobile_menu.addEventListener('click', () => {
    mobile_menu.classList.toggle('hidden');
})

const message = document.getElementById('#message');


// setTimeout(() => {
//     //alert('toto');
//     message.classList.add('hidden');
// }, 5000); 