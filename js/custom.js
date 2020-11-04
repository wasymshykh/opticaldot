const navItem = document.querySelector('.nav-drop');

document.body.addEventListener('click', (e)=>{

	const navItemChild = e.target.nextElementSibling;
	const serviceRemove = document.querySelector('.nav-services-drop');
	const portfolioRemove = document.querySelector('.nav-portfolio-drop');
	const fpBtn = document.querySelector('#fp-nav');

	if(e.target.parentElement.classList.contains('nav-drop') && e.target.parentElement.classList.contains('nav-drop-services')){
		if(portfolioRemove.classList.contains('nav-portfolio-active')) {
			portfolioRemove.classList.remove('nav-portfolio-active');
		} 
		if(navItemChild.classList.contains('nav-service-active')) {
			navItemChild.classList.remove('nav-service-active');
		} else {
			navItemChild.classList.add('nav-service-active');
		}
	} 
	else if(e.target.parentElement.classList.contains('nav-drop') && e.target.parentElement.classList.contains('nav-drop-portfolio')){
		
		if(serviceRemove.classList.contains('nav-service-active')) {
			serviceRemove.classList.remove('nav-service-active');
		} 
		if(navItemChild.classList.contains('nav-portfolio-active')) {
			navItemChild.classList.remove('nav-portfolio-active');
		} else {
			navItemChild.classList.add('nav-portfolio-active');
		}
	} else {
		if(serviceRemove.classList.contains('nav-service-active')) {
			serviceRemove.classList.remove('nav-service-active');
		} 
		if(portfolioRemove.classList.contains('nav-portfolio-active')) {
			portfolioRemove.classList.remove('nav-portfolio-active');
		} 
	}        

	if(e.target.classList.contains('hamburger')) {
		document.querySelector('.navigation').classList.add('nav-opened');
		fpBtn.style.zIndex = '-1';
	}
	if((e.target.classList.contains('navigation') && e.target.classList.contains('nav-opened')) || e.target.classList.contains('close-btn')){
		document.querySelector('.navigation').classList.remove('nav-opened');
		fpBtn.style.zIndex = '100';
	}
});


let items = 3;
if(window.innerWidth <= 650) {
	items = 1;
}
document.addEventListener('DOMContentLoaded', function() {
	var elems = document.querySelectorAll('.carousel');
	M.Carousel.init(elems, {numVisible: items, dist:-50, padding: 10});
});

document.addEventListener('DOMContentLoaded', function() {
	var elems = document.querySelectorAll('select');
	M.FormSelect.init(elems);
});

document.addEventListener('DOMContentLoaded', function() {
	var elems = document.querySelectorAll('.tooltipped');
	M.Tooltip.init(elems, {
		margin: -5,
		enterDelay: 100
	});
});

document.addEventListener('DOMContentLoaded',()=>{
	const pageLoad = document.querySelector('#page-loader');
	pageLoad.style.animation =  'fade-out-bck 0.7s cubic-bezier(0.250, 0.460, 0.450, 0.940) both';
	setTimeout(()=>{
		pageLoad.style.display = 'none';
	}, 700);
});
