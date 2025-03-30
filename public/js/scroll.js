document.addEventListener('DOMContentLoaded', function () {
    const mainContent = document.querySelector('.content-wrapper'); // Or whatever contains your main content
    const adContainer = document.querySelector('.ad-container');

    window.addEventListener('scroll', function () {
// Calculate how far down the page we've scrolled as a percentage
        const scrollPercentage = window.scrollY / (document.body.scrollHeight - window.innerHeight);

// Calculate how far we should scroll the ad container
        const adScrollAmount = (adContainer.scrollHeight - adContainer.clientHeight) * scrollPercentage;

// Apply the scroll to the ad container
        adContainer.style.position = 'sticky';
        adContainer.scrollTop = adScrollAmount;
    });
});
