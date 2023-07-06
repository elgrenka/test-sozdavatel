<?php
// Подключаем модуль инфоблоков
CModule::IncludeModule("iblock");

// Создаем класс для кастомного свойства
class CMultipleCustomProperty {
    public static function GetAdminListViewHTML($arProperty, $value, $strHTMLControlName) {
        if ($value["VALUE"] !== "") {
            return htmlspecialcharsbx($value["VALUE"]);
        }
        else {
            return '';
        }
    }

    // Функция для отображения свойства в форме редактирования элемента
    public static function GetPropertyFieldHtml($arProperty, $value, $strHTMLControlName) {
        $fieldCount = intval($arProperty["USER_TYPE_SETTINGS"]["FIELD_COUNT"]);
        $showSort = $arProperty["USER_TYPE_SETTINGS"]["SHOW_SORT"] == "Y";
        $fieldWidth = intval($arProperty["USER_TYPE_SETTINGS"]["FIELD_WIDTH"]);

        if ($fieldCount < 1) $fieldCount = 1;
        if ($fieldWidth < 1) $fieldWidth = 20;

        $html = "";
        for ($i = 0; $i < $fieldCount; $i++) {
            $val = isset($value[$i]) ? $value[$i]["VALUE"] : "";
            $sort = isset($value[$i]) ? $value[$i]["SORT"] : 500;
            $html .= '<input type="text" name="' . $strHTMLControlName["VALUE"] . '[' . $i . ']" id="' . $strHTMLControlName["VALUE"] . '[' . $i . ']" value="' . htmlspecialcharsbx($val) . '" size="' . $fieldWidth . '" />';

            if ($showSort) {
                $html .= '<input type="text" name="' . $strHTMLControlName["SORT"] . '[' . $i . ']" id="' . $strHTMLControlName["SORT"] . '[' . $i . ']" value="' . htmlspecialcharsbx($sort) . '" size="3" />';
            }

            $html .= '<br />';
        }

        $html .= '<input type="button" value="' . GetMessage("IBLOCK_PROP_MULTIPLE_CUSTOM_ADD") . '" onclick="jsAddNewField(\'' . $arProperty["ID"] . '\', \'' . $strHTMLControlName["FORM_NAME"] . '\', \'' . $strHTMLControlName["VALUE"] . '\')" />';

        return $html;
    }

    // Функция для сохранения значений свойства в базу данных
    public static function ConvertToDB($arProperty, $value) {
        if ($value["VALUE"] !== "") {
            $value["VALUE"] = serialize($value);
        }
        return $value;
    }

    // Функция для извлечения значений свойства из базы данных
    public static function ConvertFromDB($arProperty, $value) {
        if ($value["VALUE"] !== "") {
            $value["VALUE"] = unserialize($value);
        }
        return $value;
    }

    // Функция для получения значений свойства по фильтру
    public static function GetPropertyFieldHtmlMulty($arProperty, $value, $strHTMLControlName) {
        $showSort = $arProperty["USER_TYPE_SETTINGS"]["SHOW_SORT"] == "Y";
        $fieldWidth = intval($arProperty["USER_TYPE_SETTINGS"]["FIELD_WIDTH"]);

        if ($fieldWidth < 1) $fieldWidth = 20;

        $html = "";
        foreach ($value as $val) {
            $html .= '<input type="text" name="' . $strHTMLControlName["VALUE"] . '[' . $val["ID"] . ']" id="' . $strHTMLControlName["VALUE"] . '[' . $val["ID"] . ']" value="' . htmlspecialcharsbx($val["VALUE"]) . '" size="' . $fieldWidth . '" />';

            if ($showSort) {
                $html .= '<input type="text" name="' . $strHTMLControlName["SORT"] . '[' . $val["ID"] . ']" id="' . $strHTMLControlName["SORT"] . '[' . $val["ID"] . ']" value="' . htmlspecialcharsbx($val["SORT"]) . '" size="3" />';
            }

            $html .= '<br />';
        }

        return $html;
    }

    // Функция для отображения настроек свойства в форме редактирования свойства
    public static function GetPropertyFieldHtmlSettings($arProperty) {
        $fieldCount = intval($arProperty["USER_TYPE_SETTINGS"]["FIELD_COUNT"]);
        $showSort = $arProperty["USER_TYPE_SETTINGS"]["SHOW_SORT"] == "Y";
        $fieldWidth = intval($arProperty["USER_TYPE_SETTINGS"]["FIELD_WIDTH"]);

        if ($fieldCount < 1) $fieldCount = 1;
        if ($fieldWidth < 1) $fieldWidth = 20;

        $html = "";

        $html .= '<tr><td>' . GetMessage("IBLOCK_PROP_MULTIPLE_CUSTOM_FIELD_COUNT") . ':</td><td>';
        $html .= '<input type="text" name="[USER_TYPE_SETTINGS][FIELD_COUNT]" id="[USER_TYPE_SETTINGS][FIELD_COUNT]" value="' . htmlspecialcharsbx($fieldCount) . '" size="5" />';
        $html .= '</td></tr>';

        $html .= '<tr><td>' . GetMessage("IBLOCK_PROP_MULTIPLE_CUSTOM_SHOW_SORT") . ':</td><td>';
        $html .= '<input type="checkbox" name="[USER_TYPE_SETTINGS][SHOW_SORT]" id="[USER_TYPE_SETTINGS][SHOW_SORT]" value="Y" ' . ($showSort ? 'checked="checked"' : '') . ' />';
        $html .= '</td></tr>';

        $html .= '<tr><td>' . GetMessage("IBLOCK_PROP_MULTIPLE_CUSTOM_FIELD_WIDTH") . ':</td><td>';
        $html .= '<input type="text" name="[USER_TYPE_SETTINGS][FIELD_WIDTH]" id="[USER_TYPE_SETTINGS][FIELD_WIDTH]" value="' . htmlspecialcharsbx($fieldWidth) . '" size="5" />';
        $html .= '</td></tr>';

        return $html;
    }
}
