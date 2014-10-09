function saveImage(name) {
    html2canvas($(".order_info_img"), {
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