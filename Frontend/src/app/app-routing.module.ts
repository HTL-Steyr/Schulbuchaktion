import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {MoneyViewComponent} from "./money-view/money-view.component";
import {RouterModule, Routes} from "@angular/router";


const routes: Routes = [
  {path: '', redirectTo: '/GeldUebersicht', pathMatch: 'full'},
  {path: 'money-view', component: MoneyViewComponent},
]

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
