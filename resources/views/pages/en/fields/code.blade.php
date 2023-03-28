<x-page title="Code">

<x-p>Code Editor</x-p>

<x-code language="php">
use Leeto\MoonShine\Fields\Code;

//...
public function fields(): array
{
    return [
        Code::make('Code', 'code')
            ->language('js')
            ->lineNumbers()
    ];
}

//...
</x-code>

<x-image src="{{ asset('screenshots/code.png') }}"></x-image>

</x-page>


