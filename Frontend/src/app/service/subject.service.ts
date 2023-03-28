import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Subject} from "../model/subject";
import {Observable} from "rxjs";

@Injectable({
  providedIn: 'root'
})
export class SubjectService {
  private readonly baseUrl = '../subject';
  constructor(private _http: HttpClient) { }

  public findAll(): Observable<Subject[]> {
        return this._http.get<Subject[]>(this.baseUrl);
  }

  public findOneById(id: number): Observable<Subject> {
      let idUrl = `${this.baseUrl}/${id}`;
      return this._http.get<Subject>(idUrl);
  }
}
