$(document).ready(function(){
    $('#show-layouts').on('click', '.remove-layout', function() {
        var item = $(this).parent();
        var dataId = item.attr('data-id');

        /*$.ajax({
            type: 'POST',
            url: '/ajax/remove_layout.php',
            cache: false,
            data: {
                id : dataId
            },
            dataType: 'JSON',
            success: function(data) {
                if (data.avalib > 0) {
                    $('#no-layouts > div > span').text(data.avalib);
                    $('#no-layouts').show();
                    $('#upload-box').attr('data-max', data.avalib);
                    item.remove();
                }
            }
        });*/
    });

    $('#upload-layouts').colorbox({inline: true, width: '800px'});

    $('.selectOne:first').attr('checked', 'checked');

    $('body').on('click', '.moreImg', function(){
        var nextNum = parseInt($('.hereImg').attr('data-num')) + 1;
        $(this).removeClass('moreImg').addClass('delImg').text('Убрать фото');
        $('.hereImg').attr('data-num', nextNum);
        $('.hereImg').before('<div class="imgInput"><a class="moreImg">Ещё фото</a><input type="file" name="file'+ nextNum +'"></div>');
    });

    $('body').on('click', '.delImg', function(){
        $(this).parent().remove();
    });

    function reCountCost() {

        var result = 0;
        var printingNumber = parseInt($('#printing-number').val());
        var printingTypeCost = parseFloat($('#printingType option:selected').attr('data-cost'));


        var extraCost = 0;
        if($('.type_tmpl_block').length){
            var printingTypeSide = $('#printingType option:selected').attr('data-side');
            if(printingTypeSide=='2'){
                $('.type_tmpl_block').show();
            }else{
                $('.type_tmpl_block').hide();
            }
        }

        $('.extraCost,.selectOne,input[name="paper_type"]:radio').each(function(){
            if($(this).prop('checked')){
                extraCost += parseFloat($(this).attr('data-cost'));
            }
        });


        if (printingTypeCost == 0) {
            $('.noPrinting').show();
        } else {


            result = (printingTypeCost + extraCost) * printingNumber;
            $('.noPrinting').hide();
        }

        $('#totalCost').text(result.toFixed(2));
    }

    $('#changePaper').click(function(event){
        event.preventDefault();
        $('#paper-list-block').slideToggle(300);
    });

    $('#printingType').on('change', function(){
        var type_print =  $('#printingType option:selected').text();
        $('#type_side').val($('#printingType option:selected').attr('data-side'));
        if(type_print.match(/.*1000/)){
            $('.extraCost,.selectOne').each(function(){
                $(this).attr('data-cost',$(this).attr('data-cost2'));
                var new_cost = $(this).attr('data-cost');

                $(this).next('label').children('span').html('( +' + new_cost +' грн. за комплект)');
            });
            $('input[name="paper_type"]:radio').each(function(){
                $(this).attr('data-cost',$(this).attr('data-cost2'));
                var new_cost = $(this).attr('data-cost');

                $(this).parent().parent().find('.addCost').html('( +' + new_cost +' грн. за комплект)');
            });

        }else{
            $('.extraCost,.selectOne').each(function(){
                $(this).attr('data-cost',$(this).attr('data-cost1'));
                var new_cost = $(this).attr('data-cost');

                $(this).next('label').children('span').html('( +' + new_cost +' грн. за комплект)');
            });
            $('input[name="paper_type"]:radio').each(function(){
                $(this).attr('data-cost',$(this).attr('data-cost1'));
                var new_cost = $(this).attr('data-cost');

                $(this).parent().parent().find('.addCost').html('+' + new_cost +' грн. за комплект');
            });




        }
        reCountCost();
    });

    $('#printing-number').on('keyup', function(){
        reCountCost();
    });

    $('.extraCost').on('click', function(){
        reCountCost();
    });

    $('.selectOne').change(function(){
        reCountCost();
    });

    $('input[name="paper_type"]:radio').on('change', function(){
        reCountCost();
        var paperName = $(this).next('label').text();
        var paperInfo = paperName + ' (+' + parseFloat($(this).attr('data-cost')) + ' грн)';
        $('#showPaperType').children('span').text(paperInfo);
        $('#selected_type_paper').attr('value','success').trigger('change');
    });

    $(window).load(function(){
        if($('#offset_tpl').length){
            var offset = parseInt($('#offset_tpl').val());
            var height = $('#height_tpl').val();
            var width = $('#width_tpl').val();

            $('#cardMainEditor').css('height',height+'px');
            $('#cardMainEditor').css('width',width+'px');
            $('#cardEditorField').css('margin',offset+'px');
            $('#cardEditorField').css('height',(parseInt($('#cardMainEditor').height()) - offset*2)+'px');
        }
    })
});