import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {SchoolClass} from "../model/schoolclass";

@Injectable({
  providedIn: 'root'
})
export class SchoolclassService {
  constructor(private _http: HttpClient) { }

  public async getAll(): Promise<SchoolClass[]> {
    throw new Error("Method not implemented")
  }

  public async getOneById(): Promise<SchoolClass> {
    throw new Error("Method not implemented")
  }
}
