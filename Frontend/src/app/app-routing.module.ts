import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { NotFoundComponent } from './not-found/not-found.component';
import { OrderlistComponent } from './orderlist/orderlist.component';
import {ClassesOverviewComponent} from "./classes-overview/classes-overview.component";

const routes: Routes = [
    {path: '', redirectTo: '/bestelluebersicht', pathMatch:'full'},
    {path: 'bestelluebersicht', component: OrderlistComponent},
  {path: 'klassenuebersicht', component:ClassesOverviewComponent},
  {path: '**', component: NotFoundComponent}, //LEAVE THIS LAST!
]

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
