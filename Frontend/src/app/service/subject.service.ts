import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Subject} from "../model/subject";
import {Observable} from "rxjs";

@Injectable({
  providedIn: 'root'
})
export class SubjectService {
  constructor(private _http: HttpClient) { }

  public findAll(): Observable<Subject[]> {
    throw new Error("Method not implemented")
  }

  public findOneById(): Observable<Subject> {
    throw new Error("Method not implemented")
  }
}
