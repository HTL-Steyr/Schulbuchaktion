import { Injectable } from '@angular/core';
import {Book} from "../model/book";
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";

@Injectable({
  providedIn: 'root'
})
export class BookService {
  constructor(private _http: HttpClient) { }

  public findAll(): Observable<Book[]> {
    throw new Error("Method not implemented")
  }

  public finOneById(): Observable<Book> {
    throw new Error("Method not implemented")
  }
}
