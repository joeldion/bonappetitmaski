'use strict';

const googleMap = typeof google !== 'undefined' ? true : false;

window.onload = function() {
    initMap();
}

/*
 *  Get coordinates
 */
function initMap() {

    if (!googleMap) return false;

    const address = document.getElementById('bam-address');
    const city = document.getElementById('bam-city');
    const postalCode = document.getElementById('bam-postal-code');
    const addressFields = document.querySelectorAll('#bam-address, #bam-city, #bam-postal-code');
    const coordinates = document.getElementById('bam-coord');
    let geocoder = new google.maps.Geocoder();

    /*
     *  Update coordinates (producteurs)
     */
    if (coordinates !== null) {

        function getCoord() {

            const fullAddress = address.value + ', ' + city.value + ' ' + postalCode.value + ' QC Canada';
    
            console.log(fullAddress);
    
            geocoder.geocode({
                'address': fullAddress,
            }, function(results) {
                let coord = results[0].geometry.viewport;
                let latObj = Object.values(coord)[0];
                let lngObj = Object.values(coord)[1];
                let lat = Object.values(latObj)[0];
                let lng = Object.values(lngObj)[1];
                let coordValue = lat + ',' + lng;
                coordinates.setAttribute('value', coordValue);              
            });
    
        }
    
        getCoord();
    
        for (let i = 0; i < addressFields.length; i++) {
            addressFields[i].addEventListener('change', function(){
                getCoord();
            });
        }

    }

}


/*
 * Media Uploader
 */

(function ($) {
    let mediaUploader;

    // Top Image Upload
    const menuUploadBtn = document.getElementById('bam-media-upload');
    // const menuRemove = document.getElementById('bam-media-remove');
    const menuInput = document.getElementById('bam-resto-menu');
    const menuFileName = document.getElementById('bam-media-name');
    // const menuPreview = document.getElementById('bam-menu-preview');
    let attachment = '';

    if (menuUploadBtn === null) return;

    menuUploadBtn.addEventListener('click', function (e) {
        console.log(this);
        e.preventDefault();

        if (mediaUploader) {
            mediaUploader.open();
            return;
        }

        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choisir un document',
            button: {
                text: 'Choisir ce document',
            },
            multiple: false,
        });

        mediaUploader.on('select', function () {
            attachment = mediaUploader.state().get('selection').first().toJSON();
            menuInput.value = attachment.id;
            menuFileName.innerText = 'Fichier sélectionné : "' + attachment.filename + '"';
            // menuPreview.style.backgroundImage = 'url(' + attachment.url + ')';
            menuRemove.classList.add('visible');
            
        });

        mediaUploader.open();
    });

    // menuRemove.addEventListener('click', function (e) {
    //     e.preventDefault();
    //     console.log(this);
    //     menuInput.value = '';
    //     menuFileName.innerText = '';
    //     // menuPreview.style.backgroundImage = 'url()';
    //     menuRemove.classList.remove('visible');
    // });
})(jQuery);
