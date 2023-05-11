import {Book} from "./book";
import {DisplayNames} from "../utils/displayNames";

export interface BookPrice {
  id?: number;
  year?: number;
  priceInclusiveEbook?: number;
  priceEbook?: number;
  priceEbookPlus?: number;
  book?: Book;
}

export const BOOK_PRICE_DISPLAY_NAMES: DisplayNames<BookPrice> = {
  object: "Buchpreis",
  id: "ID",
  year: "Jahr",
  priceInclusiveEbook: "Preis inkl. E-Book",
  priceEbook: "Preis E-Book",
  priceEbookPlus: "Preis E-Book+",
  book: "Buch",
}
