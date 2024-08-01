function extractVideoID(e){let t=e.match(/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/);return t&&11===t[2].length?t[2]:null}function setupYoutubeEmbeds(e,t){let o=document.querySelectorAll(`.${e}`),u=document.querySelectorAll(`.${t}`);o.forEach((e,t)=>{let o=e.textContent.trim();if(o){let a=extractVideoID(o);if(a&&u[t]){let i=document.createElement("div");i.className="youtube-facade",i.setAttribute("data-video-id",a);let r=document.createElement("div");r.className="youtube-facade-thumbnail";let n=document.createElement("img");n.src=`https://img.youtube.com/vi/${a}/hqdefault.jpg`,n.alt="Video Thumbnail",r.appendChild(n),i.appendChild(r);let l=document.createElement("div");l.className="youtube-facade-play-button",i.appendChild(l),i.addEventListener("click",function(){let e=document.createElement("iframe");e.setAttribute("width","100%"),e.setAttribute("src",`https://www.youtube.com/embed/${a}?autoplay=1&si=83oiblxyjFLcMFmN`),e.setAttribute("frameborder","0"),e.setAttribute("allow","accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"),e.setAttribute("allowfullscreen","true"),this.parentNode.replaceChild(e,this)}),u[t].parentNode.replaceChild(i,u[t])}}})}function debounce(e,t){let o;return function u(...a){let i=()=>{clearTimeout(o),e(...a)};clearTimeout(o),o=setTimeout(i,t)}}function runSetup(){setupYoutubeEmbeds("link","youtube-iframe"),setupYoutubeEmbeds("link-overview","youtube-iframe-overview"),setupYoutubeEmbeds("link-speciality","youtube-iframe-speciality"),setupYoutubeEmbeds("link-patient","youtube-iframe-patient")}const debouncedRunSetup=debounce(runSetup,300);runSetup();const observer=new MutationObserver(()=>{debouncedRunSetup()});observer.observe(document.body,{childList:!0,subtree:!0});const style=document.createElement("style");style.textContent=`
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
`,document.head.appendChild(style);