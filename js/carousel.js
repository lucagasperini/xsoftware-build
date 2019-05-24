window.onload = function() {
        xsb_carousel_btn(0);
};

var carousel_index = 0;

function xsb_carousel_btn(index) {
        var i;
        var x = document.getElementsByClassName("xsb_carousel_item");
        for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";  
        }
        if(carousel_index + index <= x.length - xs_build_carousel_range)
                carousel_index += index;
        
        if(carousel_index < 0)
                carousel_index = 0;
        
        for (i = 0; i < xs_build_carousel_range; i++) {
                x[carousel_index+i].style.display = "inline-block";
        }
} 
