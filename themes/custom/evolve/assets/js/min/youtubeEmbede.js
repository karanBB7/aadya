function extractVideoID(url) {
    const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
    const match = url.match(regExp);
    return (match && match[2].length === 11) ? match[2] : null;
}

function setupYoutubeEmbeds(linkClass, iframeClass) {
    const links = document.querySelectorAll(`.${linkClass}`);
    const iframes = document.querySelectorAll(`.${iframeClass}`);

    links.forEach((link, index) => {
        const youtubeLink = link.textContent.trim();
        if (youtubeLink) {
            const videoID = extractVideoID(youtubeLink);
            if (videoID && iframes[index]) {
                const facade = document.createElement('div');
                facade.className = 'youtube-facade';
                facade.setAttribute('data-video-id', videoID);

                const thumbnail = document.createElement('div');
                thumbnail.className = 'youtube-facade-thumbnail';
                const img = document.createElement('img');
                img.src = `https://img.youtube.com/vi/${videoID}/hqdefault.jpg`;
                img.alt = 'Video Thumbnail';
                thumbnail.appendChild(img);
                facade.appendChild(thumbnail);

                const playButton = document.createElement('div');
                playButton.className = 'youtube-facade-play-button';
                facade.appendChild(playButton);

                facade.addEventListener('click', function() {
                    const iframe = document.createElement('iframe');
                    iframe.setAttribute('width', '100%');
                    // iframe.setAttribute('height', '100%');
                    iframe.setAttribute('src', `https://www.youtube.com/embed/${videoID}?autoplay=1&si=83oiblxyjFLcMFmN`);
                    iframe.setAttribute('frameborder', '0');
                    iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
                    iframe.setAttribute('allowfullscreen', 'true');

                    this.parentNode.replaceChild(iframe, this);
                });

                iframes[index].parentNode.replaceChild(facade, iframes[index]);
            }
        }
    });
}

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function runSetup() {
    setupYoutubeEmbeds('link', 'youtube-iframe');
    setupYoutubeEmbeds('link-overview', 'youtube-iframe-overview');
    setupYoutubeEmbeds('link-speciality', 'youtube-iframe-speciality');
    setupYoutubeEmbeds('link-patient', 'youtube-iframe-patient');
}

const debouncedRunSetup = debounce(runSetup, 300);

runSetup();

const observer = new MutationObserver(() => {
    debouncedRunSetup();
});

observer.observe(document.body, { childList: true, subtree: true });

// Add CSS for facade elements
const style = document.createElement('style');
style.textContent = `
.youtube-facade {
    position: relative;
    width: 100%;
    padding-bottom: 56.25%; 
    background-color: #000;
    cursor: pointer;
}
.youtube-facade-thumbnail {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
.youtube-facade-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}
.youtube-facade-play-button {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 68px;
    height: 48px;
    background-color: rgba(0,0,0,0.7);
    border-radius: 14px;
}
.youtube-facade-play-button::before {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border-style: solid;
    border-width: 15px 0 15px 26px;
    border-color: transparent transparent transparent white;
}
`;
document.head.appendChild(style);

