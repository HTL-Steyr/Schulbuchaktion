import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {SchoolClass} from "../model/schoolclass";
import {Observable} from "rxjs";
import { FindAll } from './findAll';

@Injectable({
  providedIn: 'root'
})
export class SchoolclassService implements FindAll<SchoolClass>{
  private readonly baseUrl = '../schoolclass';
  constructor(private _http: HttpClient) { }

  public findAll(): Observable<SchoolClass[]> {
    return this._http.get<SchoolClass[]>(this.baseUrl);
  }

  public findOneById(id: number): Observable<SchoolClass> {
    let idUrl = `${this.baseUrl}/${id}`;
    return this._http.get<SchoolClass>(idUrl);
  }
}
