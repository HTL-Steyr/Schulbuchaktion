import {Book} from "./book";
import {SchoolClass} from "./schoolclass";
import {DisplayNames} from "../utils/displayNames";

export interface BookOrder {
  id?: number;
  price?: number;
  count?: number;
  ebook?: boolean;
  ebookPlus?: boolean;
  schoolClass?: SchoolClass;
  book?: Book;
  teacherCopy?: boolean;
}

export const BOOK_ORDER_DISPLAY_NAMES: DisplayNames<BookOrder> = {
  object: "Bestellung",
  id: "ID",
  price: "Preis",
  count: "Anzahl",
  ebook: "E-Book",
  ebookPlus: "E-Book+",
  schoolClass: "Klasse",
  book: "Buch",
  teacherCopy: "Lehrerexemplar",
}
