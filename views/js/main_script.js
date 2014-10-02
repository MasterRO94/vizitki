function doImage() {
    html2canvas($("#cardMainEditor"), {
        onrendered: function(canvas) {
            theCanvas = canvas;
            document.body.appendChild(canvas);

            // Convert and download as image
            // Canvas2Image.saveAsPNG(canvas);

            var out = $("#img_out");

            out.append(canvas);

            /*var tmp = canvas.toDataURL("image/png");

            $.ajax({
                type: 'POST',
                url: '',
                data: {
                    doImage: true,
                    dataImg: tmp
                },
                success: function(result){

                }
            });*/



            out.append(Canvas2Image.convertToPNG(canvas));
            $('#img-out').val(out.find('img').attr('src'));

            // Clean up
            //document.body.removeChild(canvas);
        }
    });
}



$(document).ready(function(){



});// END READY