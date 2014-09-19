<?php print_arr($_POST);  ?>


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
                <a href="/catalog/edit_template/vizitki/template/56" class="editorBtn original">восстановить оригинал</a>
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

    <form class="validat form_style" method="post" action="" enctype='multipart/form-data'>

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
                    <option data-cost="17" data-side="1" value="1">
                        100 штук                                                                                                             (одностронние)
                    </option>
                    <option data-cost="41" data-side="2" value="2">
                        100 штук                                                                                                             (двусторонние)
                    </option>
                    <option data-cost="90" data-side="1" value="3">
                        1000 штук                                                                                                             (одностронние)
                    </option>
                    <option data-cost="114" data-side="2" value="4">
                        1000 штук                                                                                                             (двусторонние)
                    </option>
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
                <li>
                    <div class="radioSelect">
                        <input type="radio" name="paper_type" id="paperNum-10" data-cost1="0" data-cost2="0" value="10">
                        <label for="paperNum-10">Мелованная матовая</label>
                    </div>
                    <img src="/pic/none_paper.jpg"/>
                    <p class="addCost">+0 грн за комплект</p>
                    <div class="infoPaper">
                        <p><span>Плотность:</span> 300 гр/м2</p>
                        <p><span>Цвет:</span> белый</p>
                    </div>
                </li>
                <li>
                    <div class="radioSelect">
                        <input type="radio" name="paper_type" id="paperNum-11" data-cost1="0" data-cost2="0" value="11">
                        <label for="paperNum-11">Мелованная глянцевая</label>
                    </div>
                    <img src="/pic/none_paper.jpg"/>
                    <p class="addCost">+0 грн за комплект</p>
                    <div class="infoPaper">
                        <p><span>Плотность:</span> 300 гр/м2</p>
                        <p><span>Цвет:</span> белый</p>
                    </div>
                </li>
                <li>
                    <div class="radioSelect">
                        <input type="radio" name="paper_type" id="paperNum-7" data-cost1="163" data-cost2="1464" value="7">
                        <label for="paperNum-7">Keaykolour original tangerine</label>
                    </div>
                    <img src="/images/_paper_type/7.jpg"/>
                    <p class="addCost">+0 грн за комплект</p>
                    <div class="infoPaper">
                        <p><span>Плотность:</span> 300 гр/м2</p>
                        <p><span>Фактура:</span> гладкая</p>
                        <p><span>Цвет:</span> апельсиновый</p>
                    </div>
                </li>
                <li>
                    <div class="radioSelect">
                        <input type="radio" name="paper_type" id="paperNum-6" data-cost1="204" data-cost2="1789" value="6">
                        <label for="paperNum-6">Rives tradition ice white</label>
                    </div>
                    <img src="/images/_paper_type/6.jpg"/>
                    <p class="addCost">+0 грн за комплект</p>
                    <div class="infoPaper">
                        <p><span>Плотность:</span> 250 гр/м2</p>
                        <p><span>Фактура:</span> фетр</p>
                        <p><span>Цвет:</span> белый перламутровый</p>
                    </div>
                </li>
                <li>
                    <div class="radioSelect">
                        <input type="radio" name="paper_type" id="paperNum-2" data-cost1="163" data-cost2="0" value="2">
                        <label for="paperNum-2">Keaykolor embossing reiderr snow</label>
                    </div>
                    <img src="/images/_paper_type/2.jpg"/>
                    <p class="addCost">+0 грн за комплект</p>
                    <div class="infoPaper">
                        <p><span>Плотность:</span> 300 гр/м2</p>
                        <p><span>Фактура:</span> кора дерева</p>
                        <p><span>Цвет:</span> белый</p>
                    </div>
                </li>
                <li>
                    <div class="radioSelect">
                        <input type="radio" name="paper_type" id="paperNum-8" data-cost1="204" data-cost2="0" value="8">
                        <label for="paperNum-8">Keaykolor embossing reiderr snow</label>
                    </div>
                    <img src="/images/_paper_type/8.jpg"/>
                    <p class="addCost">+0 грн за комплект</p>
                    <div class="infoPaper">
                        <p><span>Плотность:</span> 300 гр/м2</p>
                        <p><span>Фактура:</span> кора дерева</p>
                        <p><span>Цвет:</span> белый</p>
                    </div>
                </li>
                <li>
                    <div class="radioSelect">
                        <input type="radio" name="paper_type" id="paperNum-9" data-cost1="204" data-cost2="0" value="9">
                        <label for="paperNum-9">Rives corn design</label>
                    </div>
                    <img src="/images/_paper_type/9.jpg"/>
                    <p class="addCost">+0 грн за комплект</p>
                    <div class="infoPaper">
                        <p><span>Плотность:</span> 250 гр/м2</p>
                        <p><span>Фактура:</span> сетка</p>
                        <p><span>Цвет:</span> бежевый светлый</p>
                    </div>
                </li>
                <li>
                    <div class="radioSelect">
                        <input type="radio" name="paper_type" id="paperNum-3" data-cost1="163" data-cost2="0" value="3">
                        <label for="paperNum-3">Keaykolor original biscuit</label>
                    </div>
                    <img src="/images/_paper_type/3.jpg"/>
                    <p class="addCost">+0 грн за комплект</p>
                    <div class="infoPaper">
                        <p><span>Плотность:</span> 300 гр/м2</p>
                        <p><span>Фактура:</span> гладкая</p>
                        <p><span>Цвет:</span> бежевый</p>
                    </div>
                </li>
                <li>
                    <div class="radioSelect">
                        <input type="radio" name="paper_type" id="paperNum-1" data-cost1="277" data-cost2="0" value="1">
                        <label for="paperNum-1">Majestic fresh mint</label>
                    </div>
                    <img src="/images/_paper_type/1.jpg"/>
                    <p class="addCost">+0 грн за комплект</p>
                    <div class="infoPaper">
                        <p><span>Плотность:</span> 290 гр/м2</p>
                        <p><span>Фактура:</span> гладкая металлизированная</p>
                        <p><span>Цвет:</span> салатовый светлый</p>
                    </div>
                </li>
                <li>
                    <div class="radioSelect">
                        <input type="radio" name="paper_type" id="paperNum-4" data-cost1="163" data-cost2="0" value="4">
                        <label for="paperNum-4">Fedrigony sirio Tela sabbia</label>
                    </div>
                    <img src="/images/_paper_type/4.jpg"/>
                    <p class="addCost">+0 грн за комплект</p>
                    <div class="infoPaper">
                        <p><span>Плотность:</span> 290 гр/м2</p>
                        <p><span>Фактура:</span> лен</p>
                        <p><span>Цвет:</span> кофе с молоком</p>
                    </div>
                </li>
                <li>
                    <div class="radioSelect">
                        <input type="radio" name="paper_type" id="paperNum-5" data-cost1="163" data-cost2="0" value="5">
                        <label for="paperNum-5">Rives corn traditions </label>
                    </div>
                    <img src="/images/_paper_type/5.jpg"/>
                    <p class="addCost">+0 грн за комплект</p>
                    <div class="infoPaper">
                        <p><span>Плотность:</span> 250 гр/м2</p>
                        <p><span>Фактура:</span> фетр</p>
                        <p><span>Цвет:</span> бежевый светлый</p>
                    </div>
                </li>
            </ul>
        </div>

        <p class="properties-order">Авторские права</p>

        <div class="row checkbox-style">
            <div class="controls">
                <input id="confirm-author" type="checkbox" name="" class="valid" />
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
        <input type="hidden" class="init_template"  id="code_template" name="TMPL[code]" value='{"data_id":"45326446","data_value":"E-mail: xxxxx@xxxx.xx","style":"color: rgb(0, 0, 0); font-size: 20px; left: 356px; top: 272px;","styleImg":"color: rgb(0, 0, 0); font-size: 20px; left: 356px; top: 272px;"}|||{"data_id":"29932038","data_value":"моб.: (ххх) ххх-хх-хх","style":"color: rgb(0, 0, 0); font-size: 20px; left: 371px; top: 242px;","styleImg":"color: rgb(0, 0, 0); font-size: 20px; left: 371px; top: 242px;"}|||{"data_id":"15987516","data_value":"Тел.факс: (ххх) ххх-хх-хх","style":"color: rgb(0, 0, 0); font-size: 20px; left: 326px; top: 211px;","styleImg":"color: rgb(0, 0, 0); font-size: 20px; left: 326px; top: 211px;"}|||{"data_id":"22169546","data_value":"Улица, дом","style":"color: rgb(0, 0, 0); font-size: 18px; left: 453px; top: 183px;","styleImg":"color: rgb(0, 0, 0); font-size: 18px; left: 453px; top: 183px;"}|||{"data_id":"45948140","data_value":"Страна, г. Город","style":"color: rgb(0, 0, 0); left: 409px; top: 161px; font-size: 18px;","styleImg":"color: rgb(0, 0, 0); left: 409px; top: 161px; font-size: 18px;"}|||{"data_id":"99653617","data_vis":false,"data_value":"должность","style":"color: rgb(0, 0, 0); left: 471px; top: 127px;","styleImg":"color: rgb(0, 0, 0); left: 471px; top: 127px;"}|||{"data_id":"11236042","data_value":"Имя Отчество","style":"font-size: 20px; color: rgb(255, 255, 255); left: 417px; top: 103px;","styleImg":"font-size: 20px; color: rgb(255, 255, 255); left: 417px; top: 103px;"}|||{"data_id":"5916004","data_value":"Фамилия","style":"font-size: 28px; color: rgb(255, 255, 255); left: 419px; top: 67px; font-weight: bold;","styleImg":"font-size: 28px; color: rgb(255, 255, 255); left: 419px; top: 67px; font-weight: bold;"}|||{"data_id":"40267012","data_value":"услуги","style":"color: rgb(0, 0, 0); left: 504px; top: 20px;","styleImg":"color: rgb(0, 0, 0); left: 504px; top: 20px;"}|||{"data_id":"63309878","data_value":"Название","style":"color: rgb(0, 0, 0); font-size: 20px; left: 462px; top: 0px;","styleImg":"color: rgb(0, 0, 0); font-size: 20px; left: 462px; top: 0px;"}|||{"data_id":"370647","data_name":"9b3f0c35fc9b8eifj4rf4uf49rfj4f8c8ea78.jpg","data_type":true,"styleImg":"position: absolute; top: -112px; left: -295px; width: 906.7707641196013px; height: 570px;"}|||11|||"rgb(255, 255, 255)"'/>
        <input type="hidden" class="init_template1"  id="code_template1" name="TMPL[code1]" value='{"data_id":"45326446","data_value":"E-mail: xxxxx@xxxx.xx","style":"color: rgb(0, 0, 0); font-size: 20px; left: 356px; top: 272px;","styleImg":"color: rgb(0, 0, 0); font-size: 20px; left: 356px; top: 272px;"}|||{"data_id":"29932038","data_value":"моб.: (ххх) ххх-хх-хх","style":"color: rgb(0, 0, 0); font-size: 20px; left: 371px; top: 242px;","styleImg":"color: rgb(0, 0, 0); font-size: 20px; left: 371px; top: 242px;"}|||{"data_id":"15987516","data_value":"Тел.факс: (ххх) ххх-хх-хх","style":"color: rgb(0, 0, 0); font-size: 20px; left: 326px; top: 211px;","styleImg":"color: rgb(0, 0, 0); font-size: 20px; left: 326px; top: 211px;"}|||{"data_id":"22169546","data_value":"Улица, дом","style":"color: rgb(0, 0, 0); font-size: 18px; left: 453px; top: 183px;","styleImg":"color: rgb(0, 0, 0); font-size: 18px; left: 453px; top: 183px;"}|||{"data_id":"45948140","data_value":"Страна, г. Город","style":"color: rgb(0, 0, 0); left: 409px; top: 161px; font-size: 18px;","styleImg":"color: rgb(0, 0, 0); left: 409px; top: 161px; font-size: 18px;"}|||{"data_id":"99653617","data_vis":false,"data_value":"должность","style":"color: rgb(0, 0, 0); left: 471px; top: 127px;","styleImg":"color: rgb(0, 0, 0); left: 471px; top: 127px;"}|||{"data_id":"11236042","data_value":"Имя Отчество","style":"font-size: 20px; color: rgb(255, 255, 255); left: 417px; top: 103px;","styleImg":"font-size: 20px; color: rgb(255, 255, 255); left: 417px; top: 103px;"}|||{"data_id":"5916004","data_value":"Фамилия","style":"font-size: 28px; color: rgb(255, 255, 255); left: 419px; top: 67px; font-weight: bold;","styleImg":"font-size: 28px; color: rgb(255, 255, 255); left: 419px; top: 67px; font-weight: bold;"}|||{"data_id":"40267012","data_value":"услуги","style":"color: rgb(0, 0, 0); left: 504px; top: 20px;","styleImg":"color: rgb(0, 0, 0); left: 504px; top: 20px;"}|||{"data_id":"63309878","data_value":"Название","style":"color: rgb(0, 0, 0); font-size: 20px; left: 462px; top: 0px;","styleImg":"color: rgb(0, 0, 0); font-size: 20px; left: 462px; top: 0px;"}|||{"data_id":"370647","data_name":"9b3f0c35fc9b8eifj4rf4uf49rfj4f8c8ea78.jpg","data_type":true,"styleImg":"position: absolute; top: -112px; left: -295px; width: 906.7707641196013px; height: 570px;"}|||11|||"rgb(255, 255, 255)"'/>
        <?php endif; ?>

        <input type="hidden" id="item_id" name="id" value='56'/>
        <input type="hidden" id="height_tpl" name="TMPL[height]" value="348" />
        <input type="hidden" id="width_tpl" name="TMPL[width]" value="606" />
        <input type="hidden" id="offset_tpl" name="TMPL[offset]" value="25" />
        <input type="hidden" id="type_side" name="TMPL[type_side]" value="1"/>
    </form>
</section>