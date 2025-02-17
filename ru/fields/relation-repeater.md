# RelationRepeater

- [Основы](#basics)
- [Набор полей](#fields)
- [Вертикальный режим](#vertical)
- [Добавление/Удаление](#creatable-removable)
- [Кнопки](#buttons)
- [Модификаторы](#modify)

---

<a name="basics"></a>
## Основы

Содержит все [Базовые методы](/docs/{{version}}/fields/basic-methods).

Поле `RelationRepeater` предназначено для работы с отношениями `HasMany` и `HasOne`.
Оно позволяет создавать, редактировать и удалять связанные записи прямо из формы основной модели.

> [!NOTE]
> Поле автоматически синхронизирует связанные записи при сохранении основной модели.

```php
make(
    string|Closure $label,
    ?string $relationName = null,
    string|Closure|null $formatted = null,
    ModelResource|string|null $resource = null,
)
```

- `$label` - заголовок поля,
- `$relationName` - имя отношения,
- `$formatted` - замыкание для форматирования значения поля в режиме "preview",
- `$resource` - ресурс связанной модели.

```php
use MoonShine\Laravel\Fields\Relationships\RelationRepeater;

RelationRepeater::make(
    'Characteristics',
    'characteristics',
    resource: CharacteristicResource::class
)
```

<a name="fields"></a>
## Набор полей

По умолчанию поле использует все поля формы из указанного ресурса.
Однако вы можете переопределить набор полей с помощью метода `fields()`.

```php
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Switcher;
use MoonShine\Laravel\Fields\Relationships\RelationRepeater;

RelationRepeater::make('Characteristics', 'characteristics')
    ->fields([
        ID::make(),
        Text::make('Name', 'name'),
        Text::make('Value', 'value'),
        Switcher::make('Active', 'is_active'),
    ])
```

> [!WARNING]
> Наличие поля `ID` обязательно, иначе записи будут всегда добавляться.

<a name="vertical"></a>
## Вертикальный режим

Метод `vertical()` изменяет отображение таблицы из горизонтального режима на вертикальный.

```php
vertical(Closure|bool|null $condition = null)
```

```php
RelationRepeater::make('Characteristics', 'characteristics')
    ->vertical()
```

<a name="creatable-removable"></a>
## Добавление/Удаление

По умолчанию поле позволяет добавлять новые элементы. Это поведение можно изменить с помощью метода `creatable()`:

```php
creatable(
    Closure|bool|null $condition = null,
    ?int $limit = null,
    ?ActionButtonContract $button = null
)
```

- `$condition` - условие, при котором метод должен быть применён,
- `$limit` - ограничение на количество возможных элементов,
- `$button` - возможность заменить кнопку добавления на свою.

Для возможности удаления элементов используется метод `removable()`.

```php
removable(
    Closure|bool|null $condition = null,
    array $attributes = []
)
```

```php
RelationRepeater::make('Characteristics', 'characteristics')
    ->creatable(limit: 5)
    ->removable()
```

<a name="buttons"></a>
## Кнопки

Метод `buttons()` позволяет переопределить кнопки, используемые в поле.

```php
use MoonShine\UI\Components\ActionButton;

RelationRepeater::make('Characteristics', 'characteristics')
    ->buttons([
        ActionButton::make('', '#')
            ->icon('trash')
            ->onClick(fn() => 'remove()', 'prevent')
            ->class('btn-error')
            ->showInLine()
    ])
```

<a name="modify"></a>
## Модификаторы

### Модификатор таблицы

Метод `modifyTable()` позволяет модифицировать таблицу (`TableBuilder`).

```php
use MoonShine\UI\Components\Table\TableBuilder;

RelationRepeater::make('Characteristics', 'characteristics')
    ->modifyTable(
        fn(TableBuilder $table, bool $preview) => $table
            ->customAttributes([
                'class' => 'custom-table'
            ])
    )
```

### Модификатор кнопки удаления

Метод `modifyRemoveButton()` позволяет изменить кнопку удаления.

```php
use MoonShine\UI\Components\ActionButton;

RelationRepeater::make('Characteristics', 'characteristics')
    ->modifyRemoveButton(
        fn(ActionButton $button) => $button
            ->customAttributes([
                'class' => 'btn-secondary'
            ])
    )
```
