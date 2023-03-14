import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Department} from "../model/department";

@Injectable({
  providedIn: 'root'
})
export class DepartmentService {
  constructor(private _http: HttpClient) { }

  public async getAll(): Promise<Department[]> {
    throw new Error("Method not implemented")
  }

  public async getOneById(): Promise<Department> {
    throw new Error("Method not implemented")
  }
}
