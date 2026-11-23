<?php
declare(strict_types=1);

namespace App\Orchid\Layouts\Material;

use App\Enums\Material\Unit;
use App\Models\Material;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

/**
 * Таблица материалов (Layout = «как выглядит»).
 *
 * Сам в базу не ходит. Данные ему отдаёт MaterialListScreen через query(),
 * а эта таблица только описывает, какие колонки показать.
 */
class MaterialListLayout extends Table
{
    /**
     * Откуда брать строки таблицы.
     *
     * Это ключ из массива, который вернул MaterialListScreen::query().
     * Там написано 'materials' => ..., поэтому и здесь 'materials'.
     * Если слова не совпадут, таблица будет пустой.
     *
     * @var string
     */
    protected $target = 'materials';

    /**
     * Колонки таблицы.
     *
     * TD::make('поле в модели', 'Заголовок колонки').
     * Без ->render() просто выводится значение поля.
     * ->render(fn ...) позволяет вывести что-то своё (ссылку, подпись и т.п.).
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            // Название: можно сортировать (->sort), фильтровать (->filter)
            // и кликнуть, чтобы перейти на экран редактирования этого материала.
            TD::make('name', 'Название')
                ->sort()
                ->filter(Input::make())
                ->render(fn (Material $material) => Link::make($material->name)
                ->route('platform.materials.edit', $material)),
            TD::make('grade', 'Марка'),
            TD::make('standard', 'ГОСТ / ТУ'),

            // В базе лежит код ('kg'), а показываем человеку подпись ('кг').
            TD::make('unit', 'Ед. измерения')
                ->render(fn (Material $material) => Unit::getName($material->unit->value)),

            TD::make('manufacturer', 'Производитель'),
        ];
    }
}
