<?php

namespace Database\Seeders;

use App\Models\Appointments\Appointment;
use App\Models\Appointments\Preconsultation;
use App\Models\Appointments\PreconsultationField;
use App\Models\Consultation\Consultation;
use App\Models\Expenditures\Expenditure;
use App\Models\Payments\Payment;
use App\Models\Pharmacy\Category;
use App\Models\Pharmacy\Composition;
use App\Models\Pharmacy\Drug;
use App\Models\Pharmacy\DrugCompositionRelationship;
use App\Models\Pharmacy\Invoice\Invoice;
use App\Models\Pharmacy\Invoice\Item as InvoiceItem;
use App\Models\Pharmacy\Invoice\Returnn as InvoiceReturn;
use App\Models\Pharmacy\Purchase\Inventory as PurchaseInventory;
use App\Models\Pharmacy\Purchase\Item;
use App\Models\Pharmacy\Purchase\Order;
use App\Models\Pharmacy\Purchase\Returnn as PurchaseReturn;
use App\Models\Pharmacy\Supplier;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User\User;
use App\Models\User\UserCustomField;
use App\Models\User\UserCustomValue;
use App\Models\User\UserRoleRelation;
use Illuminate\Database\Seeder;

class DevTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        require __DIR__ . '/./sample-db.php';

        $migrations = array(
            array(
                'table' => $pharmacy_categories,
                'model' => new Category,
            ),
            array(
                'table' => $pharmacy_drugs,
                'model' => new Drug,
            ),
            array(
                'table' => $pharmacy_compositions,
                'model' => new Composition,
            ),
            array(
                'table' => $pharmacy_drug_composition_relationship,
                'model' => new DrugCompositionRelationship,
            ),
            array(
                'table' => $pharmacy_purchase_orders,
                'model' => new Order,
            ),
            array(
                'table' => $pharmacy_purchase_order_items,
                'model' => new Item,
            ),
            array(
                'table' => $pharmacy_purchase_order_inventory,
                'model' => new PurchaseInventory,
            ),
            array(
                'table' => $pharmacy_purchase_order_returns,
                'model' => new PurchaseReturn,
            ),
            array(
                'table' => $pharmacy_suppliers,
                'model' => new Supplier,
            ),
            array(
                'table' => $pharmacy_invoices,
                'model' => new Invoice,
            ),
            array(
                'table' => $pharmacy_invoice_items,
                'model' => new InvoiceItem,
            ),
            array(
                'table' => $pharmacy_invoice_returns,
                'model' => new InvoiceReturn,
            ),
            array(
                'table' => $roles,
                'model' => new Role,
            ),
            array(
                'table' => $settings,
                'model' => new Setting,
            ),
            array(
                'table' => $user_custom_fields,
                'model' => new UserCustomField,
            ),
            array(
                'table' => $user_custom_values,
                'model' => new UserCustomValue,
            ),
            array(
                'table' => $preconsultation_fields,
                'model' => new PreconsultationField,
            ),
            array(
                'table' => $appointment_preconsultations,
                'model' => new Preconsultation,
            ),
            array(
                'table' => $appointments,
                'model' => new Appointment,
            ),
            array(
                'table' => $user_role_relation,
                'model' => new UserRoleRelation,
            ),
            array(
                'table' => $payments,
                'model' => new Payment,
            ),
            array(
                'table' => $expenditures,
                'model' => new Expenditure,
            ),
            array(
                'table' => $consultations,
                'model' => new Consultation,
            ),
        );

        foreach ($users as $item) {
            $row = new User;
            foreach ($item as $key => $value) {
                if ($key === 'password') {
                    $value = 'Password@123';
                }
                $row->$key = $value;
            }
            $row->save();
        }
      
        foreach ($migrations as $migration) {
            $items = $migration['table'];
            $model = $migration['model'];
            foreach ($items as $index => $item) {
                $row = clone $model;
                foreach ($item as $key => $value) {
                    $row->$key = $value;
                }
                $row->save();

            }

        }
    }

}
