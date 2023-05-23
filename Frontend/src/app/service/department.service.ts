import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";
import { Department } from "../model/department";
import { Observable } from "rxjs";
import { FindAll } from './findAll';
import { UserService } from './user.service';

@Injectable({
  providedIn: 'root'
})
export class DepartmentService implements FindAll<Department>{
  private readonly baseUrl = '../departments';

  constructor(private _http: HttpClient, private userService: UserService) { }

  update(id: number, data: Department): Observable<Department> {
    return this._http.put<Department>(`${this.baseUrl}/update/${id}`, data, {headers: this.userService.getAuthorizationHeader()});
  }

  public delete(key: any): Observable<Department> {
    throw new Error('Method not implemented.');
  }

  public findAll(): Observable<Department[]> {
    return this._http.get<Department[]>(this.baseUrl);
  }

  public findOneById(id: number): Observable<Department> {
    let idUrl = `${this.baseUrl}/${id}`;
    return this._http.get<Department>(idUrl);
  }
}
