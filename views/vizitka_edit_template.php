<?php defined('VIZITKI') or die('Access denied'); ?>

<?php if($template): ?>
    <section id="editor" style="width: 960px;">
    <div class="editor">
        <div class="editorLeft">
            <div class="topControl">
                <div id="textEditControl">
                    <div class="chooseFont">
                        <select>
                            <option value="Arial" selected>Arial</option>
                            <option value="Tahoma">Tahoma</option>
                            <option value="Verdana">Verdana</option>
                            <option value="Times New Roman">Times New Roman</option>
                            <option value="Helvetica">Helvetica</option>
                            <option value="Comic Sans MS">Comic Sans MS</option>
                            <option value="Courier New">Courier New</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Impact">Impact</option>
                            <option value="Lucida Console">Lucida Console</option>
                            <option value="Palatino Linotype">Palatino Linotype</option>
                            <option value="Trebuchet MS">Trebuchet MS</option>
                        </select>
                    </div>
                    <div class="chooseFontSize">
                        <select>
                            <option value="8">8</option>
                            <option value="10">10</option>
                            <option value="12">12</option>
                            <option value="14">14</option>
                            <option value="16" selected>16</option>
                            <option value="18">18</option>
                            <option value="20">20</option>
                            <option value="24">24</option>
                            <option value="28">28</option>
                        </select>
                    </div>
                    <div class="chooseColor">
                        <div id="colorSelector"><div style="background-color: #000000"></div><span></span></div>
                        <div id="colorpickerHolder"></div>
                    </div><!-- .chooseColor -->
                    <div class="chooseTxt_decor">
                        <a href="#" id="txtBold">B</a>
                        <a href="#" id="txtItalic">I</a>
                        <a href="#" id="txtUnder">U</a>
                    </div><!-- .chooseTxt_decor -->
                </div><!-- #textEditControl -->
                <a href="<?=$_SERVER['URL']?>" class="editorBtn original">восстановить оригинал</a>
                <div class="clear"></div>
            </div><!-- .topControl -->
            <div class="cardEditor" style="position: relative">
                <section id="loading-editor"></section>
                <div class="cardEditorBlock" id="cardMainEditor">
                    <div class="cardEditorField safety_line" id="cardEditorField">
                    </div><!-- .cardEditorField -->
                </div><!-- .cardEditorBlock -->
            </div><!-- .cardEditor -->
            <div class="lineControl">
                <label><input type="checkbox" checked><p>показывать границу безопасности</p></label>
                <div class="lineControlInfo">
                    за эту линию не должны выходить значимые текстовые поля
                </div>
                <p style="font-weight: bold; color:red;font-size: 14px;">Для перемещения и изменения размера изображения зажмите клавишу SHIFT</p>
                <div class="backgroundColor">
                    <p>Фон: </p>
                    <div id="backgroundColorSelector"><div style="background-color: #ffffff"></div><span></span></div>
                    <div id="backgroundColorHolder"></div>
                </div><!-- .chooseColor -->
            </div><!-- .lineControl -->
            <div class="button">
                <button id="add_back_side" data-template-alias="<?=$template['group_alias']?>">Добавить вторую сторону</button>
            </div>
            <div class="type_tmpl_block" <?php if($_SERVER['HTTP_REFERER'] == PATH.'/offer/order1') { $ts = getSession('TMPL'); if($ts['type_side'] == 2) echo 'style="display:block"'; } ?>   >
                <a class="editorBtn active" href="#" id="front_side">Лицевая сторона</a>
                <a class="editorBtn" href="#" id="back_side">Обратная сторона</a>
            </div>
        </div><!-- .editorLeft -->
        <div class="editorRight">
            <div class="editorRightBtn">
                <button class="editorBtn" id="addText">добавить текст</button>
                <div class="addimageBlock">
                    <button class="editorBtn">добавить изображение</button>
                    <div class="addImageField">
                        <iframe id="superframe" name="superframe" style="display: none;"></iframe>
                        <form method="post" enctype="multipart/form-data" action="<?=PATH?>/upload-image" target="superframe">
                            <input name="file" type="file">
                            <input type="submit" class="editorBtn" id="addImage" name="uploadImage" value="Загрузить">
                        </form>
                    </div><!-- .addImageField -->
                    <div style="display: none;" id="new_photo"></div>
                </div>
                <!--<button id="generate_image">Сгенерировать изображение</button>-->
            </div>
            <div class="sortableBlock">
                <ul id="sortableBlock">
                </ul>
            </div><!-- .sortableBlock -->
            <!--<button id="save" class="editorBtn">Подтвердить изменение элементов на макете</button>-->
        </div><!-- .editorRight -->
        <div class="clear"></div>
    </div><!-- .editor -->

    <form class="validat form_style" method="post" action="<?=PATH?>/offer/order1" enctype='multipart/form-data'>

        <input type="hidden" name="edit_template" />

        <div class="row checkbox-style">
            <div class="controls">
                <input id="confirm-template" type="checkbox" name="confirm_template" class="valid" required/>
                <label for="confirm-template" class="simple-label">Я проверил орфографию и контактные данные</label>
            </div>
        </div>

        <div class="row">
            <label class="label"></label>
            <div class="controls">
                <input type="submit" class="but submit" value="Следующий шаг" />
            </div>
        </div>

        <?php if(isset($_SESSION['TMPL']['code']) && ($_SERVER['HTTP_REFERER'] == PATH.'/offer/order1')): ?>
            <input type="hidden" class="init_template"  id="code_template" name="TMPL[code]" value='<?=$_SESSION['TMPL']['code']?>'/>
            <input type="hidden" class="init_template1"  id="code_template1" name="TMPL[code1]" value='<?=$_SESSION['TMPL']['code1']?>'/>

            <input type="hidden" id="height_tpl" name="TMPL[height]" value="<?=$_SESSION['TMPL']['height']?>" />
            <input type="hidden" id="width_tpl" name="TMPL[width]" value="<?=$_SESSION['TMPL']['width']?>" />
            <input type="hidden" id="offset_tpl" name="TMPL[offset]" value="<?=$_SESSION['TMPL']['offset']?>" />
            <input type="hidden" id="type_side" name="TMPL[type_side]" value="<?=$_SESSION['TMPL']['type_side']?>"/>
            <!-- converted to image code -->
            <div id="img_out_1" ><input type="hidden" id="img-out-1" name="TMPL[img_out_1]" value="<?=$_SESSION['TMPL']['img_out_1']?>"/></div>
            <div id="img_out_2" ><input type="hidden" id="img-out-2" name="TMPL[img_out_2]" value="<?=$_SESSION['TMPL']['img_out_2']?>"/></div>
        <?php else: ?>
            <input type="hidden" class="init_template"  id="code_template" name="TMPL[code]" value='<?=$template['code_face']?>'/>
            <input type="hidden" class="init_template1"  id="code_template1" name="TMPL[code1]" value=''/>
            <input type="hidden" id="height_tpl" name="TMPL[height]" value="<?=$template['height']?>" />
            <input type="hidden" id="width_tpl" name="TMPL[width]" value="<?=$template['width']?>" />
            <input type="hidden" id="offset_tpl" name="TMPL[offset]" value="<?=$template['offset']?>" />
            <input type="hidden" id="type_side" name="TMPL[type_side]" value="1"/>
            <!-- converted to image code -->
            <div id="img_out_1" ><input type="hidden" id="img-out-1" name="TMPL[img_out_1]" value=""/></div>
            <div id="img_out_2" ><input type="hidden" id="img-out-2" name="TMPL[img_out_2]" value=""/></div>
        <?php endif; ?>
        <input type="hidden" id="current_side" value="1"/>
    </form>
    </section>

    <section id="add_bside_window_bg">
        <section id="add_bside_window_wrapper">
            <section id="add_bside_window">
                <div class="window_header">
                    <h4>Выберите шаблон</h4>
                    <p id="close_bside_window">X</p>
                </div>
                <div id="window_body">

                </div>
            </section>
        </section>
    </section>

<?php else: ?>
    <h3>Такого шаблона нет!</h3>
<?php endif; ?>