import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Department} from "../model/department";
import {Observable} from "rxjs";

@Injectable({
  providedIn: 'root'
})
export class DepartmentService {
  constructor(private _http: HttpClient) { }

  public findAll(): Observable<Department[]> {
    throw new Error("Method not implemented")
  }

  public findOneById(): Observable<Department> {
    throw new Error("Method not implemented")
  }
}
