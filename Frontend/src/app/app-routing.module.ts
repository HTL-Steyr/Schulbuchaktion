import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { NotFoundComponent } from './not-found/not-found.component';
import { OrderlistComponent } from './orderlist/orderlist.component';
import {LoginComponent} from "./login/login.component";

const routes: Routes = [
    {path: '', redirectTo: '/bestelluebersicht', pathMatch:'full'},
    {path: 'bestelluebersicht', component: OrderlistComponent},
    {path: 'login', component: LoginComponent},
    {path: '**', component: NotFoundComponent},
]

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
