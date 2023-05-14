import {Subject} from "./subject";
import {BookOrder} from "./bookOrder";
import {Publisher} from "./publisher";
import {BookPrice} from "./bookPrice";
import {SchoolGrade} from "./schoolGrade";
import {DisplayNames} from "../utils/displayNames";

export interface Book {
  id?: number;
  bookNumber?: number;
  title: string;
  shortTitle?: string;
  listType?: number;
  schoolForm?: number;
  info?: string;
  ebook?: boolean;
  ebookPlus?: boolean;
  subject?: Subject;
  publisher?: Publisher;
  bookOrders: BookOrder[];
  schoolGrade: SchoolGrade[];
  bookPrices: BookPrice[];
  mainBook?: Book;
  childBooks?: Book[];
}


export const BOOK_DISPLAY_NAMES: DisplayNames<Book> = {
  object: "Buch",
  id: "ID",
  bookNumber: "BNR",
  title: "Titel",
  shortTitle: "Kurztitel",
  listType: "Listtyp",
  schoolForm: "Schulform",
  info: "Anmerkung",
  ebook: "E-Book",
  ebookPlus: "E-Book+",
  subject: "Gegenstand",
  publisher: "Verlag",
  bookOrders: "Bestellungen",
  schoolGrade: "Jahrgang",
  bookPrices: "Buchpreise",
  mainBook: "Hauptbuch",
  childBooks: "childBooks",
}
