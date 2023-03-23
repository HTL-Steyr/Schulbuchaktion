import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { NotFoundComponent } from './not-found/not-found.component';
import { OrderlistComponent } from './orderlist/orderlist.component';
import { ClassesOverviewComponent } from "./classes-overview/classes-overview.component";
import { LoginComponent } from "./login/login.component";
import { XlsImportComponent } from './xls-import/xls-import.component';
import { LoginErrorAlertComponent } from "./login-error-alert/login-error-alert.component";

const routes: Routes = [
    { path: '', redirectTo: '/login', pathMatch: 'full' },
    { path: 'bestelluebersicht', component: OrderlistComponent },
    { path: 'klassenuebersicht', component: ClassesOverviewComponent },
    { path: 'login', component: LoginComponent },
    { path: 'import', component: XlsImportComponent },
    { path: 'gelduebersicht', component: MoneyViewComponent },
    { path: 'loginerror', component: LoginErrorAlertComponent },
    { path: '**', component: NotFoundComponent },
]

@NgModule({
    imports: [RouterModule.forRoot(routes)],
    exports: [RouterModule]
})
export class AppRoutingModule {
}

import { MoneyViewComponent } from "./money-view/money-view.component";
