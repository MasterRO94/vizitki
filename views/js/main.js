$(document).ready(function(){

    if(!Modernizr.generatedcontent){
        $('html').addClass('no-generatedcontent');
    }else{
        $('html').addClass('generatedcontent');
    }

    //start gall
    $('.g_list').each(function(){
        var gList = $(this);
        var gItem = $('.g_item',gList)
        $('.g_pic',gList).each(function(){
            var gPic = $(this);
            gClone1 = gPic.clone().removeClass('g_pic').addClass('g_clone1').addClass('g_clone').css({left:'-5px',top:'-6px',position:'absolute'});
            gClone2 = gPic.clone().removeClass('g_pic').addClass('g_clone2').addClass('g_clone').css({left:'2px',top:'6px',position:'absolute'});
            gClone3 = gPic.clone().removeClass('g_pic').addClass('g_clone3').addClass('g_clone').css({left:'5px',top:'-2px',position:'absolute'});
            gPic
                .before(gClone1)
                .before(gClone2)
                .before(gClone3)
        })

        gItem.bind('mouseenter',function(){
            $('.g_clone1',$(this)).stop().animate({left:'-15px',top:'-11px'},100);
            $('.g_clone2',$(this)).stop().animate({left:'7px',top:'15px'},100);
            $('.g_clone3',$(this)).stop().animate({left:'15px',top:'-14px'},100);
        }).bind('mouseleave',function(){
            $('.g_clone1',$(this)).stop().animate({left:'-5px',top:'-6px'},100);
            $('.g_clone2',$(this)).stop().animate({left:'2px',top:'6px'},100);
            $('.g_clone3',$(this)).stop().animate({left:'5px',top:'-2px'},100);
        })
    })
    //end gall

    //start file
    $('.file').each(function(){
        var f = $(this);
        var fileItem = f.closest('.file_item');
        var fakeBut = $('.fakebut',fileItem);
        var rightPos = fileItem.width() - (fakeBut.position().left + fakeBut.outerWidth());
        f.css({right:rightPos});
    })
    $(document).on('change','.file',function(){

        var item_wrap = $(this).closest('.row');
        var file = $(this).val();
        var reWin = /.*\\(.*)/;
        var fileTitle = file.replace(reWin, "$1"); //w*s
        var reUnix = /.*\/(.*)/;
        var fileTitle = fileTitle.replace(reUnix, "$1"); //*nix

        $('.fakefile input',item_wrap).val(fileTitle)
    })
    //end file

    //sart placeholder
    if (!Modernizr.input.placeholder)
    {
        $('input[placeholder]').each(function(){
            var el = $(this);
            var ph = el.attr('placeholder')
            if(el.val() == ''){el.val(ph)}
            el.focus(function(){
                if(el.val() == ph){el.val('')}
            }).blur(function(){
                if(el.val() == ''){el.val(ph)}
            })
        })
    }
    //end placeholder

    //start submit
    $('a.submit').bind('click',function(){
        $(this).closest('form').submit();
        return false
    })
    //end submit

    //start vertical middle
    $('.middle_inner').each(function(){
        $('<span>').addClass('helper').appendTo($(this).parent());
    })
    //end vertical middle

    //start navigator
    $('.navigator a').each(function(){
        var nav_el = $(this);
        nav_el.after('<span>&nbsp;/&nbsp;</span>').css({padding:'0'})
    })
    //end navigator

    //start form_style
    $('.form_style').each(function(){
        var label_w = $('label',$(this)).outerWidth()
        $('.sdvig',$(this)).css({marginLeft:label_w+10})
    })
    //end form_style

    //start gallery
    $('.gallery_list').each(function(){
        var g_list = $(this);
        $('.thumbnail',g_list).each(function(){
            var th_item = $(this);
            var th_link = $('.img_link',th_item);
            var th_img = $('img',th_item)
            var th_clone = th_img.clone().addClass('th_clone_top').css({opacity:'0.2'})
            var th_clone2 = th_img.clone().addClass('th_clone_bot').css({opacity:'0.2'})
            th_clone.prependTo(th_link)
            th_clone2.prependTo(th_link)
            th_img.css({position:'relative',zIndex:'50'});

        })
    })
    $('.thumbnails').each(function(){
        var g_wrap = $(this);
        g_wrap.bind('mouseenter',function(){
            $('.thumbnail',g_wrap).stop().animate({opacity:'0.7'},1000).bind('mouseenter',function(){
                $(this).stop().animate({opacity:'1'},300)
            }).bind('mouseleave',function(){
                $(this).stop().animate({opacity:'0.7'},300)
            })
        }).bind('mouseleave',function(){
            $('.thumbnail',g_wrap).stop().animate({opacity:'1'},1000)
        })
    })
    //end gallery

    //start content pic
    $('.content>img,.content>p>img').each(function(){
        var float = $(this).attr('style')
        var align = $(this).attr('align')
        if(float == 'float: left;' || float == 'float: left' || float == 'float:left;' || float == 'float:left' || align == 'left'){
            $(this).addClass('imgLeft')
        }
        if(float == 'float: right;' || float == 'float: right' || float == 'float:right;' || float == 'float:right' || align == 'right'){
            $(this).addClass('imgRight')
        }
    })
    //end content pic

    /*-----------------------*/
    $(window).load(function(){
        //start img style
        if($('img.cone').length){
            $('img.cone').each(function(){
                var elStyle = $(this).attr('style');
                if(!elStyle){
                    elStyle = '';
                }

                var
                    topLeft = $(this).css('border-top-left-radius'),
                    topRight = $(this).css('border-top-right-radius'),
                    botLeft = $(this).css('border-bottom-left-radius'),
                    botRight = $(this).css('border-bottom-right-radius'),
                    imgWrap = $('<span>').attr('class',$(this).attr('class')).attr('style',elStyle).addClass('img-cone').css({width:$(this).width(),height:$(this).height(),background:'url('+$(this).attr('src')+') 50% 50% no-repeat', 'border-radius':topLeft+' '+topRight+' '+botRight+' '+botLeft});
                $(this).wrap(imgWrap).hide();
            });
        };
        //end img style

        //quotes min
        jQuery.fn.liQuotes=function(options){var o=jQuery.extend({},options);return this.each(function(){htmlreplace($(this));function htmlreplace(element){if(!element)element=document.body;var nodes=$(element).contents().each(function(){if(this.nodeType==Node.TEXT_NODE){$(this).wrap('<span class="node_t"/>');}else{htmlreplace(this);}});};$('.node_t').each(function(){var el=$(this),str=el.html(),raquo_one=/'\s/g,laquo_one=/\s'/g,raquo_two=/"\s/g,laquo_two=/\s"/g,raquo_brack_one=/'\)/g,laquo_brack_one=/\('/g,raquo_brack_two=/"\)/g,laquo_brack_two=/\("/g,raquo_tag_one=/'$/g,laquo_tag_one=/^'/g,raquo_tag_two=/"$/g,laquo_tag_two=/^"/g,raquo_one_coma=/'\,/g,raquo_one_dot=/'\./g,raquo_two_coma=/"\,/g,raquo_two_dot=/"\./g,raquo_one_colon=/'\:/g,raquo_two_colon=/"\:/g,quest_one_colon=/'\?/g,quest_two_colon=/"\?/g,exclam_one_colon=/'\!/g,exclam_two_colon=/"\!/g,semic_one_colon=/'\;/g,semic_two_colon=/"\;/g;var result=str.replace(laquo_one," &laquo;").replace(raquo_one,"&raquo; ").replace(laquo_two," &laquo;").replace(raquo_two,"&raquo; ").replace(raquo_one_coma,"&raquo;,").replace(raquo_one_dot,"&raquo;.").replace(raquo_two_coma,"&raquo;,").replace(raquo_two_dot,"&raquo;.").replace(raquo_one_colon,"&raquo;:").replace(raquo_two_colon,"&raquo;:").replace(quest_one_colon,"&raquo;?").replace(quest_two_colon,"&raquo;?").replace(exclam_one_colon,"&raquo;!").replace(exclam_two_colon,"&raquo;!").replace(laquo_brack_one,"(&laquo;").replace(raquo_brack_one,"&raquo;)").replace(laquo_brack_two,"(&laquo;").replace(raquo_brack_two,"&raquo;)").replace(laquo_tag_one,"&laquo;").replace(raquo_tag_one,"&raquo;").replace(laquo_tag_two,"&laquo;").replace(raquo_tag_two,"&raquo;").replace(semic_one_colon,"&raquo;;").replace(semic_two_colon,"&raquo;;");el.html(result);});$('.node_t').each(function(){var html = $(this).html();$(this).after(html).remove()});});};
        $('.q').liQuotes();
    })
});


//add more link @version 1.2
jQuery.fn.addtocopy=function(usercopytxt){var options={htmlcopytxt:'<br>More: <a href="'+window.location.href+'">'+window.location.href+'</a><br>',minlen:25,addcopyfirst:false}
    $.extend(options,usercopytxt);var copy_sp=document.createElement('span');copy_sp.id='ctrlcopy';copy_sp.innerHTML=options.htmlcopytxt;return this.each(function(){$(this).mousedown(function(){$('#ctrlcopy').remove();});$(this).mouseup(function(){if(window.getSelection){var slcted=window.getSelection();var seltxt=slcted.toString();if(!seltxt||seltxt.length<options.minlen)return;var nslct=slcted.getRangeAt(0);seltxt=nslct.cloneRange();seltxt.collapse(options.addcopyfirst);seltxt.insertNode(copy_sp);if(!options.addcopyfirst)nslct.setEndAfter(copy_sp);slcted.removeAllRanges();slcted.addRange(nslct);}else if(document.selection){var slcted=document.selection;var nslct=slcted.createRange();var seltxt=nslct.text;if(!seltxt||seltxt.length<options.minlen)return;seltxt=nslct.duplicate();seltxt.collapse(options.addcopyfirst);seltxt.pasteHTML(copy_sp.outerHTML);if(!options.addcopyfirst){nslct.setEndPoint("EndToEnd",seltxt);nslct.select();}}});});}

//debug()
var debug = function(f){
    if (window.console != undefined){
        console.log(f)
    }
}