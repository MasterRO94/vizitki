<?php
    unset($_SESSION['basket']);
?>

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
            <div class="cardEditor">
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
            <div class="type_tmpl_block" style="display: none;">
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
            <button id="save" class="editorBtn">Подтвердить изменение элементов на макете</button>
        </div><!-- .editorRight -->
        <div class="clear"></div>
    </div><!-- .editor -->

    <form class="validat form_style" method="post" action="<?=PATH?>/offer/order" enctype='multipart/form-data'>

    <div class="like_h1">Поля заказа</div>

    <div class="row">
        <label for="wishes" class="label">Пожелания к макету</label>
        <div class="controls">
            <textarea data-error="" id="wishes" name="wishes" class="valid"></textarea>
            <div class="help">Введите ваши пожелания к макету</div>
        </div>
    </div>

    <input type="text" value="12" name="group_id" style="display: none;" />

    <p class="properties-order">Свойства заказа</p>

    <div class="row">
        <label class="label">Тираж</label>
        <div class="controls">
            <select data-error="" id="printingType" class="valid" name="printing_type">
                <option data-cost="0"></option>
                <?php foreach($tiraj as $t): ?>
                    <option data-cost="<?=$t['price']?>" data-side="<?=$t['type_side']?>" value="<?=$t['id']?>">
                        <?=$t['text']?>
                    </option>
                <?php endforeach; ?>
            </select>
            <div class="help">Выберите тираж</div>
        </div>
    </div>


    <div class="row">
        <label for="printing-number" class="label">Количесто комплектов</label>
        <div class="controls">
            <input id="printing-number" type="text" name="kolvo" value="1" class="valid digits" />
        </div>
    </div>

    <p class="properties-order">Дополнительные услуги</p>


    <div id="showPaperType">
        <p class="properties-order"><span class="small-italic">Тип бумаги</span></p>
        <span><span style="color:red; font-size: 15px;">Выберите тип бумаги</span></span>
        <a href="#" class="but" id="changePaper">Изменить</a>
    </div>


    <div id="paper-list-block">
        <ul id="paper-list-ul">
            <?php foreach($paper_types as $paper): ?>
                <li>
                    <div class="radioSelect">
                        <input type="radio" name="paper_type" id="paperNum-<?=$paper['id']?>" data-cost1="<?=$paper['price']?>" data-cost2="0" value="<?=$paper['id']?>">
                        <label for="paperNum-<?=$paper['id']?>"><?=$paper['title']?></label>
                    </div>
                    <img src="<?=PATH.'/uploads/paper_type/'.$paper['image']?>"/>
                    <p class="addCost">+0 грн за комплект</p>
                    <div class="infoPaper">
                        <p><span>Плотность:</span> <?=$paper['density']?> гр/м2</p>
                        <p><span>Цвет:</span> <?=$paper['color']?></p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

            <p class="properties-order">Авторские права</p>

            <div class="row checkbox-style">
                <div class="controls">
                    <input id="confirm-author" type="checkbox" name="confirm_copy_rights" class="valid" />
                    <label for="confirm-author" class="simple-label">Оформляя заказ, я подтверждаю, что не нарушаю чьих-либо авторских прав на макет в целом, либо на его составные элементы.</label>
                </div>
            </div>

            <div class="row" style="display: none;">
                <label for="selected_type_paper" class="label">Пожелания к макету</label>
                <div class="controls">
                    <input data-error="" id="selected_type_paper" name="selected_type_paper" class="valid" value=""/>
                    <div class="help">Выберите тип бумаги</div>
                </div>
            </div>

            <div class="cost-style">
                <span class="noPrinting">Вы не выбрали тираж!</span>
                <br>
                <span>Итого:</span> <span id="totalCost">0</span> грн
            </div>

            <input type="hidden" name="edit_template" />

            <div class="row">
                <label class="label"></label>
                <div class="controls">
                    <input type="submit" class="but submit" value="Оформить заказ" />
                </div>
            </div>

            <?php if(isset($_POST['TMPL']['code'])): ?>
                <input type="hidden" class="init_template"  id="code_template" name="TMPL[code]" value='<?=$_POST['TMPL']['code']?>'/>
                <input type="hidden" class="init_template1"  id="code_template1" name="TMPL[code1]" value='<?=$_POST['TMPL']['code1']?>'/>
            <?php else: ?>
                <input type="hidden" class="init_template"  id="code_template" name="TMPL[code]" value='<?=$template['code_face']?>'/>
                <input type="hidden" class="init_template1"  id="code_template1" name="TMPL[code1]" value='<?=$template['code_back']?>'/>
            <?php endif; ?>

            <input type="hidden" id="item_id" name="id" value='56'/>
            <input type="hidden" id="height_tpl" name="TMPL[height]" value="<?=$template['height']?>" />
            <input type="hidden" id="width_tpl" name="TMPL[width]" value="<?=$template['width']?>" />
            <input type="hidden" id="offset_tpl" name="TMPL[offset]" value="<?=$template['offset']?>" />
            <input type="hidden" id="type_side" name="TMPL[type_side]" value="1"/>
            <!-- converted to image code -->
            <div id="img_out" style="display: none"><input type="hidden" id="img-out" name="TMPL[img_out]" value=""/></div>
        </form>
    </section>

<?php else: ?>
    <h3>Такого шаблона нет!</h3>
<?php endif; ?>