const mainCarousel = document.getElementById('Qtarget');
const filterCatMenu = document.getElementById('catMenu');
const filterTagMenu = document.getElementById('tagMenu');


/* 100vh fix for mobile browsers
   https://css-tricks.com/the-trick-to-viewport-units-on-mobile/ */
let vh = window.innerHeight * 0.01;
document.documentElement.style.setProperty('--vh', `${vh}px`);
// css: 
// height: 100vh; /* Fallback for below */
// height: calc(var(--vh, 1vh) * 100);


/* start carousel instance */
var flkty = new Flickity( mainCarousel, { 
	setGallerySize: false, 
	lazyLoad: 2, 
	contain: true, 
	pageDots: false, 
	wrapAround: true, 
	groupCells: false 
});


/* default implementation of Glightbox: 
var lightbox = GLightbox({
	skin: 'HAvenice',
	touchNavigation: false,
	keyboardNavigation: false,
	width: '90vw',
	height: '80vh',
	loop: false,
	draggable: false,
	autoplayVideos: true
});
*/

document.addEventListener('DOMContentLoaded', (event) => {
	var checkboxes = document.querySelectorAll("input[type=checkbox][name=categories],input[type=checkbox][name=tags]");
	checkboxes.forEach(function(checkbox) {
  		checkbox.addEventListener('change', function() {
  			queryBE();
  		});
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
		setGallerySize: false, 
		contain: true, 
		pageDots: false, 
		wrapAround: true, 
		groupCells: false 
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