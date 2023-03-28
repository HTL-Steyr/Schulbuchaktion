import { Injectable } from '@angular/core';
import {Book} from "../model/book";
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";

@Injectable({
  providedIn: 'root'
})
export class BookService {
  // No Interface defined for Book so will not program it our for now
  private readonly baseUrl = '../book';
  constructor(private _http: HttpClient) { }

  public findAll(): Observable<Book[]> {
    throw new Error("Method not implemented")
  }

  public findOneById(): Observable<Book> {
    throw new Error("Method not implemented")
  }
}
