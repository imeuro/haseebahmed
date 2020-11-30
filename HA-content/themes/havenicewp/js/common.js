const bodyClassList = document.body.classList;
let sw = document.body.offsetWidth;

const mainCarousel = document.getElementById('Qtarget');
const postCarousel = document.getElementById('allPostIMG');
const filterCatMenu = document.getElementById('catMenu');
const filterTagMenu = document.getElementById('tagMenu');
const filterClear = document.getElementById('clearAllFilters');

/* 100vh fix for mobile browsers
   https://css-tricks.com/the-trick-to-viewport-units-on-mobile/ */
let vh = window.innerHeight * 0.01;
document.documentElement.style.setProperty('--vh', `${vh}px`);
// css: 
// height: 100vh; /* Fallback for below */
// height: calc(var(--vh, 1vh) * 100);


/*** for the homepage: ***/
if (bodyClassList.contains('home')) {
	/* start carousel instance */
	// if (sw > 768) {
		var flkty = new Flickity( mainCarousel, { 
			pageDots: false, 
			rightToLeft: true,
			watchCSS: true,
			arrowShape: 'm75.7576 83.986c0-1.4286-6.9697-9.8214-15.1515-18.5714l-15.4546-15.7143 15.4546-15.5357c15.4545-15.8929 18.1818-20.7143 11.2121-20.5358-6.6667.1786-47.5758 31.25-47.5758 36.0715 0 3.0357 7.8788 10 23.0303 20.7143 22.7273 16.0714 28.4849 18.75 28.4849 13.5714z'
		});
	// }


	/* default implementation of Glightbox: */
	var lightbox = GLightbox({
		skin: 'HAvenice',
		touchNavigation: false,
		keyboardNavigation: false,
		width: '100vw',
		height: window.innerHeight,
		loop: false,
		draggable: false,
		autoplayVideos: false,
		closeButton: true,
		closeOnOutsideClick: true
	});


	document.addEventListener('DOMContentLoaded', (event) => {
		var checkboxes = document.querySelectorAll("input[type=checkbox][name=categories],input[type=checkbox][name=tags]");
		checkboxes.forEach(function(checkbox) {
			checkbox.addEventListener('change', function() {
				queryBE();
			});
		});
		filterClear.addEventListener('click', function() {
			checkboxes.forEach(function(checkbox) {
				checkbox.checked=false;
			});
			filternav.parentNode.classList.remove('toggled');
			queryBE();
		});
		// reveal/hide tags filter
		const filternav = document.querySelector('#steps-navigation button');
		filternav.addEventListener('click', function() {
			filternav.parentNode.classList.toggle('toggled');
		});

	});


	/*** FILTERED RESULTS ***/

	// GENERATE FRONTEND
	let genFE = (data,mainCarousel) => {
		let out = '';
		data.forEach( function(element, index) {
			console.debug({element});
			let bordercat = ' border-color-'+element.categories_slug[0];
			let singlebordercat = '';
			if (element.categories_slug.length > 1) {
				bordercat  = '" style="border-image-slice: 1; border-image-source: linear-gradient(90deg, ';
				element.categories_slug.forEach( (e, i) => {
					singlebordercat += element.categories_colors[i]+',';
					console.debug(singlebordercat.slice(0, -1));
				});
				bordercat += singlebordercat.slice(0, -1);
				bordercat += ')';
			}
			out += `
				<figure id="post-${element.id}" class="carousel-cell carousel-reloaded category-${element.categories_slug[0]}">
					<a class="glightbox${bordercat}" href="${element.link}" rel="bookmark">
						<div class="entry-header">
							${element.excerpt.rendered}
						</div>
						<p class="entry-date">22 Nov</p>
						<img class="carousel-cell-image" src="${uPath}/${element.better_featured_image.media_details.file}" width="${element.better_featured_image.media_details.width}" height="${element.better_featured_image.media_details.height}" />
					</a>
				</figure>
			`
		});
		// write to target:
		mainCarousel.innerHTML = out;
		// reinit carousel
		var flkty = new Flickity( mainCarousel, {  
			pageDots: false, 
			rightToLeft: true,
			watchCSS: true,
			arrowShape: 'm75.7576 83.986c0-1.4286-6.9697-9.8214-15.1515-18.5714l-15.4546-15.7143 15.4546-15.5357c15.4545-15.8929 18.1818-20.7143 11.2121-20.5358-6.6667.1786-47.5758 31.25-47.5758 36.0715 0 3.0357 7.8788 10 23.0303 20.7143 22.7273 16.0714 28.4849 18.75 28.4849 13.5714z'
		});
		// reinit lightbox
		var lightbox = GLightbox({
			skin: 'HAvenice',
			touchNavigation: false,
			keyboardNavigation: false,
			width: '100vw',
			height: '100vh',
			loop: false,
			draggable: false,
			autoplayVideos: false,
			closeButton: true,
			closeOnOutsideClick: true
		});
	}

	// [WP-REST] QUERY POSTS
	let queryBE = () => { 
		let checkedCatchecks = filterCatMenu.querySelectorAll(':checked');
		let checkedTagchecks = filterTagMenu.querySelectorAll(':checked');
		let checkCatIDs = '';
		let checkTagIDs = '';
		Array.from(checkedCatchecks).forEach( function(element, index) {
			console.debug({element});
			checkCatIDs += element.value+','
		});
		Array.from(checkedTagchecks).forEach( function(element, index) {
			console.debug({element});
			checkTagIDs += element.value+','
		});
		checkCatIDs = checkCatIDs.slice(0, -1);
		checkTagIDs = checkTagIDs.slice(0, -1);
		console.debug({checkCatIDs});
		console.debug({checkTagIDs});
	    fetch(qPath+'?categories='+checkCatIDs+'&tags='+checkTagIDs,{
			method: "GET",
		    body: JSON.stringify(this.data),
	    })
	    .then((response) => response.json())
	    .then((data) => {
	      if (data) {
	      	// destroy original carousel
	      	flkty.destroy();
	      	genFE(data,mainCarousel);
	      }
	    })
	    .catch((error) => {
	      console.log('[HAfilter]');
	      console.error(error);
	    });
	}
}

