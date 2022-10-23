<?php

namespace App\Http\Livewire\Invoice;

use App\Models\MSalesorderSewa;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Rules\Rule;

final class SoSewaTable extends PowerGridComponent
{
    use ActionButton;

    //Messages informing success/error data is updated.
    public bool $showUpdateMessages = true;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): void
    {
        $this->showPerPage();
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
    * PowerGrid datasource.
    *
    * @return  \Illuminate\Database\Eloquent\Builder<\App\Models\MSalesorderSewa>|null
    */
    public function datasource(): ?Builder
    {
        return MSalesorderSewa::join('customers','m_salesorder_sewas.customer_id','customers.id')
        ->select('m_salesorder_sewas.*','customers.nama_customer');
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    */
    public function addColumns(): ?PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('noso')
            ->addColumn('tgl_so_formatted', function(MSalesorderSewa $model) {
                return Carbon::parse($model->tgl_so)->format('d/m/Y');
            })
            ->addColumn('marketing')
            ->addColumn('pembayaran')
            ->addColumn('jatuh_tempo_formatted', function(MSalesorderSewa $model) {
                return Carbon::parse($model->jatuh_tempo)->format('d/m/Y');
            })
            ->addColumn('customer_id')
            ->addColumn('nama_customer');
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

     /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::add()
                ->title('NOSO')
                ->field('noso')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('TGL SO')
                ->field('tgl_so_formatted', 'tgl_so')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker('tgl_so'),

            Column::add()
                ->title('CUSTOMER')
                ->field('nama_customer')
                ->searchable()
                ->sortable()
                ->makeInputText(),

            Column::add()
                ->title('MARKETING')
                ->field('marketing')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('PEMBAYARAN')
                ->field('pembayaran')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('JATUH TEMPO')
                ->field('jatuh_tempo_formatted', 'jatuh_tempo')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker('jatuh_tempo'),

            Column::add()
                ->title('STATUS SO')
                ->field('status_so')
                ->sortable()
                ->searchable()
                ->makeInputText(),

        ]
;
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

     /**
     * PowerGrid MSalesorderSewa Action Buttons.
     *
     * @return array<int, \PowerComponents\LivewirePowerGrid\Button>
     */

    
    public function actions(): array
    {
       return [
            Button::add('invoice')
            ->caption(__('Invoice'))
            ->class('bg-green-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm w-36')
            ->openModal('invoice.invoice-modal',[
                'tipe_so' => 'Sewa',
                'so_id' => 'id'
            ]),
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

     /**
     * PowerGrid MSalesorderSewa Action Rules.
     *
     * @return array<int, \PowerComponents\LivewirePowerGrid\Rules\RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [
           
           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($m-salesorder-sewa) => $m-salesorder-sewa->id === 1)
                ->hide(),
        ];
    }
    */

    /*
    |--------------------------------------------------------------------------
    | Edit Method
    |--------------------------------------------------------------------------
    | Enable the method below to use editOnClick() or toggleable() methods.
    | Data must be validated and treated (see "Update Data" in PowerGrid doc).
    |
    */

     /**
     * PowerGrid MSalesorderSewa Update.
     *
     * @param array<string,string> $data
     */

    /*
    public function update(array $data ): bool
    {
       try {
           $updated = MSalesorderSewa::query()->findOrFail($data['id'])
                ->update([
                    $data['field'] => $data['value'],
                ]);
       } catch (QueryException $exception) {
           $updated = false;
       }
       return $updated;
    }

    public function updateMessages(string $status = 'error', string $field = '_default_message'): string
    {
        $updateMessages = [
            'success'   => [
                '_default_message' => __('Data has been updated successfully!'),
                //'custom_field'   => __('Custom Field updated successfully!'),
            ],
            'error' => [
                '_default_message' => __('Error updating the data.'),
                //'custom_field'   => __('Error updating custom field.'),
            ]
        ];

        $message = ($updateMessages[$status][$field] ?? $updateMessages[$status]['_default_message']);

        return (is_string($message)) ? $message : 'Error!';
    }
    */
}
