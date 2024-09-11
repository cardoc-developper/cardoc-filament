<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehicleResource\Pages;
use App\Filament\Resources\VehicleResource\RelationManagers;
use App\Models\Vehicle;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('Vehicle')
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->label('Vehicle Name')
                                ->required()
                                ->maxLength(255),

                            Forms\Components\Select::make('type')
                                ->label('Type')
                                ->options([
                                    'Car' => 'Car',
                                    'Motorcycle' => 'Motorcycle',
                                    'Other' => 'Other',
                                ])
                                ->native(false)
                                ->required(),
                        ]),
                    Forms\Components\Wizard\Step::make('Brand Information')
                        ->schema([

                            Forms\Components\TextInput::make('license_plate')
                                ->label('License Plate')
                                ->required()
                                ->maxLength(255),
                                // TODO: Add autocomplete for brandm model and vin

                            Forms\Components\TextInput::make('brand')
                                ->label('Brand')
                                ->required()
                                ->maxLength(255),

                            Forms\Components\TextInput::make('model')
                                ->label('Model')
                                ->required()
                                ->maxLength(255),

                            Forms\Components\TextInput::make('vin')
                                ->label('VIN')
                                ->maxLength(255),
                        ]),

                    Forms\Components\Wizard\Step::make('Vehicle Details')
                        ->schema([
                            Forms\Components\TextInput::make('color')
                                ->label('Color'),

                            Forms\Components\TextInput::make('mileage')
                                ->label('Mileage')
                                ->numeric()
                                ->maxLength(255),

                            Forms\Components\Select::make('energy')
                                ->label('Energy')
                                ->options([
                                    // TODO: Set enum values for energy
                                    'Gasoline' => 'Gasoline',
                                    'Diesel' => 'Diesel',
                                    'Electric' => 'Electric',
                                    'Hybrid' => 'Hybrid',
                                    'Other' => 'Other',
                                ])
                                ->native(false)
                                ->required(),
                            Forms\Components\DatePicker::make('date_of_registration')
                                ->label('Date of Registration'),
                            Forms\Components\DatePicker::make('date_of_purchase')
                                ->label('Date of Purchase'),

                            Forms\Components\TextInput::make('number_of_owner')
                                ->label('Number of Owner')
                                ->numeric()
                                ->maxLength(255),
                        ]),

                    Forms\Components\Wizard\Step::make('Attachments')
                        ->schema([
                            Forms\Components\FileUpload::make('images')
                                ->label('Images')
                                ->multiple()
                                ->maxFiles(12)
                                ->directory('/' . auth()->user()->id . '/vehicles/')
                                ->acceptedFileTypes(['image/*']),
                            Forms\Components\FileUpload::make('attachments')
                                ->label('Attachments')
                                ->acceptedFileTypes(['application/pdf', 'image/*'])
                                ->multiple(),
                        ]),
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('license_plate')
                    ->searchable(),
                Tables\Columns\TextColumn::make('brand')
                    ->searchable(),
                Tables\Columns\TextColumn::make('model')
                    ->searchable(),
                Tables\Columns\TextColumn::make('color')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_of_registration')
                    ->date()
                    ->searchable(),
                Tables\Columns\TextColumn::make('mileage')
                    ->suffix(' km')
                    ->searchable(),
                Tables\Columns\TextColumn::make('energy')
                    ->searchable(),
                Tables\Columns\TextColumn::make('vin')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('date_of_purchase')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('number_of_owner')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('images')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('attachments')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicle::route('/create'),
            'view' => Pages\ViewVehicle::route('/{record}'),
            'edit' => Pages\EditVehicle::route('/{record}/edit'),
        ];
    }
}
