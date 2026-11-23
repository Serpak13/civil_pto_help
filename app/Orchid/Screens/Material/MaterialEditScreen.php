<?php
declare(strict_types=1);

namespace App\Orchid\Screens\Material;

use App\Enums\Material\Unit;
use App\Models\Material;
use App\Orchid\Layouts\Material\MaterialEditLayout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

/**
 * Экран создания и редактирования материала (Screen = «страница с мозгами»).
 *
 * Один экран на два адреса:
 *  - /admin/materials/create      → новый материал (пустая модель);
 *  - /admin/materials/{id}/edit   → существующий материал.
 * Кнопки «Сохранить» и «Удалить» вызывают методы save() и remove() этого же класса.
 */
class MaterialEditScreen extends Screen
{
    /**
     * Сюда Orchid сам кладёт 'material' из query(),
     * чтобы в name() и commandBar() можно было проверить $this->material->exists.
     */
    public $material;

    /**
     * Шаг 1. Достаём данные.
     *
     * Laravel сам подставляет $material:
     *  - на /create — пустую новую модель (exists = false);
     *  - на /{id}/edit — материал, найденный по UUID (exists = true).
     * Ключ 'material' потом используют поля формы ('material.name' и т.д.).
     *
     * @return array
     */
    public function query(Material $material): iterable
    {
        return [
            'material' => $material,
        ];
    }

    /**
     * Заголовок зависит от того, новый материал или существующий.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->material->exists ? 'Редактировать материал' : 'Создать материал';
    }

    /**
     * Кнопки в правом верхнем углу.
     *
     * ->method('save') значит: при нажатии вызвать метод save() этого экрана.
     * ->canSee(...) прячет «Удалить», пока материал не сохранён.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Удалить')->icon('bs.trash3')
                ->confirm('Вы уверены, что хотите удалить материал?')
                ->method('remove')
                ->canSee($this->material->exists),

            Button::make('Сохранить')->icon('bs.check-circle')
                ->method('save'),
        ];
    }

    /**
     * Шаг 2. Из чего состоит страница.
     *
     * Форма MaterialEditLayout внутри карточки с заголовком «Материал».
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::block(MaterialEditLayout::class)
                ->title('Материал')
        ];
    }

    /**
     * Действие кнопки «Сохранить».
     *
     * 1) проверяем поля (при ошибке Orchid вернёт форму и подсветит поле);
     * 2) переносим массив 'material' из формы в модель и сохраняем
     *    (новая модель → INSERT, существующая → UPDATE);
     * 3) показываем сообщение и возвращаемся в список.
     *
     * @param Material $material
     * @param Request $request
     * @return RedirectResponse
     */
    public function save(Material $material, Request $request): RedirectResponse
    {
        $request->validate([
            'material.name' => ['required', 'string', 'max:255'],
            'material.unit' => ['required', Rule::enum(Unit::class)]
        ]);

        $material->fill($request->input('material'))->save();

        Toast::info('Материал успешно сохранен');

        return redirect()->route('platform.materials');
    }

    /**
     * Действие кнопки «Удалить»: удаляем материал и возвращаемся в список.
     *
     * @param Material $material
     * @return RedirectResponse
     */
    public function remove(Material $material): RedirectResponse
    {
        $material->delete();

        Toast::info('Материал успешно удален');

        return redirect()->route('platform.materials');
    }
}
