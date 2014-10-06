<?php defined('VIZITKI') or die('Access denied'); ?>

<?php if(getSession('error')): ?>
    <script type="text/javascript">$(document).ready(function(){
            alert('<?=getSession('error')?>');
        });
        window.location.href = "<?=PATH?>";
    </script>

<?php else: ?>

<section class="upload_layout">
    <h2>Загрузить макет <?=$title?></h2>

    <?php if(getSession('errors')): ?>
        <div class="errors">
            <ul>
                <?=getSession('errors')?>
            </ul>
        </div>
    <?php endif; ?>

    <script type="text/javascript">
        $(document).ready(function() {

            // В dataTransfer помещаются изображения которые перетащили в область div
            jQuery.event.props.push('dataTransfer');

// Максимальное количество загружаемых изображений за одни раз
            var maxFiles = 6;

// Оповещение по умолчанию
            var errMessage = 0;

// Кнопка выбора файлов
            var defaultUploadBtn = $('#uploadbtn');

// Массив для всех изображений
            var dataArray = [];

// Область информер о загруженных изображениях - скрыта
            $('#uploaded-files').hide();

// Метод при падении файла в зону загрузки
            $('#drop-files').on('drop', function(e) {
                // Передаем в files все полученные изображения
                var files = e.dataTransfer.files;
                // Проверяем на максимальное количество файлов
                if (files.length <= maxFiles) {
                    // Передаем массив с файлами в функцию загрузки на предпросмотр
                    loadInView(files);
                } else {
                    alert('Вы не можете загружать больше '+maxFiles+' изображений!');
                    files.length = 0; return;
                }
            });

            // При нажатии на кнопку выбора файлов
            defaultUploadBtn.on('change', function() {
                // Заполняем массив выбранными изображениями
                var files = $(this)[0].files;
                // Проверяем на максимальное количество файлов
                if (files.length <= maxFiles) {
                    // Передаем массив с файлами в функцию загрузки на предпросмотр
                    loadInView(files);
                    // Очищаем инпут файл путем сброса формы
                    // Или вот так $("#uploadbtn").replaceWith( $("#uploadbtn").val('').clone( true ) );
                    $('#frm').each(function(){
                        this.reset();
                    });

                } else {
                    alert('Вы не можете загружать больше '+maxFiles+' изображений!');
                    files.length = 0;
                }
            });

            // Функция загрузки изображений на предпросмотр
            function loadInView(files) {
                // Показываем обасть предпросмотра
                $('#uploaded-holder').show();

                // Для каждого файла
                $.each(files, function(index, file) {

                    // Несколько оповещений при попытке загрузить не изображение
                    if (!files[index].type.match('image.*')) {

                        if(errMessage == 0) {
                            $('#drop-files p').html('Эй! только изображения!');
                            ++errMessage
                        }
                        else if(errMessage == 1) {
                            $('#drop-files p').html('Стоп! Загружаются только изображения!');
                            ++errMessage
                        }
                        else if(errMessage == 2) {
                            $('#drop-files p').html("Не умеешь читать? Только изображения!");
                            ++errMessage
                        }
                        else if(errMessage == 3) {
                            $('#drop-files p').html("Хорошо! Продолжай в том же духе");
                            errMessage = 0;
                        }

                    } else {

                        // Проверяем количество загружаемых элементов
                        if((dataArray.length+files.length) <= maxFiles) {
                            // показываем область с кнопками
                            $('#upload-button').css({'display' : 'block'});
                        }
                        else { alert('Вы не можете загружать больше '+maxFiles+' изображений!'); return; }

                        // Создаем новый экземпляра FileReader
                        var fileReader = new FileReader();
                        // Инициируем функцию FileReader
                        fileReader.onload = (function(file) {

                            return function(e) {
                                // Помещаем URI изображения в массив
                                dataArray.push({name : file.name, value : this.result});
                                addImage((dataArray.length-1));
                            };

                        })(files[index]);
                        // Производим чтение картинки по URI
                        fileReader.readAsDataURL(file);
                    }
                });
                return false;
            }

            // Процедура добавления эскизов на страницу
            function addImage(ind) {
                // Если индекс отрицательный значит выводим весь массив изображений
                if (ind < 0 ) {
                    start = 0; end = dataArray.length;
                } else {
                    // иначе только определенное изображение
                    start = ind; end = ind+1; }
                // Оповещения о загруженных файлах
                if(dataArray.length == 0) {
                    // Если пустой массив скрываем кнопки и всю область
                    $('#upload-button').hide();
                    $('#uploaded-holder').hide();
                } else if (dataArray.length == 1) {
                    $('#upload-button span').html("Был выбран 1 файл");
                } else {
                    $('#upload-button span').html(dataArray.length+" файлов были выбраны");
                }
                // Цикл для каждого элемента массива
                for (i = start; i < end; i++) {
                    // размещаем загруженные изображения
                    if($('#dropped-files > .image').length <= maxFiles) {
                        $('#dropped-files').append('<div id="img-'+i+'" class="image" style="background: url('+dataArray[i].value+'); background-size: cover;"> <a href="#" id="drop-'+i+'" class="drop-button">Удалить изображение</a></div>');
                    }
                }
                return false;
            }

            // Удаление только выбранного изображения
            $("#dropped-files").on("click","a[id^='drop']", function(e) {
                // Предотвращаем стандартное поведение
                e.preventDefault();
                // получаем название id
                var elid = $(this).attr('id');
                // создаем массив для разделенных строк
                var temp = new Array();
                // делим строку id на 2 части
                temp = elid.split('-');
                // получаем значение после тире тоесть индекс изображения в массиве
                dataArray.splice(temp[1],1);
                // Удаляем старые эскизы
                $('#dropped-files > .image').remove();
                // Обновляем эскизи в соответсвии с обновленным массивом
                addImage(-1);
            });

            // Функция удаления всех изображений
            function restartFiles() {

                // Установим бар загрузки в значение по умолчанию
                $('#loading-bar .loading-color').css({'width' : '0%'});
                $('#loading').css({'display' : 'none'});
                $('#loading-content').html(' ');

                // Удаляем все изображения на странице и скрываем кнопки
                $('#upload-button').hide();
                $('#dropped-files > .image').remove();
                $('#uploaded-holder').hide();

                // Очищаем массив
                dataArray.length = 0;

                return false;
            }

            $('#dropped-files #upload-button .delete').click(restartFiles);

            // Загрузка изображений на сервер
            $('#upload-button .upload').click(function() {

                // Показываем прогресс бар
                $("#loading").show();
                // переменные для работы прогресс бара
                var totalPercent = 100 / dataArray.length;
                var x = 0;

                $('#loading-content').html('Загружен '+dataArray[0].name);
                // Для каждого файла
                $.each(dataArray, function(index, file) {
                    // загружаем страницу и передаем значения, используя HTTP POST запрос
                    $.post('upload.php', dataArray[index], function(data) {

                        var fileName = dataArray[index].name;
                        ++x;

                        // Изменение бара загрузки
                        $('#loading-bar .loading-color').css({'width' : totalPercent*(x)+'%'});
                        // Если загрузка закончилась
                        if(totalPercent*(x) == 100) {
                            // Загрузка завершена
                            $('#loading-content').html('Загрузка завершена!');

                            // Вызываем функцию удаления всех изображений после задержки 1 секунда
                            setTimeout(restartFiles, 1000);
                            // если еще продолжается загрузка
                        } else if(totalPercent*(x) < 100) {
                            // Какой файл загружается
                            $('#loading-content').html('Загружается '+fileName);
                        }

                        // Формируем в виде списка все загруженные изображения
                        // data формируется в upload.php
                        var dataSplit = data.split(':');
                        if(dataSplit[1] == 'загружен успешно') {
                            $('#uploaded-files').append('<li><a href="images/'+dataSplit[0]+'">'+fileName+'</a> загружен успешно</li>');
                        } else {
                            $('#uploaded-files').append('<li><a href=\"images/' + data + '. Имя файла: ' + dataArray[index].name + '</li>');
                        }

                    });
                });
                // Показываем список загруженных файлов
                $('#uploaded-files').show();
                return false;
            });

        });
    </script>

    <div id="drop-files" ondragover="return false">
        <p>Перетащите изображение сюда</p>
        <form id="frm">
            <input type="file" id="uploadbtn" multiple />
        </form>
    </div>

    <!-- Область предварительного просмотра -->
    <div id="uploaded-holder">
        <div id="dropped-files">
            <!-- Кнопки загрузить и удалить, а также количество файлов -->
            <div id="upload-button">
                <center>
                    <span>0 Файлов</span>
                    <a href="#" class="upload">Загрузить</a>
                    <a href="#" class="delete">Удалить</a>
                    <!-- Прогресс бар загрузки -->
                    <div id="loading">
                        <div id="loading-bar">
                            <div class="loading-color"></div>
                        </div>
                        <div id="loading-content"></div>
                    </div>
                </center>
            </div>
        </div>
    </div>

    <!-- Список загруженных файлов -->
    <div id="file-name-holder">
        <ul id="uploaded-files">
            <h1>Загруженные файлы</h1>
        </ul>
    </div>



    <form class="form_style" method="post" action="<?=PATH?>/offer/order" enctype='multipart/form-data'>

       <!-- <label for="upload_images">Загрузить макеты</label>
        <input type="file" name="images[]" id="upload_images" />-->

        <div class="row">
            <label for="wishes" class="label">Пожелания к макету</label>
            <div class="controls">
                <textarea id="wishes" name="wishes"></textarea>
                <div class="help">Введите ваши пожелания к макету</div>
            </div>
        </div>

        <input type="hidden" value="<?=$title?>" name="type" />

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

        <?php if($extra): ?>
            <?php foreach($extra as $ext): ?>
            <div class="row checkbox-style">
                <div class="controls">
                    <input type="checkbox" id="extra-<?=$ext['id']?>" class="extraCost" data-cost1="<?=$ext['price1']?>" data-cost2="<?=$ext['price2']?>" name="EXTRA[]" value="<?=$ext['id']?>" />
                    <label class="simple-label" for="extra-<?=$ext['id']?>"><?=$ext['title']?><span>(+0 грн. за комплект)</span></label>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>

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

        <div class="row">
            <label class="label"></label>
            <div class="controls">
                <input type="submit" class="but submit" value="Оформить заказ" />
            </div>
        </div>
    </form>

</section>

<?php endif; ?>