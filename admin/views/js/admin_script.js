function saveImage(name, block) {
    html2canvas(block, {
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

    var BaseURL = 'http://art-vitalis.com.ua/test/vizitki/admin/';


    /********* SAVE IMAGE ***********/
    $('.saveImage, .saveLayout').on('click', function(e){
        e.preventDefault();
        var name = $(this).data('name');
        var block = $(this).parent().prev();
        saveImage(name, block);
    });

    /********* DELETE ORDER FROM LIST ***********/
    var del_window = $('#delete_order_window');
    var close_del_window = $('#close, #no');
    var del_order_from_list = $('#yes');
    var open_del_window = $('.delete_order, #delete_order');
    var order_id;
    open_del_window.on('click', function(e){
        e.preventDefault();
        order_id = $(this).data('order');
        del_window.find('strong').text('№'+order_id);
        del_window.show(500);
    });
    close_del_window.on('click', function(){
        del_window.hide(500);
    });
    del_order_from_list.on('click', function(){
        $.ajax({
            url: BaseURL,
            type: 'POST',
            data: {
                order_id: order_id
            },
            success: function(result){
                if($.trim(result) == 'OK'){
                    $('#order-'+order_id).remove();
                    del_window.fadeOut(300);
                }
            }

        });
    });




}); // END READY