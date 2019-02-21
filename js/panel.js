var image_index = 0;
xsb_image_slide();

function xsb_image_slide() {
        var i;
        var x = document.getElementsByClassName("xsb_image_slide");
        for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";  
        }
        
        image_index++;
        
        if (image_index > x.length) 
        {
                image_index = 1
                
        }
        x[image_index-1].style.display = "block";  
        
        setTimeout(xsb_image_slide, 2000); // Change image every 2 seconds
}
