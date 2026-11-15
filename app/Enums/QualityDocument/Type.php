<?php
declare(strict_types=1);

namespace App\Enums\QualityDocument;

enum Type: int
{
    case QUALITY_CERTIFICATE = 0; //-- Сертификат качества
    case QUALITY_PASSPORT = 1; //-- Паспорт качества
    case CERTIFICATE_OF_CONFORMITY = 2; //-- Сертификат соответствия
    case DECLARATION = 3; //-- Декларация
    case TEST_REPORT = 4; //-- Протокол испытаний
    case LETTER_OF_REFUSAL = 5; //-- Отказное письмо


    /**
     * @param int $value
     * @return string
     */
    public function getName(int $value): string
    {
        return match ($value) {
            self::QUALITY_CERTIFICATE->value => __('quality_document.type.quality_certificate'),
            self::QUALITY_PASSPORT->value => __('quality_document.type.quality_passport'),
            self::CERTIFICATE_OF_CONFORMITY->value => __('quality_document.type.certificate_of_conformity'),
            self::DECLARATION->value => __('quality_document.type.declaration'),
            self::TEST_REPORT->value => __('quality_document.type.test_report'),
            self::LETTER_OF_REFUSAL->value => __('quality_document.type.letter_of_refusal'),
            default => __('quality_document.type.unknow_type'),
        };
    }

}
