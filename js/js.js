/**
 * Created by Жира on 01.02.2016.
 */
$(document).ready(function() {
    $("#carousel").owlCarousel()
});

$("#carousel").owlCarousel({
items:1,
    navigation:true,
    loop:false,
    singleitem:true,
    autoplay:true
});

//var slider = document.getElementById('price-filter');
//
//noUiSlider.create(slider, {
//    start: [20, 80],
//    connect: true,
//    range: {
//        'min': 0,
//        'max': 100
//    }
//});
var slider = document.getElementById('price');

noUiSlider.create(slider, {
    start: [0, 100],
    connect: true,
    range: {
        'min': 0,
        'max': 100
    }
});
var valueInput = document.getElementById('value-min'),
    valueMax = document.getElementById('value-max');

// When the slider value changes, update the input and span
slider.noUiSlider.on('update', function( values, handle ) {
    if ( handle ) {
        valueMax.value = values[handle];
    } else {
        valueInput.value = values[handle];
    }
});

// When the input changes, set the slider value
valueInput.addEventListener('change', function(){
    slider.noUiSlider.set([null, this.value]);
});
valueMax.addEventListener('change', function(){
    slider.noUiSlider.set([null, this.value]);
});