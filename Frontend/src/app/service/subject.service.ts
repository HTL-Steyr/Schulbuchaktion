import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Subject} from "../model/subject";

@Injectable({
  providedIn: 'root'
})
export class SubjectService {
  constructor(private _http: HttpClient) { }

  public async getAll(): Promise<Subject[]> {
    throw new Error("Method not implemented")
  }

  public async getOneById(): Promise<Subject> {
    throw new Error("Method not implemented")
  }
}
