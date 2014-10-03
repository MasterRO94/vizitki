function saveImage(name) {
    var image = $(".order_info_img");
    var height = image.height();
    var width = image.width();
    image.css({'width':'606px', 'height':'348px'});
    image.find('img').css({'width':'606px', 'height':'348px'});
    html2canvas(image, {
        onrendered: function(canvas) {
            theCanvas = canvas;
            var forCanvas = $('.forCanvas');
            forCanvas.append(canvas);

            // Convert and download as image
            // Canvas2Image.saveAsPNG(canvas);

            canvas.toBlob(function(blob) {
                saveAs(blob, name+".png");
            });

            // Clean up
            forCanvas.empty();
        }
    });
    image.css({'width': width+'px', 'height': height+'px'});
    image.find('img').css({'width': width+'px', 'height': height+'px'});

    return false;
}

/***** DOCUMENT READY *******/
$(function(){

    /********* SAVE IMAGE ***********/
    $('.saveImage').on('click', function(e){
        e.preventDefault();
        var name = $(this).data('name');
        saveImage(name);
    });


}); // END READY