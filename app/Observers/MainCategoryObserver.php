<?php

namespace App\Observers;

use App\Models\Main_Category;

class MainCategoryObserver
{
    /**
     * Handle the Main_Category "created" event.
     */
    public function created(Main_Category $main_Category): void
    {
        //
    }

    /**
     * Handle the Main_Category "updated" event.
     */
    public function updated(Main_Category $main_Category): void
    {
        $main_Category->vendors()->update(['active' => $main_Category->active]); //vendorsتتغير معاه تفعيل ال category عشان لما نغير تفعيل ال 
    }

    /**
     * Handle the Main_Category "deleted" event.
     */
    public function deleted(Main_Category $main_Category): void
    {
        //
    }

    /**
     * Handle the Main_Category "restored" event.
     */
    public function restored(Main_Category $main_Category): void
    {
        //
    }

    /**
     * Handle the Main_Category "force deleted" event.
     */
    public function forceDeleted(Main_Category $main_Category): void
    {
        //
    }
}
