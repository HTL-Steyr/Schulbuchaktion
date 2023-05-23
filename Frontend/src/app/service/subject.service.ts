import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Subject} from "../model/subject";
import {Observable} from "rxjs";
import { FindAll } from './findAll';
import { UserService } from './user.service';

@Injectable({
  providedIn: 'root'
})
export class SubjectService implements FindAll<Subject>{
  private readonly baseUrl = 'http://schulbuch.rathgeb.at/subject';
  constructor(private _http: HttpClient, private userService: UserService) { }

  update(id: number, data: Subject): Observable<Subject> {
    return this._http.put<Subject>(`${this.baseUrl}/update/${id}`, data, {headers: this.userService.getAuthorizationHeader()});
  }

  public delete(key: any): Observable<Subject> {
    throw new Error('Method not implemented.');
  }

  public findAll(): Observable<Subject[]> {
        return this._http.get<Subject[]>(this.baseUrl, {headers: this.userService.getAuthorizationHeader()});
  }

  public findOneById(id: number): Observable<Subject> {
      let idUrl = `${this.baseUrl}/${id}`;
      return this._http.get<Subject>(idUrl);
  }
}
