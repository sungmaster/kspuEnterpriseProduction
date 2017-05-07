<?php
$html = "<div class=\"container menu_main\">
    <div class=\"row \">
        <ul>
            <li><a href=\"index.php\">Главная</a></li>
            <li><a href=\"material.php\">Материал</a>
                <ul class=\"slvl\">
                    <li><a href=\"add_material.php\">Добавить материал</a></li>
                </ul>
            </li>
            <li><a href=\"simple_detail.php\">Простая деталь</a>
                <ul class=\"slvl\">
                    <li><a href=\"add_simple_detail.php\">Создать простую деталь</a></li>
                </ul>
            </li>
            <li><a href=\"complex_detail.php\">Сложная деталь</a>
                <ul class=\"slvl\">
                    <li><a href=\"add_complex_detail.php\">Создать сложную деталь</a></li>
                </ul>
            </li>

        </ul>
    </div>
</div>";
echo $html;