import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";

@Injectable({
  providedIn: 'root'
})
export class MoneylistService {
  constructor(private _http: HttpClient) { }

  public async getAll(): Promise<MoneylistEntry[]> {
    throw new Error("Method not implemented")
  }
}
