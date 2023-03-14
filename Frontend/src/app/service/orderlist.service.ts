import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";

@Injectable({
  providedIn: 'root'
})
export class OrderlistService {
  constructor(private _http: HttpClient) { }

  public async getAll(): Promise<OrderlistEntry[]> {
    throw new Error("Method not implemented")
  }
}
