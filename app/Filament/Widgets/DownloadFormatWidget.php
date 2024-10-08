<?php

namespace App\Filament\Widgets;

use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Form;
use Filament\Widgets\Widget;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class DownloadFormatWidget extends Widget implements HasForms
{
    use InteractsWithForms;
    protected static string $view = 'filament.widgets.download-format-widget';
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Actions::make([
                    Action::make('download surat keterangan aktif')
                        ->action(function () {
                            return response()->download(public_path('surataktif.doc '));
                        })
                ])
            ])
            ->statePath('data');
    }
}