/*** for the post: ***/
if (bodyClassList.contains('single-post')) {
	var flkty = new Flickity( postCarousel, { 
  		adaptiveHeight: true,
  		prevNextButtons: true,
  		fullscreen: true,
  		arrowShape: 'm75.7576 83.986c0-1.4286-6.9697-9.8214-15.1515-18.5714l-15.4546-15.7143 15.4546-15.5357c15.4545-15.8929 18.1818-20.7143 11.2121-20.5358-6.6667.1786-47.5758 31.25-47.5758 36.0715 0 3.0357 7.8788 10 23.0303 20.7143 22.7273 16.0714 28.4849 18.75 28.4849 13.5714z'
	});
}

/*** set/get cookie for landing page ***/
function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function eraseCookie(name) {   
    document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

if (bodyClassList.contains('home')) {
	var HALanding_lightbox = GLightbox({
		elements: [{
            'href': hPath+'/landing-page/'
        }],
		skin: 'HAvenice',
		touchNavigation: false,
		keyboardNavigation: false,
		width: '100vw',
		height: window.innerHeight,
		loop: false,
		draggable: false,
		autoplayVideos: false,
		closeButton: true,
		closeOnOutsideClick: true
	});

	var HAcookie = getCookie('HALanding');
	console.debug(HAcookie);
	if (!HAcookie) {
		setCookie('HALanding','1',365);
		HALanding_lightbox.open();
	} else if (HAcookie <= 10) {
	    setCookie('HALanding',parseInt(HAcookie)+1,365);
	    HALanding_lightbox.open();
	} else {
		setCookie('HALanding','done',365);
	}
}