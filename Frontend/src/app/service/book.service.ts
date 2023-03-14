import { Injectable } from '@angular/core';
import {Book} from "../model/book";
import {HttpClient} from "@angular/common/http";

@Injectable({
  providedIn: 'root'
})
export class BookService {
  constructor(private _http: HttpClient) { }

  public async getAll(): Promise<Book[]> {
    throw new Error("Method not implemented")
  }

  public async getOneById(): Promise<Book> {
    throw new Error("Method not implemented")
  }
}
