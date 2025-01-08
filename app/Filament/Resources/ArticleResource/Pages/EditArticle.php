<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Notifications\Notification;

class EditArticle extends EditRecord
{
    protected static string $resource = ArticleResource::class;

    public function save(bool $shouldRedirect = true, bool $shouldSendSaveNotification = true): void
    {
        Notification::make()
            ->title('Changes saved')
            ->success()
            ->body('Your changes have been saved!')
            ->sendToDatabase(auth()->user());

        parent::save($shouldRedirect, $shouldSendSaveNotification);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
