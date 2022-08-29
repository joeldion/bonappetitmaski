"use strict";

let locationsBAM = [];
let locationsHP = [];
const jsonDataFiles = {
    'BAM': {
        'fileURL': bamGlobals.bamJsonURL,
        'locationsArray': locationsBAM
    },
    'HP': {
        'fileURL': bamGlobals.hpJsonURL,
        'locationsArray': locationsHP
    }    
};

(function ($) {

    // Get map locations from JSON files
    for (let key in jsonDataFiles) {
        let file = jsonDataFiles[key];
        $.getJSON(file.fileURL, function(data) {
            $.each(data, function(key, val) {
                file.locationsArray.push(val);
            });
            // console.log(file.locationsArray);
        });
    }

})(jQuery);

window.onload = function() {

    // Menu anchors
    const navItems = document.querySelectorAll(".nav__item > a");
    for (let i = 0; i < navItems.length; i++) {
        let target = navItems[i].dataset.target;
        navItems[i].addEventListener("click", function(e) {
            e.preventDefault();
            document.querySelector(target).scrollIntoView({
                behavior: "smooth",
                block: "start",
            });
        });
    }

    // Images lazy load
    // const cardImages = document.querySelectorAll('.card__logo img');
    // for (let i = 0; i < cardImages.length; i++) {
    //     let img = cardImages[i];
    //     img.src = img.dataset['src'];
    //     img.srcset = img.dataset['srcset'];
    // }

    // Back to top button
    const backToTop = document.getElementById("back-to-top");
    window.onscroll = function() {
        let windowTop = window.pageYOffset;
        if (windowTop > 800) {
            backToTop.classList.add("active");
        } else {
            backToTop.classList.remove("active");
        }
    };
    backToTop.addEventListener("click", function(e) {
        e.preventDefault();
        window.scroll({
            top: 0,
            left: 0,
            behavior: "smooth",
        });
    });

};

/*
 * Google Map
*/
window.addEventListener(
    "resize",
    function(e) {
        setTimeout(initMap(), 1000);
    },
    true
);

let markerCategories = { 'hp': true, 'bam': true };

function initMap() {   

    setTimeout(function() {

        let mapZoom = 11;
        if (window.innerWidth <= 900) mapZoom = 10;

        const mapTypeStyles = [{
            featureType: "all",
            elementType: "labels.text.fill",
            stylers: [
                {
                    color: "#124c3c",
                },
            ],
        }, ];

        const mapOptions = {
            center: {
                lat: 46.4155250,
                lng: -72.969765
            },
            zoom: mapZoom,
            mapTypeId: "roadmap",
            mapTypeControl: false,
            styles: mapTypeStyles
        };
        const mapProd = new google.maps.Map(document.getElementById("map-prod"), mapOptions);

        let markerOptions,
            marker,
            infoWindow,
            infoWindowContent;

        let locationsDataHP = {
            'data': locationsHP,
            'icon': bamGlobals.iconURL + 'icon-map-hangart-2.png',
            'color': '#994488',
            'suffix': 'hp'
        };
        let locationsDataBAM = {
            'data': locationsBAM,
            'icon': bamGlobals.iconURL + 'icon-map-bam.png',
            'color': '#124c3c',
            'suffix': 'bam'
        };
        let locations = [];
        if (markerCategories.hp) locations.push(locationsDataHP);
        if (markerCategories.bam) locations.push(locationsDataBAM);

        for (let key in locations) {
            let locationsData = locations[key];
            let markerIcon = locationsData.icon;    

            for (let location of locationsData.data) {
                
                markerOptions = {
                    position: new google.maps.LatLng(location.lat, location.lng),
                    optimized: false,
                    // animation: google.maps.Animation.DROP,
                };
                marker = new google.maps.Marker(markerOptions);
                marker.setMap(mapProd);
                // marker.setLabel(location.title);
                // marker.setIcon('https://bonappetitmaski.com/wp-content/themes/bonappetitmaski/img/icons/icon-map-prod-2.png');
                marker.setIcon(markerIcon);
        
                infoWindow = new google.maps.InfoWindow();
        
                (function(marker, location) {
                    google.maps.event.addListener(marker, "click", function(e) {
                        infoWindowContent = "<div class='marker marker--" + locationsData.suffix + "' style='width:150px;min-height:100px'>";
                        infoWindowContent += "<h4 class='marker__title marker__title--" + locationsData.suffix + "'>" + location.title + "</h4>";
                        infoWindowContent += "<span class='marker__address'><a href='" + location.gmap + "' target='_blank'>" + location.address + "</a></span>";
                        infoWindowContent += "<span class='marker__phone'><a href='tel:+1" + location.phone.replace(/\-|\s/g, "") + "'>" + location.phone + "</a></span>";
                        infoWindowContent += "<span class='marker__website'><a href='" + location.website + "' target='_blank'>En savoir plus</a></span>";
                        infoWindowContent += "</div>";
                        infoWindow.setContent(infoWindowContent);
                        infoWindow.open(mapProd, marker);
                    });
                })(marker, location);
            }

        }

    }, 250);

}

// Google Map Filters
const filters = document.querySelectorAll('.filter');
for (let i = 0; i < filters.length; i++) {
    filters[i].addEventListener('click', function(){
        let cat = filters[i].dataset.cat;
        let checkbox = filters[i].querySelector('.filter__checkbox');
        if (!markerCategories[cat]) {
            markerCategories[cat] = true;
            checkbox.classList.remove('unchecked');
        } else {
            markerCategories[cat] = false;
            checkbox.classList.add('unchecked');
        }
        initMap();
    });
    
}