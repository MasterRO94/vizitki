$(document).ready(function() {
    var textField = $('#cardEditorField');
    var textControl = $('#textEditControl');
    var mainField = $('#cardMainEditor');

    $('#colorpickerHolder').ColorPicker({
        flat: true,
        color: '#000000',
        onSubmit: function(hsb, hex, rgb) {
            $('#colorSelector div').css('backgroundColor', '#' + hex);
            $('#colorpickerHolder').fadeOut(100);
            var color = tieTxtControl($('#colorpickerHolder'));
            color.css('color', '#' + hex);
        }
    });

    $('#colorSelector').on('click', function() {
        $('#colorpickerHolder').stop(true).fadeIn('slow');
    });

    $('#backgroundColorHolder').ColorPicker({
        flat: true,
        color: '#ffffff',
        onSubmit: function(hsb, hex, rgb) {
            $('#backgroundColorSelector div').css('backgroundColor', '#' + hex);
            $('#backgroundColorHolder').fadeOut(100);
            mainField.css('background', '#' + hex);
        }
    });

    $('#backgroundColorSelector').on('click', function() {
        $('#backgroundColorHolder').stop(true).fadeIn('slow');
    });

    $('.lineControl label').on('mouseup', function() {
        var itm = $(this);
        if (itm.children('input').is(':checked')) {
            textField.removeClass('safety_line');
        } else {
            textField.addClass('safety_line');
        }
    });

    var uid = function() {
        var id = Math.floor(Math.random() * 99999999);
        return id;
    };

    $('#sortableBlock').sortable({
        placeholder: "editorContolBlock_light",
        containment: '.sortableBlock',
        cursor: "crosshair",
        distance: 10,
        handle: ".hendl",
        stop: function(event, ui) {
            $('#sortableBlock').children('li').each(function() {
                if ($(this).data('img')) {
                    var sortImg = tieImgSort($(this));
                    sortImg.prependTo(mainField);
                } else {
                    var sortTxt = tieTxtSort($(this));
                    sortTxt.prependTo(textField);
                }
            });
        }
    });

    var tieImgSort = function(target) {
        var itmImg = target.attr('data-id'),
            secImg = mainField.find('[data-id="' + itmImg + '"]');
        return secImg;
    };

    var tieTxtSort = function(target) {
        var itmTxt = target.attr('data-id'),
            secTxt = textField.find('[data-id="' + itmTxt + '"]');
        return secTxt;
    };

    var tieTxt = function(target) {
        var itmp = target.closest('.editorContolBlock'),
            itmp_att = itmp.attr('data-id'),
            txtB = mainField.find('[data-id="' + itmp_att + '"]');
        return txtB;
    };

    var tieTxtControl = function(target) {
        var itmp = target.closest(textControl),
            itmp_att = itmp.attr('data-id'),
            txtB = textField.find('[data-id="' + itmp_att + '"]');
        return txtB;
    };

    var tieTxtBack = function(target) {
        var itmp_att = target.attr('data-id'),
            txtB = $('#sortableBlock').find('[data-id="' + itmp_att + '"]');
        return txtB;
    };

    var addTxt = function() {
        var id = uid();
        var li = $('<li>').addClass('editorContolBlock').attr('data-id', id),
            vis = $('<div>').addClass('visible'),
            hen = $('<div>').addClass('hendl'),
            del = $('<div>').addClass('delBtn'),
            inp = $('<input type="text" value="New text">');
        vis.appendTo(li);
        hen.appendTo(li);
        del.appendTo(li);
        inp.appendTo(li);
        li.prependTo('#sortableBlock');

        var txtm = $('<div>').addClass('txtMove').attr('data-id', id).text('New text');
        txtm.appendTo(textField);

        $('.txtMove').draggable({
            containment: "parent"
        });
        inp.focus();
    };

    var addImage = function() {
        var id = uid();
        var last_name = $('#new_photo').text();
        var li = $('<li>').addClass('editorContolBlock').attr('data-id', id).attr('data-name',last_name).data('img', true),
            vis = $('<div>').addClass('visible'),
            hen = $('<div>').addClass('hendl'),
            del = $('<div>').addClass('delBtn'),
            imgC = $('<div>').addClass('imgControl'),
            imgP = $('<div>').addClass('imgPreview');

        img = $('<img src="http://localhost/vizitki/views/images/templates/'+last_name+'">');
        img.appendTo(imgP);
        imgP.appendTo(imgC);
        imgC.appendTo(li);
        vis.appendTo(li);
        hen.appendTo(li);
        del.appendTo(li);
        li.prependTo('#sortableBlock');

        var imgCont = $('<div>').addClass('imgMove').attr('data-id', id);
        var imgm = $('<img src="http://localhost/vizitki/views/images/templates/'+last_name+'" alt="">');
        imgm.appendTo(imgCont);
        imgCont.appendTo(mainField);

        $('.imgMove').draggable().resizable();
    };

    $(document).on('keydown', function(e) {
        if (e.keyCode == 16) {
            textField.addClass('point');
        }
    }).on('keyup', function(e) {
        if (e.keyCode == 16) {
            textField.removeClass('point');
        }
    });

    $(document).on('click','.delBtn', function() {
        var del = $(this).parent('.editorContolBlock'),
            txtB = tieTxt($(this));
        del.addClass('lightSpeedOut');
        txtB.css({
            '-webkit-transform': 'scale(0.1)',
            '-moz-transform': 'scale(0.1)',
            '-ms-transform': 'scale(0.1)',
            '-o-transform': 'scale(0.1)',
            'transform': 'scale(0.1)'
        });
        $('<div class="disbl"></div>').appendTo(del);
        setTimeout(function() {
            del.remove();
            txtB.remove();
        }, 300);
    });

    $(document).on('click','.visible', function() {
        var vis = $(this).parent('.editorContolBlock'),
            itm = $(this),
            txtB = tieTxt(itm);
        if (itm.data('visi')) {
            itm.data('visi', false);
            vis.css('opacity', 1);
            vis.children('.disbl').remove();
            txtB.removeClass('hidden');
        } else {
            itm.data('visi', true);
            vis.css('opacity', 0.2);
            $('<div class="disbl"></div>').appendTo(vis);
            txtB.addClass('hidden');
        }
    });

    $('#addText').on('click touchstart', function(event) {
        event.preventDefault();
        addTxt();
    });

    $('.addimageBlock .editorBtn').on('click touchstart', function(event) {
        $(this).parent().children('.addImageField').fadeIn(300);
    });


    $('#addImage').on('click touchstart', function(event) {
        $(this).parent().parent().fadeOut(20);
    });


    $('#superframe').on('load',function(){
        if($('#new_photo').text()!=''){addImage();}
    });

    var setTxtParam = function(target, child) {
        textControl.children(child).find('option').prop('selected', false);
        textControl.children(child).find("option[value='" + target + "']").prop("selected", true);
        console.log(target);
    };

    var setTxtStyle = function(styleBtn, bool) {
        if (bool) {
            $(styleBtn).addClass('active');
        } else {
            $(styleBtn).removeClass('active');
        }
    };

    $(document).on('focus','.editorContolBlock input', function(event) {
        textField.removeClass('point');
        var focItm = tieTxt($(this)),
            fAtt = focItm.attr('data-id');
        focItm.addClass('edit');
        textControl.attr('data-id', fAtt).fadeIn(100);
        setTxtParam(focItm.css('font-family').replace(new RegExp("'", 'g'),''), '.chooseFont');
        setTxtParam(parseInt(focItm.css('font-size'), 10), '.chooseFontSize');
        $('#colorSelector div').css('background-color', focItm.css('color'));
        $('#colorpickerHolder').ColorPickerSetColor(focItm.css('color'));
        setTxtStyle('#txtBold', focItm.css('font-weight') === 'bold');
        setTxtStyle('#txtItalic', focItm.css('font-style') === 'italic');
        setTxtStyle('#txtUnder', focItm.css('text-decoration').split(" ")[0] === 'underline');

    });

    $(document).on('blur','.editorContolBlock input', function(event) {
        var focItm = tieTxt($(this));
        focItm.removeClass('edit');
    });

    $(document).on('keyup','.editorContolBlock input', function(event) {
        var focItm = tieTxt($(this));
        focItm.text($(this).val());
    });

    $(document).on('mouseenter','.txtMove', function() {
        var inp = tieTxtBack($(this));
        inp.children('input').addClass('edit');
    });

    $(document).on('dblclick','.txtMove', function() {
        var inp = tieTxtBack($(this));
        inp.children('input').focus();
    });

    $(document).on('mouseout','.txtMove', function(event) {
        var inp = tieTxtBack($(this));
        inp.children('input').removeClass('edit');
    });

    $(document).on('change','.chooseFont select', function() {
        var val = $(this).val().replace(new RegExp("'", 'g'),'');
        txtid = textControl.attr('data-id');
        textField.find('[data-id="' + txtid + '"]').css({
            'font-family': val
        });
    });

    $(document).on('change','.chooseFontSize select', function() {
        var val = $(this).val();
        txtid = textControl.attr('data-id');
        textField.find('[data-id="' + txtid + '"]').css({
            'font-size': val + 'px'
        });
    });

    $(document).on('click','#txtBold', function(event) {
        event.preventDefault();
        var th = $(this);
        var itm = tieTxtControl(th);
        if (th.hasClass('active')) {
            itm.css('font-weight', 'normal');
            th.removeClass('active');
        } else {
            itm.css('font-weight', 'bold');
            th.addClass('active');
        }
    });

    $(document).on('click','#txtItalic', function(event) {
        event.preventDefault();
        var th = $(this);
        var itm = tieTxtControl(th);
        if (th.hasClass('active')) {
            itm.css('font-style', 'normal');
            th.removeClass('active');
        } else {
            itm.css('font-style', 'italic');
            th.addClass('active');
        }
    });

    $(document).on('click','#txtUnder', function(event) {
        event.preventDefault();
        var th = $(this);
        var itm = tieTxtControl(th);
        if (th.hasClass('active')) {
            itm.css('text-decoration', 'none');
            th.removeClass('active');
        } else {
            itm.css('text-decoration', 'underline');
            th.addClass('active');
        }
    });

    /*--------------------------  SAVE  ------------------------------------ */

    $(document).on('click','#save', function(event) {
        event.preventDefault();
        var str = '';
        var itm = $('#sortableBlock li');
        var itmlen = itm.length;

        itm.each(function(i) {
            var liInWin = tieTxtSort($(this));
            var liImgWin = tieImgSort($(this));
            var liNew = {};
            liNew.data_id = $(this).attr('data-id');
            liNew.data_name = $(this).attr('data-name');
            liNew.data_type = $(this).data('img');
            liNew.data_vis = $(this).children('.visible').data('visi');
            liNew.data_value = $(this).children('input').val();
            liNew.style = liInWin.attr('style');
            liNew.styleImg = liImgWin.attr('style');
            str += JSON.stringify(liNew)+'|||';
        });
        var liCol = itmlen;
        str += JSON.stringify(liCol)+'|||';
        var color = $('#backgroundColorSelector div').css('background-color');
        str += JSON.stringify(color);
        $('#code_template').val(str);
    });

    $(document).on('click','#save1', function(event) {
        event.preventDefault();
        var str = '';
        var itm = $('#sortableBlock li');
        var itmlen = itm.length;

        itm.each(function(i) {
            var liInWin = tieTxtSort($(this));
            var liImgWin = tieImgSort($(this));
            var liNew = {};
            liNew.data_id = $(this).attr('data-id');
            liNew.data_name = $(this).attr('data-name');
            liNew.data_type = $(this).data('img');
            liNew.data_vis = $(this).children('.visible').data('visi');
            liNew.data_value = $(this).children('input').val();
            liNew.style = liInWin.attr('style');
            liNew.styleImg = liImgWin.attr('style');
            str += JSON.stringify(liNew)+'|||';
        });
        var liCol = itmlen;
        str += JSON.stringify(liCol)+'|||';
        var color = $('#backgroundColorSelector div').css('background-color');
        str += JSON.stringify(color);
        $('#code_template1').val(str);
    });
    /*-----------------------------------------INIT------------------------------*/

    if($('.init_template').length){
        var str = $('#code_template').val().split('|||');
        var liC = JSON.parse(str[str.length-2]);
        var color = JSON.parse(str[str.length-1]);

        $('#backgroundColorSelector div').css('background-color', color);
        mainField.css('background-color', color);
        if (liC > 0) {
            for (var c = 0; c < liC; c++) {
                var liItm = JSON.parse(str[c]);
                if (liItm.data_type === true) {
                    var liImg = $('<li>').addClass('editorContolBlock').attr('data-id', liItm.data_id).attr('data-name', liItm.data_name).data('img', true),
                        visImg = $('<div>').addClass('visible'),
                        henImg = $('<div>').addClass('hendl'),
                        delImg = $('<div>').addClass('delBtn'),
                        imgC = $('<div>').addClass('imgControl'),
                        imgP = $('<div>').addClass('imgPreview');
                    if (liItm.data_vis === true) {
                        visImg.data('visi', true);
                        li.css('opacity', 0.2);
                    }

                    img = $('<img src="http://localhost/vizitki/views/images/templates/'+liItm.data_name+'">');
                    img.appendTo(imgP);
                    imgP.appendTo(imgC);
                    imgC.appendTo(liImg);
                    visImg.appendTo(liImg);
                    henImg.appendTo(liImg);
                    delImg.appendTo(liImg);
                    liImg.appendTo('#sortableBlock');

                    var imgCont = $('<div>').addClass('imgMove').attr('style', liItm.styleImg).attr('data-id', liItm.data_id);
                    var imgm = $('<img src="http://localhost/vizitki/views/images/templates/'+liItm.data_name+'" alt="">');
                    imgm.appendTo(imgCont);
                    imgCont.appendTo(mainField);

                    $('.imgMove').draggable().resizable();

                } else {
                    var li = $('<li>').addClass('editorContolBlock').attr('data-id', liItm.data_id),
                        vis = $('<div>').addClass('visible'),
                        hen = $('<div>').addClass('hendl'),
                        del = $('<div>').addClass('delBtn'),
                        inp = $('<input type="text" value="' + liItm.data_value + '">');
                    if (liItm.data_vis === true) {
                        vis.data('visi', true);
                        li.css('opacity', 0.2);
                    }
                    vis.appendTo(li);
                    hen.appendTo(li);
                    del.appendTo(li);
                    inp.appendTo(li);
                    li.appendTo('#sortableBlock');

                    var txtm = $('<div>').addClass('txtMove').attr('style', liItm.style).attr('data-id', liItm.data_id).text(liItm.data_value);
                    txtm.prependTo(textField);
                    $('.txtMove').draggable({
                        containment: "parent"
                    });
                }
            }
        }
    }

    $(document).on('click','#front_side',function(){
        if(!$(this).hasClass('active')){
            $('#back_side').removeClass('active');
            $('#save1').attr('id','save');
            $('.delBtn').trigger('click');
            $(this).addClass('active');
            var str = $('#code_template').val().split('|||');
            var liC = JSON.parse(str[str.length-2]);
            var color = JSON.parse(str[str.length-1]);

            $('#backgroundColorSelector div').css('background-color', color);
            mainField.css('background-color', color);
            if (liC > 0) {
                for (var c = 0; c < liC; c++) {
                    var liItm = JSON.parse(str[c]);
                    if (liItm.data_type === true) {
                        var liImg = $('<li>').addClass('editorContolBlock').attr('data-id', liItm.data_id).attr('data-name', liItm.data_name).data('img', true),
                            visImg = $('<div>').addClass('visible'),
                            henImg = $('<div>').addClass('hendl'),
                            delImg = $('<div>').addClass('delBtn'),
                            imgC = $('<div>').addClass('imgControl'),
                            imgP = $('<div>').addClass('imgPreview');
                        if (liItm.data_vis === true) {
                            visImg.data('visi', true);
                            li.css('opacity', 0.2);
                        }

                        img = $('<img src="http://localhost/vizitki/views/images/templates/'+liItm.data_name+'">');
                        img.appendTo(imgP);
                        imgP.appendTo(imgC);
                        imgC.appendTo(liImg);
                        visImg.appendTo(liImg);
                        henImg.appendTo(liImg);
                        delImg.appendTo(liImg);
                        liImg.appendTo('#sortableBlock');

                        var imgCont = $('<div>').addClass('imgMove').attr('style', liItm.styleImg).attr('data-id', liItm.data_id);
                        var imgm = $('<img src="http://localhost/vizitki/views/images/templates/'+liItm.data_name+'" alt="">');
                        imgm.appendTo(imgCont);
                        imgCont.appendTo(mainField);

                        $('.imgMove').draggable().resizable();

                    } else {
                        var li = $('<li>').addClass('editorContolBlock').attr('data-id', liItm.data_id),
                            vis = $('<div>').addClass('visible'),
                            hen = $('<div>').addClass('hendl'),
                            del = $('<div>').addClass('delBtn'),
                            inp = $('<input type="text" value="' + liItm.data_value + '">');
                        if (liItm.data_vis === true) {
                            vis.data('visi', true);
                            li.css('opacity', 0.2);
                        }
                        vis.appendTo(li);
                        hen.appendTo(li);
                        del.appendTo(li);
                        inp.appendTo(li);
                        li.appendTo('#sortableBlock');

                        var txtm = $('<div>').addClass('txtMove').attr('style', liItm.style).attr('data-id', liItm.data_id).text(liItm.data_value);
                        txtm.prependTo(textField);
                        $('.txtMove').draggable({
                            containment: "parent"
                        });
                    }
                }
            }
        }
        return false;
    });

    $(document).on('click','#back_side',function(){
        if(!$(this).hasClass('active')){
            $('#front_side').removeClass('active');
            $('#save').attr('id','save1');
            $('.delBtn').trigger('click');
            $(this).addClass('active');
            var str = $('#code_template1').val().split('|||');
            var liC = JSON.parse(str[str.length-2]);
            var color = JSON.parse(str[str.length-1]);

            $('#backgroundColorSelector div').css('background-color', color);
            mainField.css('background-color', color);
            if (liC > 0) {
                for (var c = 0; c < liC; c++) {
                    var liItm = JSON.parse(str[c]);
                    if (liItm.data_type === true) {
                        var liImg = $('<li>').addClass('editorContolBlock').attr('data-id', liItm.data_id).attr('data-name', liItm.data_name).data('img', true),
                            visImg = $('<div>').addClass('visible'),
                            henImg = $('<div>').addClass('hendl'),
                            delImg = $('<div>').addClass('delBtn'),
                            imgC = $('<div>').addClass('imgControl'),
                            imgP = $('<div>').addClass('imgPreview');
                        if (liItm.data_vis === true) {
                            visImg.data('visi', true);
                            li.css('opacity', 0.2);
                        }

                        img = $('<img src="http://localhost/vizitki/views/images/templates/'+liItm.data_name+'">');
                        img.appendTo(imgP);
                        imgP.appendTo(imgC);
                        imgC.appendTo(liImg);
                        visImg.appendTo(liImg);
                        henImg.appendTo(liImg);
                        delImg.appendTo(liImg);
                        liImg.appendTo('#sortableBlock');

                        var imgCont = $('<div>').addClass('imgMove').attr('style', liItm.styleImg).attr('data-id', liItm.data_id);
                        var imgm = $('<img src="http://localhost/vizitki/views/images/templates/'+liItm.data_name+'" alt="">');
                        imgm.appendTo(imgCont);
                        imgCont.appendTo(mainField);

                        $('.imgMove').draggable().resizable();

                    } else {
                        var li = $('<li>').addClass('editorContolBlock').attr('data-id', liItm.data_id),
                            vis = $('<div>').addClass('visible'),
                            hen = $('<div>').addClass('hendl'),
                            del = $('<div>').addClass('delBtn'),
                            inp = $('<input type="text" value="' + liItm.data_value + '">');
                        if (liItm.data_vis === true) {
                            vis.data('visi', true);
                            li.css('opacity', 0.2);
                        }
                        vis.appendTo(li);
                        hen.appendTo(li);
                        del.appendTo(li);
                        inp.appendTo(li);
                        li.appendTo('#sortableBlock');

                        var txtm = $('<div>').addClass('txtMove').attr('style', liItm.style).attr('data-id', liItm.data_id).text(liItm.data_value);
                        txtm.prependTo(textField);
                        $('.txtMove').draggable({
                            containment: "parent"
                        });
                    }
                }
            }
        }
        return false;
    });

    /*-----------------------------------------------GENERATE-----------------------------------------------------*/
    $('#generate_image').on('click',function(){
        var str = $('#code_template').val();
        var item_id = $('#item_id').val();
        $.ajax({
            type: 'POST',
            url: '/ajax/create_image.php',
            data: ({w:'606',h:'348',params_str:str,id:item_id}),
            success: function(data){
                if(data == true){
                    console.log('OK!');
                };
            }
        });

    })

});