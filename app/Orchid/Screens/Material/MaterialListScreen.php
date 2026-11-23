<?php
declare(strict_types=1);

namespace App\Orchid\Screens\Material;

use App\Models\Material;
use App\Orchid\Layouts\Material\MaterialListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

/**
 * Экран списка материалов (Screen = «страница с мозгами»).
 *
 * Открывается по адресу /admin/materials (маршрут platform.materials).
 * Порядок работы: query() достаёт данные → layout() говорит, чем их показать.
 */
class MaterialListScreen extends Screen
{
    /**
     * Шаг 1. Достаём данные для страницы.
     *
     * Ключ 'materials' — «надпись на коробке». MaterialListLayout
     * найдёт данные по этому ключу (у него $target = 'materials').
     * filters() — сортировка/фильтр из таблицы, paginate() — разбивка на страницы.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'materials' => Material::filters()->defaultSort('name')->paginate(),
        ];
    }

    /**
     * Заголовок страницы.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Материалы';
    }

    /**
     * Кнопки в правом верхнем углу.
     *
     * «Добавить» — обычная ссылка на создание нового материала.
     * Id не нужен, потому что материала ещё нет (поэтому create, а не edit).
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Добавить')->icon('bs.plus-circle')
            ->route('platform.materials.create'),
        ];
    }

    /**
     * Шаг 2. Из чего состоит страница.
     *
     * Здесь только таблица. Данные из query() Orchid передаст ей сам.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            MaterialListLayout::class,
        ];
    }
}
