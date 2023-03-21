import {Book} from "./book";

export interface BookPrice {
  id?: number;
  year?: number;
  priceInclusiveEbook?: number;
  priceEbook?: number;
  priceEbookPlus?: number;
  book?: Book;
}
