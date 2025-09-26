function lazyLoad() {
  var lazyLoadImages = document.querySelectorAll('img[loading="lazy"], img[decoding="async"]');
  lazyLoadImages.forEach(function(image) {
    if (image.getBoundingClientRect().top <= window.innerHeight && image.getBoundingClientRect().bottom >= 0 && getComputedStyle(image).display !== 'none') {
      
      /* image.src = image.dataset.src; */
      
      image.classList.add('is-loaded');
    }
  });

}

document.addEventListener('DOMContentLoaded', function() {
  window.addEventListener('DOMContentLoaded', lazyLoad);
  window.addEventListener('scroll', lazyLoad);
  window.addEventListener('resize', lazyLoad);
  window.addEventListener('orientationchange', lazyLoad);
});

