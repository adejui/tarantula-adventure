<?php

namespace App\Http\View\Composers;

use App\Models\Loan;
use Illuminate\View\View;

class LoanNotificationComposer
{
    public function compose(View $view)
    {
        $view->with(
            'notifLoans',
            Loan::where('status', 'requested')->get()
        );
    }
}
