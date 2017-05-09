<?php
$html = "<div class=\"container menu_main\">
    <div class=\"row \">
        <ul>
            <li><a href=\"index.php\">Главная</a></li>
            <li><a href=\"material.php\">Материалы</a>
                <ul class=\"slvl\">
                    <li><a href=\"add_material.php\">Добавить материал</a></li>
                </ul>
            </li>
            <li><a href=\"simple_detail.php\">Простые детали</a>
                <ul class=\"slvl\">
                    <li><a href=\"add_simple_detail.php\">Создать простую деталь</a></li>
                </ul>
            </li>
            <li><a href=\"complex_detail.php\">Сложные детали</a>
                <ul class=\"slvl\">
                    <li><a href=\"add_complex_detail.php\">Создать сложную деталь</a></li>
                </ul>
            </li>

        </ul>
    </div>
</div>";
echo $html;