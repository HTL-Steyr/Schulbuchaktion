import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {SchoolClass} from "../model/schoolclass";
import {Observable} from "rxjs";

@Injectable({
  providedIn: 'root'
})
export class SchoolclassService {
  constructor(private _http: HttpClient) { }

  public findAll(): Observable<SchoolClass[]> {
    throw new Error("Method not implemented")
  }

  public findOneById(): Observable<SchoolClass> {
    throw new Error("Method not implemented")
  }
}
