<?php
declare(strict_types=1);

namespace App\Orchid\Layouts\Material;

use App\Enums\Material\Unit;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

/**
 * Форма материала (Layout = «как выглядит»).
 *
 * Описывает только поля формы. Показывает её MaterialEditScreen,
 * он же сохраняет данные при нажатии кнопки.
 */
class MaterialEditLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Поля формы.
     *
     * Имена вида 'material.name' значат две вещи:
     * 1) при открытии Orchid берёт 'material' из MaterialEditScreen::query()
     *    и сам подставляет в поле значение $material->name;
     * 2) при сохранении все поля приходят одним массивом
     *    $request->input('material') = ['name' => ..., 'unit' => ..., ...].
     *
     * @return iterable
     * @throws \ReflectionException
     */
    protected function fields(): iterable
    {

        return [
            Input::make('material.name')->title('Название')->required(),
            Input::make('material.grade')->title('Марка / характеристика'),
            Input::make('material.standard')->title('ГОСТ / ТУ'),

            // Выпадающий список из enum Unit: человек видит label() ('кг'),
            // а на сервер уходит код ('kg'). Поэтому Select, а не Input.
            Select::make('material.unit')->title('Единица измерения')
                ->fromEnum(Unit::class, 'label'),

            Input::make('material.manufacturer')->title('Производитель'),
            TextArea::make('material.description')->title('Описание')->rows(3),
        ];
    }
}
