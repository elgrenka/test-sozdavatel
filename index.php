<?php
// Подключаем модуль инфоблоков
CModule::IncludeModule("iblock");

class CMyIblockListComponent extends CBitrixComponent {
    public function onPrepareComponentParams($arParams) {
        if (!isset($arParams["IBLOCK_ID"]) || intval($arParams["IBLOCK_ID"]) <= 0) {
            $arParams["IBLOCK_ID"] = 0;
        }

        if (!isset($arParams["CACHE_TIME"]) || intval($arParams["CACHE_TIME"]) <= 0) {
            $arParams["CACHE_TIME"] = 3600;
        }

        return $arParams;
    }

    // Функция для получения списка элементов инфоблока
    public function getElements() {
        $arSelect = array(
            "ID",
            "NAME",
            "PREVIEW_TEXT",
            "IBLOCK_SECTION_ID"
        );

        $arFilter = array(
            "IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
            "ACTIVE" => "Y"
        );

        $arOrder = array(
            "SORT" => "ASC",
            "NAME" => "ASC"
        );

        $rsElements = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
        $arElements = array();
        $arSectionsIds = array();

        while ($arElement = $rsElements->GetNext()) {
            $arElements[] = $arElement;

            if ($arElement["IBLOCK_SECTION_ID"] > 0 && !in_array($arElement["IBLOCK_SECTION_ID"], $arSectionsIds)) {
                $arSectionsIds[] = $arElement["IBLOCK_SECTION_ID"];
            }
        }

        return array($arElements, $arSectionsIds);
    }

    // Функция для получения списка разделов инфоблока по их ID
    public function getSectionsByIds($arSectionsIds) {
        $arSelect = array(
            "ID",
            "NAME"
        );

        $arFilter = array(
            "IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
            "ID" => $arSectionsIds
        );

        $rsSections = CIBlockSection::GetList(false, $arFilter, false, $arSelect);
        $arSections = array();

        while ($arSection = $rsSections->GetNext()) {
            $arSections[$arSection["ID"]] = $arSection;
        }

        return $arSections;
    }

    // Функция для выполнения логики компонента
    public function executeComponent() {
        if ($this->StartResultCache()) {
            list($arElements, $arSectionsIds) = $this->getElements();

            $arSections = $this->getSectionsByIds($arSectionsIds);
            $this->arResult["ITEMS"] = $arElements;
            $this->arResult["SECTIONS"] = $arSections;
            $this->IncludeComponentTemplate();
        }
    }
}

$component = new CMyIblockListComponent();
$component->executeComponent();

